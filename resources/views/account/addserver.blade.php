@extends('layouts.main')

@section("title", "MNS Game | Добавление сервера")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <style type="text/css">
        .tooltip-custom {
            cursor: pointer;
        }

        .tooltip-custom::after {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px 10px 10px 5px;
            box-shadow: 2px 2px 11px rgba(0, 0, 0, 0.6);
            color: #FFF;
            content: attr(data-tooltip); /* Основной код, который определяет, что будет во всплывающей подсказке*/
            margin-top: -31px;
            padding: 5px 9px;
            position: absolute;
            visibility: hidden; /* ...скрываем элемент */
            font-size: 0.75rem;
            line-height: 1rem;
            opacity: 1 !important;
        }

        .tooltip-custom:hover::after {
            opacity: 1; /* Показываем элемент */
            visibility: visible;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('body')
    <div class="container max-w-lg px-4 mx-auto text-left md:max-w-none md:text-center">
        <div class="lg:grid grid-cols-1 max-w-6xl mx-auto">
            <div id="firstColumn" class="lg:mt-8 lg:mb-12">
                <div class="text-center lg:text-lg mb-2 font-semibold">
                    Предпросмотр сервера
                </div>
                <div class="w-full h-12 flex rounded-1">
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Место
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Игра
                    </div>
                    <div class="w-7/12 justify-center items-center flex text-sm">
                        Название сервера
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Игроков
                    </div>
                    <div class="w-2/12 justify-center items-center flex text-sm">
                        IP адрес
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Голосов
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-sm">
                        Рейтинг
                    </div>
                </div>
                <div class="bg-gray-200 w-full h-24 flex rounded-1 shadow-md my-3" id="server_preview">
                    <div class="w-1/12 justify-center items-center flex text-md">
                        <div class="bg-gray-300 rounded-3 px-2 py-1 font-semibold tooltip-custom" data-tooltip="Место в рейтинге">
                            1
                        </div>
                    </div>
                    <div class="w-1/12 justify-center items-center flex tooltip-custom" data-tooltip="Counter Strike: Global Offensive">
                        <img class="rounded-3" src="{{ asset("img/test/csgo_logo.png") }}" width="42" height="42" id="game_logo" alt="Counter Strike: Global Offensive">
                    </div>
                    <div class="w-7/12 justify-center items-center flex flex-col truncate">
                        <div class="text-md mb-2 truncate font-bold">
                            ⭐❗ Сервер 1.18.1 ❗⭐ Без /GM 1 и админок!
                        </div>
                        <div class="block">
                            <img class="rounded-3" src="{{ asset("/img/test/banner.png") }}" width="420" height="54" alt="">
                        </div>
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        <div class="bg-gray-300 text-indigo-500 rounded-3 px-2 py-1 tooltip-custom" data-tooltip="Текущее кол-во игроков на сервере">
                            1100
                        </div>
                    </div>
                    <div class="w-2/12 justify-center items-center flex text-xs">
                        <div class="bg-gray-300 rounded-3 px-2 py-1 tooltip-custom" data-tooltip="Нажмите, чтобы скопировать адрес">
                            192.168.124.120:27015
                        </div>
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        <div class="bg-gray-300 rounded-3 px-2 py-1 tooltip-custom" data-tooltip="Кол-во проголосовавших игроков">
                            111
                        </div>
                    </div>
                    <div class="w-1/12 justify-center items-center flex text-xs">
                        <div class="bg-gray-300 rounded-3 px-2 py-1 text-orange-400 font-semibold tooltip-custom" data-tooltip="Рейтинг сервера">
                            10204
                        </div>
                    </div>
                </div>
            </div>
            <div id="secondColumn" class="my-4">
                <form class="w-full" action="{{ route("addserver") }}" method="POST">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left" for="server-title">
                                Название сервера <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>
                            </label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Название вашего сервера. Разрешены буквы и цифры</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-title" type="text" placeholder="Какое будет название у вашего сервера?" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label class="block text-md tracking-wide text-gray-700 font-semibold mb-2 !text-left" for="server-description">
                                Описание сервера <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span>
                            </label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Полное описание вашего сервера. Данное описание будет отображаться на странице вашего сервера.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <textarea id="server-description" class="w-full h-16 px-3 py-2 text-sm text-gray-700 placeholder-gray-600 border rounded focus:shadow-outline" placeholder="Чтобы вы хотели рассказать о своём сервере игрокам?" required></textarea>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="game-title" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Название игры <span class="text-red-500 tooltip-custom" data-tooltip="Поле обязательное для заполнения">*</span></label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Выберите игру, которой посвящен ваш сервер.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <select id="game-title" class="w-full h-10 px-3 text-sm placeholder-gray-600 border rounded appearance-none focus:shadow-outline" onchange="getFilters()">
                                <option value="" disabled selected>Выберите игру</option>
                                @foreach($games as $game)
                                    <option value="{{ $game->title }}">{{ $game->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2" id="filters">

                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="server-site" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Сайт сервера</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Ссылка на сайт сервера.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-site" type="text" placeholder="Ссылка на сайт сервера" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="server-vk" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Сообщество Вконтакте</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Ссылка на сообщество Вконтакте.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-vk" type="text" placeholder="Ссылка на сообщество Вконтакте" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="server-discord" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Discord сервера</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Ссылка-приглашение в Discord сервер.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-discord" type="text" placeholder="Ссылка-приглашение в Discord" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="server-ip" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">IP адрес сервера</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Текстовая или циферная ссылка на ваш сервер.</span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4">
                            <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-3 mb-3 mx-0 lg:mx-24 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" id="server-ip" type="text" placeholder="IP адрес сервера" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="lg:w-1/3 w-full px-3 lg:my-2">
                            <label for="game-title" class="block text-md tracking-wide text-gray-700 font-bold mb-2 text-left">Баннер</label>
                            <span class="block text-md tracking-wide text-gray-700 mb-2 text-left">Баннер сервера в формате gif, png или jpg размером 468x60 пикселей. <br><br><span class="text-red-500 font-bold">Внимание! Использование агрессивных, мигающих и нецензурных баннеров запрещено! Максимальный размер баннера 2 Мегабайта. Несоблюдение данных правил карается удалением сервера с хостинга без возможности восстановления!</span></span>
                        </div>
                        <div class="lg:w-2/3 w-full px-3 lg:my-4" id="dropzone">
                            <label class="flex h-[80px] w-full cursor-pointer appearance-none justify-center rounded-md border-2 border-dashed border-gray-300 bg-white px-4 transition hover:border-gray-400 focus:outline-none">
                                <span class="flex items-center space-x-2">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                  </svg>
                                  <span class="font-medium text-gray-600">
                                    Перетащите сюда файл или нажмите, чтобы
                                    <span class="text-blue-600 underline">выбрать</span>
                                  </span>
                                </span>
                                <input type="file" name="banner" class="hidden" />
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="h-4 w-16">Чекнуть</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section("scripts")
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        const dropzone = new Dropzone("div#dropzone", {
            url: "{{ url("/addserver") }}",
            maxFiles: 1,
            paramName: "banner",
            maxFilesize: 2, // MB
            createImageThumbnails: false,
            addRemoveLinks: true,
            disablePreviews: true,
            autoProcessQueue: false,
            addedfile: file => {
                console.log(file.fileURL);
            }
        });

        function importImage(input) {
            let fileReference = input.files && input.files[0];

            if(fileReference){
                let reader = new FileReader();

                reader.onload = (event) => {
                    document.getElementById('preview').src = event.target.result;
                }

                reader.readAsDataURL(fileReference);

            }

        }
    </script>
    <script>
        function showFiltersBlock(){
           document.getElementById("filters").innerHTML = "<div class='lg:w-1/3 w-full px-3 lg:my-2'><label for='game-filters' class='block text-md tracking-wide text-gray-700 font-bold mb-2 text-left'>Категории сервера</label><span class='block text-md tracking-wide text-gray-700 mb-2 text-left'>Этот параметр определяет, в какие категории попадет ваш сервер. Выбирайте только те категории, которые действительно присутствуют на вашем сервере. В противном случае, редактирование сервера будет отключено, а сам сервер понижен в рейтинге. <br><br><strong>Внимание!</strong> В случае полного игнорирования правил выбора параметров, сервер будет удален из мониторинга без возможности восстановления!</span></div><div class='lg:w-2/3 w-full px-3 lg:my-2'><div class='flex flex-col items-center relative'><div class='w-full'> <div class='p-1 flex border border-gray-200 bg-white rounded-t-lg'><div class='flex flex-auto flex-wrap' id='filters-input'></div> <div class='text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200'><button type='button' class='cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none' onclick='showSuggestions()'><svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='w-4 h-4' style='transform: rotate(180deg);'><polyline points='18 15 12 9 6 15'></polyline></svg></button></div></div><div class='items-stretch w-full mb-4 z-20 absolute bg-gray-100 top-[42px] !rounded-b-lg hover:rounded-b-lg drop-shadow-lg'><div class='flex flex-col w-full' id='filters-suggestion'></div></div></div></div></div>";
        }

        function getFilters(){
            showFiltersBlock();
            let game_title = document.getElementById("game-title").value;
            let filters_suggestions = document.getElementById("filters-suggestion");
            filters_suggestions.innerHTML = "";

            const request = new XMLHttpRequest();

            const url = "{{ url("/server/loadFilters") }}";

            const params = "&game_title=" + game_title;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    let data = JSON.parse(request.responseText);

                    if(data.length === 0 )
                        return;

                    if(data["status"] === true){
                        data["filters"].forEach(function (element){
                            filters_suggestions.innerHTML +=
                                "<div class=\"cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-indigo-100\" onclick=\"selectFilter(this)\" id=\"filter-id-" + element.id + "\" data-value=\""+ element.filter +"\">" +
                                    "<div class=\"flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-indigo-100\">" +
                                        "<div class=\"w-full items-center flex\">" +
                                            "<div class=\"mx-2 leading-6\">"+ element.filter +"</div>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>";
                        });
                    }
                    else{
                        console.log(data["error"]);
                    }
                }
            });
            request.send(params);
        }

        function selectFilter(element){
            let selection = element.firstChild;
            if(selection.classList.contains("border-indigo-500")){
                selection.classList.add("hover:border-indigo-100");
                selection.classList.remove("border-indigo-500");
                changeInputFilters(element.id, element.getAttribute("data-value"));
            }
            else{
                selection.classList.add("border-indigo-500");
                selection.classList.remove("hover:border-indigo-100");
                changeInputFilters(element.id, element.getAttribute("data-value"));
            }
        }

        function changeInputFilters(id, title){
            let filter_input = document.getElementById(id + "-input");
            if(filter_input == null){
                let filters_selected = document.getElementById("filters-input");

                filters_selected.innerHTML +=
                    "<div class=\"flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-indigo-700 bg-indigo-100 border border-indigo-300\" id=\""+ id + "-input" +"\">" +
                        "<div class=\"text-xs font-normal leading-none max-w-full flex-initial\">"+ title +"</div>" +
                        "<div class=\"flex flex-auto flex-row-reverse\">" +
                            "<div>" +
                                "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"100%\" height=\"100%\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-x cursor-pointer hover:text-indigo-400 rounded-full w-4 h-4 ml-2\" data-select-parent=\""+ id +"\" onclick=\"removeFromSelect(this)\">" +
                                    "<line x1=\"18\" y1=\"6\" x2=\"6\" y2=\"18\"></line>" +
                                    "<line x1=\"6\" y1=\"6\" x2=\"18\" y2=\"18\"></line>" +
                                "</svg>" +
                            "</div>" +
                        "</div>" +
                    "</div>";
            }
            else{
                document.getElementById(id + "-input").remove();
            }
        }

        function removeFromSelect(element){
            let filter_suggestion = document.getElementById(element.getAttribute("data-select-parent")).firstChild;
            filter_suggestion.classList.add("hover:border-indigo-100");
            filter_suggestion.classList.remove("border-indigo-500");
            element.parentNode.parentNode.parentNode.remove();
        }

        function showSuggestions(){
            let suggestions = document.getElementById("filters-suggestion");

            if(suggestions.classList.contains("hidden")){
                suggestions.classList.remove("hidden");
            }
            else{
                suggestions.classList.add("hidden");
            }
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Server add') }}</div>

                    <div class="card-body">

                        @if(session()->has('Status'))
                            <div class="alert alert-success" role="alert">
                                Server added success!
                            </div>
                        @endif

                        <form method="POST" action="{{ route('addserver') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="name" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="game" class="col-md-4 col-form-label text-md-right">{{ __('Game') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select @error('game') is-invalid @enderror" name="game" required>
                                        @foreach($games as $game)
                                            <option value="{{ $game->title }}">{{ $game->title }}</option>
                                        @endforeach
                                    </select>

                                    @error('game')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="server_data" class="col-md-4 col-form-label text-md-right">{{ __('ServerData') }}</label>

                                <div class="col-md-6">
                                    <input id="server_data" type="text" class="form-control @error('server_data') is-invalid @enderror" name="server_data" value="{{ old('server_data') }}" required autocomplete="server_data" autofocus>

                                    @error('server_data')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('AddServer') }}
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
