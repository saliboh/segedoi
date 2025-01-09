<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->id,
            'role' => 'required|string|in:' . implode(',', array_keys(\App\Enums\UserRoleTypeEnum::toArray())),
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'id_url' => 'nullable|string|max:255',
            'contract_url' => 'nullable|string|max:255',
            'banned_at' => 'nullable|date',
        ];

        if ($this->isMethod('POST')) {
            $rules['password'] = 'required|min:6';
        } else {
            $rules['password'] = 'nullable|min:6'; // Optional for update
        }

        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
