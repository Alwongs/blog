<?php

namespace App\Http\Requests\Product;

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
            'product_list_id' => ['required'],
            'title'       => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('products', 'title')->where(function ($query) {
                    return $query->where('product_list_id', $this->product_list_id);
                }),              
            ],
            'price' => ['nullable', 'integer'],
            'status' => ['required', 'string'],
            'rate' => ['nullable'],
            
        ];
    }

    public function messages()
    {
        return [
            'title.unique'                  => 'The title is alredy exists in this category',
            'product_list_id.required'      => 'The product list field is required',
            'status.required'               => 'Status is required'
        ];
    }    
}
