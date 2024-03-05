<?php

namespace App\Http\Requests\Tasks;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
    public function rules(): array
    {

        return [
            'title' => ['string'],
            'description' => ['string'],
            'status' => [Rule::in(TaskStatus::values())],
            'date' => ['date'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'date.date' => 'Wrong date format',
            'status.in' => 'Wrong status',
            'title.string' => 'Wrong title format',
            'description.string' => 'Wrong description format',
        ];
    }
}
