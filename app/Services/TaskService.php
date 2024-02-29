<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskService
{
    public function createNewTask(Request $request)
    {
        $validatedData = $request->validated();

        return Task::create([
            'user_id' => $request->user()->id,
            'title' => $validatedData["title"],
            'description' => $validatedData["description"],
            'status' => $validatedData["status"],
            'due_date' => $validatedData["date"],
        ]);
    }

    public function updateTask(Request $request, Task $task)
    {
        $this->checkOwnership($request->user(), $task, 'You are not allowed to update this task');

        $validatedData = $request->validated();

        return $task->update([
            'title' => $request->filled('title') ? $validatedData["title"] : $task->title,
            'description' => $request->filled('description') ? $validatedData["description"] : $task->description,
            'status' => $request->filled('status') ? $validatedData["status"] : $task->status,
            'due_date' => $request->filled('date') ? $validatedData["date"] : $task->due_date,
        ]);
    }

    public function deleteTask(Request $request, Task $task)
    {
        $this->checkOwnership($request->user(), $task, 'You are not allowed to delete this task');

        $task->delete();
    }

    private function checkOwnership($user, Task $task, string $errorMessage)
    {
        if (!$user->is($task->user)) {
            return response()->json([
                'status' => Response::HTTP_FORBIDDEN,
                'error' => 'Forbidden',
                'message' => $errorMessage,
            ]);
        }
    }
}
