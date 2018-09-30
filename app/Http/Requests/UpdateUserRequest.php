<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|regex:/^[A-Za-z\s-_]+$/',
            'phone' => 'required|numeric',
            'email' => ['required','email',Rule::unique('users')->ignore($this->user)],
            'nationality' => 'required',
            'password' => 'nullable|min:6|confirmed',
            'birthDate' => 'required',
            'image' => 'image'
        ];
    }
}
