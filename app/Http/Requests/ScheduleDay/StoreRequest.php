<?php

namespace App\Http\Requests\ScheduleDay;

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
            'year'   => ['required'],
            'month'   => ['required'],
            'first_day_shift_index' => ['required'],
            'description' => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'month.unique' => 'The month is alredy exists in this category',
        ];
    }    
}
