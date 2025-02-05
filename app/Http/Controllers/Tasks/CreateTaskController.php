<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;

use OpenApi\Attributes as OA;

#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT"
)]
class CreateTaskController extends Controller
{
    #[OA\Post(
        path: "/api/tasks",
        summary: "Create a task",
        description: "Create a new task with specified details",
        tags: ["Tasks"],
        security: [["bearerAuth" => []]]
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
                    )
                ]
            )
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Task created successfully",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(property: "id", type: "integer"),
                    new OA\Property(property: "title", type: "string"),
                    new OA\Property(property: "description", type: "string"),
                    new OA\Property(property: "status", type: "string"),
                    new OA\Property(property: "due_date", type: "string", format: "date"),
                    new OA\Property(property: "created_by", type: "integer"),
                    new OA\Property(property: "updated_by", type: "integer"),
                    new OA\Property(property: "created_at", type: "string", format: "date-time"),
                    new OA\Property(property: "updated_at", type: "string", format: "date-time"),
                    new OA\Property(property: "user", type: "object", format: "object")
                ]
            )
        )
    )]
    #[OA\Response(
        response: 422,
        description: "Validation Error",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(
                        property: "message",
                        type: "string",
                        example: "The title field is required."
                    ),
                    new OA\Property(
                        property: "errors",
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "title",
                                type: "array",
                                items: new OA\Items(
                                    type: "string",
                                    example: "The title field is required."
                                )
                            )
                        ]
                    )
                ]
            )
        )
    )]
    public function __invoke(CreateTaskRequest $request)
    {
        Task::create($request->validated());
    }
}
