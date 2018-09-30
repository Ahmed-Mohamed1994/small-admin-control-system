<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'name' => 'required|regex:/^[A-Za-z\s-_]+$/',
            'phone' => 'required|digits_between:6,14|numeric',
            'email' => 'required|email|unique:users,email',
            'image' => 'image',
            'group' => 'required'
        ];
    }
}
