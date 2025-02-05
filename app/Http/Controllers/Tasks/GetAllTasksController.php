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
        description: "Retrieve all tasks.",
        tags: ["Tasks"],
        security: [["bearerAuth" => []]]
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
                                new OA\Property(property: "description", type: "string"),
                                new OA\Property(property: "status", type: "string"),
                                new OA\Property(property: "due_date", type: "date"),
                                new OA\Property(property: "created_by", type: "integer"),
                                new OA\Property(property: "updated_by", type: "integer"),
                                new OA\Property(property: "created_at", type: "integer"),
                                new OA\Property(property: "updated_at", type: "datetime"),
                                new OA\Property(property: "user", type: "object"),
                                // ... other task properties
                            ]
                        )
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
