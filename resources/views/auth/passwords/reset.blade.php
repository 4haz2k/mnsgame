@extends('layouts.main')

@section("title", "MNS game | Изменение пароля")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
@endsection

@section('body')
    <div class="min-h-full flex items-center justify-center pb-24 pt-2 flex-grow-2">
        <div class="w-[95%] lg:!w-[440px]">
            <div class="mb-4">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">MNS Game<span class="text-indigo-500">.</span></h2>
                <br>
                <h3 class="text-center text-xl font-extrabold text-gray-900">Изменение пароля</h3>
            </div>
            <div class="bg-white px-5 pb-5 pt-3 rounded-3 shadow-xl shadow-slate-700/10">
                <form class="mt-8 space-y-6" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label for="email" class="font-bold">Электронная почта</label>
                        <input id="email" name="email" type="text" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('email') !border-red-500 @enderror" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="font-bold">Новый пароль</label>
                        <input id="password" name="password" type="password" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('password') !border-red-500 @enderror" required autocomplete="new-password" autofocus>
                        @error('password')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="font-bold">Подтверждение пароля</label>
                        <input id="password-confirm" name="password_confirmation" type="password" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required autocomplete="new-password" autofocus>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Восстановить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
