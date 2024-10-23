<?php

namespace App\Http\Requests\ManageTime;

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
            'manage_day_id' => ['required'],
            'title'       => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('manage_times', 'title')->where(function ($query) {
                    return $query->where('manage_day_id', $this->manage_day_id);
                }),              
            ],
            'time_from' => ['required'],
            'time_to' => ['required'],
            'status' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'title.unique'                  => 'The title is alredy exists in this category',
            'manage_day_id.required'      => 'The manage day id field is required',
            'status.required'               => 'Status is required'
        ];
    }    
}
