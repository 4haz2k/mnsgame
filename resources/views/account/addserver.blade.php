@extends('layouts.main')

@section("title", "MNS Game | Добавление сервера")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <style type="text/css">
        .tooltip {
            cursor: pointer;
        }

        .tooltip::after {
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
        }

        .tooltip:hover::after {
            opacity: 1; /* Показываем элемент */
            visibility: visible;
        }
    </style>
@endsection

@section('body')
    <div class="container max-w-lg px-4 mx-auto text-left md:max-w-none md:text-center">
        <div class="lg:grid grid-cols-1 max-w-6xl mx-auto">
            <div id="firstColumn" class="lg:mt-8 lg:mb-16">
                <div class="text-center lg:text-lg mb-2">
                    Предпросмотр сервера
                </div>
                <div class="w-full h-12 flex rounded-1">
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Место
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Игра
                    </div>
                    <div class="w-7/12 justify-center items-center flex text-sm">
                        Название сервера
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Игроков
                    </div>
                    <div class="w-2/12 justify-center items-center flex text-sm">
                        IP адрес
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Голосов
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Рейтинг
                    </div>
                </div>
                <div class="bg-gray-200 w-full h-24 flex rounded-1 shadow-md my-3" id="server_preview">
                    <div class="w-1/12 justify-center items-center flex text-md">
                        <div class="bg-gray-300 rounded-3 px-2 py-1 font-semibold tooltip" data-tooltip="Место в рейтинге">
                            1
                        </div>
                    </div>
                    <div class="w-1/12 justify-center items-center flex tooltip" data-tooltip="Counter Strike: Global Offensive">
                        <img class="rounded-3" src="{{ asset("img/test/csgo_logo.png") }}" width="42" height="42" id="game_logo" alt="Counter Strike: Global Offensive">
                    </div>
                    <div class="w-7/12 justify-center items-center flex flex-col truncate">
                        <div class="text-md mb-2 truncate font-bold">
                            ⭐❗ Сервер 1.18.1 ❗⭐ Без /GM 1 и админок!
                        </div>
                        <div class="block">
                            <img class="rounded-3" src="{{ asset("/img/test/banner.png") }}" width="420" height="54" alt="">
                        </div>
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        <div class="bg-gray-300 text-indigo-500 rounded-3 px-2 py-1 tooltip" data-tooltip="Текущее кол-во игроков на сервере">
                            1100
                        </div>
                    </div>
                    <div class="w-2/12 justify-center items-center flex text-xs">
                        <div class="bg-gray-300 rounded-3 px-2 py-1 tooltip" data-tooltip="Нажмите, чтобы скопировать адрес">
                            192.168.124.120:27015
                        </div>
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        <div class="bg-gray-300 rounded-3 px-2 py-1 tooltip" data-tooltip="Кол-во проголосовавших игроков">
                            111
                        </div>
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        <div class="bg-gray-300 rounded-3 px-2 py-1 text-orange-400 font-semibold tooltip" data-tooltip="Рейтинг сервера">
                            10204
                        </div>
                    </div>
                </div>
            </div>
            <div id="secondColumn" class="">

            </div>
        </div>

    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('Login') }}</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>

                                    @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
