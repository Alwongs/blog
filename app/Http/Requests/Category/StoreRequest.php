<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

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
            'category_name' => ['required', 'unique:categories,title', 'string', 'max:20'],
            'category_id' => ['nullable'],
            'position' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'Request validation: A title is required',
            'category_name.max:20' => 'Request validation: Too long title. Max - 20'
        ];
    }    
}
