<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private TaskService $service
    ) {
        $this->middleware('auth:sanctum')
            ->except([
                'index',
                'show',
            ]);
    }

    public function index()
    {
        return TaskResource::collection(
            Task::all()
        );
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function store(CreateTaskRequest $request)
    {
        return new TaskResource(
            $this->service->createNewTask($request)
        );
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        return new TaskResource(
            $this->service->updateTask($request, $task)
        );
    }

    public function destroy(Request $request, Task $task)
    {
        $this->service->deleteTask($request, $task);

        return response()->noContent();
    }
}
