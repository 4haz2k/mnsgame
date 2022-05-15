<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServer extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            "filters_input" => json_decode($this->get("filters_input"))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "server_title" => "required|max:60|min:15",
            "server_description" => "required|max:2048|min:20",
            "game_title" => "required|exists:games,title",
            "server_site" => "active_url|nullable",
            "server_vk" => "active_url|nullable",
            "server_discord" => "active_url|nullable",
            "server_ip" => "required_without:launcher_link|nullable|unique:servers,server_data",
            "launcher_link" => "required_without:server_ip|active_url|nullable",
            "server_callback" => "active_url|nullable",
            "server_banner" => "mimes:jpeg,jpg,png,gif|dimensions:width=486,height=60|max:2048|nullable",
            "filters_input" => "array|nullable",
            "filters_input.*" => "exists:filters,filter"
        ];
    }

    public function messages(): array
    {
        return [
            "server_title.required" => "Название сервера должно быть заполнено.",
            "server_title.max" => "Название сервера должно быть не длинее 60 символов.",
            "server_title.min" => "Название сервера должно быть не короче 15 символов.",
            "server_description.required" => "Описание сервера должно быть заполнено.",
            "server_description.max" => "Описание сервера должно быть не длинее 255 символов.",
            "server_description.min" => "Описание сервера должно быть не короче 20 символов.",
            "game_title.required" => "Нужно выбрать игру.",
            "game_title.exists" => "Данной игры не существует на MNS Game.",
            "server_site.active_url" => "Сайт сервера имеет нерабочую ссылку. Проверьте работоспособность вашего сайта.",
            "server_vk.active_url" => "Группа Вконтакте имеет нерабочую ссылку. Проверьте правильность указанной ссылки.",
            "server_discord.active_url" => "Ссылка-приглашение в Discord сервер имеет нерабочую ссылку. Проверьте работоспособность ссылки.",
            "server_ip.required_without" => "Адрес сервера должен быть заполнен.",
            "server_ip.unique" => "Сервер с таким IP адресом уже существует.",
            "launcher_link.required_without" => "Ссылка на лаунчер должна быть заполнена.",
            "launcher_link.active_url" => "Ссылка на лаунчер должна быть рабочей ссылкой.",
            "server_banner.mimes" => "Изображение должно быть формата jpeg, jpg, png или gif.",
            "server_banner.dimensions" => "Изображение должно быть размером 486x60 пикселей (468px ширина, 80px высота).",
            "server_banner.size" => "Изображение не должно превышать размер 2 МБ (2048 КилоБайт).",
            "filters_input.array" => "Фильтры должны быть массивом.",
            "filters_input.*.exists" => "Выбранного фильтра у данной игры не существует."
        ];
    }
}
