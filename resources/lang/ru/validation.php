<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Вы должны принять :attribute.',
    'accepted_if' => 'Поле :attribute должно быть активно, когда :other имеет значение :value.',
    'active_url' => 'Поле :attribute имеет недействительную ссылку.',
    'after' => 'Поле :attribute должно быть датой после :date.',
    'after_or_equal' => 'Поле :attribute должно быть датой после или равной :date.',
    'alpha' => 'Поле :attribute может содержать только буквы.',
    'alpha_dash' => 'Поле :attribute может содержать только буквы, цифры, дефис и подчеркивание.',
    'alpha_num' => 'Поле :attribute может содержать только буквы и цифры.',
    'array' => 'Поле :attribute должно быть массивом.',
    'before' => 'Поле :attribute должно быть датой перед :date.',
    'before_or_equal' => 'Поле :attribute должно быть датой перед или равной :date.',
    'between' => [
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'file'    => 'Размер :attribute должен быть от :min до :max килобайт.',
        'string'  => 'Длина :attribute должна быть от :min до :max символов.',
        'array'   => 'Поле :attribute должно содержать :min - :max элементов.',
    ],
    'boolean' => 'Поле :attribute должно быть логической истинной или ложью.',
    'confirmed' => 'Поле :attribute не совпадает с подтверждением.',
    'current_password' => 'Указанный пароль неверный..',
    'date' => 'Поле :attribute не является датой.',
    'date_equals' => 'Поле :attribute должен быть датой, равной :date.',
    'date_format' => 'Поле :attribute не соответствует формату :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'Поля :attribute и :other должны различаться.',
    'digits' => 'Длина цифрового поля :attribute должна быть :digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'Длина цифрового поля :attribute должна быть между :min и :max.',
    'distinct' => 'Поле :attribute имеет повторяющееся зачение.',
    'email' => 'Поле :attribute должно быть действительным электронным адресом.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'Выбранное значение для :attribute некорректно.',
    'file' => 'Поле :attribute должно быть файлом.',
    'filled' => 'Поле :attribute обязательно для заполнения.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'Поле :attribute должно быть изображением.',
    'in' => 'Выбранное значение для :attribute ошибочно.',
    'in_array' => 'Поле :attribute не существует в :other.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'ip' => 'Поле :attribute должно быть действительным IP-адресом.',
    'ipv4' => 'Поле :attribute должно быть действительным IPv4-адресом.',
    'ipv6' => 'Поле :attribute должно быть действительным IPv6-адресом.',
    'json' => 'Поле :attribute должно быть валидной JSON строкой.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file'   => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
        'array'  => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'Поле :attribute должно быть не больше :max.',
        'file'    => 'Поле :attribute должно быть не больше :max Килобайт.',
        'string'  => 'Поле :attribute должно быть не длиннее :max символов.',
        'array'   => 'Поле :attribute должно содержать не более :max элементов.',
    ],
    'mimes' => 'Поле :attribute должно быть файлом одного из типов: :values.',
    'mimetypes' => 'Поле :attribute должно быть файлом одного из типов: :values.',
    'min' => [
        'numeric' => 'Поле :attribute должно быть не менее :min.',
        'file'    => 'Поле :attribute должно быть не менее :min Килобайт.',
        'string'  => 'Поле :attribute должно быть не короче :min символов.',
        'array'   => 'Поле :attribute должно содержать не менее :min элементов.'
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'Выбранное значение для :attribute ошибочно.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'password' => 'Введённый пароль неверный.',
    'present' => 'Поле :attribute должно присутствовать.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'Поле :attribute имеет ошибочный формат.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'required_if' => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
    'required_unless' => 'Поле :attribute обязательно для заполнения, когда :other не равно :values.',
    'required_with' => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_with_all' => 'Поле :attribute обязательно для заполнения, когда :values указаны.',
    'required_without' => 'Поле :attribute обязательно для заполнения, когда :values не указано.',
    'required_without_all' => 'Поле :attribute обязательно для заполнения, когда :values не указаны.',
    'same' => 'Значение :attribute должно совпадать с :other.',
    'size' => [
        'numeric' => 'Поле :attribute должно быть :size.',
        'file'    => 'Поле :attribute должно быть :size Килобайт.',
        'string'  => 'Поле :attribute должно быть длиной :size символов.',
        'array'   => 'Количество элементов в поле :attribute должно быть :size.'
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'Поде :attribute должно быть строкой.',
    'timezone' => 'Поле :attribute должно быть валидной временной зоной.',
    'unique' => 'Такое значение поля :attribute уже существует.',
    'uploaded' => 'Загрузка поля :attribute не удалась.',
    'url' => 'Поле :attribute имеет ошибочный формат.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        "password" => '«Пароль»',
        "email" => '«Электронная почта»',
        "login" => '«Логин»',
        "profile_img" => "«Профиль изображения»",
        "name" => "«Имя»",
        "surname" => "«Фамилия»",
        "password_confirmation" => "«Повторный пароль»",
        "current_password" => "«Текущий пароль»"
    ],

];
