<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class UpdateTaskController extends Controller
{
    #[OA\Put(
        path: "/api/tasks/{id}",
        summary: "Update a task",
        description: "Update details of an existing task",
        tags: ["Tasks"],
        security: [["bearerAuth" => []]]
    )]
    #[OA\Parameter(
        name: "id",
        in: "path",
        description: "Task ID",
        required: true,
        schema: new OA\Schema(type: "integer")
    )]
    #[OA\RequestBody(/* Similar to create request body */)]
    #[OA\Response(
        response: 200,
        description: "Task updated successfully",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    // Updated task properties
                ]
            )
        )
    )]
    public function __invoke(Task $task, UpdateTaskRequest $request)
    {
        $task->update($request->validated());
    }
}
