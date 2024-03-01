<?php

namespace App\Services;

use App\Exceptions\NotTaskOwnerException;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskService
{
    public function createNewTask(Request $request)
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

    public function updateTask(Request $request, Task $task)
    {
        throw_unless($this->isOwner($request->user(), $task), new NotTaskOwnerException);

        $validatedData = $request->validated();

        $task->update([
            'title' => $request->filled('title') ? $validatedData['title'] : $task->title,
            'description' => $request->filled('description') ? $validatedData['description'] : $task->description,
            'status' => $request->filled('status') ? $validatedData['status'] : $task->status,
            'due_date' => $request->filled('date') ? $validatedData['date'] : $task->due_date,
        ]);

        return $task;
    }

    public function deleteTask(Request $request, Task $task)
    {
        throw_unless($this->isOwner($request->user(), $task), new NotTaskOwnerException);

        $task->delete();
    }

    private function isOwner($user, Task $task): bool
    {
        return $user->is($task->user);
    }
}
