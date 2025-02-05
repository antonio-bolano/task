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
    #[OA\RequestBody(
        description: "Task creation details",
        required: true,
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                required: ["title", "description"],
                properties: [
                    new OA\Property(
                        property: "title",
                        type: "string",
                        maxLength: 255,
                        example: "Complete project report"
                    ),
                    new OA\Property(
                        property: "description",
                        type: "string",
                        example: "Finalize and submit the quarterly project report"
                    ),
                    new OA\Property(
                        property: "status",
                        type: "string",
                        enum: ["pending", "in_progress", "completed"],
                        example: "pending"
                    ),
                    new OA\Property(
                        property: "due_date",
                        type: "string",
                        format: "date",
                        example: "2024-12-31"
                    ),
                    new OA\Property(
                        property: "user_id",
                        type: "integer",
                        format: 1,
                        example: 1
                    )
                ]
            )
        )
    )]
    #[OA\Response(
        response: 200,
        description: "Task updated successfully",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                required: ["title", "description"],
                properties: [
                    new OA\Property(
                        property: "title",
                        type: "string",
                        maxLength: 255,
                        example: "Complete project report"
                    ),
                    new OA\Property(
                        property: "description",
                        type: "string",
                        example: "Finalize and submit the quarterly project report"
                    ),
                    new OA\Property(
                        property: "status",
                        type: "string",
                        enum: ["pending", "in_progress", "completed"],
                        example: "pending"
                    ),
                    new OA\Property(
                        property: "due_date",
                        type: "string",
                        format: "date",
                        example: "2024-12-31"
                    ),
                    new OA\Property(
                        property: "user_id",
                        type: "integer",
                        format: 1,
                        example: 1
                    )
                ]
            )
        )
    )]
    public function __invoke(Task $task, UpdateTaskRequest $request)
    {
        $task->update($request->validated());
    }
}
