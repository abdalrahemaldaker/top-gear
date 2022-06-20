<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCarRequest extends FormRequest
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
            'price'         =>'required|numeric|min:1000000',
            'colors'        =>'required|array',
            'colors.*'      =>'required|exists:colors,id',
            'gear_type'     =>'required',
            'is_new'        =>'boolean|nullable',
            'year'          =>'required',
            'country'       =>'required',
            'description'   =>'required',
            'category_id'   =>'required|numeric|exists:categories,id',
            'featured_image'=>'required|file|image'


        ];
    }
}
