<?php

namespace App\Http\Requests;

use App\Models\User;
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
            'name' => ['string', 'max:255'],
            'country'=> ['string', 'max:255'],
            'sex'=> ['boolean'],
            'avatar'=>['image'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'card_number' => ['regex:/^\d{16}$/'],
            'card_expire' => ['regex:/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/'],
            'card_cvv' => ['regex:/^\d{3,4}$/'],
        ];
    }
}
