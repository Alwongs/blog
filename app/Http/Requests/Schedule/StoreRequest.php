<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required'],
            'month'       => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('schedules', 'month')->where(function ($query) {
                    return $query->where('user_id', $this->user_id);
                }),              
            ],
        ];
    }

    public function messages()
    {
        return [
            'month.unique' => 'The month is alredy exists in this category',
        ];
    }    
}
