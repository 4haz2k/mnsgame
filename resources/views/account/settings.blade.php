@extends("layouts.main")

@section("title", "MNS Game | Продвижение проекта")

@section("styles")
    <style type="text/css">
        .wp-caption {
            position: relative;
        }
        .wp-caption img {
            display: block;
            max-width: 100%;
            height: auto;
        }
        .wp-caption-text {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            bottom: 0;
            z-index: 2;
            background-color: rgba(0,0,0,.7);
            -webkit-transition: opacity .3s ease-in-out;
            transition: opacity .3s ease-in-out;
            border-radius: 9999px;
            text-align: center;
        }
        .wp-caption:hover .wp-caption-text {
            opacity: 1;
        }
    </style>
    <script src="https://use.fontawesome.com/fd45a37d11.js"></script>
@endsection

@section("mainHeroContent")

@endsection

@section("body")
    <section class="mb-10">
        <div class="container max-w-4xl mx-auto">
            <div class="text-2xl font-bold tracking-tight mdm:text-center">MNS Game<span class="text-indigo-500 text-3xl">.</span> Настройки аккаунта</div>
            <div class="text-lg font-medium tracking-tight mdm:text-center">Измените поля с данными для применения изменений</div>
        </div>
    </section>
    <div class="container max-w-4xl lg:mx-auto mb-4">
        <div class="flex flex-col justify-center w-full text-center">
            <div class="mx-auto cursor-pointer wp-caption my-auto">
                <img class="w-24 h-24 rounded-full" src="{{ asset('img/user.png') }}" alt="User picture">
                <div class="wp-caption-text flex justify-center">
                    <div class="my-auto text-white">
                        Изменить
                    </div>
                </div>
            </div>
            <div class="text-base font-bold mt-2">{{ $user->login }}</div>
            <div class="text-base mt-1">{{ $user->email }}</div>
        </div>
    </div>
    <div class="container max-w-3xl lg:mx-auto mb-12">
        <form action="{{ route("updateSettings") }}" enctype="multipart/form-data" method="POST">
            <div class="my-2">
                <label for="name" class="font-bold">Ваше имя</label>
                <input id="name" name="name" type="text" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('name') !border-red-500 @enderror" placeholder="Ваше имя" value="{{ $user->name }}">
                @error('name')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-2">
                <label for="surname" class="font-bold">Ваша фамилия</label>
                <input id="surname" name="surname" type="text" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('surname') !border-red-500 @enderror" placeholder="Ваша фамилия" value="{{ $user->surname }}">
                @error('surname')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-2">
                <label for="email" class="font-bold">Электронная почта</label>
                <input id="email" name="email" type="text" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('email') !border-red-500 @enderror" placeholder="Ваш Email" value="{{ $user->email }}">
                @error('email')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4 text-lg text-center font-bold">Смена пароля</div>
            <div>
                <label for="current_password" class="font-bold">Текущий пароль</label>
                <input id="current_password" name="current_password" type="password" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('current_password') !border-red-500 @enderror" placeholder="Введите текущий пароль">
                @error('current_password')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-2">
                <label for="password" class="font-bold">Новый пароль</label>
                <input id="password" name="password" type="password" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('password') !border-red-500 @enderror" placeholder="Введите новый пароль">
                @error('password')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-2">
                <label for="password_confirmation" class="font-bold">Подтверждение нового пароля</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('password_confirmation') !border-red-500 @enderror" placeholder="Введите новый пароль повторно">
                @error('password_confirmation')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4 w-1/2 mx-auto">
                <button class="bg-indigo-500 w-full hover:bg-indigo-400 text-white font-bold py-1 px-3 rounded" type="submit">
                    <span class="inline align-middle">Сохранить изменения</span>
                </button>
            </div>
            @csrf
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('public/js/app.js') }}"></script>
@endsection
