@extends("layouts.main")

@section("title", "MNS Game | $game->title")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    {{--    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.3/dist/flowbite.min.css" />--}}
    <style type="text/css">
        .bg-shadow-50{
            background: url("{{ asset($game->image) }}") center no-repeat;
            position: relative;
            -webkit-background-size: cover;
            background-size: cover;
        }
        .bg-shadow-50:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgb(255,255,255);
            background: -moz-linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(0,0,0,0.85) 30%);
            background: -webkit-linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(0,0,0,0.85) 30%);
            background: linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(0,0,0,0.85) 30%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#000000",GradientType=1);
            z-index: 2;
        }

        .inner {
            position: relative;
            z-index: 3;
            color: #fff;
            text-align: center;
        }

        .text-gray-700{
            color: white !important;
        }

        .text-gray-700:hover{
            color: #0a58ca !important;
        }

        .title-color-white{
            color: white;
        }
    </style>
@endsection

@section("title-color", "title-color-white")

@section("background", "bg-shadow-50")

@section("mainHeroContent")
    <!-- Main Hero Content -->
    <div class="mt-16 h-96 text-left">
        <h1 class="text-5xl font-bold mb-5">{{ $game->title }}</h1>
        <h3 class="text-xl w-9/12">{{ $game->description }}</h3>
    </div>
    <!-- End Main Hero Content -->
@endsection

@section("body")
    <div class="flex flex-wrap justify-center lg:justify-around mb-12 mx-4 lg:!mx-36" id="games">
        
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <script>
        const source = document.getElementById('search-input');
        const games = document.getElementById('games');

        const inputHandler = function(e) {
            const request = new XMLHttpRequest();

            const url = "{{ url("/game/get_games") }}";

            const params = "&title=" + e.target.value;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    let data = JSON.parse(request.responseText);

                    if(data.length === 0 ){
                        games.innerHTML = "<div class='text-center text-xl'>Игры по вашему запросы не найдены.</div>"
                        return;
                    }

                    games.innerHTML = "";

                    for (let i = 0; i < data.length; i++){
                        games.innerHTML +=
                            '<div class="bg-white h-[25rem] lg:w-1/2 w-full drop-shadow-xl max-w-[16rem] mx-4 my-4">' +
                            '<div class="img-hover-zoom img-hover-zoom--brightness">' +
                            '<a href="/servers/' + data[i].short_link + '" class="cursor-pointer">' +
                            '<img src="/'+ data[i].image_short + '" alt="' + data[i].title + '">' +
                            '</a>' +
                            '</div>' +
                            '<div class="text-left font-semibold text-base mt-3 px-3 truncate max-w-[16rem] max-h-[24px]">Игра: ' + data[i].title + '</div>' +
                            '<div class="text-left font-medium text-base mt-2 px-3 truncate max-w-[16rem] max-h-[24px]">Разработчик: ' + data[i].developer + '</div>' +
                            '<div class="text-left font-medium text-sm mt-2 px-3">Серверов на MNS Game: <span class="text-indigo-500 font-semibold">' + data[i].servers_count + '</span></div>' +
                            '<button class="btn h-[24px] w-60 mx-auto justify-center mt-3 inline-block px-3 py-2.5 bg-blue-600 text-white font-medium text-sm leading-tight !rounded-tr-xl !rounded-bl-xl shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" data-link="/servers/' + data[i].short_link + '" onclick="redirect(this)">' +
                            'Перейти' +
                            '</button>' +
                            '</div>';
                    }
                }
            });
            request.send(params);
        }

        source.addEventListener('input', inputHandler);
        source.addEventListener('propertychange', inputHandler); // for IE8
    </script>

    <script>
        function redirect(element){
            window.location.href = element.getAttribute("data-link");
        }
    </script>
@endsection
