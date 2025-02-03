<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use OpenApi\Attributes as OA;

class DeleteTaskController extends Controller
{
    #[OA\Delete(
        path: "/api/tasks/{id}",
        summary: "Delete a task",
        description: "Remove a specific task",
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
        response: 204,
        description: "Task deleted successfully"
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
    public function __invoke(int $task)
    {
        $task = Task::find($task);

        if (!$task) {
            return response('', 404);
        }

        $task->delete();
        return response('', 204);
    }
}
