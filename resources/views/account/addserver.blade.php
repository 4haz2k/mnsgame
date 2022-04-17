@extends('layouts.main')

@section("title", "MNS Game | Добавление сервера")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <style type="text/css">
        .tooltip-custom {
            cursor: pointer;
        }

        .tooltip-custom::after {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px 10px 10px 5px;
            box-shadow: 2px 2px 11px rgba(0, 0, 0, 0.6);
            color: #FFF;
            content: attr(data-tooltip); /* Основной код, который определяет, что будет во всплывающей подсказке*/
            margin-top: -31px;
            padding: 5px 9px;
            position: absolute;
            visibility: hidden; /* ...скрываем элемент */
            font-size: 0.75rem;
            line-height: 1rem;
            opacity: 1 !important;
        }

        .tooltip-custom:hover::after {
            opacity: 1; /* Показываем элемент */
            visibility: visible;
        }

        .tooltip-custom-callback::after{
            margin-top: -58px !important;
        }
    </style>
@endsection

@section('body')
    <div class="container max-w-full px-4 mx-auto text-left md:max-w-none md:text-center">
        <div class="lg:grid grid-cols-1 max-w-6xl mx-auto">
            <div id="firstColumn" class="lg:mt-8 lg:mb-12">
                <div class="text-center lg:text-lg mb-2 font-semibold">
                    Предпросмотр сервера
                </div>
                <div class="w-full h-12 flex rounded-1 mdm:hidden">
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        Место
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        Игра
                    </div>
                    <div class="w-6/12 justify-center items-center flex text-xs">
                        Название сервера
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        Игроков
                    </div>
                    <div class="w-2/12 justify-center items-center flex text-xs">
                        IP адрес
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        Рейтинг
                    </div>
                </div>
                <div class="bg-gray-200 w-full mdm:h-48 h-24 flex rounded-1 shadow-md my-3 px-2 flex-wrap lg:flex-nowrap lg:px-0" id="server_preview">
                    <div class="w-1/12 justify-center items-center flex text-md">
                        <div class="bg-gray-300 rounded-3 px-2 py-1 font-semibold tooltip-custom hidden lg:inline" data-tooltip="Место в рейтинге">
                            1
                        </div>
                    </div>
                    <div class="w-1/12 justify-center items-center flex tooltip-custom hidden lg:block my-auto mx-auto text-center" data-tooltip="Counter Strike: Global Offensive">
                        <img class="rounded-3 mx-auto" src="{{ asset("img/test/csgo_logo.png") }}" width="42" height="42" id="game-logo" alt="Counter Strike: Global Offensive">
                    </div>
                    <div class="w-full lg:w-6/12 justify-center items-center flex flex-col truncate">
                        <div class="text-xs lg:!text-base mb-1 text-ellipsis overflow-hidden font-bold max-w-[560px] text-center mdm:mt-2" id="server-title-preview">
                            ⭐ Будущее название сервера на MNS Game! ⭐
                        </div>
                        <div class="block">
                            <img class="rounded-2" src="{{ asset("/img/test/banner.png") }}" width="486" height="60" alt="" id="server-banner">
                        </div>
                    </div>
                    <div class="w-1/3 lg:w-1/12 justify-center items-center flex text-xs mdm:hidden">
                        <div class="bg-gray-300 text-indigo-500 rounded-3 px-2 py-1 tooltip-custom" data-tooltip="Текущее кол-во игроков на сервере">
                            1100
                        </div>
                    </div>
                    <div class="w-full lg:w-2/12 justify-center items-center flex text-xs mdm:mt-2 mdm:flex-wrap mdm:text-center">
                        <div class="lg:hidden w-full mb-1">
                            <span class="block font-semibold">Адрес сервера</span>
                        </div>
                        <div>
                            <div class="bg-gray-300 rounded-3 px-2 py-1 tooltip-custom text-ellipsis overflow-hidden max-w-[150px]" data-tooltip="Нажмите, чтобы скопировать адрес" id="ip-preview">
                                192.168.124.120:27015
                            </div>
                            <button class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded hidden" id="launcher-button-preview">
                                <svg class="w-5 h-4 inline mr-1 align-middle" color="white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 293.573 293.573" xml:space="preserve">
