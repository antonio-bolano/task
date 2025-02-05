<?php

namespace App\Models;

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
    ];

    protected $with = [
        'user'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
