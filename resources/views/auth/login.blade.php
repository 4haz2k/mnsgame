@extends('layouts.main')

@section("title", "MNS Game | Авторизация")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
@endsection

@section("background", "login-background")

@section('mainHeroContent')
    <div class="min-h-full flex items-center justify-center pb-24 pt-2 flex-grow-2">
        <div class="w-[95%] lg:!w-[440px]">
            <div class="mb-4">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">MNS Game<span class="text-indigo-500">.</span></h2>
                <br>
                <h3 class="text-center text-xl font-extrabold text-gray-900">Авторизация</h3>
            </div>
            <div class="bg-white px-5 pb-5 pt-3 rounded-3 shadow-xl shadow-slate-700/10">
                <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="remember" value="true">
                    <div>
                        <label for="login" class="font-bold">Логин</label>
                        <input id="login" name="login" type="text" autocomplete="email" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('login') !border-red-500 @enderror" placeholder="Ваш логин">
                        @error('login')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="font-bold">Пароль</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('password') !border-red-500 @enderror" placeholder="Ваш пароль">
                        @error('password')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Запомнить меня </label>
                        </div>

                        <div class="text-sm text-center">
                            <div>
                                <a href="{{ url("/password/reset") }}" class="font-medium text-indigo-600 hover:text-indigo-500"> Забыли пароль? </a>
                            </div>
                            <div>
                                <a href="{{ url("/register") }}" class="font-medium text-indigo-600 hover:text-indigo-500"> Регистрация </a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Авторизоваться
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
                        <a href="{{ route("auth.social", "discord") }}">
                            <button class="w-full justify-center text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-1 focus:ring-indigo-200 font-medium rounded-lg text-sm px-[2.5rem] py-1 text-center mr-2 mb-2">
                                <svg class="mx-auto w-6 h-6 text-center inline" fill="#808080" viewBox="-1 0 20 20"><path d="M15.45,0 C16.5684694,0 17.4812026,0.901320283 17.4997134,2.02517151 L17.5,2.06 L17.5,20 L15.35,18.1 L14.14,16.98 L12.86,15.79 L13.39,17.64 L2.05,17.64 C0.931530612,17.64 0.0187973761,16.7386797 0.000286625896,15.6148285 L0,15.58 L0,2.06 C0,0.931632653 0.901320283,0.0187984173 2.01547452,0.00028663652 L2.05,0 L15.45,0 Z M7.32,4.78 L7.22,4.6599169 L7.1630624,4.66059412 C6.890192,4.66871965 5.6772,4.7596 4.41,5.71 L4.36156128,5.802081 C4.110624,6.291581 2.97,8.6742 2.97,11.54 L2.99079837,11.5731719 C3.132297,11.789822 4.0089,12.9963 6.02,13.06 L6.31452473,12.6987136 C6.43107266,12.5548097 6.56647059,12.3864706 6.69,12.23 C5.5242617,11.8811964 5.02413637,11.1785226 4.94987673,11.0655003 L4.94,11.05 L4.98113281,11.0774219 C5.02625,11.1067188 5.1075,11.1575 5.22,11.22 C5.23,11.23 5.24,11.24 5.26,11.25 C5.29,11.27 5.32,11.28 5.35,11.3 C5.6,11.44 5.85,11.55 6.08,11.64 C6.49,11.8 6.98,11.96 7.55,12.07 C8.27857143,12.206 9.12982041,12.2570694 10.0579114,12.0948686 L10.14,12.08 C10.61,12 11.09,11.86 11.59,11.65 C11.94,11.52 12.33,11.33 12.74,11.06 L12.7236045,11.0849198 C12.6278835,11.2248395 12.1044828,11.9182759 10.93,12.25 L11.0953826,12.4572606 C11.347936,12.770868 11.59,13.06 11.59,13.06 C13.8,12.99 14.65,11.54 14.65,11.54 C14.65,8.32 13.21,5.71 13.21,5.71 C11.9716,4.7812 10.784972,4.67329454 10.4769888,4.66128549 L10.4,4.6599169 L10.26,4.82 C11.7675403,5.28112997 12.5594623,5.92313048 12.7194499,6.06258405 L12.75,6.09 C11.71,5.52 10.69,5.24 9.74,5.13 C9.02,5.05 8.33,5.07 7.72,5.15 C7.66,5.15 7.61,5.16 7.55,5.17 L7.493785,5.17528 C7.11445,5.21385 6.2965,5.3535 5.28,5.8 L5.13470143,5.86775227 C4.9530442,5.9537305 4.82068394,6.02127593 4.74962341,6.05838585 L4.69,6.09 C4.69,6.09 5.503483,5.315721 7.26629086,4.79567994 L7.32,4.78 Z M6.94,8.39 C7.51,8.39 7.97,8.89 7.96,9.5 C7.96,10.11 7.51,10.61 6.94,10.61 C6.38,10.61 5.92,10.11 5.92,9.5 C5.92,8.89 6.37,8.39 6.94,8.39 Z M10.59,8.39 C11.16,8.39 11.61,8.89 11.61,9.5 C11.61,10.11 11.16,10.61 10.59,10.61 C10.03,10.61 9.57,10.11 9.57,9.5 C9.57,8.89 10.02,8.39 10.59,8.39 Z"/></svg>
                                <span class="inline block lg:hidden text-sm my-auto align-middle">Discord</span>
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
{{--                    <div class="relative w-full mx-1 justify-center text-center ">--}}
{{--                        <a href="{{ route("auth.social", "google") }}">--}}
{{--                            <button class="w-full justify-center text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-1 focus:ring-indigo-200 font-medium rounded-lg text-sm px-[2.5rem] py-1 text-center mr-2 mb-2">--}}
{{--                                <svg class="mx-auto w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path fill="#808080" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"/><path fill="#fff" d="M34 19H36V27H34z"/><path fill="#fff" d="M31 22H39V24H31zM27.815 22.2l-.05-.2H19v3h5.91c-.477 2.837-2.938 5-5.91 5-3.314 0-6-2.686-6-6s2.686-6 6-6c1.5 0 2.868.554 3.92 1.465l2.151-2.106C23.471 15.894 21.34 15 19 15c-4.971 0-9 4.029-9 9s4.029 9 9 9 9-4.029 9-9C28 23.383 27.934 22.782 27.815 22.2z"/></svg>--}}
{{--                                <span class="inline block lg:hidden text-sm my-auto align-middle">Google</span>--}}
{{--                            </button>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
