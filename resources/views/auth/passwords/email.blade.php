@extends('layouts.main')

@section("title", "MNS game | Восстановление пароля")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
@endsection

@section('body')
    <div class="min-h-full flex items-center justify-center pb-24 pt-2 flex-grow-2">
        <div class="w-[95%] lg:!w-[440px]">
            <div class="mb-4">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">MNS Game<span class="text-indigo-500">.</span></h2>
                <br>
                <h3 class="text-center text-xl font-extrabold text-gray-900">Восстановление пароля</h3>
            </div>
            <div class="bg-white px-5 pb-5 pt-3 rounded-3 shadow-xl shadow-slate-700/10">
                <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <input type="hidden" name="remember" value="true">
                    <div>
                        <label for="email" class="font-bold">Email</label>
                        <input id="email" name="email" type="text" autocomplete="email" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('email') !border-red-500 @enderror" placeholder="Введите e-mail адрес, привязанный к аккаунту">
                        @error('email')
                        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
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

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
