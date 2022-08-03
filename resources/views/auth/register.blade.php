@extends('layouts.main')

@section("title", "MNS Game | Регистрация")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
@endsection

@section("body-bg", "register-background")

@section('body')
    <div class="container max-w-lg px-4 mx-auto text-left md:max-w-none md:text-center">
        <div class="lg:grid lg:!grid-cols-2 md:grid-cols-1">
            <div id="firstColumn" class="lg:mt-[-35px] mt-[50px] px-0 text-left pt-0 lg:!pt-48 lg:!px-32">
                <h2 class="mt-6 text-4xl font-extrabold text-gray-900 text-center lg:!text-left">Играй на хороших проетах вместе с <br>MNS Game Project<span class="text-indigo-500">.</span></h2>
                <h3 class="text-xl font-normal text-gray-900 text-center lg:!text-left mt-3 mb-5" id="justify">
                    MNS Game Project - это эффективный сервис, позволяющий игрокам найти хорошие проекты для игры, а владельцам поднимать его в рейтинге. Присоединяйся!
                </h3>
            </div>
            <div id="secondColumn" class="lg:mt-[40px]">
                <div class="min-h-full flex items-center justify-center pb-24 pt-2 flex-grow-2">
                    <div class="w-[95%] lg:!w-[440px]">
                        <div class="mb-4">
                            <h3 class="text-center text-xl font-extrabold text-gray-900">Бесплатная регистрация</h3>
                        </div>
                        <div class="bg-white px-3 lg:!px-5 pb-5 pt-3 rounded-3 shadow-xl shadow-slate-700/10">
                            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="remember" value="true">
                                <div class="text-left">
                                    <label for="login" class="font-bold">Логин</label>
                                    <input id="login" name="login" type="text" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('login') !border-red-500 @enderror" placeholder="Какой у вас будет логин?">
                                    @error('login')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-left">
                                    <label for="email" class="font-bold">Электронная почта</label>
                                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('email') !border-red-500 @enderror" placeholder="Электронная почта для связи">
                                    @error('email')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-left">
                                    <label for="password" class="font-bold">Пароль</label>
                                    <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('password') !border-red-500 @enderror" placeholder="Пароль для входа">
                                    @error('password')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-left">
                                    <label for="password-confirm" class="font-bold">Повторный пароль</label>
                                    <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('password') !border-red-500 @enderror" placeholder="Повторный пароль">
                                </div>
                                <div class="items-center justify-between">
                                    <div class="text-center">
                                        <a href="{{ url("/login") }}" class="font-medium text-indigo-600 hover:text-indigo-500"> У меня уже есть аккаунт </a>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Зарегистрироваться
                                    </button>
                                </div>
                            </form>
                            <div class="relative flex py-3 items-center">
                                <div class="flex-grow border-t border-gray-400"></div>
                                <span class="flex-shrink mx-2 text-gray-400">или войти через</span>
                                <div class="flex-grow border-t border-gray-400"></div>
                            </div>
                            <div class="flex flex-col lg:flex-row w-full items-center justify-center">
                                <div class="relative mx-1 w-full">
                                    <a href="{{ route("auth.social", "vkontakte") }}">
                                        <button class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-1 focus:ring-indigo-200 font-medium rounded-lg text-sm px-[2.5rem] py-1 text-center mr-2 mb-2">
                                            <svg class="mx-auto w-6 h-6 inline" fill="#808080" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="50px" height="50px">    <path d="M25,2C12.318,2,2,12.318,2,25s10.318,23,23,23c12.683,0,23-10.318,23-23S37.683,2,25,2z M34.973,29.535 c2.237,1.986,2.702,2.695,2.778,2.816C38.678,33.821,36.723,34,36.723,34h-4.12c0,0-1.003,0.011-1.86-0.557 c-1.397-0.915-2.86-2.689-3.888-2.381C25.992,31.32,26,32.486,26,33.483C26,33.84,25.693,34,25,34s-0.981,0-1.288,0 c-2.257,0-4.706-0.76-7.149-3.313c-3.456-3.609-6.487-10.879-6.487-10.879s-0.179-0.366,0.016-0.589 c0.221-0.25,0.822-0.218,0.822-0.218L14.909,19c0,0,0.376,0.071,0.646,0.261c0.223,0.156,0.347,0.454,0.347,0.454 s0.671,2.216,1.526,3.629c1.67,2.758,2.447,2.828,3.014,2.531C21.27,25.445,21,22.513,21,22.513s0.037-1.259-0.395-1.82 c-0.333-0.434-0.97-0.665-1.248-0.701c-0.225-0.029,0.151-0.423,0.63-0.648C20.627,19.059,21.498,18.986,23,19 c1.169,0.011,1.506,0.081,1.962,0.186C26.341,19.504,26,20.343,26,23.289c0,0.944-0.13,2.271,0.582,2.711 c0.307,0.19,1.359,0.422,3.231-2.618c0.889-1.442,1.596-3.834,1.596-3.834s0.146-0.263,0.373-0.393 c0.232-0.133,0.225-0.13,0.543-0.13S35.832,19,36.532,19c0.699,0,1.355-0.008,1.468,0.402c0.162,0.589-0.516,2.607-2.234,4.797 C32.943,27.793,32.63,27.457,34.973,29.535z"/></svg>
                                            <span class="inline block lg:hidden text-sm my-auto align-middle">Вконтакте</span>
                                        </button>
                                    </a>
                                </div>
                                <div class="relative mx-1 w-full justify-center text-center">
                                    <a href="{{ route("auth.social", "yandex") }}">
                                        <button class="w-full justify-center text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-1 focus:ring-indigo-200 font-medium rounded-lg text-sm px-[2.5rem] py-1 text-center mr-2 mb-2">
                                            <svg class="mx-auto w-6 h-6 text-center inline" fill="#808080" viewBox="-6 0 24 24"><path d="m7.083 14.8-4.098 9.2h-2.986l4.5-9.834c-2.114-1.074-3.525-3.018-3.525-6.614-.005-5.034 3.185-7.551 6.979-7.551h3.858v24h-2.582v-9.2h-2.146zm2.147-12.62h-1.378c-2.08 0-4.097 1.378-4.097 5.372 0 3.858 1.847 5.1 4.097 5.1h1.378z"/></svg>
                                            <span class="inline block lg:hidden text-sm my-auto align-middle">Yandex</span>
                                        </button>
                                    </a>
                                </div>
                                <div class="relative w-full mx-1 justify-center text-center ">
                                    <a href="{{ route("auth.social", "google") }}">
                                        <button class="w-full justify-center text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-1 focus:ring-indigo-200 font-medium rounded-lg text-sm px-[2.5rem] py-1 text-center mr-2 mb-2">
                                            <svg class="mx-auto w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path fill="#808080" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"/><path fill="#fff" d="M34 19H36V27H34z"/><path fill="#fff" d="M31 22H39V24H31zM27.815 22.2l-.05-.2H19v3h5.91c-.477 2.837-2.938 5-5.91 5-3.314 0-6-2.686-6-6s2.686-6 6-6c1.5 0 2.868.554 3.92 1.465l2.151-2.106C23.471 15.894 21.34 15 19 15c-4.971 0-9 4.029-9 9s4.029 9 9 9 9-4.029 9-9C28 23.383 27.934 22.782 27.815 22.2z"/></svg>
                                            <span class="inline block lg:hidden text-sm my-auto align-middle">Google</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
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