<path fill="#FFFFFF" d="M229.62,140.665v0.093h-69.718c-0.086-1-0.139-1.69-0.139-2.479c0-11.511,9.364-20.95,20.857-20.95l43.12,0.015
	c28.053,0,50.876-22.741,50.876-50.794s-22.823-50.793-50.876-50.793h-25.606c-8.284,0-15,6.716-15,15s6.716,15,15,15h25.606
	c11.511,0,20.876,9.264,20.876,20.774s-9.365,20.826-20.858,20.826l-43.12-0.077c-28.053,0-50.875,22.958-50.875,51.011
	c0,0.782,0.024,1.466,0.059,2.466H63.62v-0.093C27.62,143.237,0,172.986,0,209.211c0,37.908,30.905,68.604,68.813,68.604
	c24.786,0,46.61-13.057,58.708-33.057h38.864c12.098,20,33.857,33.057,58.644,33.057c37.908,0,68.543-30.768,68.543-68.676
	C293.573,172.914,265.62,143.237,229.62,140.665z M101.62,218.758h-24v23h-18v-23h-24v-19h24v-23h18v23h24V218.758z M194.24,218.559
	c-6.429,0-11.659-5.23-11.659-11.659s5.23-11.658,11.659-11.658s11.658,5.229,11.658,11.658S200.669,218.559,194.24,218.559z
	 M225.029,249.348c-6.429,0-11.659-5.23-11.659-11.659s5.23-11.658,11.659-11.658s11.658,5.229,11.658,11.658
	S231.458,249.348,225.029,249.348z M225.029,187.77c-6.429,0-11.659-5.23-11.659-11.659s5.23-11.658,11.659-11.658
	s11.658,5.229,11.658,11.658S231.458,187.77,225.029,187.77z M255.818,218.559c-6.429,0-11.659-5.23-11.659-11.659
	s5.23-11.658,11.659-11.658s11.658,5.229,11.658,11.658S262.247,218.559,255.818,218.559z"/>
