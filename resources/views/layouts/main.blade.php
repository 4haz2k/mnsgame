<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        #user-menu::after {
            --tw-border-opacity: 0;
            bottom: 100%;
            left: 84.9%;
            border: solid transparent;
            content: '';
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-color: rgb(156 163 175 / var(--tw-border-opacity));
            border-bottom-color: #ffffff;
            border-width: 6px;
            margin-left: -6px;
        }

        .notify-indicator {
            position: absolute;
            top: 75%;
            left: 140px;
            z-index: 2;
            width: 10px;
            height: 10px;
            color: #fff;
            background-image: linear-gradient(#54a3ff, #006eed);
            background-clip: padding-box;
            border-radius: 50%;
            right: 10px;
            border: 0;
        }

        .notify-indicator-button {
            position: absolute;
            top: 7px;
            left: 227px;
            z-index: 2;
            width: 12px;
            height: 12px;
            color: #fff;
            background-image: linear-gradient(#54a3ff, #006eed);
            background-clip: padding-box;
            border-radius: 50%;
            right: 10px;
            border: 2px solid var(--bs-body-bg);
        }
    </style>
    @yield("styles")
</head>
<body class="@yield("body-bg")">

<!-- Section 1 -->
<section class="w-full px-6 pb-12 antialiased @yield('background')">
    <div class="mx-auto max-w-7xl inner">
        <nav class="relative z-50 h-24 select-none @yield('other-class')" x-data="{ showMenu: false }">
            <div class="container relative flex flex-wrap items-center justify-between h-24 mx-auto font-medium lg:justify-center sm:px-4 md:px-2">
                <div class="flex items-center justify-start w-1/4 mdm:w-2/4 h-full pr-4">
                    <a href="/" class="inline-block py-4 md:py-0">
                        <span class="p-1 text-xl font-black leading-none text-gray-900 @yield("title-color")">
                            <span class="">MNS Game</span><span class="text-indigo-600">.</span>
                        </span>
                    </a>
                </div>
                <div class="top-0 left-0 items-start hidden w-full h-full p-4 text-sm {{ request()->is('games/*') ? 'bg-gray-900' : 'bg-gray-200' }} md:items-center md:w-3/4 md:absolute lg:text-base md:bg-transparent md:p-0 md:relative md:flex" :class="{'flex fixed': showMenu, 'hidden': !showMenu }">
                    <div class="flex-col w-full h-auto rounded-lg md:bg-transparent md:rounded-none relative md:flex md:flex-row text-left">
                        <a href="/" class="inline-flex items-center block w-auto h-16 px-6 text-xl font-black leading-none {{ request()->is('games/*') ? 'text-white' : 'text-gray-900' }} md:hidden">
                            MNS Game<span class="text-indigo-600">.</span>
                        </a>
                        <div class="flex flex-col items-start justify-center w-full space-x-6 text-center lg:space-x-8 md:w-2/3 md:mt-0 md:flex-row md:items-center">
                            <a href="/" class="inline-block w-full py-2 ml-6 font-medium text-left {{ (request()->is('/')) ? 'text-indigo-600' : 'text-gray-700' }} md:ml-0 md:w-auto md:px-0 md:mx-2 lg:mx-3 md:text-center">Главная</a>
                            <a href="{{ url("/games") }}" class="inline-block w-full py-2 font-medium text-left {{ request()->is('games/*') || request()->is('games') ? 'text-indigo-600' : 'text-gray-700' }} md:w-auto md:px-0 md:mx-2 lg:mx-3 md:text-center">Игры</a>
                            <a href="{{ url("/promote") }}" class="inline-block w-full py-2 font-medium text-left {{ request()->is('promote') ? 'text-indigo-600' : 'text-gray-700' }} md:w-auto md:px-0 md:mx-2 hover:text-indigo-600 lg:mx-3 md:text-center">Продвижение</a>
                            <a href="{{ url("/support") }}" class="inline-block w-full py-2 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 {{ (request()->is('support')) ? 'text-indigo-600' : 'text-gray-700' }} lg:mx-3 md:text-center">Поддержка</a>
                        </div>
                        @guest
                            <div class="relative flex py-3 items-center lg:hidden">
                                <div class="flex-grow border-t border-gray-400"></div>
                                <div class="flex-grow border-t border-gray-400"></div>
                            </div>
                            <div class="flex flex-col items-start justify-end w-full md:items-center md:w-1/3 md:flex-row md:py-0 relative z-10">
                                <a href="{{ url('/login') }}" class="w-full px-6 py-2 mr-0 text-gray-700 md:px-0 lg:pl-2 md:mr-4 lg:mr-5 md:w-auto">Вход</a>
                                <a href="{{ url('/register') }}" class="inline-flex items-center w-full px-6 py-3 text-sm font-medium leading-4 text-white bg-indigo-600 md:px-3 md:w-auto md:rounded-full lg:px-5 hover:bg-indigo-500">Регистрация</a>
                            </div>
                        @else
                            <div class="relative flex py-3 items-center lg:hidden">
                                <div class="flex-grow border-t border-gray-400"></div>
                                <span class="flex-shrink mx-2 text-gray-400">Вы вошли как @if(\Illuminate\Support\Facades\Auth::user()->role != "admin") <strong>{{ \Illuminate\Support\Facades\Auth::user()->login }}</strong> @else <span class="text-red-500"><strong>{{ \Illuminate\Support\Facades\Auth::user()->login }}</strong></span> @endif</span>
                                <div class="flex-grow border-t border-gray-400"></div>
                            </div>
                            <div class="flex flex-col items-start justify-center w-full space-x-6 text-center md:w-2/3 md:mt-0 md:flex-row md:items-center lg:hidden">
                                @if(\Illuminate\Support\Facades\Auth::user()->role == "admin")
                                    <a href="{{ url('adminpanel') }}" class="ml-[1.5rem] inline-block w-full py-2 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 {{ (request()->is('addserver')) ? 'text-indigo-600' : 'text-gray-700' }} lg:mx-3 md:text-center"><strong>Панель администратора</strong></a>
                                @endif
                                <a href="{{ route("myservers") }}" class="ml-[1.5rem] inline-block w-full py-2 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 {{ (request()->is('myservers')) ? 'text-indigo-600' : 'text-gray-700' }} lg:mx-3 md:text-center">Мои сервера</a>
                                <a href="{{ route("addserver") }}" class="inline-block w-full py-2 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 {{ (request()->is('addserver')) ? 'text-indigo-600' : 'text-gray-700' }} lg:mx-3 md:text-center">Добавить сервер</a>
                                <a href="{{ route("settings") }}" class="inline-block w-full py-2 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 {{ (request()->is('settings')) ? 'text-indigo-600' : 'text-gray-700' }} lg:mx-3 md:text-center">Настройки</a>
                                <a href="{{ route("notifications") }}" class="inline-block w-full py-2 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 {{ (request()->is('notifications')) ? 'text-indigo-600' : 'text-gray-700' }} lg:mx-3 md:text-center">Уведомления</a>
                                <a href="{{ route("addserver") }}" class="inline-block w-full py-2 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 text-gray-700 lg:mx-3 md:text-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>
                            </div>
                            <div class="mdm:hidden flex flex-col items-start justify-end w-full md:items-center md:w-1/3 md:flex-row md:py-0 relative z-10">
                                <a href="{{ route("notifications") }}">
                                    <button class="block rounded-md bg-transparent p-2 focus:outline-none inline-flex">
                                        <svg class="h-5 w-5 text-gray-800 m-auto" xmlns="http://www.w3.org/2000/svg"  width="20px" height="20px" viewBox="0 0 512.000000 512.000000"  preserveAspectRatio="xMidYMid meet"> <g class="h-6 w-6" transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="{{ request()->is('games/*') ? '#ffffff' : '#000000' }}" stroke="none"> <path d="M2377 4949 c-643 -74 -1185 -516 -1386 -1129 -74 -226 -74 -219 -78 -976 l-4 -682 -47 -12 c-134 -34 -301 -168 -370 -297 -163 -308 -38 -694 273 -842 114 -54 116 -54 524 -60 l384 -6 13 -65 c36 -177 116 -325 248 -456 139 -138 289 -217 471 -249 471 -82 924 222 1024 689 l18 81 384 5 384 5 74 27 c128 47 230 125 306 236 124 183 139 422 38 624 -69 137 -234 273 -375 308 l-47 12 -4 682 c-4 757 -3 748 -78 975 -243 742 -984 1220 -1752 1130z m401 -475 c230 -41 442 -154 618 -328 168 -168 272 -358 326 -595 21 -93 22 -123 27 -893 l6 -796 30 -44 c58 -81 120 -108 254 -108 105 0 151 -22 182 -87 34 -70 15 -135 -55 -187 l-27 -21 -1579 0 -1579 0 -27 21 c-70 51 -89 117 -55 186 32 66 66 82 196 89 124 6 172 24 220 81 57 67 55 39 55 818 0 758 4 844 45 1007 91 359 385 678 742 807 200 71 406 88 621 50z m192 -3537 c0 -8 -14 -42 -31 -76 -129 -257 -476 -313 -681 -109 -45 46 -108 153 -108 186 0 9 89 12 410 12 336 0 410 -2 410 -13z"/> </g> </svg>
                                    </button>
                                </a>
                                <button class="relative z-10 block rounded-md bg-transparent p-2 focus:outline-none h-auto w-auto inline-flex" id="user-menu-btn" aria-expanded="true" aria-haspopup="true">
                                    <img class="h-6 w-6 inline-flex mr-[2px] rounded-full" src="@if(\Illuminate\Support\Facades\Auth::user()->profile_image) {{ asset("/img/profiles/".\Illuminate\Support\Facades\Auth::user()->profile_image) }} @else {{ asset('img/user.png') }} @endif" alt="">
                                    <svg class="h-3 w-3 text-gray-800 m-auto" xmlns="http://www.w3.org/2000/svg"  width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"  preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="{{ request()->is('games/*') ? '#ffffff' : '#000000' }}" stroke="none"> <path d="M783 3543 c-29 -6 -63 -49 -63 -79 0 -15 20 -46 52 -81 29 -32 434 -451 901 -930 834 -858 849 -873 887 -873 38 0 53 15 887 873 467 479 872 898 901 930 59 65 64 91 28 134 l-24 28 -1774 1 c-975 1 -1783 -1 -1795 -3z"/> </g> </svg>
                                </button>
                            </div>
                        @endguest
                    </div>
                </div>
                <div @click="showMenu = !showMenu" class="absolute right-0 flex flex-col items-center items-end justify-center w-10 h-10 bg-white rounded-full cursor-pointer md:hidden hover:bg-gray-100" onclick="changeState(this);">
                    <svg class="w-6 h-6 text-gray-600" x-show="!showMenu" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="w-6 h-6 text-gray-600" x-show="showMenu" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
            @guest @else
            <div class="origin-top-right absolute mt-2 w-42 rounded-sm shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100  focus:outline-none top-[60px] right-[40px] max-w-[210px] !text-left" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="user-menu" style="display: none">
                <div class="py-1" role="none">
                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                    <a href="{{url("/home")}}" class="text-gray-900 block px-4 py-2 text-sm hover:text-gray-900" role="menuitem" tabindex="-1" id="menu-item-0">
                        Вы вошли как @if(\Illuminate\Support\Facades\Auth::user()->role != "admin") <strong>{{ \Illuminate\Support\Facades\Auth::user()->login }}</strong> @else <span class="text-red-500"><strong>{{ \Illuminate\Support\Facades\Auth::user()->login }}</strong></span> @endif
                    </a>
                </div>
                <div class="py-1" role="none">
                    <a href="{{ route("myservers") }}" class="text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">Мои проекты</a>
                    <a href="{{ route("addserver") }}" class="text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">Добавить проект</a>
                    <a href="{{ url("promote") }}" class="text-lime-500 block px-4 py-2 text-sm font-semibold" role="menuitem" tabindex="-1" id="menu-item-3">Продвижение</a>
                </div>
                <div class="py-1" role="none">
                    <a href="{{ route("settings") }}" class="text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-4">Настройки</a>
                    <a href="{{ route("notifications") }}" class="text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-5">
                        Уведомления
                        @if(\Illuminate\Support\Facades\Auth::user()->role != "admin")
                            <span class="notify-indicator"></span>
                        @endif
                    </a>
                    @if(\Illuminate\Support\Facades\Auth::user()->role == "admin")
                        <a href="{{ url('adminpanel') }}" class="text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-6"><strong>Панель администратора</strong></a>
                    @endif
                </div>
                <div class="py-1" role="none">
                    <a href="{{ route('logout') }}" class="text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-7" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            @endguest
        </nav>
        @yield("mainHeroContent")
    </div>
</section>

@yield("body")

<!-- Section 4 -->
<section class="bg-white">
    <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8 @yield("footer")">
        <nav class="flex flex-wrap justify-center -mx-5 -my-2">
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Что такое MNS Game?
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="{{ url("support") }}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Связаться с нами
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="{{ url("/promote") }}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Продвижение проекта
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="{{ url('/offer') }}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Публичная оферта
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    MNS Game API
                </a>
            </div>
        </nav>
        <div class="flex justify-center mt-8 space-x-6">
            <a href="https://t.me/+negTqGAPrX1lNGMy" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Telegram</span>
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="24px" height="24px">
                    <path d="M 25.154297 3.984375 C 24.829241 3.998716 24.526384 4.0933979 24.259766 4.2011719 C 24.010014 4.3016357 23.055766 4.7109106 21.552734 5.3554688 C 20.048394 6.0005882 18.056479 6.855779 15.931641 7.7695312 C 11.681964 9.5970359 6.9042108 11.654169 4.4570312 12.707031 C 4.3650097 12.746607 4.0439208 12.849183 3.703125 13.115234 C 3.3623292 13.381286 3 13.932585 3 14.546875 C 3 15.042215 3.2360676 15.534319 3.5332031 15.828125 C 3.8303386 16.121931 4.144747 16.267067 4.4140625 16.376953 C 5.3912284 16.775666 8.4218473 18.015862 8.9941406 18.25 C 9.195546 18.866983 10.29249 22.222526 10.546875 23.044922 C 10.714568 23.587626 10.874198 23.927519 11.082031 24.197266 C 11.185948 24.332139 11.306743 24.45034 11.453125 24.542969 C 11.511635 24.579989 11.575789 24.608506 11.640625 24.634766 L 11.644531 24.636719 C 11.659471 24.642719 11.67235 24.652903 11.6875 24.658203 C 11.716082 24.668202 11.735202 24.669403 11.773438 24.677734 C 11.925762 24.726927 12.079549 24.757812 12.216797 24.757812 C 12.80196 24.757814 13.160156 24.435547 13.160156 24.435547 L 13.181641 24.419922 L 16.191406 21.816406 L 19.841797 25.269531 C 19.893193 25.342209 20.372542 26 21.429688 26 C 22.057386 26 22.555319 25.685026 22.875 25.349609 C 23.194681 25.014192 23.393848 24.661807 23.478516 24.21875 L 23.478516 24.216797 C 23.557706 23.798129 26.921875 6.5273437 26.921875 6.5273438 L 26.916016 6.5507812 C 27.014496 6.1012683 27.040303 5.6826405 26.931641 5.2695312 C 26.822973 4.8564222 26.536648 4.4608905 26.181641 4.2480469 C 25.826669 4.0352506 25.479353 3.9700339 25.154297 3.984375 z M 24.966797 6.0742188 C 24.961997 6.1034038 24.970391 6.0887279 24.962891 6.1230469 L 24.960938 6.1347656 L 24.958984 6.1464844 C 24.958984 6.1464844 21.636486 23.196371 21.513672 23.845703 C 21.522658 23.796665 21.481573 23.894167 21.439453 23.953125 C 21.379901 23.91208 21.257812 23.859375 21.257812 23.859375 L 21.238281 23.837891 L 16.251953 19.121094 L 12.726562 22.167969 L 13.775391 17.96875 C 13.775391 17.96875 20.331562 11.182109 20.726562 10.787109 C 21.044563 10.471109 21.111328 10.360953 21.111328 10.251953 C 21.111328 10.105953 21.035234 10 20.865234 10 C 20.712234 10 20.506484 10.14875 20.396484 10.21875 C 18.963383 11.132295 12.671823 14.799141 9.8515625 16.439453 C 9.4033769 16.256034 6.2896636 14.981472 5.234375 14.550781 C 5.242365 14.547281 5.2397349 14.548522 5.2480469 14.544922 C 7.6958673 13.491784 12.47163 11.434667 16.720703 9.6074219 C 18.84524 8.6937992 20.838669 7.8379587 22.341797 7.1933594 C 23.821781 6.5586849 24.850125 6.1218894 24.966797 6.0742188 z"/>
                </svg>
            </a>
            <a href="https://vk.com/mnsgameru" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Вконтакте</span>
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="24px" height="24px">
                    <path d="M45.763,35.202c-1.797-3.234-6.426-7.12-8.337-8.811c-0.523-0.463-0.579-1.264-0.103-1.776 c3.647-3.919,6.564-8.422,7.568-11.143C45.334,12.27,44.417,11,43.125,11l-3.753,0c-1.237,0-1.961,0.444-2.306,1.151 c-3.031,6.211-5.631,8.899-7.451,10.47c-1.019,0.88-2.608,0.151-2.608-1.188c0-2.58,0-5.915,0-8.28 c0-1.147-0.938-2.075-2.095-2.075L18.056,11c-0.863,0-1.356,0.977-0.838,1.662l1.132,1.625c0.426,0.563,0.656,1.248,0.656,1.951 L19,23.556c0,1.273-1.543,1.895-2.459,1.003c-3.099-3.018-5.788-9.181-6.756-12.128C9.505,11.578,8.706,11.002,7.8,11l-3.697-0.009 c-1.387,0-2.401,1.315-2.024,2.639c3.378,11.857,10.309,23.137,22.661,24.36c1.217,0.12,2.267-0.86,2.267-2.073l0-3.846 c0-1.103,0.865-2.051,1.977-2.079c0.039-0.001,0.078-0.001,0.117-0.001c3.267,0,6.926,4.755,8.206,6.979 c0.368,0.64,1.056,1.03,1.8,1.03l4.973,0C45.531,38,46.462,36.461,45.763,35.202z"/>
                </svg>
            </a>
            <a href="https://www.instagram.com/mns.game" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Instagram</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="https://github.com/4haz2k/GSMS" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">GitHub</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        <p class="mt-8 text-base leading-6 text-center text-gray-400">
            © 2021 - {{ date("Y", time()) }} MNSGame.ru. Все права защищены.
        </p>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.0/alpine.js"></script>

@guest @else
<script>
    let modal = document.getElementById("user-menu");

    let btn = document.getElementById("user-menu-btn");

    btn.onclick = function() {
        if(modal.style.display === "none")
            modal.style.display = "block";
        else
            modal.style.display = "none";
    }
</script>

<script>
    function changeState(element){
        element.classList.toggle("fixed");
        element.classList.toggle("right-[25px]")
        element.classList.toggle("absolute");
    }
</script>

<script>
    document.addEventListener("click", function(event) {if (!event.target.closest("#user-menu") && !event.target.closest("#user-menu-btn")) {closeModal()}}, false)
    function closeModal() {document.querySelector("#user-menu").style.display = "none"}
</script>
@endguest

@yield('scripts')
</body>
</html>
