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
            'id' => ['required', 'string', 'max:9', Rule::unique(User::class)->ignore($this->user()->id)],
            'name' => ['required', 'string', 'max:100'],
            'department' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:500'],
            'birth_date' => ['required', 'date', 'max:100'],
        ];
    }
}
