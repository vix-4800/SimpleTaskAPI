<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TaskService
{
    /**
     * Get filtered tasks
     */
    public function getFilteredTasks(Request $request): Collection
    {
        return Task::query()
            ->when($request->input('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->when($request->input('date'), fn ($query) => $query->where('due_date', $request->input('date')))
            ->get();
    }

    /**
     * Create new task
     */
    public function createNewTask(Request $request): Task
    {
        $validatedData = $request->validated();

        return Task::create([
            'user_id' => $request->user()->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'due_date' => $validatedData['date'],
        ]);
    }

    /**
     * Update task
     *
     * @param  Task  $task  Task to update
     */
    public function updateTask(Request $request, Task $task): Task
    {
        $validatedData = $request->validated();

        $task->update([
            'title' => $request->filled('title') ? $validatedData['title'] : $task->title,
            'description' => $request->filled('description') ? $validatedData['description'] : $task->description,
            'status' => $request->filled('status') ? $validatedData['status'] : $task->status,
            'due_date' => $request->filled('date') ? $validatedData['date'] : $task->due_date,
        ]);

        return $task;
    }
}
