@extends("layouts.main")

@section("title", "MNS Game | Список игр")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    {{--    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.3/dist/flowbite.min.css" />--}}
@endsection

@section("mainHeroContent")
    <!-- Main Hero Content -->
    <div class="mt-20 flex flex-wrap">
        <div class="lg:w-1/3 w-full">
            <h1 class="text-3xl font-extrabold leading-10 tracking-tight lg:!text-left text-center text-gray-900 text-left sm:leading-none md:text-4xl lg:text-4xl">MNS Game<span class="text-indigo-500">.</span> Игры</h1>
            <div class="mx-auto mt-3 text-gray-500 lg:!text-left text-center lg:text-lg">
                Введите название игры для быстрого поиска
            </div>
        </div>
        <div class="flex justify-center mt-4 lg:w-2/3 w-full">
            <div class="mb-3 xl:w-9/12">
                <div class="input-group relative flex flex-wrap items-stretch w-full mb-4" id="search-input">
                    <input type="search" class="form-control h-12 relative flex-auto min-w-0 block w-full px-3 py-1.5 lg:!text-base text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 !rounded-l-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Введите название игры..." aria-label="Search" aria-describedby="button-addon2" name="search-input">
                    <button class="btn inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase !rounded-r-lg shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="button" id="button-addon2" onclick="search()">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                        </svg>
                    </button>
                    <div class="items-stretch w-full mb-4 z-20 absolute bg-gray-100 top-[48px] !rounded-b-lg hover:rounded-b-lg drop-shadow-lg" id="search-suggestions-window">
                        <ul id="search-suggestions"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Hero Content -->
@endsection

@section("body")
    <div class="flex flex-wrap justify-center lg:justify-around mb-12 mx-4 lg:!mx-36">
        <div class="bg-white h-[25rem] lg:w-1/2 w-full drop-shadow-xl max-w-[16rem] mx-4 my-4">
            <div class="img-hover-zoom img-hover-zoom--brightness">
                <a href="" class="cursor-pointer">
                    <img src="{{ asset("img/games/minecraft.png") }}" alt="Minecraft">
                </a>
            </div>
            <div class="text-left font-semibold text-base mt-3 px-3 truncate max-w-[16rem] max-h-[24px]">Игра: Minecraft</div>
            <div class="text-left font-medium text-base mt-2 px-3 truncate max-w-[16rem] max-h-[24px]">Разработчик: Mojang AB</div>
            <div class="text-left font-medium text-sm mt-2 px-3">Серверов на MNS Game: <span class="text-indigo-500 font-semibold">102400</span></div>
            <button class="btn h-[24px] w-60 mx-auto justify-center mt-3 inline-block px-3 py-2.5 bg-blue-600 text-white font-medium text-sm leading-tight !rounded-tr-xl !rounded-bl-xl shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center">
                Перейти
            </button>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
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
                            "<li class=\"py-1 hover:bg-gray-300 px-4 py-3 cursor-pointer\" onclick=\"search(this)\"> " +
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

    <script>
        function search(e = null) {
            let data;
            if(e === null)
                data = document.getElementsByName("search-input")[0].value;
            else
                data = e.children[1].textContent;

            window.location.href = "{{ url("/support/faq/search?question=") }}" + data;
        }
    </script>
@endsection
