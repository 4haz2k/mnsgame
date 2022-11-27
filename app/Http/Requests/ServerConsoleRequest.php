<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ServerConsoleRequest extends FormRequest
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
            "server_id" => "required|exists:servers,id",
            "user_key" => "required"
        ];
    }

    public function messages(): array
    {
        return [
            "server_id.required" => "Необходимо указать ID сервера для отправки команды.",
            "server_id.exists" => "Указанный сервер не найден.",
            "user_key.required" => "Необходимо указать секретный ключ для соединения с сервером."
        ];
    }
}
