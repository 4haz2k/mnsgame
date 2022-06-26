@extends("layouts.main")

@section("title", "MNS Game | $server->title")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <style type="text/css">
        .notify{
            position: fixed;
            top: 0;
            width: 100%;
            height: 0;
            box-sizing: border-box;
            color: white;
            text-align: center;
            background: rgba(0,0,0,.6);
            overflow: hidden;
            transition: height .2s;
            z-index: 100;
        }

        #notifyType:before{
            display: block;
            margin-top: 15px;

        }

        .active{
            height: 50px;
        }

        .success:before{
            Content: "Адрес сервера скопирован в буфер обмена";
        }

        .voteSuccess:before{
            Content: "Голос засчитан";
        }

        .voteFailed:before{
            Content: "Нельзя проголосовать за свой проект!";
        }

        .voteTimeFailed:before{
            Content: "Голосовать за один проект можно только один раз за 24 часа!";
        }

        .voteServerNotFound:before{
            Content: "Данного сервера не существует!";
        }
    </style>
@endsection

@section("mainHeroContent")
    <!-- Main Hero Content -->
    <!-- End Main Hero Content -->
@endsection

@section("body")
    <div class="relative w-full px-2 pt-6 pb-5 bg-white ring-1 ring-gray-900/5 mdm:max-w-3xl md:mx-auto lg:max-w-7xl lg:pt-8 lg:pb-14 lg:!px-0 mb-2 rounded-2">
        <div class="mt-2 px-10 mdm:px-2 mx-auto">
            <div class="flex justify-center mdm:flex-wrap">
                <div class="w-3/12 mdm:w-full flex flex-col">
                    <h1 class="w-full text-base text-black font-semibold mdm:text-center">{{ $server->title }}</h1>
                    @if(!$server->is_launcher)
                        <button class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 rounded" id="launcher-button-preview" onclick="copy('{{ $server->server_data }}')">
                            <span class="inline align-middle pt-[1px]">{{ $server->server_data }}</span>
                        </button>
                    @else
                        <button class="modal-open bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 rounded" id="launcher-button-preview" onclick="redirect('{{ $server->server_data }}')">
                            <svg class="w-5 h-4 inline mr-1 align-middle" color="white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 293.573 293.573" xml:space="preserve">
                                                <path fill="#FFFFFF" d="M229.62,140.665v0.093h-69.718c-0.086-1-0.139-1.69-0.139-2.479c0-11.511,9.364-20.95,20.857-20.95l43.12,0.015
                                                    c28.053,0,50.876-22.741,50.876-50.794s-22.823-50.793-50.876-50.793h-25.606c-8.284,0-15,6.716-15,15s6.716,15,15,15h25.606
                                                    c11.511,0,20.876,9.264,20.876,20.774s-9.365,20.826-20.858,20.826l-43.12-0.077c-28.053,0-50.875,22.958-50.875,51.011
                                                    c0,0.782,0.024,1.466,0.059,2.466H63.62v-0.093C27.62,143.237,0,172.986,0,209.211c0,37.908,30.905,68.604,68.813,68.604
                                                    c24.786,0,46.61-13.057,58.708-33.057h38.864c12.098,20,33.857,33.057,58.644,33.057c37.908,0,68.543-30.768,68.543-68.676
                                                    C293.573,172.914,265.62,143.237,229.62,140.665z M101.62,218.758h-24v23h-18v-23h-24v-19h24v-23h18v23h24V218.758z M194.24,218.559
                                                    c-6.429,0-11.659-5.23-11.659-11.659s5.23-11.658,11.659-11.658s11.658,5.229,11.658,11.658S200.669,218.559,194.24,218.559z
                                                     M225.029,249.348c-6.429,0-11.659-5.23-11.659-11.659s5.23-11.658,11.659-11.658s11.658,5.229,11.658,11.658
                                                    S231.458,249.348,225.029,249.348z M225.029,187.77c-6.429,0-11.659-5.23-11.659-11.659s5.23-11.658,11.659-11.658
                                                    s11.658,5.229,11.658,11.658S231.458,187.77,225.029,187.77z M255.818,218.559c-6.429,0-11.659-5.23-11.659-11.659
                                                    s5.23-11.658,11.659-11.658s11.658,5.229,11.658,11.658S262.247,218.559,255.818,218.559z"/>
                                            </svg>
                            <span class="inline align-middle">Скачать лаунчер</span>
                        </button>
                    @endif
                </div>
                <div class="w-full lg:hidden justify-center align-middle py-3">
                    <img class="rounded-2" src="@if($server->banner_img == null) {{ asset("/img/test/banner.png") }} @else {{ asset("/img/banners/{$server->banner_img}") }} @endif" width="486" height="60" alt="" id="server-banner">
                </div>
                <div class="w-1/12 mdm:w-1/3 flex flex-col mt-[1%]">
                    @if(!$server->is_launcher)
                        <div class="text-center mr-1 items-center justify-center">
                            <svg class="inline font-bold" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <circle fill="#00A300" cx="11.997" cy="18" r="1"/>
                                <path fill="#00A300" d="M18 13c-.198 0-.397-.058-.572-.18-5.77-4.038-10.748-.084-10.798-.044-.43.35-1.06.283-1.406-.147-.35-.43-.282-1.064.146-1.413.062-.05 6.214-4.935 13.202-.044.453.317.563.943.248 1.397-.194.28-.505.43-.82.43z"/>
                                <path fill="#00A300" d="M21 10c-.193 0-.388-.055-.56-.172C11.173 3.546 3.72 9.7 3.644 9.763c-.423.36-1.053.303-1.41-.12-.354-.424-.302-1.058.12-1.415.086-.072 8.7-7.184 19.205-.065.456.31.576.934.27 1.394-.195.288-.51.443-.83.443zm-6.002 6c-.197 0-.396-.058-.57-.18-2.552-1.776-4.713-.113-4.803-.04-.43.343-1.058.273-1.404-.157-.342-.43-.28-1.055.148-1.403 1.157-.945 4.153-2.17 7.203-.046.455.316.567.94.25 1.395-.193.28-.504.43-.82.43z"/>
                            </svg>
                            <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500">{{ $server->online }}</span>
                        </div>
                        <div class="text-center">Онлайн</div>
                    @endif
                </div>
                <div class="w-5/12 mdm:hidden justify-center align-middle">
                    <img class="rounded-2" src="@if($server->banner_img == null) {{ asset("/img/test/banner.png") }} @else {{ asset("/img/banners/{$server->banner_img}") }} @endif" width="486" height="60" alt="" id="server-banner">
                </div>
                <div class="w-1/3 lg:hidden align-middle text-center mt-[1%]">
                    <button class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 hover:border-indigo-500 rounded tooltip-custom" id="launcher-button-preview" onclick="voteProject({{ $server->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class="w-5 h-4 inline mr-1 align-middle font-bold" color="white"	 viewBox="0 0 66.831 66.831" style="enable-background:new 0 0 66.831 66.831;" xml:space="preserve"> <g> 	<path fill="#FFFFFF" d="M51.735,20h-2.934c1.419-3.934,2.799-9.714,0.942-14.247c-1.095-2.673-3.177-4.574-6.021-5.496 		C43.197,0.086,42.651,0,42.101,0c-3.701,0-7.05,3.613-11.944,12.888c-2.199,4.171-5.364,7.683-7.593,9.577 		c-0.946,0.804-1.702,1.624-2.315,2.431c-1.69-2.512-4.558-4.167-7.806-4.167c-5.185,0-9.404,4.219-9.404,9.404v27.294 		c0,5.186,4.219,9.404,9.404,9.404c3.406,0,6.386-1.827,8.036-4.546c2.212,2.728,5.586,4.477,9.364,4.477h23.023 		c9.507,0,10.926-6.136,10.926-9.793v-24.91C63.793,25.41,58.384,20,51.735,20z M15.847,57.427c0,1.877-1.527,3.404-3.403,3.404 		c-1.877,0-3.404-1.527-3.404-3.404V30.133c0-1.877,1.527-3.404,3.404-3.404c1.876,0,3.403,1.527,3.403,3.404V57.427z 		 M57.793,56.969c0,2.221-0.354,3.793-4.926,3.793H29.844c-3.34,0-6.058-2.717-6.058-6.057V32.059l0.008-0.095l-0.021-0.176 		c-0.006-0.096-0.106-2.386,2.676-4.75c2.656-2.258,6.419-6.425,9.015-11.351c4.132-7.83,6.104-9.353,6.639-9.641 		c1.039,0.388,1.688,1.007,2.087,1.981c1.293,3.156-0.331,9.224-2.603,13.587l-2.283,4.385h12.43c3.341,0,6.059,2.718,6.059,6.059 		V56.969z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                        <span class="align-middle">Голосовать</span>
                    </button>
                </div>
                <div class="w-1/12 mdm:w-1/3 flex flex-col mt-[1%]">
                    <div class="text-center mr-1 items-center justify-center">
                        <svg class="inline font-bold" width="20px" height="20px" viewBox="0 0 211.618 211.618">
	                        <path fill="#00A300" d="M204.118,202.309H7.5c-4.142,0-7.5-3.357-7.5-7.5v-178c0-4.143,3.358-7.5,7.5-7.5s7.5,3.357,7.5,7.5v170.5h189.118 c4.142,0,7.5,3.357,7.5,7.5S208.26,202.309,204.118,202.309z M188.854,93.754c-1.932-1.413-4.424-1.819-6.703-1.092l-47.875,15.254 l-16.317-47.958c-0.74-2.176-2.437-3.892-4.604-4.656c-2.166-0.767-4.565-0.495-6.507,0.735L78.768,73.809L43.2,28.261 c-1.971-2.523-5.325-3.519-8.352-2.476c-3.027,1.042-5.059,3.891-5.059,7.092v133.863c0,4.143,3.358,7.5,7.5,7.5h147.139 c4.142,0,7.5-3.357,7.5-7.5V99.809C191.928,97.416,190.786,95.167,188.854,93.754z"/>
                        </svg>
                        <span class="inline ml-1 align-middle font-semibold text-sm text-gray-500">{{ $server->rating }}</span>
                    </div>
                    <div class="text-center mt-[4px]">Рейтинг</div>
                </div>
                <div class="w-2/12 mdm:hidden align-middle text-center mt-[1%]">
                    <button class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-3 hover:border-indigo-500 rounded tooltip-custom" id="launcher-button-preview" onclick="voteProject({{ $server->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class="w-5 h-4 inline mr-1 align-middle font-bold" color="white"	 viewBox="0 0 66.831 66.831" style="enable-background:new 0 0 66.831 66.831;" xml:space="preserve"> <g> 	<path fill="#FFFFFF" d="M51.735,20h-2.934c1.419-3.934,2.799-9.714,0.942-14.247c-1.095-2.673-3.177-4.574-6.021-5.496 		C43.197,0.086,42.651,0,42.101,0c-3.701,0-7.05,3.613-11.944,12.888c-2.199,4.171-5.364,7.683-7.593,9.577 		c-0.946,0.804-1.702,1.624-2.315,2.431c-1.69-2.512-4.558-4.167-7.806-4.167c-5.185,0-9.404,4.219-9.404,9.404v27.294 		c0,5.186,4.219,9.404,9.404,9.404c3.406,0,6.386-1.827,8.036-4.546c2.212,2.728,5.586,4.477,9.364,4.477h23.023 		c9.507,0,10.926-6.136,10.926-9.793v-24.91C63.793,25.41,58.384,20,51.735,20z M15.847,57.427c0,1.877-1.527,3.404-3.403,3.404 		c-1.877,0-3.404-1.527-3.404-3.404V30.133c0-1.877,1.527-3.404,3.404-3.404c1.876,0,3.403,1.527,3.403,3.404V57.427z 		 M57.793,56.969c0,2.221-0.354,3.793-4.926,3.793H29.844c-3.34,0-6.058-2.717-6.058-6.057V32.059l0.008-0.095l-0.021-0.176 		c-0.006-0.096-0.106-2.386,2.676-4.75c2.656-2.258,6.419-6.425,9.015-11.351c4.132-7.83,6.104-9.353,6.639-9.641 		c1.039,0.388,1.688,1.007,2.087,1.981c1.293,3.156-0.331,9.224-2.603,13.587l-2.283,4.385h12.43c3.341,0,6.059,2.718,6.059,6.059 		V56.969z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                        <span class="align-middle">Голосовать</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="relative w-full px-2 py-6 bg-white ring-1 ring-gray-900/5 mdm:max-w-3xl md:mx-auto lg:max-w-7xl lg:pt-8 lg:pb-14 lg:!px-0 mb-5 rounded-2">
        <div class="mt-2 px-10 mdm:px-2 mx-auto">
            <div class="text-lg mb-4">Информация сервера</div>
            <div class="flex flex-wrap my-1">
                <div class="w-1/6 mdm:w-1/2 text-base text-gray-700">ID сервера MNS:</div>
                <div class="w-5/6 mdm:w-1/2 text-left text-base font-medium text-black">{{ $server->id }}</div>
            </div>
            <div class="flex flex-wrap my-1">
                <div class="w-1/6 mdm:w-1/2 text-base text-gray-700">Игра:</div>
                <div class="w-5/6 mdm:w-1/2 text-left text-base font-medium text-black"><a href="{{ route("toGame", ["link" => $server->game->short_link]) }}">{{ $server->game->title }}</a></div>
            </div>
            @if($server->site != null)
                <div class="flex flex-wrap my-1">
                    <div class="w-1/6 mdm:w-1/2 text-base text-gray-700">Сайт сервера:</div>
                    <div class="w-5/6 mdm:w-1/2 text-left text-base font-medium text-black"><a target="_blank" href="{{ $server->site }}">{{ $server->site }}</a></div>
                </div>
            @endif
            @if($server->vk != null)
                <div class="flex flex-wrap my-1">
                    <div class="w-1/6 mdm:w-1/2 text-base text-gray-700">Сообщество ВКонтакте:</div>
                    <div class="w-5/6 mdm:w-1/2 text-left text-base font-medium text-black"><a target="_blank" href="{{ $server->vk }}">{{ $server->site }}</a></div>
                </div>
            @endif
            @if($server->discord != null)
                <div class="flex flex-wrap my-1">
                    <div class="w-1/6 mdm:w-1/2 text-base text-gray-700">Discord сервер:</div>
                    <div class="w-5/6 mdm:w-1/2 text-left text-base font-medium text-black"><a target="_blank" href="{{ $server->discord }}">{{ $server->site }}</a></div>
                </div>
            @endif
            @if($server->filters->isNotEmpty())
                <div class="flex flex-wrap my-1">
                    <div class="w-1/6 mdm:w-full text-base text-gray-700 mt-[7px]">Категории сервера:</div>
                    <div class="flex flex-col items-center relative">
                        <div class="w-full">
                            <div class="p-1 flex h-full">
                                <div class="flex flex-auto flex-wrap">
                                    @foreach($server->filters as $filter)
                                        <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-indigo-700 bg-indigo-100 border border-indigo-300 h-[26px] cursor-pointer" id="filter-id-{{ $filter->id }}">
                                            <div class="text-xs font-normal leading-none max-w-full flex-initial">
                                                {{ $filter->filter }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="relative flex py-3 items-center mt-4 mb-4">
                <div class="flex-grow border-t border-gray-400"></div>
            </div>
            <div class="text-lg mb-4">Описание сервера</div>
            <div class="text-base mdm:text-justify">{{$server->description }}</div>
        </div>
        <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center hidden">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div class="modal-content py-4 text-left px-6">
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-xl font-bold">Внимание!</p>
                    </div>
                    <p class="mb-1">Вы покидаете <strong>MNS Game Project!</strong></p>
                    <p class="my-1">Мы не несём ответственность за содержимое и деятельность сайта, на который вы переходите.</p>
                    <p class="mt-1">Вы уверены, что хотите продолжить?</p>
                    <div class="flex justify-end pt-2">
                        <button class="modal-close px-3 bg-transparent py-1 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Отменить</button>
                        <a id="redirectUrl" target="_blank">
                            <button class="modal-close bg-red-500 hover:bg-red-400 text-white py-1 px-3 rounded">
                                <span class="inline align-middle pt-[1%]">Продолжить</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="notify"><span id="notifyType" class=""></span></div>
@endsection

@section('scripts')
    <script>
        let openmodal = document.querySelectorAll('.modal-open')
        for (let i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event){
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        let closemodal = document.querySelectorAll('.modal-close')
        for (let i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            modal.classList.toggle('hidden')
            body.classList.toggle('modal-active')
        }

        function redirect(url){
            document.getElementById("redirectUrl").href = url;
        }
    </script>

    <script>
        function copy(ip){
            copyToClipboard(ip);

            let notify_window = document.querySelector(".notify");
            let notifyType = document.getElementById("notifyType");
            notify_window.classList.toggle("active");
            notifyType.classList.toggle("success");

            setTimeout(() => {
                notify_window.classList.toggle("active");
                notifyType.classList.toggle("success");
            }, 2500)
        }

        function copyToClipboard(textToCopy) {
            if (navigator.clipboard && window.isSecureContext) {
                return navigator.clipboard.writeText(textToCopy);
            } else {
                let textArea = document.createElement("textarea");
                textArea.value = textToCopy;
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                textArea.style.top = "-999999px";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                return new Promise((res, rej) => {
                    document.execCommand('copy') ? res() : rej();
                    textArea.remove();
                });
            }
        }
    </script>

    <script>
        function voteProject(server_id){
            const request = new XMLHttpRequest();

            const url = "{{ url("/server/vote") }}" + "/" + server_id;

            request.open("POST", url, true);

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("Accept", "application/json");
            request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    let notify_window = document.querySelector(".notify");
                    let notifyType = document.getElementById("notifyType");
                    notify_window.classList.toggle("active");
                    notifyType.classList.toggle("voteSuccess");
                    setTimeout(() => {
                        notify_window.classList.toggle("active");
                        notifyType.classList.toggle("voteSuccess");
                    }, 2500)

                }
                else if(request.readyState === 4 && request.status === 422){
                    let data = JSON.parse(request.responseText);

                    let notify_window = document.querySelector(".notify");
                    let notifyType = document.getElementById("notifyType");
                    notify_window.classList.toggle("active");

                    switch (data.code){
                        case 0:
                            notifyType.classList.toggle("voteServerNotFound");
                            setTimeout(() => {
                                notify_window.classList.toggle("active");
                                notifyType.classList.toggle("voteServerNotFound");
                            }, 2500)
                            break;
                        case 1:
                            notifyType.classList.toggle("voteFailed");
                            setTimeout(() => {
                                notify_window.classList.toggle("active");
                                notifyType.classList.toggle("voteFailed");
                            }, 2500)
                            break;
                        case 2:
                            notifyType.classList.toggle("voteTimeFailed");
                            setTimeout(() => {
                                notify_window.classList.toggle("active");
                                notifyType.classList.toggle("voteTimeFailed");
                            }, 2500)
                            break;
                        default:
                            break;
                    }
                }
                else if(request.readyState === 4 && request.status === 401){
                    window.location.href = '{{ url("/login") }}';
                }
            });
            request.send();
        }
    </script>
@endsection
