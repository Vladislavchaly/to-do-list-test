<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'parentId' => 'nullable|exists:tasks,id',
            'priority' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'completedAt' => 'nullable|date',
        ];
    }
}
