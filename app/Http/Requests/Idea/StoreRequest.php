<?php

namespace App\Http\Requests\Idea;

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
            'title'       => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('ideas', 'title')->where(function ($query) {
                    return $query->where('user_id', $this->user_id);
                }),              
            ],
            'description' => ['nullable'],
            'status' => ['required', 'string'],
            'rate' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'title.unique'                  => 'The title is alredy exists in this category',
            'status.required'               => 'Status is required'
        ];
    }    
}
