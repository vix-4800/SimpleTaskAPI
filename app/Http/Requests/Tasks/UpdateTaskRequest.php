<?php

namespace App\Http\Requests\Tasks;

use App\Models\Task;
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
    public function rules()
    {

        return [
            'title' => ['string'],
            'description' => ['string'],
            'status' => [Rule::in([
                Task::STATUS_TODO,
                Task::STATUS_IN_PROGRESS,
                Task::STATUS_COMPLETED,
            ])],
            'date' => ['date'],
        ];
    }

    public function messages()
    {
        return [
            'date.date' => 'Wrong date format',
            'status.in' => 'Wrong status',
        ];
    }
}
