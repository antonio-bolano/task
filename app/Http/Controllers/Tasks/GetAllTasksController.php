<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class GetAllTasksController extends Controller
{
    #[OA\Get(
        path: "/api/tasks",
        summary: "List tasks",
        description: "Retrieve a list of tasks",
        tags: ["Tasks"],
        security: [["bearerAuth" => []]]
    )]
    #[OA\Parameter(
        name: "page",
        in: "query",
        description: "Page number for pagination",
        required: false,
        schema: new OA\Schema(type: "integer", default: 1)
    )]
    #[OA\Response(
        response: 200,
        description: "Successful response",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer"),
                                new OA\Property(property: "title", type: "string"),
                                // ... other task properties
                            ]
                        )
                    ),
                    new OA\Property(
                        property: "meta",
                        type: "object",
                        properties: [
                            new OA\Property(property: "current_page", type: "integer"),
                            new OA\Property(property: "last_page", type: "integer"),
                            new OA\Property(property: "per_page", type: "integer"),
                            new OA\Property(property: "total", type: "integer")
                        ]
                    )
                ]
            )
        )
    )]
    public function __invoke(Request $request)
    {
        return Task::all();
    }
}
