@extends('admin.layouts.sidebar')

@section('title', "MNS Game | Админ-панель")

@section('body')
<div class="relative md:ml-64 bg-blueGray-50">
    <nav class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
        <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
            <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="{{url('adminpanel')}}">Мониторинг данных</a>
            <div class="text-white text-sm uppercase hidden lg:inline-block lg:ml-auto font-semibold mr-3">
                <div class="relative flex w-full flex-wrap items-stretch">
                    {{ $name }}
                </div>
            </div>
            <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
                <a class="text-blueGray-500 block" onclick="openDropdown(event,'user-dropdown')">
                    <div class="items-center flex">
                        <span class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full">
                            <img alt="img" class="w-full rounded-full align-middle border-none shadow-lg" src="@if(\Illuminate\Support\Facades\Auth::user()->profile_image) {{ asset("/img/profiles/".\Illuminate\Support\Facades\Auth::user()->profile_image) }} @else {{ asset('img/user.png') }} @endif"/>
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
                <div class="flex flex-wrap justify-around">
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-4">
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
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-4">
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
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                            Продажи
                                        </h5>
                                        <span class="font-semibold text-xl text-blueGray-700">{{ $sales["current_month"] }}</span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-blueGray-400 mt-4">
                                    @if($sales["percent"] <= 0)
                                        <span class="text-red-500 mr-2">
                                            <i class="fas fa-arrow-down"></i>
                                            {{$sales["percent"] * -1}}%
                                        </span>
                                    @else
                                        <span class="text-emerald-500 mr-2">
                                            <i class="fas fa-arrow-up"></i>
                                            {{$sales["percent"]}}%
                                        </span>
                                    @endif
                                    <span class="whitespace-nowrap"> С прошлого месяца </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-4">
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
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                            Всего пользователей
                                        </h5>
                                        <span class="font-semibold text-xl text-blueGray-700">{{ $users }}</span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-emerald-500">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4 py-4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                            <div class="flex-auto p-4">
                                <div class="flex flex-wrap">
                                    <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                        <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                            Всего серверов
                                        </h5>
                                        <span class="font-semibold text-xl text-blueGray-700">{{ $servers }}</span>
                                    </div>
                                    <div class="relative w-auto pl-4 flex-initial">
                                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-gray-500">
                                            <i class="fas fa-server"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 md:px-10 mx-auto w-full -m-24">
        <div class="flex flex-wrap">
            <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-blueGray-700">
                    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full max-w-full flex-grow flex-1">
                                <h6 class="uppercase text-blueGray-100 mb-1 text-xs font-semibold">
                                    Статистика
                                </h6>
                                <h2 class="text-white text-xl font-semibold">
                                    Визиты и новые пользователи
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex-auto">
                        <!-- Chart -->
                        <div class="relative h-350-px">
                            <canvas id="line-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-4/12 px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full max-w-full flex-grow flex-1">
                                <h6 class="uppercase text-blueGray-400 mb-1 text-xs font-semibold">
                                    Статистика
                                </h6>
                                <h2 class="text-blueGray-700 text-xl font-semibold">
                                    Заказы и сумма
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex-auto">
                        <!-- Chart -->
                        <div class="relative h-350-px">
                            <canvas id="bar-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap mt-4">
            <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-blueGray-700">
                                    Посещаемость страниц за последние 30 дней
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <!-- Projects table -->
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                            <tr>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Ссылка
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Посетители
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Название страницы
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($page_views as $view)
                            <tr>
                                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    {{ $view["url"] }}
                                </th>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    {{ $view["pageviews"] }}
                                </td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    {{ \Illuminate\Support\Str::limit($view["title"], 50) }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-4/12 px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-blueGray-700">
                                    Показы в городах и регионах
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <!-- Projects table -->
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead class="thead-light">
                            <tr>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Область
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Показы
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($geo_data as $geo)
                            <tr>
                                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    {{ $geo->name }}
                                </th>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    {{ $geo->y }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
