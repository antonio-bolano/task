<?php

namespace App\Enums;

enum TaskStatus : String
{
    case Todo = 'todo';
    case InProgress = 'in_progress';
    case Done = 'done';
}
