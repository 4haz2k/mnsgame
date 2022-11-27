<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ServerConnectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "server_id" => "required",
            "is_launcher" => "required",
            "address" => "required_if:is_launcher,1",
            "rcon_password" => "required",
            "rcon_port" => "required",
            "user_key" => "required"
        ];
    }

    public function messages(): array
    {
        return [
            "address.required_if" => "Необходимо указать IP адрес сервера.",
            "rcon_password.required" => "Необходимо указать Rcon пароль сервера.",
            "rcon_port.required" => "Необходимо указать Rcon порт сервера.",
            "user_key.required" => "Необходимо указать уникальный ключ для доступа к серверу.",
            "server_id.required" => "Не передан ID сервера.",
            "is_launcher.required" => "Не передан тип проекта.",
        ];
    }
}
