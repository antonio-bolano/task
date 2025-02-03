<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class GetTaskController extends Controller
{
    #[OA\Get(
        path: "/api/tasks/{id}",
        summary: "Get a specific task",
        description: "Retrieve details of a specific task",
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
    #[OA\Response(
        response: 200,
        description: "Successful response",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(property: "id", type: "integer"),
                    new OA\Property(property: "title", type: "string"),
                    // ... other task properties
                ]
            )
        )
    )]
    #[OA\Response(
        response: 404,
        description: "Task not found",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(property: "message", type: "string", example: "Task not found")
                ]
            )
        )
    )]
    public function __invoke(Task $task)
    {
        return $task;
    }
}
