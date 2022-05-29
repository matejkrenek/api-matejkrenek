<?php

namespace App\Http\Requests\V1\Kanban;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['nullable', Rule::requiredIf(!$this->task), 'string'],
            'description' => ['nullable', 'string'],
            'executor_id' => ['nullable', Rule::exists('users', 'id')],
            'row' => ['nullable', 'number'],
            'is_completed' => ['nullable', 'boolean'],
        ];
    }
}
