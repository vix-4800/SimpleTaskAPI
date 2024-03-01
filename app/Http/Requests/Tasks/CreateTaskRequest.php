<?php

namespace App\Http\Requests\Tasks;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', Rule::in(TaskStatus::values())],
            'date' => ['required', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'date.date' => 'Wrong date format',
            'date.required' => 'Date is required',
            'title.required' => 'Title is required',
            'title.string' => 'Wrong title format',
            'description.required' => 'Description is required',
            'description.string' => 'Wrong description format',
            'status.required' => 'Status is required',
            'status.in' => 'Wrong status',
        ];
    }
}
