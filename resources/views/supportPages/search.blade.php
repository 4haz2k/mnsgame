@extends("layouts.main")

@section("title", "MNS Game | $question")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <style>
        /* Tab content - closed */
        .tab-content {
            max-height: 0;
            -webkit-transition: max-height .35s;
            -o-transition: max-height .35s;
            transition: max-height .35s;
        }
        /* :checked - resize to full height */
        .tab input:checked ~ .tab-content {
            max-height: 100vh;
        }
        /* Label formatting when open */
        .tab input:checked + label{
            /*@apply text-xl p-5 border-l-2 border-indigo-500 bg-gray-100 text-indigo*/
            font-size: 1.25rem; /*.text-xl*/
            padding: 1.25rem; /*.p-5*/
            border-left-width: 2px; /*.border-l-2*/
            border-color: #6574cd; /*.border-indigo*/
            background-color: #f8fafc; /*.bg-gray-100 */
            color: #6574cd; /*.text-indigo*/
        }
        /* Icon */
        .tab label::after {
            float:right;
            right: 0;
            top: 0;
            display: block;
            width: 1.5em;
            height: 1.5em;
            line-height: 1.5;
            font-size: 1.25rem;
            text-align: center;
            -webkit-transition: all .35s;
            -o-transition: all .35s;
            transition: all .35s;
        }
        /* Icon formatting - closed */
        .tab input[type=checkbox] + label::after {
            content: "+";
            font-weight:bold; /*.font-bold*/
            border-width: 1px; /*.border*/
            border-radius: 9999px; /*.rounded-full */
            border-color: #b8c2cc; /*.border-grey*/
        }
        .tab input[type=radio] + label::after {
            content: "\25BE";
            font-weight:bold; /*.font-bold*/
            border-width: 1px; /*.border*/
            border-radius: 9999px; /*.rounded-full */
            border-color: #b8c2cc; /*.border-grey*/
        }
        /* Icon formatting - open */
        .tab input[type=checkbox]:checked + label::after {
            transform: rotate(315deg);
            background-color: #6574cd; /*.bg-indigo*/
            color: #f8fafc; /*.text-grey-lightest*/
        }
        .tab input[type=radio]:checked + label::after {
            transform: rotateX(180deg);
            background-color: #6574cd; /*.bg-indigo*/
            color: #f8fafc; /*.text-grey-lightest*/
        }
    </style>
@endsection

@section("mainHeroContent")
    <!-- Main Hero Content -->
    <div class="mt-20">
        <h1 class="text-2xl leading-10 tracking-tight text-left text-gray-900 text-left sm:leading-none md:text-4xl lg:text-2xl">Показаны результаты поиска по запросу: <span class="font-extrabold">{{$question}}</span></h1>
    </div>
    <!-- End Main Hero Content -->
@endsection

