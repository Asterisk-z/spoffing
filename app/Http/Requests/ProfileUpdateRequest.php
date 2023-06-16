<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['integer', 'max:255'],
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'phone_number' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'province' => ['string', 'max:255'],
            'timezone' => ['string', 'max:255'],
        ];
    }
}
