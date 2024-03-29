<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\GetAllTasksRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')
            ->except([
                'index',
                'show',
            ]);
    }

    /**
     * Display a list of the tasks.
     */
    public function index(GetAllTasksRequest $request): JsonResponse
    {
        return TaskResource::collection(TaskService::getFilteredTasks($request))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Display the specified task.
     *
     * @param  Task  $task  Task to display.
     */
    public function show(Task $task): JsonResponse
    {
        return (new TaskResource($task))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Store a new task.
     */
    public function store(CreateTaskRequest $request): JsonResponse
    {
        return (new TaskResource(TaskService::createNewTask($request)))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Update the specified task.
     *
     * @param  Task  $task  Task to update.
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $this->authorize('update', $task);

        return (new TaskResource(TaskService::updateTask($request, $task)))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Delete the specified task.
     *
     * @param  Task  $task  Task to delete.
     */
    public function destroy(Task $task): Response
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()
            ->noContent()
            ->setStatusCode(204);
    }
}
