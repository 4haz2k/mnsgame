<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'profile_img' => [
                'nullable',
                'mimes:jpeg,png,jpg',
                'size:2048',
                'dimensions:min_width=96,min_height=96'
            ],
            'name' => [
                'nullable',
                'string',
                'max:255'
            ],
            'surname' => [
                'nullable',
                'string',
                'max:255'
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(Auth::id()),
            ],
            'login' => [
                'nullable',
                'string',
                'min:5',
                'max:255',
                Rule::unique('users', 'login')->ignore(Auth::id())
            ],
            'password' => [
                'nullable',
                'required_with:current_password',
                'string',
                'min:8',
                'confirmed'
            ],
            'password_confirmation' => [
                'nullable',
                'required_with:password',
                'string'
            ],
            "current_password" => [
                'nullable',
                'required_with:password',
                new MatchOldPassword
            ]
        ];
    }
}
