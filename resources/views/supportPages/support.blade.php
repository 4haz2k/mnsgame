@extends("layouts.main")

@section("title", "MNS Game | Поддержка")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    {{--    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.3/dist/flowbite.min.css" />--}}
@endsection

@section("mainHeroContent")
    <!-- Main Hero Content -->
    <div class="mt-20">
        <h1 class="text-3xl font-extrabold leading-10 tracking-tight text-left text-gray-900 text-center sm:leading-none md:text-4xl lg:text-4xl">MNS Game<span class="text-indigo-500">.</span> Support</h1>
        <div class="mx-auto mt-3 text-gray-500 text-center lg:text-lg">
            Мы здесь, чтобы помочь. Найдите ответы на интересующие вас вопросы или выберите способ связи с нами.
        </div>
        <div class="flex justify-center mt-5">
            <div class="mb-3 xl:w-9/12">
                <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                    <input type="search" class="form-control h-12 relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 !rounded-l-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Введите свой вопрос..." aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase !rounded-r-lg shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="button" id="button-addon2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Hero Content -->
@endsection

@section("body")
    <div class="flex flex-col lg:flex-row justify-center lg:justify-around mb-12 mx-4 lg:mx-24">
        <div class="bg-white shadow-2xl py-16 text-center max-w-sm rounded-3 my-5 mx-auto">
            <div class="px-2">
                <svg fill="#000000" class="h-20 w-20 mx-auto" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="30px" height="30px"><path d="M 25.154297 3.984375 C 24.829241 3.998716 24.526384 4.0933979 24.259766 4.2011719 C 24.010014 4.3016357 23.055766 4.7109106 21.552734 5.3554688 C 20.048394 6.0005882 18.056479 6.855779 15.931641 7.7695312 C 11.681964 9.5970359 6.9042108 11.654169 4.4570312 12.707031 C 4.3650097 12.746607 4.0439208 12.849183 3.703125 13.115234 C 3.3623292 13.381286 3 13.932585 3 14.546875 C 3 15.042215 3.2360676 15.534319 3.5332031 15.828125 C 3.8303386 16.121931 4.144747 16.267067 4.4140625 16.376953 C 5.3912284 16.775666 8.4218473 18.015862 8.9941406 18.25 C 9.195546 18.866983 10.29249 22.222526 10.546875 23.044922 C 10.714568 23.587626 10.874198 23.927519 11.082031 24.197266 C 11.185948 24.332139 11.306743 24.45034 11.453125 24.542969 C 11.511635 24.579989 11.575789 24.608506 11.640625 24.634766 L 11.644531 24.636719 C 11.659471 24.642719 11.67235 24.652903 11.6875 24.658203 C 11.716082 24.668202 11.735202 24.669403 11.773438 24.677734 C 11.925762 24.726927 12.079549 24.757812 12.216797 24.757812 C 12.80196 24.757814 13.160156 24.435547 13.160156 24.435547 L 13.181641 24.419922 L 16.191406 21.816406 L 19.841797 25.269531 C 19.893193 25.342209 20.372542 26 21.429688 26 C 22.057386 26 22.555319 25.685026 22.875 25.349609 C 23.194681 25.014192 23.393848 24.661807 23.478516 24.21875 L 23.478516 24.216797 C 23.557706 23.798129 26.921875 6.5273437 26.921875 6.5273438 L 26.916016 6.5507812 C 27.014496 6.1012683 27.040303 5.6826405 26.931641 5.2695312 C 26.822973 4.8564222 26.536648 4.4608905 26.181641 4.2480469 C 25.826669 4.0352506 25.479353 3.9700339 25.154297 3.984375 z M 24.966797 6.0742188 C 24.961997 6.1034038 24.970391 6.0887279 24.962891 6.1230469 L 24.960938 6.1347656 L 24.958984 6.1464844 C 24.958984 6.1464844 21.636486 23.196371 21.513672 23.845703 C 21.522658 23.796665 21.481573 23.894167 21.439453 23.953125 C 21.379901 23.91208 21.257812 23.859375 21.257812 23.859375 L 21.238281 23.837891 L 16.251953 19.121094 L 12.726562 22.167969 L 13.775391 17.96875 C 13.775391 17.96875 20.331562 11.182109 20.726562 10.787109 C 21.044563 10.471109 21.111328 10.360953 21.111328 10.251953 C 21.111328 10.105953 21.035234 10 20.865234 10 C 20.712234 10 20.506484 10.14875 20.396484 10.21875 C 18.963383 11.132295 12.671823 14.799141 9.8515625 16.439453 C 9.4033769 16.256034 6.2896636 14.981472 5.234375 14.550781 C 5.242365 14.547281 5.2397349 14.548522 5.2480469 14.544922 C 7.6958673 13.491784 12.47163 11.434667 16.720703 9.6074219 C 18.84524 8.6937992 20.838669 7.8379587 22.341797 7.1933594 C 23.821781 6.5586849 24.850125 6.1218894 24.966797 6.0742188 z"/></svg>
            </div>
            <div class="mt-4">
                <span class="text-2xl font-bold">Бот Telegram</span>
            </div>
            <div class="px-10 my-5 h-25">
                <span class="text-[1rem] text-gray-500">Воспользуйтесь нашим ботом Telegram для создания тикета и быстрого ответа на ваш вопрос. В нем же вы можете найти ответы на свои вопросы.</span>
            </div>
            <div>
                <a href="">
                    <button class="bg-black hover:!bg-[#383838] w-2/3 text-white font-bold py-2 px-4 rounded hover:shadow-lg">
                        Перейти
                    </button>
                </a>
            </div>
        </div>
        <div class="bg-white shadow-2xl py-16 text-center max-w-sm rounded-3 my-5 mx-auto">
            <div class="px-2">
                <svg class="h-20 w-20 mx-auto" xmlns="http://www.w3.org/2000/svg"  width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"  preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M340 4344 c-30 -8 -59 -19 -65 -25 -11 -11 2161 -2190 2207 -2215 35 -18 121 -18 156 0 46 25 2218 2204 2207 2215 -6 6 -37 17 -70 25 -53 14 -298 16 -2220 15 -1871 0 -2167 -2 -2215 -15z"/> <path d="M23 4048 c-17 -50 -18 -123 -18 -1488 0 -1365 1 -1438 18 -1487 10 -29 22 -53 25 -53 4 0 354 347 777 770 l770 770 -770 770 c-423 424 -773 770 -777 770 -3 0 -15 -24 -25 -52z"/> <path d="M4295 3330 l-770 -770 770 -770 c423 -423 773 -770 777 -770 3 0 15 24 25 53 17 49 18 122 18 1487 0 1365 -1 1438 -18 1488 -10 28 -22 52 -25 52 -4 0 -354 -346 -777 -770z"/> <path d="M1030 1575 c-495 -495 -761 -768 -755 -774 6 -6 37 -17 70 -25 53 -14 299 -16 2215 -16 1916 0 2162 2 2215 16 33 8 64 19 70 25 6 6 -260 279 -757 776 l-767 767 -238 -235 c-218 -216 -245 -239 -317 -275 l-80 -39 -126 0 -126 0 -80 39 c-72 36 -100 60 -315 273 -129 128 -237 233 -240 233 -2 0 -348 -344 -769 -765z"/> </g> </svg>             </div>
            <div class="mt-4">
                <span class="text-2xl font-bold">Форма обратной связи</span>
            </div>
            <div class="px-10 my-5 h-25">
                <span class="text-[1rem] text-gray-500">Заполните форму обратной связи с вашим вопросом или проблемой, а мы свяжемся с вами через указанную вами электронную почту.</span>
            </div>
            <div>
                <a href="">
                    <button class="bg-black hover:!bg-[#383838] w-2/3 text-white font-bold py-2 px-4 rounded hover:shadow-lg">
                        Заполнить
                    </button>
                </a>
            </div>
        </div>
        <div class="bg-white shadow-2xl py-16 text-center max-w-sm rounded-3 my-5 mx-auto">
            <div class="px-2">
                <svg class="h-20 w-20 mx-auto" xmlns="http://www.w3.org/2000/svg"  width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"  preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M618 5104 c-252 -45 -467 -221 -562 -459 -57 -142 -56 -118 -56 -1579 1 -1448 0 -1417 54 -1560 100 -265 351 -452 635 -475 l76 -6 3 -512 2 -513 1030 515 1030 515 818 0 c785 0 822 1 898 20 267 67 462 257 546 530 l23 75 3 1374 c3 1500 4 1472 -54 1616 -97 242 -311 415 -570 460 -125 22 -3756 21 -3876 -1z m3823 -510 c37 -11 67 -29 95 -58 79 -78 74 16 74 -1465 0 -930 -3 -1328 -11 -1356 -19 -68 -63 -121 -126 -152 l-58 -28 -875 -5 -875 -5 -265 -136 c-146 -75 -457 -234 -692 -353 l-428 -218 0 355 0 355 -287 3 -288 4 -58 28 c-31 16 -69 44 -83 62 -56 74 -54 17 -54 1445 0 1468 -4 1384 68 1462 24 26 56 46 92 58 53 19 116 19 1886 20 1654 0 1836 -2 1885 -16z"/> <path d="M2399 4336 c-195 -41 -369 -158 -478 -322 -70 -104 -108 -216 -126 -366 l-6 -58 255 0 255 0 11 55 c14 68 60 131 120 165 38 21 58 25 130 25 72 0 92 -4 130 -25 117 -66 160 -217 99 -347 -14 -29 -47 -63 -109 -112 -97 -78 -151 -135 -212 -224 -88 -130 -146 -301 -155 -464 l-6 -103 255 0 255 0 6 81 c7 113 54 209 135 276 94 79 176 164 219 228 154 229 188 455 104 703 -41 117 -84 184 -181 282 -95 96 -191 153 -320 190 -96 28 -286 35 -381 16z"/> <path d="M2302 2048 l3 -253 255 0 255 0 3 253 2 252 -260 0 -260 0 2 -252z"/> </g> </svg>             </div>
            <div class="mt-4">
                <span class="text-2xl font-bold">База знаний</span>
            </div>
            <div class="px-10 my-5 h-25">
                <span class="text-[1rem] text-gray-500">Попробуйте найти ответ на свой вопрос в базе знаний нашего проекта. Вам не придется ждать ответ, если такой вопрос уже был задан. </span>
            </div>
            <div>
                <a href="">
                    <button class="bg-black hover:!bg-[#383838] w-2/3 text-white font-bold py-2 px-4 rounded hover:shadow-lg">
                        Перейти
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
@endsection
