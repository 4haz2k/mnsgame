@extends("layouts.main")

@section("title", "MNS Game | Продвижение проекта")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <script src="https://use.fontawesome.com/fd45a37d11.js"></script>
@endsection

@section("mainHeroContent")
    <section class="py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold tracking-tight text-center">Повышение рейтинга проекта</h2>
            <!-- component -->
            <div class="max-w-6xl mx-auto my-4 border-b-2 pb-4">
                <div class="flex pb-3">
{{--                    First space--}}
                    <div class="flex-1"></div>

{{--                    First circle--}}
                    <div class="flex-1">
                        <div class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center" id="first-circle">
                            <span class="text-gray-700 text-center w-full" id="first-circle-child">1</span>
                        </div>
                    </div>

{{--                    First line--}}
                    <div class="w-1/6 align-center items-center align-middle content-center flex">
                        <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                            <div class="bg-indigo-200 text-xs leading-none py-1 text-center text-grey-darkest rounded" style="width: 0" id="first-line"></div>
                        </div>
                    </div>

{{--                    Second circle--}}
                    <div class="flex-1">
                        <div class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center" id="second-circle">
                            <span class="text-gray-700 text-center w-full" id="second-circle-child">2</span>
                        </div>
                    </div>

{{--                    Second line--}}
                    <div class="w-1/6 align-center items-center align-middle content-center flex">
                        <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                            <div class="bg-indigo-200 text-xs leading-none py-1 text-center text-grey-darkest rounded" style="width: 0" id="second-line"></div>
                        </div>
                    </div>

{{--                    Third circle--}}
                    <div class="flex-1">
                        <div class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center" id="third-circle">
                            <span class="text-gray-700 text-center w-full" id="third-circle-child">3</span>
                        </div>
                    </div>

{{--                    Third line--}}
                    <div class="w-1/6 align-center items-center align-middle content-center flex">
                        <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                            <div class="bg-indigo-200 text-xs leading-none py-1 text-center text-grey-darkest rounded" style="width: 0" id="third-line"></div>
                        </div>
                    </div>

{{--                    Fourth circle--}}
                    <div class="flex-1">
                        <div class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center" id="fourth-circle">
                            <span class="text-gray-700 text-center w-full" id="fourth-circle-child">4</span>
                        </div>
                    </div>

