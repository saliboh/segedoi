<?php

namespace App\Http\Requests;

use App\Enums\PaymentFrequencyType;
use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'financer_id' => 'required|exists:financers,id',
            'total' => 'required|numeric',
            'interest' => 'required|numeric',
            'term_in_months' => 'required|numeric',
            'payment_frequency' => 'required|in:'.implode(',', PaymentFrequencyType::toArrayValues()),
        ];
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
