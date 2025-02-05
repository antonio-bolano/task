<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "string",
            "description" => "string",
            "status" => Rule::enum(TaskStatus::class),
            "due_date" => "date|date_format:Y-m-d|after:today",
            'user_id' => "integer|exists:users,id|nullable",
        ];
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated(), [
            'updated_by' => auth()->id(),
        ]);
    }
}
