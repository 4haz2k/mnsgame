@extends('layouts.main')

@section("title", "MNS Game | Добавление проекта")

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
                    Предпросмотр проекта
                </div>
                <div class="w-full h-12 flex rounded-1 mdm:hidden">
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        Место
                    </div>
                    <div class="w-6/12 justify-center items-center flex text-xs">
                        Название проекта
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        Игроков
                    </div>
                    <div class="w-2/12 justify-center items-center flex text-xs">
                        IP адрес / Сайт проекта
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        Рейтинг
                    </div>
                </div>
                <div class="server-bg w-full mdm:h-[17rem] h-24 flex rounded-1 shadow-md my-3 flex-wrap lg:flex-nowrap mdm:px-2 border-b-4 server-border-color" id="server_preview">
                    <div class="w-1/12 justify-center items-center flex text-md">
                        <div class="rounded-3 px-2 py-1 font-semibold tooltip-custom hidden lg:inline" data-tooltip="Место в рейтинге">
                            1
                        </div>
                    </div>
                    <div class="w-full lg:w-6/12 justify-center items-center flex flex-col truncate">
                        <div class="text-xs lg:!text-base mb-1 text-ellipsis overflow-hidden font-bold max-w-[560px] text-center mdm:mt-2" id="server-title-preview">
                            ⭐ Будущее название сервера на MNS Game! ⭐
                        </div>
                        <div class="block">
                            <img class="rounded-2" src="{{ asset("/img/deps/banner_placeholder_preview.png") }}" width="486" height="60" alt="" id="server-banner">
                        </div>
                    </div>
                    <div class="w-1/3 lg:w-1/12 justify-center items-center flex text-xs mdm:hidden">
                        <div class="text-indigo-500 rounded-3 px-2 py-1 tooltip-custom" data-tooltip="Текущее кол-во игроков на сервере">
                            <div class="text-center mr-1 items-center justify-center">
                                <svg class="inline font-bold" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <circle fill="#00A300" cx="11.997" cy="18" r="1"/>
                                    <path fill="#00A300" d="M18 13c-.198 0-.397-.058-.572-.18-5.77-4.038-10.748-.084-10.798-.044-.43.35-1.06.283-1.406-.147-.35-.43-.282-1.064.146-1.413.062-.05 6.214-4.935 13.202-.044.453.317.563.943.248 1.397-.194.28-.505.43-.82.43z"/>
                                    <path fill="#00A300" d="M21 10c-.193 0-.388-.055-.56-.172C11.173 3.546 3.72 9.7 3.644 9.763c-.423.36-1.053.303-1.41-.12-.354-.424-.302-1.058.12-1.415.086-.072 8.7-7.184 19.205-.065.456.31.576.934.27 1.394-.195.288-.51.443-.83.443zm-6.002 6c-.197 0-.396-.058-.57-.18-2.552-1.776-4.713-.113-4.803-.04-.43.343-1.058.273-1.404-.157-.342-.43-.28-1.055.148-1.403 1.157-.945 4.153-2.17 7.203-.046.455.316.567.94.25 1.395-.193.28-.504.43-.82.43z"/>
                                </svg>
                                <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500">1356</span>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-2/12 justify-center items-center flex text-xs mdm:mt-2 mdm:flex-wrap mdm:text-center">
                        <div class="lg:hidden w-full mb-1">
                            <span class="block font-semibold">Адрес проекта</span>
                        </div>
                        <div>
                            <div class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded tooltip-custom flex max-w-[185px]" data-tooltip="Нажмите, чтобы скопировать адрес" id="ip-preview">
                                <svg viewBox="0 0 195.085 195.085" class="inline font-bold mr-1" width="16px" height="16px">
                                    <g>
                                        <path fill="#FFFFFF" d="M179.617,15.453c-0.051-0.05-0.102-0.1-0.154-0.149c-18.689-18.549-48.477-20.463-69.37-4.441
                                                    c-2.091,1.599-3.776,3.053-5.302,4.575c-0.044,0.044-0.087,0.088-0.13,0.133L71.224,49.012c-2.929,2.929-2.929,7.678,0.001,10.606
                                                    c2.93,2.93,7.679,2.929,10.606-0.001l33.561-33.566c0.035-0.035,0.069-0.07,0.104-0.105c1.023-1.01,2.205-2.02,3.715-3.174
                                                    c15.008-11.508,36.411-10.098,49.789,3.281c0.044,0.044,0.089,0.088,0.134,0.131c14.652,14.786,14.611,38.742-0.124,53.483
                                                    l-33.559,33.563c-2.929,2.929-2.929,7.678,0.001,10.606c1.465,1.464,3.384,2.196,5.303,2.196c1.919,0,3.839-0.732,5.304-2.197
                                                    l33.56-33.563C200.241,69.641,200.241,36.077,179.617,15.453z"/>
                                        <path fill="#FFFFFF" d="M113.23,135.437l-33.541,33.542c-0.066,0.067-0.132,0.136-0.196,0.205c-3.708,3.648-8.059,6.449-12.945,8.333
                                                    c-13.995,5.418-29.888,2.07-40.481-8.524c-14.768-14.784-14.768-38.84,0-53.619L59.624,81.83c1.406-1.407,2.197-3.315,2.197-5.305
                                                    v-0.013c0-4.143-3.357-7.494-7.5-7.494c-2.135,0-4.062,0.895-5.428,2.328l-33.435,33.422c-20.61,20.628-20.612,54.195-0.002,74.828
                                                    c10.095,10.097,23.628,15.479,37.411,15.479c6.414-0.001,12.884-1.167,19.084-3.566c6.922-2.667,13.088-6.67,18.326-11.896
                                                    c0.076-0.075,0.15-0.153,0.223-0.232l33.337-33.337c2.929-2.93,2.929-7.678-0.001-10.607
                                                    C120.909,132.509,116.16,132.509,113.23,135.437z"/>
                                        <path fill="#FFFFFF" d="M59.15,135.908c1.465,1.465,3.384,2.197,5.304,2.197c1.919,0,3.839-0.732,5.303-2.196l66.164-66.161
                                                    c2.93-2.929,2.93-7.678,0.001-10.606c-2.929-2.93-7.678-2.929-10.606-0.001l-66.164,66.161
                                                    C56.221,128.23,56.221,132.979,59.15,135.908z"/>
                                    </g>
                                </svg>
                                <span class="inline align-middle pt-[1px] align-middle font-semibold text-[11.5px] text-white text-ellipsis overflow-hidden" id="server-ip-span">192.168.124.120:27015</span>
                            </div>
                            <button class="modal-open bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded hidden" id="launcher-button-preview">
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
                                <span class="inline align-middle pt-[1px]">Перейти на сайт</span>
                            </button>
                        </div>
                    </div>
                    <div class="w-1/2 justify-center items-center flex text-xs block lg:!hidden mdm:flex-wrap mdm:text-center mdm:mt-1 mdm:mb-2">
                        <div class="lg:hidden w-full mb-1">
                            <span class="block font-semibold">Игроков на сервере</span>
                        </div>
                        <div>
                            <div class="text-indigo-500 rounded-3 px-2 py-1 tooltip-custom" data-tooltip="Текущее кол-во игроков на сервере">
                                <div class="text-center mr-1 items-center justify-center">
                                    <svg class="inline font-bold" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <circle fill="#00A300" cx="11.997" cy="18" r="1"/>
                                        <path fill="#00A300" d="M18 13c-.198 0-.397-.058-.572-.18-5.77-4.038-10.748-.084-10.798-.044-.43.35-1.06.283-1.406-.147-.35-.43-.282-1.064.146-1.413.062-.05 6.214-4.935 13.202-.044.453.317.563.943.248 1.397-.194.28-.505.43-.82.43z"/>
                                        <path fill="#00A300" d="M21 10c-.193 0-.388-.055-.56-.172C11.173 3.546 3.72 9.7 3.644 9.763c-.423.36-1.053.303-1.41-.12-.354-.424-.302-1.058.12-1.415.086-.072 8.7-7.184 19.205-.065.456.31.576.934.27 1.394-.195.288-.51.443-.83.443zm-6.002 6c-.197 0-.396-.058-.57-.18-2.552-1.776-4.713-.113-4.803-.04-.43.343-1.058.273-1.404-.157-.342-.43-.28-1.055.148-1.403 1.157-.945 4.153-2.17 7.203-.046.455.316.567.94.25 1.395-.193.28-.504.43-.82.43z"/>
                                    </svg>
                                    <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500">1356</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 lg:w-1/12 justify-center items-center flex text-xs mdm:flex-wrap mdm:text-center mdm:mt-1 mdm:mb-2">
                        <div class="lg:hidden w-full mb-1">
                            <span class="block font-semibold">Рейтинг проекта</span>
                        </div>
                        <div class="tooltip-custom" data-tooltip="Рейтинг проекта">
                            <div class="rounded-3 px-2 py-1 text-orange-400 font-semibold">
                                <div class="text-center mr-1 items-center justify-center">
                                    <svg class="inline font-bold" width="20px" height="20px" viewBox="0 0 211.618 211.618">
                                        <path fill="#00A300" d="M204.118,202.309H7.5c-4.142,0-7.5-3.357-7.5-7.5v-178c0-4.143,3.358-7.5,7.5-7.5s7.5,3.357,7.5,7.5v170.5h189.118 c4.142,0,7.5,3.357,7.5,7.5S208.26,202.309,204.118,202.309z M188.854,93.754c-1.932-1.413-4.424-1.819-6.703-1.092l-47.875,15.254 l-16.317-47.958c-0.74-2.176-2.437-3.892-4.604-4.656c-2.166-0.767-4.565-0.495-6.507,0.735L78.768,73.809L43.2,28.261 c-1.971-2.523-5.325-3.519-8.352-2.476c-3.027,1.042-5.059,3.891-5.059,7.092v133.863c0,4.143,3.358,7.5,7.5,7.5h147.139 c4.142,0,7.5-3.357,7.5-7.5V99.809C191.928,97.416,190.786,95.167,188.854,93.754z"/>
                                    </svg>
                                    <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500 mt-[1%]">10000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 lg:w-1/12 justify-center items-center flex text-xs mdm:flex-wrap mdm:text-center mdm:hidden">
                        <button class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded tooltip-custom" id="launcher-button-preview" data-tooltip="Проголосовать">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class="w-5 h-4 inline mr-1 align-middle font-bold" color="white"	 viewBox="0 0 66.831 66.831" style="enable-background:new 0 0 66.831 66.831;" xml:space="preserve"> <g> 	<path fill="#FFFFFF" d="M51.735,20h-2.934c1.419-3.934,2.799-9.714,0.942-14.247c-1.095-2.673-3.177-4.574-6.021-5.496 		C43.197,0.086,42.651,0,42.101,0c-3.701,0-7.05,3.613-11.944,12.888c-2.199,4.171-5.364,7.683-7.593,9.577 		c-0.946,0.804-1.702,1.624-2.315,2.431c-1.69-2.512-4.558-4.167-7.806-4.167c-5.185,0-9.404,4.219-9.404,9.404v27.294 		c0,5.186,4.219,9.404,9.404,9.404c3.406,0,6.386-1.827,8.036-4.546c2.212,2.728,5.586,4.477,9.364,4.477h23.023 		c9.507,0,10.926-6.136,10.926-9.793v-24.91C63.793,25.41,58.384,20,51.735,20z M15.847,57.427c0,1.877-1.527,3.404-3.403,3.404 		c-1.877,0-3.404-1.527-3.404-3.404V30.133c0-1.877,1.527-3.404,3.404-3.404c1.876,0,3.403,1.527,3.403,3.404V57.427z 		 M57.793,56.969c0,2.221-0.354,3.793-4.926,3.793H29.844c-3.34,0-6.058-2.717-6.058-6.057V32.059l0.008-0.095l-0.021-0.176 		c-0.006-0.096-0.106-2.386,2.676-4.75c2.656-2.258,6.419-6.425,9.015-11.351c4.132-7.83,6.104-9.353,6.639-9.641 		c1.039,0.388,1.688,1.007,2.087,1.981c1.293,3.156-0.331,9.224-2.603,13.587l-2.283,4.385h12.43c3.341,0,6.059,2.718,6.059,6.059 		V56.969z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                        </button>
                    </div>
                    <div class="w-full justify-center items-center flex text-xs mdm:flex-wrap mdm:text-center lg:hidden mb-2">
                        <button class="bg-indigo-500 min-w-[90%] hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded tooltip-custom" id="launcher-button-preview" data-tooltip="Проголосовать">
                            <span class="inline align-middle pt-[1%]">Голосовать</span>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class="w-5 h-4 inline mr-1 align-middle font-bold" color="white"	 viewBox="0 0 66.831 66.831" style="enable-background:new 0 0 66.831 66.831;" xml:space="preserve"> <g> 	<path fill="#FFFFFF" d="M51.735,20h-2.934c1.419-3.934,2.799-9.714,0.942-14.247c-1.095-2.673-3.177-4.574-6.021-5.496 		C43.197,0.086,42.651,0,42.101,0c-3.701,0-7.05,3.613-11.944,12.888c-2.199,4.171-5.364,7.683-7.593,9.577 		c-0.946,0.804-1.702,1.624-2.315,2.431c-1.69-2.512-4.558-4.167-7.806-4.167c-5.185,0-9.404,4.219-9.404,9.404v27.294 		c0,5.186,4.219,9.404,9.404,9.404c3.406,0,6.386-1.827,8.036-4.546c2.212,2.728,5.586,4.477,9.364,4.477h23.023 		c9.507,0,10.926-6.136,10.926-9.793v-24.91C63.793,25.41,58.384,20,51.735,20z M15.847,57.427c0,1.877-1.527,3.404-3.403,3.404 		c-1.877,0-3.404-1.527-3.404-3.404V30.133c0-1.877,1.527-3.404,3.404-3.404c1.876,0,3.403,1.527,3.403,3.404V57.427z 		 M57.793,56.969c0,2.221-0.354,3.793-4.926,3.793H29.844c-3.34,0-6.058-2.717-6.058-6.057V32.059l0.008-0.095l-0.021-0.176 		c-0.006-0.096-0.106-2.386,2.676-4.75c2.656-2.258,6.419-6.425,9.015-11.351c4.132-7.83,6.104-9.353,6.639-9.641 		c1.039,0.388,1.688,1.007,2.087,1.981c1.293,3.156-0.331,9.224-2.603,13.587l-2.283,4.385h12.43c3.341,0,6.059,2.718,6.059,6.059 		V56.969z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                        </button>
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
                            <label for="server-ip" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left" id="server-type-title">
                                IP адрес сервера <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>
                            </label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left" id="server-type-description">Текстовая или циферная ссылка на ваш сервер.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input value="{{ old('server_ip') }}" name="server_ip" class="@error('server_ip') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-ip" type="text" placeholder="IP адрес сервера">
                            <input value="{{ old('launcher_link') }}" name="launcher_link" class="@error('launcher-link') !border-red-500 @enderror hidden appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-launcher" type="text" placeholder="Ссылка страницу скачивания лаунчера/клиента сервера">
                            <div class="text-center">
                                <label for="is-launcher" class="mr-[10px] ml-1 block text-xs tracking-wide text-gray-700 font-bold mb-2 inline">На моем проекте используется лаунчер или клиент</label>
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
                                Подробнее про то, как привязать callback к своему сайту и для чего он нужен, читайте в этой <a href="https://mnsgame.ru/support/faq/answer/1" class="underline text-blue-700">статье</a>.
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
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left mdm:mb-3">Баннер сервера в формате gif, png, jpeg или jpg размером 468x60 пикселей. <br><br><span class="text-red-500 font-bold">Внимание! Использование агрессивных, мигающих и нецензурных баннеров запрещено! Максимальный размер баннера 2 Мегабайта. Несоблюдение данных правил карается удалением сервера с хостинга без возможности восстановления!</span></span>
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
                            <input type="file" name="server_banner" id="banner-input" class="hidden" onchange="showPreview(event);" accept=".gif, .png, .jpeg ,.jpg"/>
                            <input type="hidden" name="filters_input" value="">
                        </div>
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-12 border border-blue-700 rounded mx-auto">Добавить проект</button>
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
           document.getElementById("filters").innerHTML = "<div class='lg:w-1/3 w-full px-3 lg:my-2'><label for='game-filters' class='block text-md tracking-wide text-gray-700 font-bold mb-2 text-left'>Категории сервера</label><span class='block text-md tracking-wide text-gray-700 mb-2 text-left'>Этот параметр определяет, в какие категории попадет ваш сервер. Выбирайте только те категории, которые действительно присутствуют на вашем сервере. В противном случае, редактирование сервера будет отключено, а сам сервер понижен в рейтинге. <br><br><strong>Внимание!</strong> В случае полного игнорирования правил выбора параметров, сервер будет удален из мониторинга без возможности восстановления!</span></div><div class='lg:w-2/3 w-full px-3 lg:my-2'><div class='flex flex-col items-center relative'><div class='w-full'> <div class='p-1 flex border border-gray-200 bg-white rounded-t-lg'><div class='flex flex-auto flex-wrap' id='filters-input'></div> <div class='text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200'><button type='button' class='cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none' onclick='showSuggestions()' id='filter-category'><svg id='filter-category' xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='w-4 h-4' style='transform: rotate(180deg);'><polyline points='18 15 12 9 6 15'></polyline></svg></button></div></div><div class='items-stretch w-full mb-4 z-20 absolute bg-gray-100 top-[42px] !rounded-b-lg hover:rounded-b-lg drop-shadow-lg'><div class='flex flex-col w-full' id='filters-suggestion'></div></div></div></div></div>";
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
                                    "<div class=\"flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-indigo-100\" id='filter-category'>" +
                                        "<div class=\"w-full items-center flex\" id='filter-category'>" +
                                            "<div class=\"mx-2 leading-6\" id='filter-category'>"+ element.filter +"</div>" +
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
                    if(this.width === 468 && this.height === 60){
                        makePreview(src);
                        changeDropzoneVisible();
                    }
                    else if(this.width !== 468){
                        banner_error.classList.remove("hidden");
                        banner_error.innerHTML = "Ширина банера должна быть равной 468 пикселям."
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
            server_ip_output = document.getElementById("server-ip-span");

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
    <script>
        window.addEventListener("click", function(event) {
            let suggestions = document.getElementById("filters-suggestion");

            if(suggestions != null){
                if(event.target.id !== "filter-category" && !suggestions.classList.contains("hidden")){
                    showSuggestions();
                }
            }
        });
    </script>
@endsection
