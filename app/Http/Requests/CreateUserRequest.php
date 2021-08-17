<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CreateUserRequest extends FormRequest
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
            'email'=>'required|max:50|email|unique:App\Models\User,email',
            'password'=>'required|string|min:6|max:20',
            'name'=>'nullable|string|min:2|max:20',
            'last_name'=>'nullable|string|min:2|max:40',
            'country'=>'nullable|string|max:100',
            'city'=>'nullable|string|min:2|max:100',
            'phone'=>'nullable|string|max:30',
            'role'=>'nullable',
        ];
    }
}
