@extends('layouts.main')

@section("title", "MNS Game | Статистика и управление проектом")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <link rel="stylesheet" href="{{ asset("css/serverControl.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset("css/serverControl.css") }}">
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

        .server-bg-color-1{
            background: -moz-linear-gradient(270deg, rgba(255, 255, 255, 0) 0%, rgba(235, 112, 112,0.5) 100%);
            background: -webkit-linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(235, 112, 112,0.5) 100%);
            background: linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(235, 112, 112,0.5) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#acace0",GradientType=1);
            background-size: 400% 400%;
        }

        .server-bg-color-2{
            background: -moz-linear-gradient(270deg, rgba(255, 255, 255, 0) 0%, rgba(255, 150, 92,0.5) 100%);
            background: -webkit-linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(255, 150, 92,0.5) 100%);
            background: linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(255, 150, 92,0.5) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#acace0",GradientType=1);
            background-size: 400% 400%;
        }

        .server-bg-color-3{
            background: -moz-linear-gradient(270deg, rgba(255, 255, 255, 0) 0%, rgba(139, 255, 114,0.5) 100%);
            background: -webkit-linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(139, 255, 114,0.5) 100%);
            background: linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(139, 255, 114,0.5) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#acace0",GradientType=1);
            background-size: 400% 400%;
        }

        .server-bg-gr-1{
            background: -moz-linear-gradient(270deg, rgb(255 0 0) 0%, rgba(66, 66, 255, 0.3) 100%);
            background: -webkit-linear-gradient(270deg, rgb(255 0 0) 0%, rgba(66, 66, 255, 0.3) 100%);
            background: linear-gradient(270deg, rgb(255 0 0) 0%, rgba(66, 66, 255, 0.3) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#acace0",GradientType=1);
            background-size: 400% 400%;
        }

        .server-bg-gr-2{
            background: -moz-linear-gradient(270deg, rgb(0 8 255) 0%, rgba(98, 255, 0, 0.26) 100%);
            background: -webkit-linear-gradient(270deg, rgb(0 8 255) 0%, rgba(98, 255, 0, 0.26) 100%);
            background: linear-gradient(270deg, rgb(0 8 255) 0%, rgba(98, 255, 0, 0.26) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#acace0",GradientType=1);
            background-size: 400% 400%;
        }

        .server-bg-gr-3{
            background: -moz-linear-gradient(270deg, rgb(255 225 0) 0%, rgba(255, 0, 0, 0.4) 100%);
            background: -webkit-linear-gradient(270deg, rgb(255 225 0) 0%, rgba(255, 0, 0, 0.4) 100%);
            background: linear-gradient(270deg, rgb(255 225 0) 0%, rgba(255, 0, 0, 0.4) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#acace0",GradientType=1);
            background-size: 400% 400%;
        }

        .glyphicon {
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: 400;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .glyphicon-send:before {
            content: "\e171";
        }

        .glyphicon-erase:before {
            content: "\e221";
        }
    </style>
@endsection

@section('body')
    <section class="mb-4">
        <div class="container max-w-7xl mx-auto">
            <div class="text-2xl font-bold tracking-tight mdm:text-center">MNS Game<span class="text-indigo-500 text-3xl">.</span> Статистика и управление проектом</div>
            <div class="text-lg font-medium tracking-tight mdm:text-center">На этой странице отображается статистика вашего проекта на MNS Game<span class="text-indigo-500 text-3xl">.</span> Также вы можете управлять своим сервером при помощи консоли.</div>
        </div>
    </section>
    <div class="container max-w-full px-4 mx-auto text-left md:max-w-none md:text-center">
        <div class="lg:grid grid-cols-1 max-w-7xl mx-auto">
            <div id="firstColumn" class="lg:mt-8 lg:mb-12">
                <div class="@if($server->background) {{ $server->background }} @else server-bg @endif w-full mdm:h-[17rem] h-24 flex rounded-1 shadow-md my-3 flex-wrap lg:flex-nowrap mdm:px-2 border-b-4 server-border-color" id="server_preview">
                    <div class="w-1/12 justify-center items-center flex text-md">
                        <div class="rounded-3 px-2 py-1 font-semibold tooltip-custom hidden lg:inline" data-tooltip="Место в рейтинге">
                            {{ $serverRating->get("place") }}
                        </div>
                    </div>
                    <div class="w-full lg:w-6/12 justify-center items-center flex flex-col truncate">
                        <div class="text-xs lg:!text-base mb-1 text-ellipsis overflow-hidden font-bold max-w-[560px] text-center mdm:mt-2" id="server-title-preview">
                            {{ $server->title }}
                        </div>
                        <div class="block">
                            <img class="rounded-2" src="@if($server->banner_img == null) {{ asset("/img/deps/banner_placeholder_preview.png") }} @else {{ asset("/img/banners/{$server->banner_img}") }} @endif" width="486" height="60" alt="" id="server-banner">
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
                                <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500">{{ $server->online ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-2/12 justify-center items-center flex text-xs mdm:mt-2 mdm:flex-wrap mdm:text-center">
                        <div class="lg:hidden w-full mb-1">
                            <span class="block font-semibold">Адрес проекта</span>
                        </div>
                        <div>
                            <div class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded tooltip-custom flex max-w-[185px] @if($server->is_launcher) hidden @endif" data-tooltip="Нажмите, чтобы скопировать адрес" id="ip-preview">
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
                                <span class="inline align-middle pt-[1px] align-middle font-semibold text-[11.5px] text-white text-ellipsis overflow-hidden" id="server-ip-span">{{ $server->server_data }}</span>
                            </div>
                            <button class="modal-open bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded @if(!$server->is_launcher) hidden @endif" id="launcher-button-preview">
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
                                    <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500">{{ $server->online ?? 0 }}</span>
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
                                    <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500 mt-[1%]">{{ $serverRating->get('rating') }}</span>
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
            <section class="text-gray-600 body-font">
                <div class="container px-5 mdm:!px-2 pb-12 mx-auto text-left">
                    <div class="flex flex-wrap -m-4">
                        <div class="w-1/3 mdm:w-full p-4">
                            <div class="border border-gray-200 p-6 mdm:p-3 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                        </svg>
                                    </div>
                                    <div class="text-lg mdm:text-base text-gray-900 font-medium title-font mb-4 justify-center mx-auto mdm:text-center">Средний онлайн за месяц</div>
                                </div>
                                <p class="leading-relaxed text-base">{{ \App\Http\Services\Utilities\RussianWords::wordDeclension($serverOnlineAvg, ["игрок", "игрока", "игроков"]) }}</p>
                            </div>
                        </div>
                        <div class="w-1/3 mdm:w-full p-4">
                            <div class="border border-gray-200 p-6 mdm:p-3 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                        <svg class="w-5 h-5" viewBox="0 0 490 490" fill="currentColor">
                                            <g>
                                                <g>
                                                    <rect x="25.924" y="311.043" width="58.417" height="178.957"/>
                                                    <rect x="120.861" y="231.295" width="58.417" height="258.705"/>
                                                    <rect x="215.784" width="58.417" height="490"/>
                                                    <rect x="310.721" y="93.621" width="58.417" height="396.379"/>
                                                    <rect x="405.659" y="176.798" width="58.417" height="313.202"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text-lg mdm:text-base text-gray-900 font-medium title-font mb-4 justify-center mx-auto mdm:text-center max-w-[16rem] mdm:max-w-[14rem] text truncate ...">Место в рейтинге {{ $server->game->title }}</div>
                                </div>
                                <p class="leading-relaxed text-base">{{ $serverRating->get("place") }} место</p>
                            </div>
                        </div>
                        <div class="w-1/3 mdm:w-full p-4">
                            <div class="border border-gray-200 p-6 mdm:p-3 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </div>
                                    <div class="text-lg mdm:text-base text-gray-900 font-medium title-font mb-4 justify-center mx-auto mdm:text-center">Просмотров на MNS Game</div>
                                </div>
                                <p class="leading-relaxed text-base">{{ \App\Http\Services\Utilities\RussianWords::wordDeclension($serverViews, ["просмотр", "просмотра", "просмотров"]) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="w-full mb-4 lg:px-4">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-indigo-500">
                    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full max-w-full flex-grow flex-1">
                                <h6 class="uppercase text-white mb-1 text-xs font-semibold text-left">
                                    Статистика проекта {{ $server->title }}
                                </h6>
                                <h2 class="text-white text-xl font-semibold text-left">
                                    Онлайн проекта за месяц
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex-auto">
                        <div class="relative h-[350px]">
                            <canvas id="line-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 mt-2 border-b-2 max-w-7xl mx-auto"></div>
    <section class="mb-4" id="serverControl">
        <div class="container max-w-7xl mx-auto">
            <div class="text-2xl font-bold tracking-tight mdm:text-center">Управление сервером</div>
            @if(!$connectionInfo->get("isServerRegistered"))
                <div class="text-lg font-medium tracking-tight mdm:text-center">В данной секции вы можете привязать к своему серверу соединение по Rcon протоколу.</div>
            @else
                <div class="text-lg font-medium tracking-tight mdm:text-center">В данной секции вы можете управлять своим сервером по Rcon протоколу.</div>
            @endif
        </div>
    </section>
    @if(!$connectionInfo->get("isServerRegistered"))
        <section class="mb-4">
            <div class="container max-w-7xl mx-auto bg-red-300 px-2.5 py-3 rounded-2">
                <div class="text-base font-medium tracking-tight mdm:text-center">
                    @if(\Illuminate\Support\Facades\Session::has("connectionError"))
                        <b>Не удалось подключиться к серверу.</b><br>
                        {!! \Illuminate\Support\Facades\Session::get("connectionError") !!}<br>
                        <b>Ошибка:</b> {{ \Illuminate\Support\Facades\Session::get("reason") }}
                    @else
                        <u>Внимание!</u> MNS Game не сохраняет открытый Rcon пароль вашего сервера!<br>
                        Для защиты вашего пароля и возможности получения доступа к серверу используется защитный ключ, который придумывете и запоминаете вы сами!<br>
                        При помощи придуманного вами ключа, Rcon пароль вашего сервера зашифровывается и сохраняется в MNS Game, поэтому расшифровать пароль удастся только при вводе верного ключа.<br>
                        После ввода верного ключа, открывается временная сессия длительностью 30 минут. В течение этого времени вы можете пользоваться консолью.
                    @endif
                </div>
            </div>
        </section>
        <div class="container max-w-7xl mx-auto">
            <div class="lg:grid grid-cols-1 max-w-7xl mx-auto">
                <div class="my-4">
                    <form class="w-full" method="POST" action="{{ route("connectToServerFirstTime") }}">
                        @csrf
                        <input type="hidden" name="server_id" value="{{ $server->id }}">
                        <input type="hidden" name="is_launcher" value="{{ $server->is_launcher }}">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="lg:w-1/3 w-full px-3 lg:my-2">
                                <label class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">
                                    IP адрес сервера @if($server->is_launcher)<span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>@endif
                                </label>
                                <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">
                                    Введите адрес сервера, по которому будет осуществляться подключение к вашему серверу. <br><br>
                                    @if(!$server->is_launcher) Оставьте поле пустым, если хотите использовать IP адрес <b>{{ @explode(":", $server->server_data)[0] }}</b>@endif
                                </span>
                            </div>
                            <div class="lg:w-2/3 w-full px-3 lg:my-4">
                                <input value="{{ old('address') }}" name="address" class="@error('address') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" type="text" placeholder="Введите IP адрес сервера (без порта) формата 127.0.0.1" @if($server->is_launcher) required @endif >
                                @error('address')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="lg:w-1/3 w-full px-3 lg:my-2">
                                <label class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">
                                    Rcon пароль <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>
                                </label>
                                <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Что такое Rcon пароль, как его получить и открыть Rcon протокол читайте в этой <a href="{{ url("support/faq/answer/4") }}" class="text-indigo-500">статье</a></span>
                            </div>
                            <div class="lg:w-2/3 w-full px-3 lg:my-4">
                                <input value="{{ old('rcon_password') }}" name="rcon_password" class="@error('rcon_password') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-1 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" type="text" placeholder="Rcon пароль вашего сервера" required>
                                @error('rcon_password')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="lg:w-1/3 w-full px-3 lg:my-2">
                                <label class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">
                                    Rcon порт <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>
                                </label>
                                <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Не путайте Rcon порт вашего сервера с портом, по которому подключаются игроки!</span>
                            </div>
                            <div class="lg:w-2/3 w-full px-3 lg:my-4">
                                <input value="{{ old('rcon_port') }}" name="rcon_port" class="@error('rcon_port') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-1 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" type="text" placeholder="Rcon порт, например: 25575" required>
                                @error('rcon_port')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="lg:w-1/3 w-full px-3 lg:my-2">
                                <label class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">
                                    Секретный ключ <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>
                                </label>
                                <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Придумайте секретный ключ, который вы будете вводить при подключении к своему серверу на этой странице.</span>
                            </div>
                            <div class="lg:w-2/3 w-full px-3 lg:my-4">
                                <input value="{{ old('user_key') }}" name="user_key" class="@error('user_key') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-1 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" type="text" placeholder="Секретный ключ, например: !VeryStrongKey1180!" required>
                                @error('user_key')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-12 border border-blue-700 rounded mx-auto">Подключиться к серверу</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif ($connectionInfo->get("isConnected") or \Illuminate\Support\Facades\Session::get("isConnected"))
        <section class="container max-w-7xl mx-auto relative h-[40rem] mb-4">
            <div class="bg-[#dadbf1] w-full h-full rounded-2 border !border-gray-300 shadow-md relative">
                <div class="h-11 bg-[#bfc2ff] border-b border-gray-400 py-2.5 px-3">
                    <div class="flex justify-content-between">
                        <div class="flex">
                            <div class="w-1/2 text-indigo-500">
                                <svg viewBox="0 0 36 36" class="w-5 h-5 mx-auto" fill="currentColor">
                                    <path d="M32,5H4A2,2,0,0,0,2,7V29a2,2,0,0,0,2,2H32a2,2,0,0,0,2-2V7A2,2,0,0,0,32,5ZM6.8,15.81V13.17l10,4.59v2.08l-10,4.59V21.78l6.51-3ZM23.4,25.4H17V23h6.4ZM4,9.2V7H32V9.2Z"></path>
                                    <rect x="0" y="0" width="36" height="36" fill-opacity="0"/>
                                </svg>
                            </div>
                            <div class="w-1/2 text-left text-base">
                                Консоль
                            </div>
                        </div>
                        <div class="flex mr-4">
                            <div class="w-1/2 text-indigo-500">
                                <svg viewBox="0 0 296.228 296.228" class="w-5 h-5 mx-auto" fill="currentColor">
                                    <path d="m167.364,48.003v-23.003h10.5c6.903,0 12.5-5.597 12.5-12.5s-5.596-12.5-12.5-12.5h-59.5c-6.903,0-12.5,5.597-12.5,12.5s5.597,12.5 12.5,12.5h10.5v23.003c-59.738,9.285-105.604,61.071-105.604,123.37-3.55271e-15,68.845 56.01,124.855 124.854,124.855 68.845,0 124.854-56.01 124.854-124.855 0-62.299-45.866-114.086-105.604-123.37zm23.148,165.589c-2.442,2.452-5.65,3.68-8.857,3.68-3.19,0-6.381-1.214-8.82-3.643l-33.54-33.398c-2.355-2.346-3.68-5.533-3.68-8.857v-64.082c0-6.903 5.597-12.5 12.5-12.5 6.903,0 12.5,5.597 12.5,12.5v58.889l29.86,29.734c4.891,4.87 4.908,12.785 0.037,17.677z"/>
                                </svg>
                            </div>
                            <div class="w-1/2 text-left text-base" id="timer">00:00</div>
                        </div>
                    </div>
                </div>
                <div class="overflow-y-auto h-[546px] filter-scroll-mnsgame" id="console-body">
                    @if($connectionInfo->get("history"))
                        @foreach($connectionInfo->get("history") as $commandLog)
                            <div class="flex @if($commandLog->by_user) bg-indigo-500 @else bg-orange-500 @endif rounded mx-2 my-1 text-sm px-2.5 py-1 text-white justify-between">
                                <div class="my-auto pr-2 max-w-[88%]">
                                    {{ $commandLog->log }}
                                </div>
                                <div class="border-l border-white pl-2 my-auto text-center w-[143px]">
                                    {{ \Carbon\Carbon::parse($commandLog->created_at)->addHours(3)->format("d.m.Y H:i:s") }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="h-12 bg-[#bfc2ff] border-b border-gray-400 py-2.5 px-3 absolute bottom-0 w-full border-t border-gray-400 py-2.5 px-4 flex mb-0" style="display: table">
                    <input type="text" id="consoleInput" class="h-7 table-cell relative float-left w-full text-gray-700 border border-gray-200 rounded-l-lg py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm">
                    <div class="whitespace-nowrap align-middle table-cell w-[1%]">
                        <button onclick="sendCommand()" class="h-7 bg-indigo-500 hover:bg-indigo-700 text-white font-bold border-blue-700 mx-auto text-xs px-2"><i class="fa-solid fa-paper-plane mr-[2px]"></i> <span class="mdm:hidden">Отправить</span></button>
                        <button onclick="clearInput()" class="h-7 bg-orange-500 hover:bg-orange-700 text-white font-bold border-blue-700 rounded-r-lg mx-auto text-xs !ml-[-5px] px-2"><i class="fa-solid fa-eraser mr-[2px]"></i> <span class="mdm:hidden">Очистить</span></button>
                    </div>
                </div>
            </div>
        </section>
    @else
        @if(\Illuminate\Support\Facades\Session::has("connectionError"))
            <section class="mb-4">
                <div class="container max-w-7xl mx-auto bg-red-300 px-2.5 py-3 rounded-2">
                    <div class="text-base font-medium tracking-tight mdm:text-center">
                        <b>Не удалось подключиться к серверу.</b><br>
                        {!! \Illuminate\Support\Facades\Session::get("connectionError") !!}<br>
                        <b>Ошибка:</b> {{ \Illuminate\Support\Facades\Session::get("reason") }}
                    </div>
                </div>
            </section>
        @endif
        <div class="container max-w-7xl mx-auto">
            <div class="lg:grid grid-cols-1 max-w-7xl mx-auto">
                <div class="my-4">
                    <form class="w-full" method="POST" action="{{ route("connectToServer") }}">
                        @csrf
                        <input type="hidden" name="server_id" value="{{ $server->id }}">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="lg:w-1/3 w-full px-3 lg:my-2">
                                <label class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">
                                    Секретный ключ <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>
                                </label>
                                <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Введите ключ, который вы указывали ранее, для подключения к серверу.</span>
                            </div>
                            <div class="lg:w-2/3 w-full px-3 lg:my-4">
                                <input value="{{ old('user_key') }}" name="user_key" class="@error('user_key') !border-red-500 @enderror appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-1 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" type="text" placeholder="Секретный ключ" required>
                                @if(!\Illuminate\Support\Facades\Session::get("isConnected"))
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ \Illuminate\Support\Facades\Session::get("reason") }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="lg:w-1/2 w-full px-3 lg:my-2 text-center">
                                <button onclick="deleteConnection()" type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-12 border border-blue-700 rounded mdm:mb-3">Удалить подключение</button>
                            </div>
                            <div class="lg:w-1/2 w-full px-3 lg:my-2 text-center">
                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-12 border border-blue-700 rounded">Подключиться к серверу</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section("scripts")
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        @if ($connectionInfo->get("isConnected"))
            let timer = document.getElementById("timer");
            let current_seconds = {{ $connectionInfo->get("timeLeft") }};

            window.onload = () => {
                scrollBottom();

                setInterval(() => {
                    if(current_seconds <= 0)
                        window.location.reload(true);

                    timer.innerText = DateMNS.getTimer(current_seconds);
                    current_seconds = current_seconds - 1;
                }, 1000);
            }
        @endif

        let consoleInput = document.getElementById("consoleInput");
        consoleInput.addEventListener("keydown", function (e) {
            if (e.code === "Enter") {
                sendCommand();
                clearInput();
            }
        });

        function scrollBottom() {
            let body = document.getElementById("console-body");
            body.scrollTop = body.scrollHeight;
        }

        function clearInput(){
            document.getElementById("consoleInput").value = "";
        }

        function sendCommand(){
            if(document.getElementById("consoleInput").value === "")
                return;

            const request = new XMLHttpRequest();

            const url = "{{ url("/server/console/send") }}";
            const server_id = {{ $server->id }};
            const command = document.getElementById("consoleInput").value;

            document.getElementById("console-body").innerHTML += '<div class="flex bg-indigo-500 rounded mx-2 my-1 text-sm px-2.5 py-1 text-white justify-between"><div class="my-auto pr-2 max-w-[88%]">' + command + '</div><div class="border-l border-white pl-2 my-auto text-center w-[143px]">' + DateMNS.getCurrentTime() + '</div></div>';

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("Accept", "application/json");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            const params = "server_id=" + server_id + "&command=" + command;

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 401){
                    window.location.href = '{{ url("/login") }}';
                }
                if(request.readyState === 4) {
                    let data = JSON.parse(request.responseText);
                    document.getElementById("console-body").innerHTML += '<div class="flex bg-orange-500 rounded mx-2 my-1 text-sm px-2.5 py-1 text-white justify-between"><div class="my-auto pr-2 max-w-[88%]">' + data.message + '</div><div class="border-l border-white pl-2 my-auto text-center w-[143px]">' + data.time + '</div></div>';
                    scrollBottom();
                    clearInput();
                }
            });
            request.send(params);
        }

        function deleteConnection() {
            const request = new XMLHttpRequest();

            const url = "{{ url("/server/console/delete") }}";
            const server_id = {{ $server->id }};

            request.open("DELETE", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("Accept", "application/json");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            const params = "server_id=" + server_id;

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 401){
                    window.location.href = '{{ url("/login") }}';
                }
                if(request.readyState === 4) {
                    window.location.reload(true);
                }
            });
            request.send(params);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
    <script>
        const myChart = new Chart(document.getElementById("line-chart").getContext('2d'), {
            type: "line",
            data: {
                labels: [
                    @foreach($server_online as $key => $online)
                        "{{ $key }}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: "Среднее количество онлайна",
                        fill: false,
                        backgroundColor: "#fff",
                        borderColor: "#fff",
                        data: [
                            @foreach($server_online as $online)
                                "{{ round($online->avg('online')) }}",
                            @endforeach
                        ],
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                title: {
                    display: false,
                    text: "Статистика",
                    fontColor: "white",
                },
                legend: {
                    labels: {
                        fontColor: "white",
                    },
                    align: "end",
                    position: "bottom",
                },
                tooltips: {
                    mode: "index",
                    intersect: false,
                },
                hover: {
                    mode: "nearest",
                    intersect: true,
                },
                scales: {
                    xAxes: [
                        {
                            ticks: {
                                fontColor: "rgba(255,255,255,.7)",
                            },
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: "Month",
                                fontColor: "white",
                            },
                            gridLines: {
                                display: false,
                                borderDash: [2],
                                borderDashOffset: [2],
                                color: "rgba(33, 37, 41, 0.3)",
                                zeroLineColor: "rgba(0, 0, 0, 0)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2],
                            },
                        },
                    ],
                    yAxes: [
                        {
                            ticks: {
                                fontColor: "rgba(255,255,255,.7)",
                                beginAtZero:true,
                            },
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: "Value",
                                fontColor: "white",
                            },
                            gridLines: {
                                borderDash: [3],
                                borderDashOffset: [3],
                                drawBorder: false,
                                color: "rgba(255, 255, 255, 0.15)",
                                zeroLineColor: "rgba(33, 37, 41, 0)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2],
                            },
                        },
                    ],
                },
            },
        });
    </script>
@endsection
