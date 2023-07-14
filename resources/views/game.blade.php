@extends("layouts.main")

@section("title", $title)

@section("integration_main")
    @if($game->id == 2)
        <a target="_blank" href="{{ url("https://superhub.host/") }}" class="inline-block w-full py-2 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 text-gray-700 lg:mx-3 md:text-center">Хостинг для сервера</a>
    @endif
@endsection

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <style type="text/css">
        .bg-shadow-50{
            background: url("{{ asset($game->image) }}") center no-repeat;
            position: relative;
            -webkit-background-size: cover;
            background-size: cover;
        }
        .bg-shadow-50:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgb(255,255,255);
            background: -moz-linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(0,0,0,0.85) 30%);
            background: -webkit-linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(0,0,0,0.85) 30%);
            background: linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(0,0,0,0.85) 30%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#000000",GradientType=1);
            z-index: 2;
        }

        @media (max-width: 1024px) {
            .bg-shadow-50:after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgb(255,255,255);
                background: -moz-linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(0,0,0,0.85) 0%);
                background: -webkit-linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(0,0,0,0.85) 0%);
                background: linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(0,0,0,0.85) 0%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#000000",GradientType=1);
                z-index: 2;
            }
        }

        .inner {
            position: relative;
            z-index: 3;
            color: #fff;
            text-align: center;
        }

        .text-gray-700{
            color: white !important;
        }

        .text-gray-700:hover{
            color: #0a58ca !important;
        }

        .title-color-white{
            color: white;
        }

        @media (min-width: 1024px) {
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
        }

        .notify{
            position: fixed;
            top: 0;
            width: 100%;
            height: 0;
            box-sizing: border-box;
            color: white;
            text-align: center;
            background: rgba(0,0,0,.6);
            overflow: hidden;
            transition: height .2s;
            z-index: 100;
        }

        #notifyType:before{
            display: block;
            margin-top: 15px;

        }

        .active{
            height: 50px;
        }

        .success:before{
            Content: "Адрес сервера скопирован в буфер обмена";
        }

        .voteSuccess:before{
            Content: "Голос засчитан. Спасибо!";
        }

        .voteFailed:before{
            Content: "Нельзя проголосовать за свой проект!";
        }

        .voteTimeFailed:before{
            Content: "Голосовать за один проект можно только один раз за 24 часа!";
        }

        .voteServerNotFound:before{
            Content: "Данного сервера не существует!";
        }

        .successFavorite:before{
            Content: "Сервер добавлен в избранное. Спасибо!";
        }

        .errorFavorite:before{
            Content: "Вы уже добавили данный сервер в избранное!";
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
    </style>
@endsection

@section("title-color", "title-color-white")

@section("background", "bg-shadow-50")

@section("mainHeroContent")
    <!-- Main Hero Content -->
    <div class="mt-16 h-96 text-left">
        <h1 class="text-5xl mdm:!text-3xl font-bold mb-5">{{ $game->title }}</h1>
        <h3 class="text-xl mdm:!text-lg w-9/12">{{ $game->description }}</h3>
    </div>
    <!-- End Main Hero Content -->
@endsection

@section("body")
        <div class="container max-w-full px-4 mx-auto text-left md:max-w-none md:text-center">
            <div class="max-w-7xl mx-auto">
                <div class="lg:mt-8 lg:mb-12">
                    <h3 class="text-xl text-left my-3">Категории</h3>
                    <div class="flex mdm:flex-wrap">
                        <div class="lg:w-2/5 w-full px-3 lg:my-2 text-justify font-medium text-base">
                            Представляем вам сервера от MNS Game, здесь вы с лёгкостью подберете сервера <strong>{{ $game->title }}</strong> под конкретные ваши требования!<br><br>
                            Рядом расположены категории <strong>{{ $game->title }}</strong>, где выбирая их нажатием, ниже вам будут отображаются сервера, которые соответствуют выбранным категориям.<br><br>
                            Удачных вам игр - команда <strong>MNS Game Мониторинг</strong>!
                        </div>
                        <div class="lg:w-3/5 w-full px-3 lg:my-2">
                            @if(!$game->filters->isEmpty())
                                <h3 class="text-lg text-center mb-2">Список категорий</h3>
                                <div class="flex flex-col items-center relative">
                                    <div class="w-full">
                                        <div class="p-1 flex border border-gray-200 bg-white h-full">
                                            <div class="flex flex-auto flex-wrap">
                                                @foreach($game->filters as $filter)
                                                    <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-indigo-700 border border-indigo-300 h-[26px] cursor-pointer category-server" id="filter-id-{{ $filter->id }}" onclick="filterHandler(this);">
                                                        <div class="text-xs font-normal leading-none max-w-full flex-initial">
                                                            {{ $filter->filter }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <h3 class="text-lg text-center mb-2 mt-3">Типы проектов</h3>
                            <div class="flex flex-col relative">
                                <div class="w-full">
                                    <div class="flex justify-center">
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input rounded-full h-4 w-4 border border-gray-300 bg-white checked:!bg-blue-600 checked:border-blue-300 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="projectType" id="projectType-1" value="{{ \App\Http\Interfaces\ServerData::projectType["all"] }}" @if(request("projectType")) @if(request("projectType") == \App\Http\Interfaces\ServerData::projectType["all"]) checked @endif @else checked @endif>
                                                <label class="form-check-label text-gray-800 text-base" for="projectType-1">
                                                    Все проекты
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:!bg-blue-600 checked:border-blue-300 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="projectType" id="projectType-2" value="{{ \App\Http\Interfaces\ServerData::projectType["onlyAddresses"] }}" @if(request("projectType")) @if(request("projectType") == \App\Http\Interfaces\ServerData::projectType["onlyAddresses"]) checked @endif @endif>
                                                <label class="form-check-label text-gray-800 text-base" for="projectType-2">
                                                    Только проекты с адресом сервера
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:!bg-blue-600 checked:border-blue-300 transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="projectType" id="projectType-3" value="{{ \App\Http\Interfaces\ServerData::projectType["onlyLaunchers"] }}" @if(request("projectType")) @if(request("projectType") == \App\Http\Interfaces\ServerData::projectType["onlyLaunchers"]) checked @endif @endif>
                                                <label class="form-check-label text-gray-800 text-base text-left" for="projectType-3">
                                                    Только сайт проектов
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-xl text-left mt-4 mb-3">Проекты</h3>
                    <div class="w-full h-12 flex rounded-1 mdm:hidden">
                        <div class="w-1/12 justify-center items-center flex text-sm">
                            Место
                        </div>
                        <div class="w-5/12 justify-center items-center flex text-sm">
                            Название проекта
                        </div>
                        <div class="w-1/12 justify-center items-center flex text-sm">
                            Игроков
                        </div>
                        <div class="w-2/12 justify-center items-center flex text-sm">
                            IP адрес / Сайт проекта
                        </div>
                        <div class="w-1/12 justify-center items-center flex text-sm">
                            Рейтинг
                        </div>
                    </div>
                    @foreach($servers as $key => $server)
                        <div class="@if($server->background) {{ $server->background }} @else server-bg @endif w-full mdm:h-[17rem] h-24 flex rounded-1 shadow-md my-3 flex-wrap lg:flex-nowrap mdm:px-2 border-b-4
                        @switch($servers->firstItem() + $key)
                            @case(1)
                                border-[#FFA500]
                                @break
                            @case(2)
                                border-[#808080]
                                @break
                            @case(3)
                                border-[#CD7F32]
                                @break
                            @default
                                server-border-color
                                @break
                        @endswitch
                        " id="server_preview">
{{--                            Rating lg sm--}}
                            <div class="w-1/12 justify-center items-center flex text-md">
                                <div class="rounded-3 px-2 py-1 font-semibold tooltip-custom hidden lg:inline flex" data-tooltip="Место в рейтинге">
                                    <div class="w-1/2 inline">
                                        @if($servers->firstItem() + $key <= 3)
                                            <svg viewBox="0 0 282.887 282.887" class="w-4 h-4">
                                                <path
                                                    @switch($servers->firstItem() + $key)
                                                        @case(1)
                                                            fill="#FFA500"
                                                            @break
                                                        @case(2)
                                                            fill="#A9A9A9"
                                                            @break
                                                        @case(3)
                                                            fill="#CD7F32"
                                                            @break
                                                        @default
                                                            fill="#FFFFFF"
                                                            @break
                                                    @endswitch
                                                    d="M282.84,92.192L263.4,264.533c-0.423,3.749-3.563,6.553-7.321,6.619c-0.469,0.092-0.954,0.075-1.45,0.075
                                                c-0.006,0-0.014,0-0.02,0H28.277c-0.46,0-0.908,0.012-1.35-0.069c-3.811-0.006-7.013-2.802-7.441-6.59L0.047,92.209
                                                c-0.127-1.132,0.005-2.277,0.386-3.351l0.425-1.196c0.979-2.759,3.475-4.695,6.39-4.96c2.909-0.26,5.717,1.19,7.178,3.729
                                                l59.346,103.095l61.463-172.88c1.063-2.99,3.893-4.987,7.066-4.987s6.004,1.998,7.067,4.988l60.797,171.056l58.298-101.273
                                                c1.461-2.538,4.258-4.002,7.181-3.728c2.916,0.266,5.411,2.204,6.389,4.964l0.424,1.196
                                                C282.836,89.935,282.967,91.062,282.84,92.192z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="w-1/2 inline">
                                        {{ $servers->firstItem() + $key }}
                                    </div>
                                </div>
                            </div>
{{--                            End Rating lg sm--}}
                            <div class="w-full lg:w-5/12 justify-center items-center flex flex-col truncate">
{{--                                Server Title lg sm--}}
                                <a href="{{ route("server", ["id" => $server->id]) }}">
                                    <div class="text-xs lg:!text-base mb-1 text-ellipsis overflow-hidden font-bold max-w-[560px] text-center mdm:mt-2" id="server-title-preview">
                                        {{ $server->title }}
                                    </div>
                                </a>
{{--                                End Server Title lg sm--}}
{{--                                Banner lg sm--}}
                                <div class="block">
                                    <a href="{{ route("server", ["id" => $server->id]) }}">
                                        <img class="rounded-2" src="@if($server->banner_img == null) {{ asset("/img/deps/banner_placeholder.png") }} @else {{ asset("/img/banners/{$server->banner_img}") }} @endif" width="486" height="60" alt="" id="server-banner">
                                    </a>
                                </div>
{{--                                End Banner lg sm--}}
                            </div>
                            @if(!$server->is_launcher)
                            <div class="w-1/3 lg:w-1/12 justify-center items-center flex text-xs mdm:hidden">
{{--                                Players count lg sm--}}
                                <div class="text-indigo-500 rounded-3 px-2 py-1 tooltip-custom" data-tooltip="Текущее кол-во игроков на сервере">
                                    <div class="text-center mr-1 items-center justify-center">
                                        <svg class="inline font-bold" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <circle fill="#00A300" cx="11.997" cy="18" r="1"/>
                                            <path fill="#00A300" d="M18 13c-.198 0-.397-.058-.572-.18-5.77-4.038-10.748-.084-10.798-.044-.43.35-1.06.283-1.406-.147-.35-.43-.282-1.064.146-1.413.062-.05 6.214-4.935 13.202-.044.453.317.563.943.248 1.397-.194.28-.505.43-.82.43z"/>
                                            <path fill="#00A300" d="M21 10c-.193 0-.388-.055-.56-.172C11.173 3.546 3.72 9.7 3.644 9.763c-.423.36-1.053.303-1.41-.12-.354-.424-.302-1.058.12-1.415.086-.072 8.7-7.184 19.205-.065.456.31.576.934.27 1.394-.195.288-.51.443-.83.443zm-6.002 6c-.197 0-.396-.058-.57-.18-2.552-1.776-4.713-.113-4.803-.04-.43.343-1.058.273-1.404-.157-.342-.43-.28-1.055.148-1.403 1.157-.945 4.153-2.17 7.203-.046.455.316.567.94.25 1.395-.193.28-.504.43-.82.43z"/>
                                        </svg>
                                        <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500">{{ $server->online == null ? 0 : $server->online }}</span>
                                    </div>
                                </div>
{{--                                Players count End lg sm--}}
                            </div>
                            @else
                                <div class="w-1/3 lg:w-1/12 justify-center items-center flex text-xs mdm:hidden"></div>
                            @endif
                            <div class="w-full lg:w-2/12 justify-center items-center flex text-xs mdm:mt-2 mdm:flex-wrap mdm:text-center">
                                <div class="lg:hidden w-full mb-1">
                                    <span class="block font-semibold">@if(!$server->is_launcher) Адрес сервера @else Ссылка на лаунчер @endif</span>
                                </div>
                                <div>
                                    @if(!$server->is_launcher)
                                        <div class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded tooltip-custom max-w-[189px] truncate overflow-hidden" data-tooltip="Нажмите, чтобы скопировать адрес" id="ip-preview" onclick="copy('{{ $server->server_data }}')">
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
                                            <span class="inline align-middle pt-[1px] align-middle font-semibold text-[11.5px] text-white">{{ $server->server_data }}</span>
                                        </div>
                                    @else
                                        <button class="modal-open bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded" id="launcher-button-preview" onclick="redirect('{{ $server->server_data }}')">
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
                                    @endif
                                </div>
                            </div>
                            @if(!$server->is_launcher)
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
                                                <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500">{{ $server->online }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="@if(!$server->is_launcher) w-1/2 @else w-full @endif lg:w-1/12 justify-center items-center flex text-xs mdm:flex-wrap mdm:text-center mdm:mt-1 mdm:mb-2">
                                <div class="lg:hidden w-full mb-1">
                                    <span class="block font-semibold">@if(!$server->is_launcher) Рейтинг сервера @else Рейтинг проекта @endif</span>
                                </div>
                                <div>
                                    <div class="rounded-3 px-2 py-1 text-orange-400 font-semibold tooltip-custom" data-tooltip="Рейтинг сервера">
                                        <div class="text-center mr-1 items-center justify-center">
                                            <svg class="inline font-bold" width="20px" height="20px" viewBox="0 0 211.618 211.618">
                                                <path fill="#00A300" d="M204.118,202.309H7.5c-4.142,0-7.5-3.357-7.5-7.5v-178c0-4.143,3.358-7.5,7.5-7.5s7.5,3.357,7.5,7.5v170.5h189.118 c4.142,0,7.5,3.357,7.5,7.5S208.26,202.309,204.118,202.309z M188.854,93.754c-1.932-1.413-4.424-1.819-6.703-1.092l-47.875,15.254 l-16.317-47.958c-0.74-2.176-2.437-3.892-4.604-4.656c-2.166-0.767-4.565-0.495-6.507,0.735L78.768,73.809L43.2,28.261 c-1.971-2.523-5.325-3.519-8.352-2.476c-3.027,1.042-5.059,3.891-5.059,7.092v133.863c0,4.143,3.358,7.5,7.5,7.5h147.139 c4.142,0,7.5-3.357,7.5-7.5V99.809C191.928,97.416,190.786,95.167,188.854,93.754z"/>
                                            </svg>
                                            <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500 mt-[1%]">{{ $server->rating != null ? $server->rating : 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/2 lg:w-1/12 justify-center items-center flex text-xs mdm:flex-wrap mdm:text-center mdm:hidden">
                                <button class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded tooltip-custom" data-tooltip="В избранное" onclick="addFavorite({{ $server->id }})">
                                    <svg viewBox="0 0 940.688 940.688" class="w-5 h-4 inline align-middle font-bold" color="white" fill="currentColor">
                                        <g>
                                            <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z"/>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            <div class="w-1/2 justify-center items-center flex text-xs mdm:flex-wrap mdm:text-center lg:hidden mb-2">
                                <button class="bg-indigo-500 min-w-[90%] hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded" onclick="addFavorite({{ $server->id }})">
                                    <span class="inline align-middle pt-[1%]">В избранное</span>
                                    <svg viewBox="0 0 940.688 940.688" class="w-5 h-4 inline align-middle font-bold" color="white" fill="currentColor">
                                        <g>
                                            <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z"/>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            <div class="w-1/2 lg:w-1/12 justify-center items-center flex text-xs mdm:flex-wrap mdm:text-center mdm:hidden">
                                <button class="modal-open bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded tooltip-custom" id="launcher-button-preview" data-tooltip="Проголосовать" onclick="addServerId({{ $server->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class="w-5 h-4 inline mr-1 align-middle font-bold" color="white"	 viewBox="0 0 66.831 66.831" style="enable-background:new 0 0 66.831 66.831;" xml:space="preserve"> <g> 	<path fill="#FFFFFF" d="M51.735,20h-2.934c1.419-3.934,2.799-9.714,0.942-14.247c-1.095-2.673-3.177-4.574-6.021-5.496 		C43.197,0.086,42.651,0,42.101,0c-3.701,0-7.05,3.613-11.944,12.888c-2.199,4.171-5.364,7.683-7.593,9.577 		c-0.946,0.804-1.702,1.624-2.315,2.431c-1.69-2.512-4.558-4.167-7.806-4.167c-5.185,0-9.404,4.219-9.404,9.404v27.294 		c0,5.186,4.219,9.404,9.404,9.404c3.406,0,6.386-1.827,8.036-4.546c2.212,2.728,5.586,4.477,9.364,4.477h23.023 		c9.507,0,10.926-6.136,10.926-9.793v-24.91C63.793,25.41,58.384,20,51.735,20z M15.847,57.427c0,1.877-1.527,3.404-3.403,3.404 		c-1.877,0-3.404-1.527-3.404-3.404V30.133c0-1.877,1.527-3.404,3.404-3.404c1.876,0,3.403,1.527,3.403,3.404V57.427z 		 M57.793,56.969c0,2.221-0.354,3.793-4.926,3.793H29.844c-3.34,0-6.058-2.717-6.058-6.057V32.059l0.008-0.095l-0.021-0.176 		c-0.006-0.096-0.106-2.386,2.676-4.75c2.656-2.258,6.419-6.425,9.015-11.351c4.132-7.83,6.104-9.353,6.639-9.641 		c1.039,0.388,1.688,1.007,2.087,1.981c1.293,3.156-0.331,9.224-2.603,13.587l-2.283,4.385h12.43c3.341,0,6.059,2.718,6.059,6.059 		V56.969z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                                </button>
                            </div>
                            <div class="w-1/2 justify-center items-center flex text-xs mdm:flex-wrap mdm:text-center lg:hidden mb-2">
                                <button class="modal-open bg-indigo-500 min-w-[90%] hover:bg-indigo-400 text-white font-bold py-1 px-3 border-b-4 border-indigo-700 hover:border-indigo-500 active:!border-0 rounded tooltip-custom" id="launcher-button-preview" data-tooltip="Проголосовать" onclick="addServerId({{ $server->id }})">
                                    <span class="inline align-middle pt-[1%]">Голосовать</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class="w-5 h-4 inline mr-1 align-middle font-bold" color="white"	 viewBox="0 0 66.831 66.831" style="enable-background:new 0 0 66.831 66.831;" xml:space="preserve"> <g> 	<path fill="#FFFFFF" d="M51.735,20h-2.934c1.419-3.934,2.799-9.714,0.942-14.247c-1.095-2.673-3.177-4.574-6.021-5.496 		C43.197,0.086,42.651,0,42.101,0c-3.701,0-7.05,3.613-11.944,12.888c-2.199,4.171-5.364,7.683-7.593,9.577 		c-0.946,0.804-1.702,1.624-2.315,2.431c-1.69-2.512-4.558-4.167-7.806-4.167c-5.185,0-9.404,4.219-9.404,9.404v27.294 		c0,5.186,4.219,9.404,9.404,9.404c3.406,0,6.386-1.827,8.036-4.546c2.212,2.728,5.586,4.477,9.364,4.477h23.023 		c9.507,0,10.926-6.136,10.926-9.793v-24.91C63.793,25.41,58.384,20,51.735,20z M15.847,57.427c0,1.877-1.527,3.404-3.403,3.404 		c-1.877,0-3.404-1.527-3.404-3.404V30.133c0-1.877,1.527-3.404,3.404-3.404c1.876,0,3.403,1.527,3.403,3.404V57.427z 		 M57.793,56.969c0,2.221-0.354,3.793-4.926,3.793H29.844c-3.34,0-6.058-2.717-6.058-6.057V32.059l0.008-0.095l-0.021-0.176 		c-0.006-0.096-0.106-2.386,2.676-4.75c2.656-2.258,6.419-6.425,9.015-11.351c4.132-7.83,6.104-9.353,6.639-9.641 		c1.039,0.388,1.688,1.007,2.087,1.981c1.293,3.156-0.331,9.224-2.603,13.587l-2.283,4.385h12.43c3.341,0,6.059,2.718,6.059,6.059 		V56.969z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                    @if($servers->isEmpty())
                        <div class="mt-6 text-lg font-bold text-center">Список серверов пуст!</div>
                        <div class="mt-2 mb-6 text-base max-w-2xl mx-auto">Возможно, на данный момент на <strong>MNS Game</strong> нет серверов по выбранной игре, либо вы указали категории, по которым сервера не были найденны!</div>
                    @endif
                    <a href="{{ route("addserver") }}">
                        <div class="flex w-full mdm:h-48 h-24 w-full cursor-pointer appearance-none justify-center rounded-md border-2 border-dashed border-gray-300 bg-white px-4 transition hover:border-gray-400 focus:outline-none mdm:mb-3" id="dropzone">
                        <span class="flex items-center space-x-2">
                            <span class="font-medium text-gray-600 text-center text-lg">
                                Хочешь добавить свой сервер?<br>
                                <span class="text-blue-600">Нажимай на эту область для добавления</span>
                            </span>
                        </span>
                        </div>
                    </a>
                </div>
                {{ $servers->appends(request()->input())->links('pagination::tailwind') }}
            </div>
        </div>
        <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center hidden">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto" id="modal-body"></div>
        </div>
        <div class="notify"><span id="notifyType" class=""></span></div>
@endsection

@section('scripts')
    <script>
        let radios = document.querySelectorAll('input[type=radio][name="projectType"]');

        function changeHandler() {
            let url = new URL(window.location.href);
            switch (this.value) {
                case "all":
                    url.searchParams.set('projectType', this.value);
                    break;
                case "addresses":
                    url.searchParams.set('projectType', this.value);
                    break;
                case "launchers":
                    url.searchParams.set('projectType', this.value);
                    break;
                default:
                    break;
            }

            window.location.href = url;
        }

        Array.prototype.forEach.call(radios, function(radio) {
            radio.addEventListener('change', changeHandler);
        });
    </script>

    <script>
        function filterHandler(element){
            if(element.classList.contains("bg-white")){
                element.classList.remove("bg-white");
                element.classList.add("bg-indigo-100");
                makeQuery(element.id.split("-")[2]);
            }
            else{
                element.classList.add("bg-white");
                element.classList.remove("bg-indigo-100");
                makeQuery(element.id.split("-")[2], "remove");
            }
        }

        function makeQuery(id, action = "add"){
            let url = new URL(window.location.href);
            if(action === "add"){
                let expect_category = url.searchParams.get("categories");

                if(expect_category == null){
                    url.searchParams.set("categories", id);
                    window.location.href = url;
                    return;
                }

                let new_categories = expect_category.split("-");
                new_categories.push(id);
                new_categories = new_categories.join("-");
                url.searchParams.set("categories", new_categories);
                window.location.href = url;
            }
            else if(action === "remove"){
                let expect_category = url.searchParams.get("categories");

                if(expect_category == null){
                    return;
                }

                let new_categories = expect_category.split("-");
                new_categories.splice(new_categories.indexOf(id), 1);
                new_categories = new_categories.join("-");
                url.searchParams.set("categories", new_categories);

                if(url.searchParams.get("categories") === ""){
                    url.searchParams.delete("categories");
                }

                window.location.href = url;
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            let url = new URL(window.location.href);

            let filter_list = document.querySelectorAll(".category-server");

            let expect_category = url.searchParams.get("categories");

            if(expect_category == null){
                return;
            }

            let categories = expect_category.split("-");

            for(element of categories){
                for (let i = 0; i < filter_list.length; i++) {
                    if(element === filter_list[i].id.split("-")[2]){
                        filter_list[i].classList.remove("bg-white");
                        filter_list[i].classList.add("bg-indigo-100");
                    }
                }
            }
        });
    </script>

    <script>
        let openmodal = document.querySelectorAll('.modal-open')
        for (let i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event){
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        let closemodal = document.querySelectorAll('.modal-close')
        for (let i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            modal.classList.toggle('hidden')
            body.classList.toggle('modal-active')
        }

        function redirect(url){
            document.getElementById("modal-body").innerHTML =
                ' <div class="modal-content py-4 text-left px-6">'+
                    '<div class="flex justify-between items-center pb-3">'+
                        '<p class="text-xl font-bold">Внимание!</p>'+
                    '</div>'+
                    '<p class="mb-1">Вы покидаете <strong>MNS Game Project!</strong></p>'+
                    '<p class="my-1">Мы не несём ответственность за содержимое и деятельность сайта, на который вы переходите.</p>'+
                    '<p class="mt-1">Вы уверены, что хотите продолжить?</p>'+
                    '<div class="flex justify-end pt-2">'+
                        '<button class="modal-close px-3 bg-transparent py-1 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2" onclick="toggleModal()">Отменить</button>'+
                        '<a href="'+ url +'" id="redirectUrl" target="_blank">'+
                            '<button class="modal-close bg-red-500 hover:bg-red-400 text-white py-1 px-3 rounded">'+
                                '<span class="inline align-middle pt-[1%]">Продолжить</span>'+
                            '</button>'+
                        '</a>'+
                    '</div>'+
                '</div>';
        }

        function addServerId(id){
            document.getElementById("modal-body").innerHTML =
                '<div class="modal-content py-4 text-left px-6">'+
                '<div class="flex justify-between items-center pb-3 text-center">'+
                '<p class="text-sm">Введите свой ник (для игры Minecraft), либо <a class="text-indigo-500 underline" href="https://steamid.io/" target="_blank">SteamID (для игр Steam)</a></p>'+
                '</div>'+
                '<input name="nickname" class="appearance-none block text-gray-600 border border-gray-200 rounded px-2 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm inline" type="text" id="nickname-input">'+
                '<div class="flex justify-center pt-2">'+
                '<button class="modal-close bg-indigo-500 hover:bg-indigo-400 text-white py-1 px-3 rounded" onclick="voteProject()">'+
                ' <span class="inline align-middle pt-[1%]">Продолжить</span>'+
                '</button>'+
                '</div>'+
                '</div>';
            localStorage.setItem("project_id", id);
        }

        function displayPromo() {
            let promoKey = localStorage.getItem('promoKey');

            if (! promoKey) {
                document.getElementById("modal-body").innerHTML =
                    '<div class="modal-content py-4 text-left px-6"><div class="items-center pb-3 text-start"><div class="text-xl text-center">Конкурс на 12 пакетов на MNS Game Мониторинг!</div><div class="mt-2">Привет! 🤙 Прямо сейчас в нашей группе <a target="_blank" href="https://vk.cc/coWOba"><strong>ВКонтакте</strong></a> проходит конкурс на пакеты для продвижения проекта!</div><div class="mt-2"><strong>Мы разыгрываем 12 пакетов, а именно:</strong></div><ul class="list-disc mt-1 pl-6"><li class="mt-2">3 пакета <strong>Emerald 🧩</strong></li><li class="mt-2">3 пакета <strong>Sapphire 💎</strong></li><li class="mt-2">6 пакетов <strong>Ruby 🔥</strong></li></ul><div class="mt-3">Начать участие в конкурсе можно всего лишь за 2 действия:</div><ul class="list-disc mt-1 pl-6"><li>Подписаться на <a target="_blank" href="https://vk.cc/coWOba" class="text-blue-500">группу</a>!</li><li>Поставить лайк на <a target="_blank" href="https://vk.cc/coWC37" class="text-blue-500">записи конкурса</a>!</li></ul><div class="mt-2">Скорее переходи и участвуй в конкурсе, ведь конкурс продлиться лишь <strong>до 14 июля</strong>!</div></div><div class="flex justify-center pt-2"><a target="_blank" href="https://vk.cc/coWC37"><button class="bg-indigo-500 hover:bg-indigo-400 text-white py-1 px-3 rounded"><span class="inline align-middle pt-[1%]">Перейти на страницу конкурса</span></button></a></div></div>';

                toggleModal();
                localStorage.setItem('promoKey', 'true');
            }
        }

        function addFavorite(id) {
            const request = new XMLHttpRequest();

            const url = "{{ url("/server/favorite") }}" + "/" + id;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("Accept", "application/json");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    let notify_window = document.querySelector(".notify");
                    let notifyType = document.getElementById("notifyType");
                    notify_window.classList.toggle("active");
                    notifyType.classList.toggle("successFavorite");
                    setTimeout(() => {
                        notify_window.classList.toggle("active");
                        notifyType.classList.toggle("successFavorite");
                    }, 2500)

                }
                else if(request.readyState === 4 && request.status === 422){
                    let data = JSON.parse(request.responseText);

                    let notify_window = document.querySelector(".notify");
                    let notifyType = document.getElementById("notifyType");
                    notify_window.classList.toggle("active");

                    switch (data.code){
                        case 0:
                            notifyType.classList.toggle("voteServerNotFound");
                            setTimeout(() => {
                                notify_window.classList.toggle("active");
                                notifyType.classList.toggle("voteServerNotFound");
                            }, 2500)
                            break;
                        case 2:
                            notifyType.classList.toggle("errorFavorite");
                            setTimeout(() => {
                                notify_window.classList.toggle("active");
                                notifyType.classList.toggle("errorFavorite");
                            }, 2500)
                            break;
                        default:
                            break;
                    }
                }
                else if(request.readyState === 4 && request.status === 401){
                    window.location.href = '{{ url("/login") }}';
                }
            });
            request.send();
        }
    </script>

    <script>
        function copy(ip){
            copyToClipboard(ip);

            let notify_window = document.querySelector(".notify");
            let notifyType = document.getElementById("notifyType");
            notify_window.classList.toggle("active");
            notifyType.classList.toggle("success");

            setTimeout(() => {
                notify_window.classList.toggle("active");
                notifyType.classList.toggle("success");
            }, 2500)
        }

        function copyToClipboard(textToCopy) {
            if (navigator.clipboard && window.isSecureContext) {
                return navigator.clipboard.writeText(textToCopy);
            } else {
                let textArea = document.createElement("textarea");
                textArea.value = textToCopy;
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                textArea.style.top = "-999999px";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                return new Promise((res, rej) => {
                    document.execCommand('copy') ? res() : rej();
                    textArea.remove();
                });
            }
        }
    </script>

    <script>
        function voteProject(){
            toggleModal();

            const request = new XMLHttpRequest();

            const url = "{{ url("/server/vote") }}" + "/" + localStorage.getItem("project_id");

            const params = "&nickname=" + document.getElementById("nickname-input").value;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("Accept", "application/json");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    let notify_window = document.querySelector(".notify");
                    let notifyType = document.getElementById("notifyType");
                    notify_window.classList.toggle("active");
                    notifyType.classList.toggle("voteSuccess");
                    setTimeout(() => {
                        notify_window.classList.toggle("active");
                        notifyType.classList.toggle("voteSuccess");
                    }, 2500)

                }
                else if(request.readyState === 4 && request.status === 422){
                    let data = JSON.parse(request.responseText);

                    let notify_window = document.querySelector(".notify");
                    let notifyType = document.getElementById("notifyType");
                    notify_window.classList.toggle("active");

                    switch (data.code){
                        case 0:
                            notifyType.classList.toggle("voteServerNotFound");
                            setTimeout(() => {
                                notify_window.classList.toggle("active");
                                notifyType.classList.toggle("voteServerNotFound");
                            }, 2500)
                            break;
                        case 1:
                            notifyType.classList.toggle("voteFailed");
                            setTimeout(() => {
                                notify_window.classList.toggle("active");
                                notifyType.classList.toggle("voteFailed");
                            }, 2500)
                            break;
                        case 2:
                            notifyType.classList.toggle("voteTimeFailed");
                            setTimeout(() => {
                                notify_window.classList.toggle("active");
                                notifyType.classList.toggle("voteTimeFailed");
                            }, 2500)
                            break;
                        default:
                            break;
                    }
                }
                else if(request.readyState === 4 && request.status === 401){
                    window.location.href = '{{ url("/login") }}';
                }
            });
            request.send(params);
        }
    </script>
@endsection
