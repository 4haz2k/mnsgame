@extends('admin.layouts.sidebar')

@section('title', "MNS Game | Админ-панель")

@section('body')
    <div class="relative md:ml-64 bg-blueGray-50">
        <nav class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
            <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
                <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="{{url('adminpanel')}}">Настройки</a>
                <div class="text-white text-sm uppercase hidden lg:inline-block lg:ml-auto font-semibold mr-3">
                    <div class="relative flex w-full flex-wrap items-stretch">
                        {{ $name }}
                    </div>
                </div>
                <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
                    <a class="text-blueGray-500 block" onclick="openDropdown(event,'user-dropdown')">
                        <div class="items-center flex">
                        <span class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full">
                            <img alt="..." class="w-full rounded-full align-middle border-none shadow-lg" src="{{ asset("img/user_default.png") }}"/>
                        </span>
                        </div>
                    </a>
                    <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48" id="user-dropdown">
                        <a href="{{ url("home") }}" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">User panel</a>
                        <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
                        <a href="{{ route("logout") }}" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </ul>
            </div>
        </nav>
        <!-- Header -->
        <div class="relative bg-gray-500 md:pt-32 pb-32 pt-12">
            <div class="px-4 md:px-10 mx-auto w-full">
                <div>
                    <!-- Card stats -->
                    <div class="flex flex-wrap">
                        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                                Трафик визитов
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">{{ $statistic["visits_sum"] }}</span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                                                <i class="far fa-chart-bar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        @if($statistic["visits_percent"] <= 0)
                                            <span class="text-red-500 mr-2">
                                            <i class="fas fa-arrow-down"></i>
                                            {{$statistic["visits_percent"] * -1}}%
                                        </span>
                                        @else
                                            <span class="text-emerald-500 mr-2">
                                            <i class="fas fa-arrow-up"></i>
                                            {{$statistic["visits_percent"]}}%
                                        </span>
                                        @endif
                                        <span class="whitespace-nowrap">
                                            С прошлого месяца
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                                Уникальные пользователи
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">
                                            {{ $statistic["users_sum"] }}
                                        </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500">
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        @if($statistic["users_percent"] <= 0)
                                            <span class="text-red-500 mr-2">
                                            <i class="fas fa-arrow-down"></i>
                                            {{$statistic["users_percent"] * -1}}%
                                        </span>
                                        @else
                                            <span class="text-emerald-500 mr-2">
                                            <i class="fas fa-arrow-up"></i>
                                            {{$statistic["users_percent"]}}%
                                        </span>
                                        @endif
                                        <span class="whitespace-nowrap">
                                            С прошлого месяца
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                                Sales
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">924</span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        <span class="text-orange-500 mr-2">
                                            <i class="fas fa-arrow-down"></i> 1.10%
                                        </span>
                                        <span class="whitespace-nowrap"> Since yesterday </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="text-blueGray-400 uppercase font-bold text-xs">Отказы</h5>
                                            <span class="font-semibold text-xl text-blueGray-700">{{ $refusal["data"] }}%</span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lightBlue-500">
                                                <i class="fas fa-percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        @if($refusal["percent"] >= 0)
                                            <span class="text-red-500 mr-2">
                                            <i class="fas fa-arrow-up"></i>
                                            {{$refusal["percent"]}}%
                                        </span>
                                        @else
                                            <span class="text-emerald-500 mr-2">
                                            <i class="fas fa-arrow-down"></i>
                                            {{$refusal["percent"] * -1}}%
                                        </span>
                                        @endif
                                        <span class="whitespace-nowrap">С прошлой недели</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 md:px-10 mx-auto w-full -m-24">
            <div class="flex flex-wrap">
                <div class="w-full px-4">
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                        <div class="rounded-t bg-white mb-0 px-6 py-6">
                            <div class="text-center flex justify-between">
                                <h6 class="text-blueGray-700 text-xl font-bold">
                                    Мой аккаунт
                                </h6>
                            </div>
                        </div>
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <form method="POST" action="{{ route("update_admin_settings") }}">
                                <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                    Информация об администраторе
                                </h6>
{{--                                <div class="p-4 mb-4 w-full text-sm text-green-700 bg-orange-200 rounded-lg" role="alert">--}}
{{--                                    <span class="font-medium">Данные успешно обновлены.</span>--}}
{{--                                </div>--}}
                                <div class="p-4 mb-4 w-full text-sm text-green-700 bg-red-200 rounded-lg" role="alert">
                                    <span class="font-medium">Не удалось обновить данные.</span>
                                </div>
                                <div class="flex flex-wrap">
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                                                Логин
                                            </label>
                                            <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" value="{{ $userdata["login"] }}"/>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                                                Email адресс
                                            </label>
                                            <input type="email" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" value="{{ $userdata["email"] }}"/>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                                                Имя
                                            </label>
                                            <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" value="{{ $userdata["name"] }}"/>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlFor="grid-password">
                                                Фамилия
                                            </label>
                                            <input type="text" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" value="{{ $userdata["surname"] }}"/>
                                        </div>
                                    </div>
                                    @csrf
                                    <button class="w-1/2 items-center bg-blueGray-600 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none ease-linear transition-all duration-150 mx-auto" type="submit">
                                        Обновить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
