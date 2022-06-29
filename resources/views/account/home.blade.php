@extends("layouts.main")

@section("title", "MNS Game | Продвижение проекта")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <script src="https://use.fontawesome.com/fd45a37d11.js"></script>
@endsection

@section("mainHeroContent")

@endsection

@section("body")
    <section class="mb-10">
        <div class="container max-w-4xl mx-auto">
            <div class="text-2xl font-bold tracking-tight mdm:text-center" id="aloha"></div>
            <div class="text-lg font-medium tracking-tight mdm:text-center">Выбери пункт меню для продолжения</div>
        </div>
    </section>
    <div class="container max-w-2xl lg:mx-auto mb-12">
        <a href="{{ url("myservers") }}">
            <div class="h-24 lg:h-20 bg-white shadow-md my-2 py-[20px] pr-[24px] flex flex-row hover:border-b-2 hover:border-indigo-500 transition ease-in-out duration-300 hover:shadow-lg">
                <div class="basis-[96px] items-center h-full flex border-r">
                    <svg class="w-6 h-6 mx-auto" viewBox="0 0 458.18 458.18">
                        <g>
                            <path class="fill-current text-blue-500" d="M36.09,5.948c-18.803,0-34.052,15.248-34.052,34.051c0,18.803,15.249,34.052,34.052,34.052 c18.803,0,34.052-15.25,34.052-34.052C70.142,21.196,54.893,5.948,36.09,5.948z"/>
                            <path class="fill-current text-blue-500" d="M147.537,80h268.604c22.092,0,40-17.908,40-40s-17.908-40-40-40H147.537c-22.092,0-40,17.908-40,40S125.445,80,147.537,80z"/>
                            <path class="fill-current text-blue-500" d="M36.09,132.008c-18.803,0-34.052,15.248-34.052,34.051s15.249,34.052,34.052,34.052c18.803,0,34.052-15.249,34.052-34.052 S54.893,132.008,36.09,132.008z"/>
                            <path class="fill-current text-blue-500" d="M416.142,126.06H147.537c-22.092,0-40,17.908-40,40s17.908,40,40,40h268.604c22.092,0,40-17.908,40-40 S438.233,126.06,416.142,126.06z"/>
                            <path class="fill-current text-blue-500" d="M36.09,258.068c-18.803,0-34.052,15.248-34.052,34.051c0,18.803,15.249,34.052,34.052,34.052 c18.803,0,34.052-15.249,34.052-34.052C70.142,273.316,54.893,258.068,36.09,258.068z"/>
                            <path class="fill-current text-blue-500" d="M416.142,252.119H147.537c-22.092,0-40,17.908-40,40s17.908,40,40,40h268.604c22.092,0,40-17.908,40-40 S438.233,252.119,416.142,252.119z"/>
                            <path class="fill-current text-blue-500" d="M36.09,384.128c-18.803,0-34.052,15.248-34.052,34.051s15.249,34.053,34.052,34.053c18.803,0,34.052-15.25,34.052-34.053 S54.893,384.128,36.09,384.128z"/>
                            <path class="fill-current text-blue-500" d="M416.142,378.18H147.537c-22.092,0-40,17.908-40,40s17.908,40,40,40h268.604c22.092,0,40-17.908,40-40 S438.233,378.18,416.142,378.18z"/>
                        </g>
                    </svg>
                </div>
                <div class="basis-full pl-6">
                    <header class="font-extrabold text-lg mb-1 text-center mr-16 lg:mt-2">
                        Мои проекты
                    </header>
                </div>
            </div>
        </a>
        <a href="{{ asset("addserver") }}">
            <div class="h-24 lg:h-20 bg-white shadow-md my-2 py-[20px] pr-[24px] flex flex-row hover:border-b-2 hover:border-indigo-500 transition ease-in-out duration-300 hover:shadow-lg">
                <div class="basis-[96px] items-center h-full flex border-r">
                    <svg class="w-8 h-8 mx-auto" viewBox="0 0 52 52"><path class="fill-current text-blue-500" d="M50,24H28V2a2,2,0,0,0-4,0V24H2a2,2,0,0,0,0,4H24V50a2,2,0,0,0,4,0V28H50a2,2,0,0,0,0-4Z"/></svg>
                </div>
                <div class="basis-full pl-6">
                    <header class="font-extrabold text-lg mb-1 text-center mr-16 lg:mt-2">
                        Добавить новый проект
                    </header>
                </div>
            </div>
        </a>
        <a href="{{ asset("promote") }}">
            <div class="h-24 lg:h-20 bg-white shadow-md my-2 py-[20px] pr-[24px] flex flex-row hover:border-b-2 hover:border-indigo-500 transition ease-in-out duration-300 hover:shadow-lg">
                <div class="basis-[96px] items-center h-full flex border-r">
                    <svg class="w-9 h-9 mx-auto" viewBox="0 0 243.317 243.317">
                        <path class="fill-current text-blue-500" d="M242.949,93.714c-0.882-2.715-3.229-4.694-6.054-5.104l-74.98-10.9l-33.53-67.941c-1.264-2.56-3.871-4.181-6.725-4.181 c-2.855,0-5.462,1.621-6.726,4.181L81.404,77.71L6.422,88.61C3.596,89.021,1.249,91,0.367,93.714 c-0.882,2.715-0.147,5.695,1.898,7.688l54.257,52.886L43.715,228.96c-0.482,2.814,0.674,5.658,2.983,7.335 c2.309,1.678,5.371,1.9,7.898,0.571l67.064-35.254l67.063,35.254c1.097,0.577,2.296,0.861,3.489,0.861c0.007,0,0.014,0,0.021,0 c0,0,0,0,0.001,0c4.142,0,7.5-3.358,7.5-7.5c0-0.629-0.078-1.24-0.223-1.824l-12.713-74.117l54.254-52.885 C243.096,99.41,243.832,96.429,242.949,93.714z M173.504,146.299c-1.768,1.723-2.575,4.206-2.157,6.639l10.906,63.581 l-57.102-30.018c-2.185-1.149-4.795-1.149-6.979,0l-57.103,30.018l10.906-63.581c0.418-2.433-0.389-4.915-2.157-6.639 l-46.199-45.031l63.847-9.281c2.443-0.355,4.555-1.889,5.647-4.103l28.55-57.849l28.55,57.849c1.092,2.213,3.204,3.748,5.646,4.103 l63.844,9.281L173.504,146.299z"/>
                    </svg>
                </div>
                <div class="basis-full pl-6">
                    <header class="font-extrabold text-lg mb-1 text-center mr-16 lg:mt-2">
                        Продвижение проекта
                    </header>
                </div>
            </div>
        </a>
        <a href="{{ asset("notifications") }}">
            <div class="h-24 lg:h-20 bg-white shadow-md my-2 py-[20px] pr-[24px] flex flex-row hover:border-b-2 hover:border-indigo-500 transition ease-in-out duration-300 hover:shadow-lg">
                <div class="basis-[96px] items-center h-full flex border-r">
                    <svg class="w-10 h-10 mx-auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle class="fill-current text-blue-500" cx="18" cy="6" r="3"/><path class="fill-current text-blue-500" d="M18 19H5V6h8c0-.712.153-1.387.422-2H5c-1.103 0-2 .897-2 2v13c0 1.103.897 2 2 2h13c1.103 0 2-.897 2-2v-8.422A4.962 4.962 0 0 1 18 11v8z"/></svg>
                </div>
                <div class="basis-full pl-6">
                    <header class="font-extrabold text-lg mb-1 text-center mr-16 lg:mt-2">
                        Уведомления
                    </header>
                </div>
            </div>
        </a>
        <a href="{{ asset("settings") }}">
            <div class="h-24 lg:h-20 bg-white shadow-md my-2 py-[20px] pr-[24px] flex flex-row hover:border-b-2 hover:border-indigo-500 transition ease-in-out duration-300 hover:shadow-lg">
                <div class="basis-[96px] items-center h-full flex border-r">
                    <svg class="w-8 h-8 mx-auto" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path class="fill-current text-blue-500" d="M14.515 11.398l-1.918-1.75.178-.601A5.487 5.487 0 007.415 2l3 2.999L5 10.414 2.002 7.416a5.49 5.49 0 007.046 5.359l.6-.177 1.615 1.767 3.252-2.967zm-4.73 4.315l-.79-.865A7.49 7.49 0 01.421 5.036l.526-1.502L5 7.586 7.586 5 3.535.949l1.5-.527a7.487 7.487 0 019.813 8.572L16 10.045l1.153-1.051A7.49 7.49 0 0126.964.422l1.502.526L24.414 5 27 7.586l4.051-4.051.527 1.5a7.487 7.487 0 01-8.572 9.813L8.255 31.022a3 3 0 01-4.338.1L.879 28.082a3 3 0 01.1-4.338l8.806-8.032zm7.444 8.166l1.477-1.349.675.739 5.842 6.4a1 1 0 001.446.033l3.038-3.038a1 1 0 00-.033-1.446l-7.487-6.828 1.348-1.478.739.674 6.748 6.154a3 3 0 01.1 4.338l-3.039 3.038a3 3 0 01-4.338-.099L17.23 23.88zM27 10.414L21.586 5l2.998-2.998a5.49 5.49 0 00-5.359 7.046l.177.6-.462.422L2.326 25.223a1 1 0 00-.033 1.446l3.038 3.038a1 1 0 001.446-.033l15.575-17.077.601.178A5.487 5.487 0 0030 7.415l-2.999 3z"></path> </svg>
                </div>
                <div class="basis-full pl-6">
                    <header class="font-extrabold text-lg mb-1 text-center mr-16 lg:mt-2">
                        Настройки профиля
                    </header>
                </div>
            </div>
        </a>
        <a href="{{ asset("paymentHistory") }}">
            <div class="h-24 lg:h-20 bg-white shadow-md my-2 py-[20px] pr-[24px] flex flex-row hover:border-b-2 hover:border-indigo-500 transition ease-in-out duration-300 hover:shadow-lg">
                <div class="basis-[96px] items-center h-full flex border-r">
                    <svg class="w-10 h-10 mx-auto" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="ic_fluent_payment_24_filled" fill="#212121" fill-rule="nonzero">
                                <path class="fill-current text-blue-500" d="M21.9883291,10.9947074 L21.9888849,16.275793 C21.9888849,17.7383249 20.8471803,18.9341973 19.4064072,19.0207742 L19.2388849,19.025793 L4.76104885,19.025793 C3.29851702,19.025793 2.10264457,17.8840884 2.01606765,16.4433154 L2.01104885,16.275793 L2.01032912,10.9947074 L21.9883291,10.9947074 Z M18.2529045,14.5 L15.7529045,14.5 L15.6511339,14.5068466 C15.2850584,14.556509 15.0029045,14.8703042 15.0029045,15.25 C15.0029045,15.6296958 15.2850584,15.943491 15.6511339,15.9931534 L15.7529045,16 L18.2529045,16 L18.3546751,15.9931534 C18.7207506,15.943491 19.0029045,15.6296958 19.0029045,15.25 C19.0029045,14.8703042 18.7207506,14.556509 18.3546751,14.5068466 L18.2529045,14.5 Z M19.2388849,5.0207074 C20.7014167,5.0207074 21.8972891,6.162412 21.9838661,7.60318507 L21.9888849,7.7707074 L21.9883291,9.4947074 L2.01032912,9.4947074 L2.01104885,7.7707074 C2.01104885,6.30817556 3.15275345,5.11230312 4.59352652,5.02572619 L4.76104885,5.0207074 L19.2388849,5.0207074 Z" id="🎨-Color"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="basis-full pl-6">
                    <header class="font-extrabold text-lg mb-1 text-center mr-16 lg:mt-2">
                        История моих платежей
                    </header>
                </div>
            </div>
        </a>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script>
        function changeAloha() {
            let aloha = document.getElementById("aloha");
            aloha.innerText = DateMNS.getCurrentAloha() + '{{ $user->login }}' + "!";
        }

        document.addEventListener("DOMContentLoaded", changeAloha);
    </script>
@endsection