@section("body")
    <div class="container max-w-6xl lg:mx-auto">
        @foreach($suggestions as $suggestion)
            <div class="h-[318px] lg:h-[198px] bg-white shadow-md my-2 py-[20px] pr-[24px] flex flex-row">
                <div class="basis-[96px] items-center h-full flex border-r">
                    <svg class="w-8 h-8 mx-auto" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"> <circle class="fill-current" cx="16" cy="16" r="16" style="--tw-text-opacity: 1; color: rgb(255 235 239/var(--tw-text-opacity));"></circle> <path class="fill-current text-pink-500" d="M14.515 11.398l-1.918-1.75.178-.601A5.487 5.487 0 007.415 2l3 2.999L5 10.414 2.002 7.416a5.49 5.49 0 007.046 5.359l.6-.177 1.615 1.767 3.252-2.967zm-4.73 4.315l-.79-.865A7.49 7.49 0 01.421 5.036l.526-1.502L5 7.586 7.586 5 3.535.949l1.5-.527a7.487 7.487 0 019.813 8.572L16 10.045l1.153-1.051A7.49 7.49 0 0126.964.422l1.502.526L24.414 5 27 7.586l4.051-4.051.527 1.5a7.487 7.487 0 01-8.572 9.813L8.255 31.022a3 3 0 01-4.338.1L.879 28.082a3 3 0 01.1-4.338l8.806-8.032zm7.444 8.166l1.477-1.349.675.739 5.842 6.4a1 1 0 001.446.033l3.038-3.038a1 1 0 00-.033-1.446l-7.487-6.828 1.348-1.478.739.674 6.748 6.154a3 3 0 01.1 4.338l-3.039 3.038a3 3 0 01-4.338-.099L17.23 23.88zM27 10.414L21.586 5l2.998-2.998a5.49 5.49 0 00-5.359 7.046l.177.6-.462.422L2.326 25.223a1 1 0 00-.033 1.446l3.038 3.038a1 1 0 001.446-.033l15.575-17.077.601.178A5.487 5.487 0 0030 7.415l-2.999 3z"></path> </svg>
                </div>
                <div class="basis-full pl-6">
                    <header class="font-extrabold text-lg mb-1">
                        <a href="{{ url("/support/faq/answer/$suggestion->id") }}" class="hover:!text-black">{{ $suggestion->title }}</a>
                    </header>
                    <p class="text-gray-600 text-base h-[168px] lg:h-12">Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца. Я совсем один и блаженствую в здешнем краю, словно созданном для таких, как я.</p>
                    <a href="{{ url("/support/faq/answer/$suggestion->id") }}" class="mt-2 font-medium items-center inline-flex text-indigo-300 hover:text-indigo-500 hover:underline">
                        <span>Читать далее</span>
                        <svg class="shrink-0 w-3 h-3 mt-px ml-2" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"> <path class="fill-current" d="M6.602 11l-.875-.864L9.33 6.534H0v-1.25h9.33L5.727 1.693l.875-.875 5.091 5.091z"></path> </svg>
                    </a>
                    <footer style="font-size: .875rem; line-height: 1.5;" class="flex items-center mt-3">
                        <div class="shrink-0 flex mr-3">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"  width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"  preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M840 4920 l0 -200 -147 0 c-91 0 -175 -6 -218 -15 -225 -47 -413 -235 -460 -460 -22 -105 -22 -3665 0 -3770 47 -225 235 -413 460 -460 105 -22 4065 -22 4170 0 225 47 413 235 460 460 22 105 22 3665 0 3770 -47 225 -235 413 -460 460 -43 9 -127 15 -217 15 l-148 0 0 200 0 200 -200 0 -200 0 0 -200 0 -200 -1320 0 -1320 0 0 200 0 200 -200 0 -200 0 0 -200z m0 -800 l0 -200 200 0 200 0 0 200 0 200 1320 0 1320 0 0 -200 0 -200 200 0 200 0 0 201 0 201 153 -4 c144 -3 156 -4 190 -28 21 -14 50 -43 65 -64 l27 -39 3 -274 3 -273 -2160 0 -2161 0 0 253 c0 139 5 268 10 289 13 44 81 115 124 127 17 5 93 10 169 10 l137 1 0 -200z m3878 -2233 l-3 -1354 -27 -39 c-15 -21 -44 -50 -65 -64 l-37 -25 -2026 0 -2026 0 -37 25 c-21 14 -50 43 -65 64 l-27 39 -3 1354 -2 1353 2160 0 2160 0 -2 -1353z"/> <path d="M760 2620 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M1560 2620 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M2360 2620 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M3160 2620 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M3960 2620 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M760 1820 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M1560 1820 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M2360 1820 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M3160 1820 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M3960 1820 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M760 1020 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M1560 1020 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M2360 1020 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> <path d="M3160 1020 l0 -200 200 0 200 0 0 200 0 200 -200 0 -200 0 0 -200z"/> </g> </svg>
                        </div>
                        <div class="text-gray-500 mt-px">
                            <span>Дата публикации: </span>
                            <span class="font-bold">{{ \Jenssegers\Date\Date::parse($suggestion->dateTime)->format('d M Y') }}</span>
                        </div>
                    </footer>
                </div>
            </div>
        @endforeach
        {{ $suggestions->appends(request()->input())->links('pagination::tailwind') }}
    </div>
@endsection

@section('scripts')
    <script>
        /* Optional Javascript to close the radio button version by clicking it again */
        var myRadios = document.getElementsByName('tabs');
        var setCheck;
        var x = 0;
        for(x = 0; x < myRadios.length; x++){
            myRadios[x].onclick = function(){
                if(setCheck != this){
                    setCheck = this;
                }else{
                    this.checked = false;
                    setCheck = null;
                }
            };
        }
    </script>

    <script>
        const source = document.getElementById('search-input');
        const suggestions = document.getElementById('search-suggestions');
        const suggestions_window = document.getElementById('search-suggestions-window');

        const inputHandler = function(e) {
            suggestions.innerHTML = "";

            if(e.target.value === "")
                return;

            suggestions_window.style.display = "block";

            const request = new XMLHttpRequest();

            const url = "{{ url("/support/faq/answer/suggestions") }}";

            const params = "&word=" + e.target.value;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    let data = JSON.parse(request.responseText);

                    if(data.length === 0 )
                        return;

                    for (let i = 0; i <= data.length; i++){

                        suggestions.innerHTML +=
                            "<li class=\"py-1 hover:bg-gray-300 px-4 py-3\"> " +
                            "<div class=\"inline mr-3\"> " +
                            "<svg class=\"inline w-5 h-5\" fill=\"#000000\" xmlns=\"http://www.w3.org/2000/svg\"  viewBox=\"0 0 30 30\" width=\"30px\" height=\"30px\"><path d=\"M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z\"/></svg>" +
                            "</div>" +
                            "<div class=\"inline align-middle\" id=\"search-suggestion-"+ i +"\">"
                            + data[i].title +
                            "</div>" +
                            "</li>";

                        if (i === 4)
                            break;
                    }
                }
            });
            request.send(params);
        }

        source.addEventListener('input', inputHandler);
        source.addEventListener('propertychange', inputHandler); // for IE8
    </script>

    <script>
        window.onload = function(){
            let divToHide = document.getElementById('search-suggestions-window');
            document.onclick = function(e){
                if(e.target.id !== 'search-suggestions-window'){
                    divToHide.style.display = 'none';
                }
            };
        };
    </script>
@endsection
