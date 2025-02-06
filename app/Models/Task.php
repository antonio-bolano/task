<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "status",
        "due_date",
        "created_by",
        "updated_by",
        "user_id",
        "project_id",
    ];

    protected $with = [
        'user',
        'project',
    ];

    protected $appends = [
        'allStatus',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeOverdue(Builder $query): Builder
    {
         return $query
            ->where('due_date', '<', now());
    }

    public function getAllStatusAttribute(): array
    {
        return TaskStatus::cases();
    }

}
