<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use OpenApi\Attributes as OA;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required:string',
            'status' => Rule::enum(TaskStatus::class),
            'due_date' => 'date|date_format:Y-m-d|after:today',
            'user_id' => "integer|exists:users,id|nullable",
            'project_id' => "integer|exists:tasks,id|nullable",
        ];
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated(), [
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    }
}
