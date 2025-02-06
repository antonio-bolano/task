<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Project;
use OpenApi\Attributes as OA;

class DeleteProjectController extends Controller
{
    #[OA\Delete(
        path: "/api/projects/{id}",
        summary: "Delete a project",
        description: "Remove a specific project",
        tags: ["Tasks"],
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
        response: 204,
        description: "Project deleted successfully"
    )]
    #[OA\Response(
        response: 404,
        description: "Proje not found",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(property: "message", type: "string", example: "Project not found")
                ]
            )
        )
    )]
    public function __invoke(int $project)
    {
        $project = Project::find($project);

        if (!$project) {
            return response('', 404);
        }

        $project->delete();
        return response('', 204);
    }
}