</svg>
                                <span class="inline align-middle pt-[1px]">Скачать лаунчер</span>
                            </button>
                        </div>
                    </div>
                    <div class="w-1/2 justify-center items-center flex text-xs block lg:!hidden mdm:flex-wrap mdm:text-center mdm:mt-1 mdm:mb-2">
                        <div class="lg:hidden w-full mb-1">
                            <span class="block font-semibold">Игроков на сервере</span>
                        </div>
                        <div>
                            <div class="bg-gray-300 text-indigo-500 rounded-3 px-2 py-1 tooltip-custom" data-tooltip="Текущее кол-во игроков на сервере">
                                1100
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 lg:w-1/12 justify-center items-center flex text-xs mdm:flex-wrap mdm:text-center mdm:mt-1 mdm:mb-2">
                        <div class="lg:hidden w-full mb-1">
                            <span class="block font-semibold">Рейтинг сервера</span>
                        </div>
                        <div>
                            <div class="bg-gray-300 rounded-3 px-2 py-1 text-orange-400 font-semibold tooltip-custom" data-tooltip="Рейтинг сервера">
                                10204
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="secondColumn" class="my-4">
                <form class="w-full" enctype="multipart/form-data" action="{{ route("addserver") }}" method="POST" id="form_input" onsubmit="inputFilters();">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left" for="server-title">
                                Название сервера <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>
                            </label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Название вашего сервера. Разрешены буквы и цифры</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input value="{{ old('server_title') }}" name="server_title" class="@error('server_title') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-title" type="text" placeholder="Какое будет название у вашего сервера?" required>
                            @error('server_title')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label class="block text-md tracking-wide text-gray-700 font-semibold mb-2 !text-left" for="server-description">
                                Описание сервера <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>
                            </label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Полное описание вашего сервера. Данное описание будет отображаться на странице вашего сервера.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <textarea name="server_description" id="server-description" class="@error('server_description') !border-red-500 @enderror w-full h-16 px-3 py-2 text-sm text-gray-700 placeholder-gray-600 border rounded focus:shadow-outline" placeholder="Чтобы вы хотели рассказать о своём сервере игрокам?" required>{{ old('server_description') }}</textarea>
                            @error('server_description')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="game-title" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Название игры <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span></label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Выберите игру, которой посвящен ваш сервер.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <select id="game-title" name="game_title" class="@error('game_title') !border-red-500 @enderror w-full h-10 px-3 text-sm placeholder-gray-600 border rounded appearance-none focus:shadow-outline" onchange="getFilters()">
                                <option value="" disabled selected>Выберите игру</option>
                                @foreach($games as $game)
                                    <option value="{{ $game->title }}">{{ $game->title }}</option>
                                @endforeach
                            </select>
                            @error('game_title')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2" id="filters"></div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="server-site" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Сайт сервера</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Ссылка на сайт сервера.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input value="{{ old('server_site') }}" name="server_site" class="@error('server_site') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-site" type="text" placeholder="Ссылка на сайт сервера">
                            @error('server_site')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="server-vk" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Сообщество Вконтакте</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Ссылка на сообщество Вконтакте.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input value="{{ old('server_vk') }}" name="server_vk" class="@error('server_vk') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-vk" type="text" placeholder="Ссылка на сообщество Вконтакте">
                            @error('server_vk')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="server-discord" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Discord сервера</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Ссылка-приглашение в Discord сервер.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input value="{{ old('server_discord') }}" name="server_discord" class="@error('server_discord') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-discord" type="text" placeholder="Ссылка-приглашение в Discord">
                            @error('server_discord')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="server-ip" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left" id="server-type-title">IP адрес сервера</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left" id="server-type-description">Текстовая или циферная ссылка на ваш сервер.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input value="{{ old('server_ip') }}" name="server_ip" class="@error('server_ip') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-ip" type="text" placeholder="IP адрес сервера">
                            <input value="{{ old('launcher_link') }}" name="launcher_link" class="@error('launcher-link') !border-red-500 @enderror hidden appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-launcher" type="text" placeholder="Ссылка страницу скачивания лаунчера/клиента сервера">
                            <div class="text-center">
                                <label for="is-launcher" class="mr-[10px] ml-1 block text-xs tracking-wide text-gray-700 font-bold mb-2 inline">На моем сервере используется лаунчер или клиент</label>
                                <input name="is_launcher" class="appearance-none block text-gray-700 border border-gray-200 rounded px-2 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm inline" id="is-launcher" type="checkbox" onchange="changeServerType(this);">
                            </div>
                            @error('server_ip')
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                            @enderror
                            @error('launcher_link')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2 mdm:mt-3">
                            <label for="server-callback" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">CallBack для сервера</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">
                                CallBack предназначен для того, чтобы мы могли отправлять вам на сайт уведомление о том, что за ваш сервер проголосовали.
                                Подробнее про то, как привязать callback к своему сайту и для чего он нужен, читайте в этой <a href="/fs" class="underline text-blue-700">статье</a>.
                            </span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <div class="flex">
                                <input value="{{ old('server_callback') }}" name="server_callback" class="@error('server_callback') !border-red-500 @enderror appearance-none block text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm inline flex-auto" id="server-callback" type="text" placeholder="Ссылка на callback сайта">
                                <button class="inline flex-none bg-white hover:!bg-gray-100 border focus:!border-blue-700 rounded ml-2 h-9 px-2 tooltip-custom tooltip-custom-callback" type="button" onclick="makeRequest(this);">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
                                        <g>
                                            <g>
                                                <path d="m391.1,373.9h-57.1v-39.9l16.2,16.1c11.2,11.2 24.9,3.9 28.9-0.1 7.9-8 7.9-20.9-0.1-28.9l-51-50.6c-8-7.9-20.8-7.9-28.8,0l-51,50.6c-8,7.9-8.1,20.9-0.1,28.9 7.9,8 20.9,8.1 28.9,0.1l16.2-16.1v39.8h-170.3c-38.6,0-70.1-31.4-70.1-70 0-38.6 31.4-70.1 70.1-70.1h268.2c38.6,0 70,31.4 70,70.1 0.1,38.6-31.4,70.1-70,70.1zm-338.3-251c-1.42109e-14-38.6 31.4-70 70.1-70h268.2c38.6,0 70,31.4 70,70 0,38.6-31.4,70.1-70,70.1h-268.2c-38.6-0.1-70.1-31.5-70.1-70.1zm402.4,90.4c28.3-20.1 46.8-53.2 46.8-90.5 0-61.1-49.7-110.8-110.9-110.8h-268.2c-61.2,0-110.9,49.7-110.9,110.9 0,37.3 18.5,70.4 46.8,90.5-28.3,20.1-46.8,53.1-46.8,90.4 0,61.1 49.7,110.9 110.9,110.9h170.3v66.9c0,11.3 9.1,20.4 20.4,20.4 11.3,0 20.4-9.1 20.4-20.4v-66.9h57.1c61.1,0 110.9-49.7 110.9-110.9 0-37.3-18.5-70.3-46.8-90.5z"/>
                                                <path d="m113.3,143.3h8.9c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-8.9c-11.3,0-20.4,9.1-20.4,20.4-0.1,11.3 9.1,20.4 20.4,20.4z"/>
                                                <path d="m189.8,143.3h8.9c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4h-8.9c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4z"/>
                                                <path d="m126.7,283.4h-8.9c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h8.9c11.3,0 20.4-9.1 20.4-20.4-2.84217e-14-11.3-9.2-20.4-20.4-20.4z"/>
                                                <path d="m203.2,283.4h-8.9c-11.3,0-20.4,9.1-20.4,20.4 0,11.3 9.1,20.4 20.4,20.4h8.9c11.3,0 20.4-9.1 20.4-20.4 0-11.3-9.1-20.4-20.4-20.4z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            @error('server_callback')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="game-title" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Баннер</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left mdm:mb-3">Баннер сервера в формате gif, png, jpeg или jpg размером 486x60 пикселей. <br><br><span class="text-red-500 font-bold">Внимание! Использование агрессивных, мигающих и нецензурных баннеров запрещено! Максимальный размер баннера 2 Мегабайта. Несоблюдение данных правил карается удалением сервера с хостинга без возможности восстановления!</span></span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <div class="w-full hidden px-3 py-2 rounded-md border-2 border-dashed border-gray-300 bg-white" id="upload_preview">
                                <div class="w-full text-center text-base font-semibold">
                                    Текущий банер сервера
                                </div>
                                <img src="" alt="" id="img-preview" class="mx-auto my-3 rounded-2" width="486" height="60">
                                <div class="w-full text-center">
                                    <button type="button" onclick="uploadButton();" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-12 border border-blue-700 rounded">
                                        Изменить изображение
                                    </button>
                                </div>
                            </div>
                            <label class="flex h-[80px] w-full cursor-pointer appearance-none justify-center rounded-md border-2 border-dashed border-gray-300 bg-white px-4 transition hover:border-gray-400 focus:outline-none mdm:mb-3" id="dropzone">
                                <span class="flex items-center space-x-2">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                  </svg>
                                  <span class="font-medium text-gray-600 text-center">
                                    Нажмите, чтобы выбрать
                                    <span class="text-blue-600 underline">изображение</span>
                                  </span>
                                </span>
                            </label>
                            <span class="flex items-center font-bold tracking-wide text-red-500 text-md text-center mt-2 ml-1 hidden" id="banner-error"></span>
                            @error('server_banner')
                                <span class="flex items-center font-bold tracking-wide text-red-500 mt-1 ml-1">{{ $message }}</span>
                            @enderror
                            <input type="file" name="server_banner" id="banner-input" class="hidden" onchange="showPreview(event);" accept=".gif, .png, .jpeg .jpg"/>
                            <input type="hidden" name="filters_input" value="">
                        </div>
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-12 border border-blue-700 rounded mx-auto">Добавить сервер</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section("scripts")
    <script>
        function makeRequest(element){
            let callback_link = document.getElementById("server-callback").value;

            if(callback_link === ""){
                element.setAttribute("data-tooltip", "Поле ввода для ссылки пустое!");
                return;
            }

            const request = new XMLHttpRequest();

            const url = "{{ url("/server/checkCallback") }}";

            const params = "&callback=" + callback_link;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    let data = JSON.parse(request.responseText);

                    if(data["status"] === true){
                        element.setAttribute("data-tooltip", data["message"]);
                    }
                    else{
                        console.log(data["error"]);
                    }
                }
            });
            request.send(params);
        }
    </script>
    <script>
        document.getElementById('dropzone')
            .addEventListener('click', () =>
                document.getElementById('banner-input').click());
    </script>

    <script>
        function showFiltersBlock(){
           document.getElementById("filters").innerHTML = "<div class='lg:w-1/3 w-full px-3 lg:my-2'><label for='game-filters' class='block text-md tracking-wide text-gray-700 font-bold mb-2 text-left'>Категории сервера</label><span class='block text-md tracking-wide text-gray-700 mb-2 text-left'>Этот параметр определяет, в какие категории попадет ваш сервер. Выбирайте только те категории, которые действительно присутствуют на вашем сервере. В противном случае, редактирование сервера будет отключено, а сам сервер понижен в рейтинге. <br><br><strong>Внимание!</strong> В случае полного игнорирования правил выбора параметров, сервер будет удален из мониторинга без возможности восстановления!</span></div><div class='lg:w-2/3 w-full px-3 lg:my-2'><div class='flex flex-col items-center relative'><div class='w-full'> <div class='p-1 flex border border-gray-200 bg-white rounded-t-lg'><div class='flex flex-auto flex-wrap' id='filters-input'></div> <div class='text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200'><button type='button' class='cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none' onclick='showSuggestions()'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='w-4 h-4' style='transform: rotate(180deg);'><polyline points='18 15 12 9 6 15'></polyline></svg></button></div></div><div class='items-stretch w-full mb-4 z-20 absolute bg-gray-100 top-[42px] !rounded-b-lg hover:rounded-b-lg drop-shadow-lg'><div class='flex flex-col w-full' id='filters-suggestion'></div></div></div></div></div>";
        }

        function getFilters(){
            showFiltersBlock();
            let game_title = document.getElementById("game-title").value;
            let filters_suggestions = document.getElementById("filters-suggestion");
            filters_suggestions.innerHTML = "";

            const request = new XMLHttpRequest();

            const url = "{{ url("/server/loadFilters") }}";

            const params = "&game_title=" + game_title;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    let data = JSON.parse(request.responseText);

                    if(data.length === 0 )
                        return;

                    if(data["status"] === true){
                        data["filters"].forEach(function (element){
                            filters_suggestions.innerHTML +=
                                "<div class=\"cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-indigo-100\" onclick=\"selectFilter(this)\" id=\"filter-id-" + element.id + "\" data-value=\""+ element.filter +"\">" +
                                    "<div class=\"flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-indigo-100\">" +
                                        "<div class=\"w-full items-center flex\">" +
                                            "<div class=\"mx-2 leading-6\">"+ element.filter +"</div>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>";
                        });
                    }
                    else{
                        console.log(data["error"]);
                    }
                }
            });
            request.send(params);
        }

        function selectFilter(element){
            let selection = element.firstChild;
            if(selection.classList.contains("border-indigo-500")){
                selection.classList.add("hover:border-indigo-100");
                selection.classList.remove("border-indigo-500");
                changeInputFilters(element.id, element.getAttribute("data-value"));
            }
            else{
                selection.classList.add("border-indigo-500");
                selection.classList.remove("hover:border-indigo-100");
                changeInputFilters(element.id, element.getAttribute("data-value"));
            }
        }

        function changeInputFilters(id, title){
            let filter_input = document.getElementById(id + "-input");
            if(filter_input == null){
                let filters_selected = document.getElementById("filters-input");

                filters_selected.innerHTML +=
                    "<div class=\"flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-indigo-700 bg-indigo-100 border border-indigo-300 h-[26px]\" id=\""+ id + "-input" +"\">" +
                        "<div class=\"text-xs font-normal leading-none max-w-full flex-initial\">"+ title +"</div>" +
                        "<div class=\"flex flex-auto flex-row-reverse\">" +
                            "<div>" +
                                "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"100%\" height=\"100%\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-x cursor-pointer hover:text-indigo-400 rounded-full w-4 h-4 ml-2\" data-select-parent=\""+ id +"\" onclick=\"removeFromSelect(this)\">" +
                                    "<line x1=\"18\" y1=\"6\" x2=\"6\" y2=\"18\"></line>" +
                                    "<line x1=\"6\" y1=\"6\" x2=\"18\" y2=\"18\"></line>" +
                                "</svg>" +
                            "</div>" +
                        "</div>" +
                    "</div>";
            }
            else{
                document.getElementById(id + "-input").remove();
            }
        }

        function removeFromSelect(element){
            let filter_suggestion = document.getElementById(element.getAttribute("data-select-parent")).firstChild;
            filter_suggestion.classList.add("hover:border-indigo-100");
            filter_suggestion.classList.remove("border-indigo-500");
            element.parentNode.parentNode.parentNode.remove();
        }

        function showSuggestions(){
            let suggestions = document.getElementById("filters-suggestion");

            if(suggestions.classList.contains("hidden")){
                suggestions.classList.remove("hidden");
            }
            else{
                suggestions.classList.add("hidden");
            }
        }
    </script>
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                let src = URL.createObjectURL(event.target.files[0]);
                let img = new Image();
                let banner_error = document.getElementById("banner-error");
                img.src = src;
                img.onload = function () {
                    if(this.width === 486 && this.height === 60){
                        makePreview(src);
                        changeDropzoneVisible();
                    }
                    else if(this.width !== 486){
                        banner_error.classList.remove("hidden");
                        banner_error.innerHTML = "Ширина банера должна быть равной 486 пикселям."
                    }
                    else if(this.height !== 60){
                        banner_error.classList.remove("hidden");
                        banner_error.innerHTML = "Высота банера должна быть равной 60 пикселям."
                    }
                };

            }
        }

        function makePreview(src){
            let preview = document.getElementById("img-preview");
            preview.src = src;
            preview.style.display = "block";

            let server_banner = document.getElementById("server-banner");
            server_banner.src = src;

            let upload_preview = document.getElementById("upload_preview");
            if(upload_preview.classList.contains("hidden")){
                upload_preview.classList.remove("hidden");
            }
        }

        function changeDropzoneVisible(){
            let dropzone = document.getElementById("dropzone");

            if(!dropzone.classList.contains("hidden"))
                dropzone.classList.add("hidden");
        }

        function uploadButton(){
            document.getElementById('banner-input').click();
        }
    </script>
    <script>
        let input  = document.getElementById("server-title"),
            output = document.getElementById("server-title-preview");

        function keydownHandler() {
            if(input.value === ""){
                output.innerHTML = "⭐ Будущее название сервера на MNS Game! ⭐";
            }
            else if(input.value !== "⭐ Будущее название сервера на MNS Game! ⭐"){
                output.innerHTML = this.value;
            }
        }

        input.addEventListener("input", keydownHandler);

        let server_ip_input = document.getElementById("server-ip"),
            server_ip_output = document.getElementById("ip-preview");

        function changeIp(){
            if(server_ip_input.value === ""){
                server_ip_output.innerHTML = "192.168.124.120:27015";
            }
            else if(server_ip_input.value !== "192.168.124.120:27015"){
                server_ip_output.innerHTML = this.value;
            }
        }

        server_ip_input.addEventListener("input", changeIp)
    </script>
    <script>
        function inputFilters(){
            let filters = document.getElementById("filters-input");
            let form = document.getElementById("form_input");

            if(filters == null){
                form.submit();
                return;
            }

            filters = filters.children;

            let data = [];

            for(let i = 0; i < filters.length; i++ )
            {
                data[i] = filters[i].firstChild.innerHTML;
            }

            if(data.length > 0){
                form.filters_input.value = JSON.stringify(data);
            }
            form.submit();
        }
    </script>

    <script>
        function changeServerType(element){
            let server_ip = document.getElementById("server-ip");
            let server_launcher = document.getElementById("server-launcher");
            let server_type_title = document.getElementById("server-type-title");
            let server_type_description = document.getElementById("server-type-description");
            let ip_preview = document.getElementById("ip-preview");
            let launcher_button_preview = document.getElementById("launcher-button-preview");
            if(element.checked){
                ip_preview.classList.add("hidden");
                launcher_button_preview.classList.remove("hidden");
                server_type_title.innerHTML = "Ссылка на скачивание лаунчера/клиента сервера";
                server_type_description.innerHTML = "Ссылка на страницу скачивания лаунчера/клиента сервера. Вместо поля IP адреса на странице серверов будет отображаться кнопка для перехода на страницу скачивания лаунчера/клиента сервера."
                server_ip.classList.add("hidden");
                server_launcher.classList.remove("hidden");
            }
            else{
                launcher_button_preview.classList.add("hidden");
                ip_preview.classList.remove("hidden");
                server_type_title.innerHTML = "IP адрес сервера";
                server_type_description.innerHTML = "Текстовая или циферная ссылка на ваш сервер."
                server_ip.classList.remove("hidden");
                server_launcher.classList.add("hidden");
            }
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Server add') }}</div>

                    <div class="card-body">

                        @if(session()->has('Status'))
                            <div class="alert alert-success" role="alert">
                                Server added success!
                            </div>
                        @endif

                        <form method="POST" action="{{ route('addserver') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="name" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="game" class="col-md-4 col-form-label text-md-right">{{ __('Game') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select @error('game') is-invalid @enderror" name="game" required>
                                        @foreach($games as $game)
                                            <option value="{{ $game->title }}">{{ $game->title }}</option>
                                        @endforeach
                                    </select>

                                    @error('game')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="server_data" class="col-md-4 col-form-label text-md-right">{{ __('ServerData') }}</label>

                                <div class="col-md-6">
                                    <input id="server_data" type="text" class="form-control @error('server_data') is-invalid @enderror" name="server_data" value="{{ old('server_data') }}" required autocomplete="server_data" autofocus>

                                    @error('server_data')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('AddServer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
