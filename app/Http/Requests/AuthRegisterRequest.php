<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|min:8|max:30|regex:(^[a-zA-Z0-9 _-]+[a-zA-Z0-9-14\-[a-zA-Z0-9-.]+$)',
        ];
    }
}
