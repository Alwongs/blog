<?php

namespace App\Http\Requests\Color;

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
        // dd($this);
        return [
            'title'    => ['required'],
            'color'    => ['required', 'string', 'max:10', Rule::unique('colors')],
            'position' => ['required'],
            'status'   => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'The title is alredy exists in this category',
        ];
    }    
}
 