<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'nullable|string|min:2|max:20',
            'last_name' => 'nullable|string|min:2|max:40',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|min:2|max:100',
        ];
    }
}
