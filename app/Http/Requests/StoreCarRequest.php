<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
            'brand'         =>'required',
            'model'         =>'required',
            'category_id'   =>'required|numeric|exists:categories,id',
            'price'         =>'required|numeric|min:1000000',
            'colors'        =>'required_without:new_colors|array',
            'colors.*'      =>'required|numeric|exists:colors,id',
            'new_colors'    =>'required_without:colors|nullable|string',
            'gear_type'     =>'required',
            'is_new'        =>'boolean|nullable',
            'year'          =>'required',
            'country'       =>'required',
            'description'   =>'required',
            'featured_image'=>'required|file|image',
            'images'        =>'required|array',
            'images.*'      =>'file|image'
        ];
    }
}
