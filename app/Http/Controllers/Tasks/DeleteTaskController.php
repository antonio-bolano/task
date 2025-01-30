<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class DeleteTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
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