{{--                    Last space--}}
                    <div class="flex-1">
                    </div>
                </div>

                <div class="flex text-xs content-center text-center">
                    <div class="w-1/4">
                        Выбор проекта
                    </div>

                    <div class="w-1/4">
                        Выбор тарифа
                    </div>

                    <div class="w-1/4">
                        Проверка данных
                    </div>

                    <div class="w-1/4">
                        Оплата
                    </div>
                </div>
            </div>
            <div id="first-step" class="w-full">
                <div class="text-xl tracking-tight text-center">Для начала определимся с проектом.<br>Выберите тот проект, для которого оказывается услуга</div>
                <div class="flex justify-center mt-4 w-full">
                    <div class="mb-3 xl:w-9/12 mdm:w-full">
                        <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                            <input type="search" class="form-control h-12 relative flex-auto min-w-0 block w-full px-3 py-1.5 lg:!text-base text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 !rounded-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Введите название проекта..." aria-label="Search" aria-describedby="button-addon2" name="search-input" id="search-input">
                        </div>
                    </div>
                </div>
                @if(isset($error))
                    <div class="text-center font-medium tracking-wide text-red-500 text-base">{{ $error }}</div>
                @endif
                @error("server_id")
                    <div class="text-center font-medium tracking-wide text-red-500 text-base">{{ $message }}</div>
                @enderror
                @error("price")
                    <div class="text-center font-medium tracking-wide text-red-500 text-base">{{ $message }}</div>
                @enderror
                <div id="servers" class="flex flex-wrap justify-center"></div>
            </div>
            <div id="second-step" class="w-full hidden">
                <div class="text-xl tracking-tight text-center">Теперь выберите количество рейтинга, которые вы хотите добавить к проекту.<br>Введенное вами количество будет добавлено к выбранному проекту.<br></div>
                <div class="flex justify-center mt-4 w-full">
                    <div class="mb-3 xl:w-9/12 mdm:w-full">
                        <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                            <input type="text" class="form-control h-12 relative flex-auto min-w-0 block w-full px-3 py-1.5 lg:!text-base text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 !rounded-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="1 рубль = 1 балл рейтинга" id="calculator">
                        </div>
                    </div>
                </div>
                <div class="w-1/2 mx-auto">
                    <button class="bg-indigo-500 w-full hover:bg-indigo-400 text-white font-bold py-1 px-3 rounded hidden" onclick="secondStep()" id="calculator-button">
                        <span class="inline align-middle">Далее</span>
                    </button>
                </div>
            </div>
            <div id="third-step" class="w-full hidden">
                <div class="text-xl tracking-tight text-center">Осталось совсем немного.<br>Проверьте правильность указанных данных<br></div>
                <div class="flex flex-col justify-start my-4 w-full h-48 mdm:h-80 bg-white border-indigo-500 border-2 shadow-md rounded py-2 px-3" id="info_block"></div>
                <div class="w-1/2 mx-auto">
                    <button class="bg-indigo-500 w-full hover:bg-indigo-400 text-white font-bold py-1 px-3 rounded" onclick="thirdStep()">
                        <span class="inline align-middle">Далее</span>
                    </button>
                </div>
            </div>
            <div id="fourth-step" class="w-full hidden">
                <div class="text-lg tracking-tight text-center">Всё готово, теперь нажмите кнопку "Оплатить" для совершения платежа. <br>Рейтинг начислится с момента поступления платежа в систему.<br>Историю платежей можно посмотреть в личном кабинете владельца проекта</div>
                <div class="w-1/2 mx-auto mt-3">
                    <button class="bg-indigo-500 w-full hover:bg-indigo-400 text-white font-bold py-1 px-3 rounded" onclick="createPayment()">
                        <span class="inline align-middle">Оплатить</span>
                    </button>
                </div>
                <div class="text-center font-medium tracking-wide text-gray-700 text-sm mt-2">Нажимая кнопку "Оплатить" Вы соглашаетесь с <a href="{{ route("offer") }}" class="text-blue-500 underline">договором публичной оферты</a>.</div>
            </div>
        </div>
    </section>
    <!-- End Main Hero Content -->
    <section class="py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold tracking-tight text-center">Как работает рейтинг проектов на MNS Game?</h2>
            <div class="max-w-6xl mx-auto my-4">
                <p class="text-base my-2"><strong>Рейтинг проекта</strong> - это сумма количества голосов вашего проекта и рейтинга, который вы покупаете на этой странице.</p>
                <img src="{{ asset("img/promote-image-1.png") }}" alt="" class="text-center border-indigo-500 border-2 my-2 shadow-md">
                <p class="text-base my-2">На основе этого рейтинга расчитывается положение вашего проекта в списке других проектов выбранной пользователем игры.</p>
                <p class="text-base my-2">Рейтинг расчитывается по формуле: <strong>Рейтинг = (Количество голосов проекта) * (Коэффициент голосов {{ \App\Http\Interfaces\ServerData::coefficient }}) + (Купленный рейтинг)</strong></p>
                <p class="text-base my-2">Так для примера рейтинг для проекта с 50-ю голосами и 1000 купленного рейтинга составит {{ 50 * \App\Http\Interfaces\ServerData::coefficient + 1000 }} рейтинга</p>
            </div>
            <h2 class="text-2xl font-bold tracking-tight text-left">Цены</h2>
            <div class="max-w-6xl mx-auto my-4">
                <p class="text-base my-2">Купленный рейтинг будет активен ровно <strong>1 месяц</strong> с момента поступления платежа в систему.</p>
                <p class="text-base my-2">Цена <strong>1 рейтинга равна 1 рублю</strong>.</p>
                <p class="text-base my-2">После пополнения счёта, история о платеже будет доступна в личном кабинете владельца проекта, для которого оказывается услуга.</p>
            </div>
        </div>
    </section>
@endsection

