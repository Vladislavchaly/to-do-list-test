<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class GetTasksRequest extends FormRequest
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
            'status' => 'nullable|in:boolean',
            'name' => 'nullable|string',
            'sort_by' => 'nullable|in:created_at,status',
            'page' => 'nullable|integer',
            'limit' => 'nullable|integer',
        ];
    }
}
