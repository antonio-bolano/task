<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Project;
use OpenApi\Attributes as OA;

class CreateProjectController extends Controller
{
    #[OA\Post(
        path: "/api/projects",
        summary: "Create a project",
        description: "Create a new project with specified details",
        tags: ["Projects"],
        security: [["bearerAuth" => []]]
    )]
    #[OA\RequestBody(
        description: "Project creation details",
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
                    )
                ]
            )
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Project created successfully",
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(property: "id", type: "integer"),
                    new OA\Property(property: "title", type: "string"),
                    new OA\Property(property: "description", type: "string")
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
    public function __invoke(CreateProjectRequest $request)
    {
        Project::create($request->validated());
    }
}