@section("body")
    <!-- Section 2 -->
    <section class="py-20 mns-background2">
        <div class="container max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold tracking-tight text-center">Почему стоит выбрать услуги MNS Game Project?</h2>
            <div class="grid grid-cols-4 gap-8 mt-2 sm:grid-cols-8 lg:grid-cols-12 sm:px-8 xl:px-0">

                <div class="flex flex-col items-start justify-between col-span-4 px-8 py-12 space-y-4 overflow-hidden sm:rounded-xl">
                    <div class="p-2.5 text-white bg-[#E6F5FF] rounded-lg inline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 inline" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#5C9CE6" stroke-width="1.5" stroke="currentColor"><path d="M1930 5102 c-19 -9 -45 -32 -57 -51 -23 -34 -23 -36 -23 -400 0 -348 1 -368 20 -399 61 -100 203 -95 258 9 23 44 23 44 20 399 -3 334 -4 357 -23 388 -39 65 -126 89 -195 54z"/><path d="M1134 4626 c-62 -27 -99 -104 -84 -172 7 -29 33 -62 112 -141 113 -115 140 -133 193 -133 78 0 136 54 143 133 6 72 -7 93 -125 209 -123 120 -162 137 -239 104z"/><path d="M2745 4626 c-49 -22 -241 -225 -250 -264 -23 -110 68 -199 182 -177 30 5 59 28 142 108 57 56 110 116 117 134 53 124 -71 253 -191 199z"/><path d="M3798 4584 c-130 -31 -111 -14 -949 -851 -623 -622 -788 -782 -792 -767 -4 11 -27 109 -52 219 -58 257 -94 335 -204 445 -86 86 -180 139 -296 166 -96 22 -245 15 -340 -17 -82 -27 -205 -107 -249 -162 l-31 -39 -3 -961 -2 -961 -234 -236 c-197 -198 -235 -241 -241 -272 -16 -83 -27 -69 513 -612 290 -290 521 -514 539 -522 27 -12 161 -14 775 -14 833 0 821 -1 968 71 85 41 85 42 761 718 620 621 678 681 707 742 89 186 54 397 -89 542 -51 51 -161 117 -195 117 -7 0 -11 37 -11 108 1 139 -24 211 -111 319 -40 51 -138 118 -194 135 l-40 12 6 66 c8 82 -11 186 -49 260 -33 66 -115 154 -175 188 -25 14 -47 27 -49 29 -3 2 117 126 266 276 300 302 321 331 344 475 32 195 -76 399 -256 488 -110 54 -206 65 -317 38z m182 -306 c77 -39 112 -116 90 -199 -11 -40 -76 -108 -680 -714 -709 -711 -701 -702 -735 -832 -67 -258 107 -524 376 -574 l67 -12 5 -54 c7 -64 54 -170 102 -229 66 -81 226 -164 314 -164 25 0 28 -4 38 -64 22 -127 96 -243 199 -311 33 -21 61 -40 64 -42 2 -2 -158 -166 -355 -364 -288 -288 -371 -365 -415 -387 l-55 -27 -710 -3 -709 -3 -403 403 c-222 222 -403 407 -403 413 0 6 86 96 191 200 105 105 197 202 205 217 12 23 14 172 14 976 l0 950 48 23 c69 34 206 34 276 0 59 -29 118 -86 146 -140 11 -23 56 -196 100 -386 44 -191 85 -356 92 -368 6 -12 54 -67 107 -123 159 -167 210 -276 218 -469 4 -82 1 -127 -11 -175 -23 -94 -87 -216 -150 -288 -81 -92 -88 -174 -20 -239 68 -64 152 -54 229 26 100 104 177 239 221 388 37 125 44 318 16 453 -34 163 -117 330 -224 446 l-42 45 805 805 c520 520 818 811 844 824 52 26 90 25 145 -2z m-340 -1250 c77 -39 112 -117 89 -200 -9 -37 -46 -78 -267 -299 -278 -278 -291 -287 -378 -274 -77 11 -144 88 -144 165 0 66 29 103 273 349 293 294 322 312 427 259z m333 -562 c69 -29 113 -109 102 -185 -6 -44 -18 -57 -208 -249 -111 -112 -214 -210 -229 -218 -35 -18 -111 -18 -147 1 -86 44 -120 156 -73 240 18 33 384 392 417 409 37 19 96 20 138 2z m340 -567 c39 -20 86 -72 98 -107 6 -19 8 -53 4 -80 -6 -44 -16 -57 -153 -194 -168 -170 -201 -190 -281 -169 -101 27 -157 132 -120 228 13 36 275 301 314 319 37 16 109 18 138 3z"/></g></svg>
                    </div>
                    <h4 class="text-xl font-medium text-gray-700 inline">Современный дизайн</h4>
                    <p class="text-base text-left text-gray-500">Наш сервис выбирают игроки, потому что MNS Game имеет современный и интуитивный дизайн. Наш сайт дружит с пользователем.</p>
                </div>

                <div class="flex flex-col items-start justify-between col-span-4 px-8 py-12 space-y-4 sm:rounded-xl">
                    <div class="p-2.5 text-white bg-[#EAE6FF] rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#735CE6" stroke-width="1.5" stroke="currentColor"><path d="M2360 5094 c-164 -20 -220 -28 -323 -49 -423 -87 -849 -299 -1158 -576 -479 -429 -759 -948 -855 -1579 -25 -164 -25 -532 0 -690 96 -611 345 -1101 762 -1499 350 -334 751 -551 1216 -657 59 -13 124 -24 145 -24 103 1 203 101 203 205 0 66 -51 150 -111 180 -15 8 -71 24 -126 36 -827 178 -1467 816 -1648 1644 -36 163 -47 280 -47 475 0 328 65 612 208 909 317 658 924 1096 1664 1202 127 18 443 15 575 -5 298 -46 552 -138 803 -288 l82 -49 -90 -132 c-49 -72 -90 -141 -90 -152 0 -12 9 -30 20 -40 19 -17 33 -17 382 14 200 18 375 34 391 37 41 8 85 50 92 88 5 25 -19 126 -95 397 -55 200 -108 371 -117 381 -22 25 -55 23 -80 -4 -11 -13 -53 -70 -93 -128 -40 -58 -76 -109 -80 -113 -4 -5 -32 7 -61 26 -292 187 -643 317 -999 372 -100 16 -490 29 -570 19z"/><path d="M2349 4177 c-18 -12 -44 -38 -56 -56 l-23 -34 0 -856 1 -856 762 -393 c435 -225 778 -396 799 -399 59 -9 105 5 143 42 66 66 68 170 4 231 -16 15 -331 184 -701 375 l-673 348 -5 759 -5 759 -28 36 c-15 20 -41 44 -57 52 -44 23 -121 19 -161 -8z"/><path d="M4665 3601 c-80 -36 -132 -124 -122 -205 7 -60 65 -213 94 -247 84 -100 249 -92 325 16 44 63 47 122 10 229 -46 130 -72 169 -134 200 -61 31 -117 33 -173 7z"/><path d="M4856 2830 c-42 -13 -90 -49 -117 -88 -21 -32 -24 -48 -27 -156 -4 -133 5 -179 45 -226 87 -104 248 -95 327 18 28 39 31 51 34 144 6 140 -9 199 -61 252 -58 57 -129 77 -201 56z"/><path d="M4699 2012 c-54 -35 -69 -56 -103 -151 -54 -149 -52 -214 6 -286 92 -110 271 -95 335 29 30 58 73 197 73 236 0 116 -88 200 -208 200 -47 0 -67 -6 -103 -28z"/><path d="M4354 1311 c-46 -21 -150 -138 -184 -207 -61 -124 23 -279 158 -292 95 -9 149 24 246 151 66 86 85 147 67 215 -14 50 -67 113 -115 136 -45 21 -121 20 -172 -3z"/><path d="M3757 756 c-132 -71 -192 -125 -215 -195 -54 -157 118 -310 274 -245 64 26 188 113 211 147 29 43 41 102 31 157 -9 52 -29 81 -82 124 -31 26 -47 31 -104 34 -57 3 -74 0 -115 -22z"/><path d="M2995 439 c-44 -10 -90 -24 -103 -31 -58 -30 -111 -113 -112 -173 0 -113 97 -215 205 -215 35 0 206 40 234 54 146 76 147 286 2 363 -54 28 -115 29 -226 2z"/></g></svg>
                    </div>
                    <h4 class="text-xl font-medium text-gray-700">Эффективность</h4>
                    <p class="text-base text-left text-gray-500">Поднимая свой проект в рейтинге вы можете быть уверены, что ваш сервер не останется без внимания и привлечет к себе игроков.</p>
                </div>

                <div class="flex flex-col items-start justify-between col-span-4 px-8 py-12 space-y-4 sm:rounded-xl">
                    <div class="p-2.5 text-white bg-[#FFE6EA] rounded-lg">
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#FF5773" stroke="none"><path d="M2012 5105 c-208 -45 -383 -213 -448 -430 -20 -65 -22 -222 -9 -513 l7 -142 -193 121 c-107 67 -224 137 -260 156 -283 145 -644 27 -794 -258 -135 -257 -63 -585 165 -753 l59 -44 -232 -132 c-128 -73 -244 -145 -260 -159 -33 -31 -52 -87 -43 -133 4 -18 116 -217 249 -443 265 -448 270 -455 357 -455 39 0 65 11 169 70 67 39 124 70 126 70 3 0 5 -437 5 -970 0 -933 1 -972 19 -1008 11 -22 35 -46 59 -60 l40 -22 1531 0 c1515 0 1532 0 1571 20 26 13 47 34 60 60 20 39 20 56 20 1275 0 1219 0 1236 -20 1275 -13 26 -34 47 -60 60 -39 20 -57 20 -1067 20 -597 0 -1023 4 -1018 9 6 5 377 220 825 479 449 258 849 490 890 514 89 51 125 105 115 171 -3 24 -92 188 -243 450 -263 454 -265 457 -355 457 -45 0 -69 -11 -283 -135 -129 -74 -238 -135 -243 -135 -4 0 -11 30 -14 68 -30 344 -378 592 -725 517z m264 -318 c146 -74 206 -253 135 -402 -16 -33 -44 -74 -62 -91 -35 -32 -477 -290 -484 -282 -10 10 -23 528 -14 567 24 107 101 194 201 227 64 21 162 12 224 -19z m1096 -605 c115 -199 145 -259 135 -268 -14 -13 -2820 -1632 -2835 -1636 -9 -2 -312 496 -312 512 0 3 137 83 303 178 166 95 379 217 472 271 94 54 352 203 575 331 760 437 935 538 1220 703 157 91 287 166 290 166 3 0 71 -115 152 -257z m-2412 -147 c19 -9 131 -76 247 -148 163 -101 210 -134 200 -143 -6 -6 -116 -71 -244 -143 -209 -120 -237 -133 -291 -138 -125 -11 -252 64 -302 179 -31 72 -31 164 0 236 29 66 110 142 176 165 61 21 165 17 214 -8z m1150 -2315 c0 -673 1 -692 20 -730 23 -45 80 -80 130 -80 50 0 89 26 198 133 l102 102 103 -102 c108 -107 147 -133 197 -133 50 0 107 35 130 80 19 38 20 57 20 730 l0 690 450 0 450 0 0 -1055 0 -1055 -1350 0 -1350 0 0 969 0 969 148 86 147 86 303 0 302 0 0 -690z m600 198 l0 -492 -27 26 c-38 35 -86 58 -123 58 -37 0 -85 -23 -122 -58 l-28 -26 0 492 0 492 150 0 150 0 0 -492z"/><path d="M4288 4189 c-43 -22 -78 -81 -78 -129 0 -74 76 -150 149 -150 77 0 151 74 151 150 0 50 -35 107 -80 130 -49 25 -94 25 -142 -1z"/><path d="M4598 3589 c-58 -30 -78 -79 -78 -189 l0 -90 -90 0 c-112 0 -159 -20 -190 -80 -38 -75 -14 -157 58 -198 33 -18 55 -22 131 -22 l91 0 0 -90 c0 -110 18 -154 78 -188 49 -27 91 -28 142 -2 60 31 80 78 80 190 l0 90 90 0 c71 0 99 4 130 20 45 23 80 80 80 130 0 50 -35 107 -80 130 -31 16 -59 20 -130 20 l-90 0 0 90 c0 112 -20 159 -80 190 -49 25 -94 25 -142 -1z"/><path d="M3688 3289 c-43 -22 -78 -81 -78 -129 0 -74 76 -150 149 -150 77 0 151 74 151 150 0 50 -35 107 -80 130 -49 25 -94 25 -142 -1z"/></g></svg>
                    </div>
                    <h4 class="text-xl font-medium text-gray-700">Вознаграждения</h4>
                    <p class="text-base text-left text-gray-500">К своему проекту вы можете привязать систему поощрений, которая будет отправлять вам ответ о голосе за ваш проект.</p>
                </div>

                <div class="flex flex-col items-start justify-between col-span-4 px-8 py-12 space-y-4 sm:rounded-xl">
                    <div class="p-2.5 text-white bg-[#E1FAE9] rounded-lg">
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#43A843" stroke="none"><path d="M2748 4570 c-41 -22 -76 -66 -89 -113 -4 -18 -135 -858 -289 -1867 -197 -1287 -280 -1852 -277 -1892 13 -204 314 -233 368 -35 4 18 135 858 289 1867 197 1287 280 1852 277 1892 -4 66 -37 117 -97 149 -46 25 -133 24 -182 -1z"/><path d="M1331 4000 c-18 -4 -45 -17 -60 -27 -14 -11 -299 -308 -632 -661 -439 -464 -611 -652 -623 -682 -21 -52 -20 -95 3 -146 12 -26 203 -237 541 -595 775 -822 722 -772 816 -772 140 0 235 154 169 275 -11 20 -258 289 -550 598 -291 308 -530 565 -530 570 0 5 239 262 530 570 292 309 539 578 550 598 75 137 -60 308 -214 272z"/><path d="M3704 4000 c-120 -28 -186 -167 -129 -272 11 -20 259 -289 550 -598 292 -308 530 -565 530 -570 0 -5 -238 -262 -530 -570 -360 -382 -537 -577 -553 -608 -59 -121 34 -265 172 -265 94 0 43 -48 816 772 337 358 529 569 541 595 24 52 24 100 0 152 -12 26 -204 237 -541 595 -610 647 -696 736 -730 753 -35 18 -89 25 -126 16z"/></g></svg>
                    </div>
                    <h4 class="text-xl font-medium text-gray-700">Исходный код</h4>
                    <p class="text-base text-left text-gray-500">С открытым исходным кодом вы можете быть уверенными, что нет никакого обмана со стороны нашего проекта. Вы можете быть уверены, что ваши деньги не пропадут.</p>
                </div>

                <div class="flex flex-col items-start justify-between col-span-4 px-8 py-12 space-y-4 sm:rounded-xl">
                    <div class="p-2.5 text-white bg-[#FFF0BD] rounded-lg">
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg"  width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"  preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#FF8000" stroke="none"> <path d="M2420 4343 c-30 -2 -109 -10 -175 -19 -424 -53 -710 -174 -786 -331 -22 -45 -22 -50 -15 -320 l6 -274 -52 8 c-99 15 -337 9 -423 -11 -360 -82 -642 -289 -819 -601 -193 -338 -204 -786 -29 -1135 88 -173 237 -348 386 -454 418 -295 975 -300 1396 -12 l84 58 78 -16 c105 -21 298 -44 446 -52 l122 -7 26 -53 c71 -145 308 -255 676 -313 558 -89 1199 -31 1554 140 89 43 195 145 213 205 9 30 12 203 12 640 l0 599 -24 50 c-61 132 -261 237 -569 300 -112 23 -304 46 -499 61 l-78 6 0 546 c0 485 -2 551 -17 592 -34 92 -93 152 -213 214 -163 85 -453 152 -754 176 -119 9 -416 11 -546 3z m424 -203 c201 -11 294 -21 446 -51 245 -49 458 -148 437 -203 -18 -47 -169 -117 -344 -160 -371 -92 -921 -101 -1318 -20 -186 38 -376 117 -413 172 -14 21 -13 25 9 48 37 40 95 70 209 108 178 59 371 92 625 105 77 5 147 9 155 9 8 1 96 -3 194 -8z m884 -817 c-28 -57 -215 -138 -408 -178 -255 -53 -558 -74 -827 -57 -339 22 -482 51 -580 118 -37 26 -108 67 -158 91 -89 43 -90 44 -97 86 -3 23 -7 88 -7 144 l-1 102 63 -29 c342 -155 1097 -199 1615 -94 131 26 313 82 372 113 l35 19 3 -145 c2 -102 -1 -152 -10 -170z m-2303 -130 c301 -58 564 -261 708 -548 155 -310 136 -686 -50 -984 -56 -90 -184 -226 -269 -287 -198 -142 -462 -211 -696 -184 -238 27 -430 117 -600 278 -177 169 -286 395 -307 640 -59 681 538 1215 1214 1085z m2315 -256 l0 -134 -127 -6 c-251 -13 -532 -69 -697 -137 -79 -33 -181 -95 -205 -123 -11 -14 -34 -17 -136 -17 -139 0 -185 6 -185 26 0 29 -74 198 -121 276 -27 45 -49 82 -49 83 0 0 26 -2 58 -7 115 -16 556 -21 703 -9 315 27 523 76 757 180 1 1 2 -59 2 -132z m375 -347 c352 -26 656 -104 764 -196 49 -43 46 -56 -27 -103 -288 -184 -1121 -242 -1659 -116 -177 42 -336 114 -363 165 -10 18 -7 25 20 50 103 97 396 172 785 203 91 8 359 6 480 -3z m-1501 -281 c2 -2 7 -84 11 -182 l7 -179 -103 7 c-57 4 -105 9 -107 10 -2 1 2 31 8 66 5 35 10 115 10 178 l0 114 86 -6 c47 -2 87 -6 88 -8z m2306 -353 c0 -73 -5 -147 -11 -164 -37 -107 -382 -211 -809 -243 -495 -38 -1092 58 -1242 199 l-28 26 0 153 c0 99 4 153 10 153 6 0 27 -8 48 -19 49 -25 185 -67 291 -91 524 -115 1256 -78 1645 84 45 18 84 34 89 35 4 0 7 -59 7 -133z m-2294 -210 c1 0 3 -82 5 -181 l4 -180 -95 3 c-90 3 -361 30 -368 36 -1 2 22 40 53 84 30 44 74 119 96 166 l41 86 132 -6 c72 -4 132 -7 132 -8z m2276 -545 c-63 -85 -356 -176 -682 -212 -163 -18 -563 -16 -727 4 -314 39 -559 117 -629 199 -23 28 -24 35 -24 174 0 79 3 144 8 144 4 0 39 -13 78 -30 198 -83 488 -130 847 -137 443 -10 803 41 1052 147 l90 38 3 -151 c2 -134 0 -154 -16 -176z"/> <path d="M1192 3028 c-39 -10 -72 -58 -72 -105 0 -28 -5 -34 -62 -61 -81 -37 -143 -100 -182 -182 -28 -59 -31 -74 -31 -165 0 -87 3 -107 26 -155 36 -76 97 -141 166 -178 52 -27 99 -39 231 -58 43 -7 107 -65 123 -111 38 -117 -49 -242 -170 -243 -85 0 -167 74 -178 162 -11 85 -42 118 -108 118 -27 0 -44 -8 -67 -30 -29 -29 -30 -34 -26 -98 7 -132 98 -263 219 -319 l57 -26 4 -65 c4 -58 8 -68 36 -93 79 -71 172 -8 172 115 0 44 0 45 54 69 153 70 248 250 216 410 -24 123 -100 226 -209 282 -32 16 -88 31 -146 40 -105 15 -118 21 -157 62 -121 128 8 340 179 294 22 -6 52 -20 67 -32 32 -25 66 -89 66 -124 0 -39 25 -92 50 -105 32 -17 83 -15 113 5 38 24 50 72 38 141 -24 129 -103 235 -214 287 -47 23 -57 32 -57 53 0 30 -23 89 -39 99 -26 15 -68 21 -99 13z"/> </g> </svg>
                    </div>
                    <h4 class="text-xl font-medium text-gray-700">Цены</h4>
                    <p class="text-base text-left text-gray-500">Даже начинающий проект с небольшим бюджетом может поднять свой сервер в рейтинге, поскольку наши цены на услуги значительно ниже цен конкурентов.</p>
                </div>

                <div class="flex flex-col items-start justify-between col-span-4 px-8 py-12 space-y-4 sm:rounded-xl">
                    <div class="p-2.5 text-white bg-[#E6F5FF] rounded-lg">
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve"><g fill="#5C9CE6"><path d="M59,56H4V1c0-0.553-0.447-1-1-1S2,0.447,2,1v55H1c-0.553,0-1,0.447-1,1s0.447,1,1,1h1v1c0,0.553,0.447,1,1,1s1-0.447,1-1 v-1h55c0.553,0,1-0.447,1-1S59.553,56,59,56z"/><path d="M7,29h2c0.553,0,1-0.447,1-1s-0.447-1-1-1H7c-0.553,0-1,0.447-1,1S6.447,29,7,29z"/><path d="M7,25h2c0.553,0,1-0.447,1-1s-0.447-1-1-1H7c-0.553,0-1,0.447-1,1S6.447,25,7,25z"/><path d="M7,21h2c0.553,0,1-0.447,1-1s-0.447-1-1-1H7c-0.553,0-1,0.447-1,1S6.447,21,7,21z"/><path d="M7,17h2c0.553,0,1-0.447,1-1s-0.447-1-1-1H7c-0.553,0-1,0.447-1,1S6.447,17,7,17z"/><path d="M7,13h2c0.553,0,1-0.447,1-1s-0.447-1-1-1H7c-0.553,0-1,0.447-1,1S6.447,13,7,13z"/><path d="M7,9h2c0.553,0,1-0.447,1-1S9.553,7,9,7H7C6.447,7,6,7.447,6,8S6.447,9,7,9z"/><path d="M7,5h2c0.553,0,1-0.447,1-1S9.553,3,9,3H7C6.447,3,6,3.447,6,4S6.447,5,7,5z"/><path d="M11.013,48.987c3.309,0,6-2.691,6-6c0-1.549-0.595-2.958-1.562-4.024l3.526-3.526C20.042,36.405,21.451,37,23,37 s2.958-0.595,4.024-1.562l4.538,4.538C30.595,41.042,30,42.451,30,44c0,3.309,2.691,6,6,6s6-2.691,6-6 c0-1.035-0.263-2.009-0.726-2.86l8.703-8.703C51.042,33.405,52.451,34,54,34c3.309,0,6-2.691,6-6s-2.691-6-6-6s-6,2.691-6,6 c0,1.035,0.263,2.009,0.726,2.86l-8.703,8.703C38.958,38.595,37.549,38,36,38c-1.035,0-2.009,0.263-2.86,0.726l-4.867-4.867 C28.737,33.009,29,32.035,29,31c0-3.309-2.691-6-6-6s-6,2.691-6,6c0,1.035,0.263,2.009,0.726,2.86l-3.854,3.854 c-0.851-0.463-1.825-0.726-2.86-0.726c-3.309,0-6,2.691-6,6S7.704,48.987,11.013,48.987z"/></g></svg>
                    </div>
                    <h4 class="text-xl font-medium text-gray-700">Мониторинг</h4>
                    <p class="text-base text-left text-gray-500">По опросу игроков и аналитике мы выяснили, что основной поток идёт от мониторингов. Поэтому MNS Game это отличный сервис для продвижения своего проекта.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <script>
        function firstStep(element_server) {
            let element_circle = document.getElementById("first-circle");
            let element_circle_child = document.getElementById("first-circle-child");
            let element_line = document.getElementById("first-line");
            let element_body_first = document.getElementById("first-step");
            let element_body_second = document.getElementById("second-step");

            element_circle.classList.toggle("bg-white");
            element_circle.classList.toggle("bg-indigo-500");
            element_circle.classList.toggle("border-2");
            element_circle.classList.toggle("border-grey-light");
            element_circle_child.classList.toggle("text-gray-700");
            element_circle_child.classList.toggle("text-white");

            element_circle_child.innerHTML = '<i class="fa fa-check w-full fill-current white"></i>';

            element_line.style.width = "100%";

            element_body_first.classList.toggle("hidden");
            element_body_second.classList.toggle("hidden");

            localStorage.setItem("server_id", element_server.id.split("-")[2]);
            localStorage.setItem("server_title", element_server.getAttribute("data-server-title"));
        }

        function secondStep(){
            let calculator = document.getElementById("calculator");

            if(!isInt(calculator.value)){
                return;
            }

            localStorage.setItem("rating_count", calculator.value);

            let element_circle = document.getElementById("second-circle");
            let element_circle_child = document.getElementById("second-circle-child");
            let element_line = document.getElementById("second-line");
            let element_body_second = document.getElementById("second-step");
            let element_body_third = document.getElementById("third-step");

            element_circle.classList.toggle("bg-white");
            element_circle.classList.toggle("bg-indigo-500");
            element_circle.classList.toggle("border-2");
            element_circle.classList.toggle("border-grey-light");
            element_circle_child.classList.toggle("text-gray-700");
            element_circle_child.classList.toggle("text-white");

            element_circle_child.innerHTML = '<i class="fa fa-check w-full fill-current white"></i>';

            element_line.style.width = "100%";

            element_body_second.classList.toggle("hidden");
            element_body_third.classList.toggle("hidden");

            let info_block = document.getElementById("info_block");
            info_block.innerHTML = showInfo(localStorage.getItem("server_title"),localStorage.getItem("server_id"),calculator.value);
        }

        function thirdStep(){
            let element_circle = document.getElementById("third-circle");
            let element_circle_child = document.getElementById("third-circle-child");
            let element_line = document.getElementById("third-line");
            let element_body_third = document.getElementById("third-step");
            let element_body_fourth = document.getElementById("fourth-step");

            element_circle.classList.toggle("bg-white");
            element_circle.classList.toggle("bg-indigo-500");
            element_circle.classList.toggle("border-2");
            element_circle.classList.toggle("border-grey-light");
            element_circle_child.classList.toggle("text-gray-700");
            element_circle_child.classList.toggle("text-white");

            element_circle_child.innerHTML = '<i class="fa fa-check w-full fill-current white"></i>';

            element_line.style.width = "100%";

            element_body_third.classList.toggle("hidden");
            element_body_fourth.classList.toggle("hidden");
        }

        function createPayment(){
            window.location.href = '{{ route("payment.create") }}'+"?server_id="+localStorage.getItem("server_id")+"&price="+localStorage.getItem("rating_count");
        }

        function isInt(value) {
            return !isNaN(value) && parseInt(Number(value)) == value && !isNaN(parseInt(value, 10));
        }

        function showInfo(title, id, rating_count){
            let date = DateMNS.getDatePassMonth();

            return '<div class="my-auto text-base text-gray-700"> <strong>Название проекта:</strong> ' + title + ' </div> <div class="my-auto text-base text-gray-700"> <strong>MNS ID:</strong> ' + id + ' </div> <div class="my-auto text-base text-gray-700"> <strong>Количество рейтинг-баллов:</strong> ' + rating_count + ' </div> <div class="my-auto text-base text-gray-700"> <strong>Сумма к оплате:</strong> ' + rating_count + ' рублей </div> <div class="my-auto text-base text-gray-700"> <strong>Дата окончания услуги:</strong> ' + date + ' (1 месяц) </div>';
        }
    </script>

    <script>
        const source = document.getElementById('search-input');
        const suggestions = document.getElementById('servers');

        const inputHandler = function(e) {
            if(e.target.value === "")
                return;

            const request = new XMLHttpRequest();

            const url = "{{ url("/servers/search") }}";

            const params = "&title=" + e.target.value;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    suggestions.innerHTML = "";
                    let data = JSON.parse(request.responseText);

                    if(data.length === 0 )
                        return;

                    for (let i = 0; i <= data.length - 1; i++){
                        suggestions.innerHTML += '<div id="server-id-'+ data[i].id +'" class="w-1/3 mdm:w-full m-2 py-2 mdm:!py-4 px-4 text-center rounded bg-gray-100 shadow-md h-24 mdm:h-36 border-indigo-500 border-2 cursor-pointer hover:border-indigo-200 transition ease-in-out duration-300 flex flex-col" data-server-title="'+ data[i].title +'" onclick="firstStep(this)"> <div class="my-auto text-base text-gray-700">'+ data[i].title +'</div> <div class="my-auto text-base text-gray-700">MNS ID: <strong>'+ data[i].id +'</strong></div> </div>';
                    }
                }
            });
            request.send(params);
        }

        const calculator = document.getElementById("calculator");
        let calculator_button = document.getElementById("calculator-button");

        const calculatorHandler = function (e){
            if(e.target.value !== "" && parseInt(e.target.value) !== 0 && parseInt(e.target.value) > 0){
                if(calculator_button.classList.contains("hidden")){
                    calculator_button.classList.remove("hidden");
                }
            }
            else{
                if(!calculator_button.classList.contains("hidden")){
                    calculator_button.classList.add("hidden");
                }
                calculator.value = "";
            }
        }

        source.addEventListener('input', inputHandler);
        calculator.addEventListener('input', calculatorHandler);
        source.addEventListener('propertychange', inputHandler); // for IE8
        calculator.addEventListener('propertychange', calculatorHandler); // for IE8
    </script>
@endsection
