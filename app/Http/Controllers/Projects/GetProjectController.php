<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class GetProjectController extends Controller
{
    #[OA\Get(
        path: "/api/projects/{id}",
        summary: "Get a specific project",
        description: "Retrieve details of a specific project",
        tags: ["Projects"],
        security: [["bearerAuth" => []]]
    )]
    #[OA\Parameter(
        name: "id",
        in: "path",
        description: "Project ID",
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
                    new OA\Property(property: "description", type: "string"),
                    new OA\Property(property: "created_by", type: "integer"),
                    new OA\Property(property: "updated_by", type: "integer"),
                    new OA\Property(property: "created_at", type: "integer"),
                    new OA\Property(property: "updated_at", type: "datetime"),
                    new OA\Property(property: "user", type: "object"),
                ]
            )
        )
    )]
    #[OA\Response(
        response: 404,
        description: "Project not found",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(property: "message", type: "string", example: "Project not found")
                ]
            )
        )
    )]
    public function __invoke(Project $project)
    {
        return $project;
    }
}
