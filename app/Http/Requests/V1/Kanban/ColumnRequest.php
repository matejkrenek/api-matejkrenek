<?php

namespace App\Http\Requests\V1\Kanban;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColumnRequest extends FormRequest
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
            'name' => ['nullable', Rule::requiredIf(!$this->column), Rule::unique('kanban_columns', 'name')->where('kanban_id', $this->kanban->id)->ignore($this->column ? $this->column->name : '', 'name')],
            'order' => ['nullable'],
            'color' => ['nullable'],
        ];
    }
}
