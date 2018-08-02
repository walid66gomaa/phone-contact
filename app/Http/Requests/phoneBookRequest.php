<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class phoneBookRequest extends FormRequest
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
    public function rules( )
    {
        return [
           'name'=>'required|max:255',
           'email'=>'required|max:255|email',
           'phone'=>'required|max:18',
          //'image' => 'max:999',
        ];
    }
}
