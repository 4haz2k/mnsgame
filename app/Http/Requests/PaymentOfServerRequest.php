<?php

namespace App\Http\Requests;

use App\Http\Interfaces\PaymentTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentOfServerRequest extends FormRequest
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
            "server_id" => [
                Rule::exists("servers", "id"),
                "required"
            ],
            "qty" => [
                "required",
                "not_in:0"
            ],
            "type" => [
                "required",
                "in:".implode(",", PaymentTypes::packets)
            ]
        ];
    }

    public function messages(): array
    {
        return [
            "server_id.required" => "Необходимо выбрать сервер, для которого будет оказана услуга.",
            "server_id.exists" => "Выбранного вами сервера не существует в системе.",
            "qty.required" => "Необходимо выбрать кол-во рейтинга, который будет зачислено на ваш сервер.",
            "qty.not_in" => "Введённое кол-во рейтинга должно быть больше нуля.",
            "type.required" => "Необходимо выбрать тип платежа.",
            "type.in" => "Выбранный тип не зарегистрирован в системе."
        ];
    }
}
