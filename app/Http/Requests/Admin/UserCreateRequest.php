<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'username' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'role_id' => 'required|integer',
            'balance' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
