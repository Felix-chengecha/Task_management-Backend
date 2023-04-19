<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTaskRequest extends FormRequest
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

                 'user_id'=> 'required|exists:users,id',
                'tasks_id' => 'required|exists:tasks,id',
                'due_date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'remarks' => 'required|string|max:255',
                'status_id'=> 'required|exists:statuses,id'
        ];
    }
}
