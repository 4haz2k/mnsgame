@extends("layouts.main")

@section("title", "MNS Game | Уведомления")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <script src="https://use.fontawesome.com/fd45a37d11.js"></script>
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
            font-size: 1.05rem; /*.text-xl*/
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

@endsection

@section("body")
    <section class="mb-10">
        <div class="container max-w-4xl mx-auto">
            <div class="text-2xl font-bold tracking-tight mdm:text-center">MNS Game<span class="text-indigo-500 text-3xl">.</span> Уведомления</div>
            <div class="text-lg font-medium tracking-tight mdm:text-center">На этой странице отображаются все ваши уведомления за всё время</div>
        </div>
    </section>
    <div class="container max-w-6xl lg:mx-auto mb-12">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-md">
                        <table class="min-w-full">
                            <thead class="border-b bg-white">
                            <tr>
                                <th scope="col" class="text-sm text-gray-900 px-6 py-4 text-center font-bold">
                                    Статус
                                </th>
                                <th scope="col" class="text-sm text-gray-900 px-6 py-4 text-center font-bold">
                                    Тема
                                </th>
                                <th scope="col" class="text-sm text-gray-900 px-6 py-4 text-center font-bold">
                                    Дата
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notifications as $notification)
                                <tr class="border-b text-center bg-white cursor-pointer hover:!bg-gray-100 transition ease-in-out duration-150" id="{{ $notification->id }}" onclick="goNotification('{{ $notification->id }}')">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                        @if($notification->is_viewed)
                                            <svg viewBox="0 0 512 512" class="w-5 h-5 mx-auto">
                                                <g>
                                                    <g>
                                                        <path class="text-black" d="m493.4,198.4l-91-74.5v-14.4c0-11.3-9.1-20.4-20.4-20.4h-22l-89.7-73.5c-7.5-6.1-18.3-6.2-25.8-0.1l-90.8,73.6h-23.4c-11.3,0-20.4,9.1-20.4,20.4v15.1l-91.3,73.7c-4.8,3.9-7.6,9.7-7.6,15.9v266.4c0,11.3 9.1,20.4 20.4,20.4h449.1c11.3,0 20.4-9.1 20.4-20.4v-266.4c0-6.1-2.8-11.9-7.5-15.8zm-46.8,14.5l-44.2,29.3v-65.4l44.2,36.1zm-85.1-83v139.3l-105.3,69.7-105.6-70.1v-138.9h210.9zm-104.3-72.1l38.3,31.3h-77l38.7-31.3zm-147.4,183.9l-44-29.2 44-35.6v64.8zm-58,218.5v-207.9l193.2,128.1c3.4,2.3 7.4,3.4 11.3,3.4 3.9,0 7.9-1.1 11.3-3.4l192.4-127.5v207.2h-408.2z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        @else
                                            <svg viewBox="0 0 512 512" class="w-5 h-5 mx-auto">
                                                <g>
                                                    <g>
                                                        <path class="text-black" d="M480.5,56H31.3C20,56,10.9,65.2,10.9,76.5v359c0,11.3,9.1,20.5,20.4,20.5h449.2c11.3,0,20.4-9.2,20.4-20.5v-359    C500.9,65.2,491.7,56,480.5,56z M432.4,97L256.3,276.2L80.2,97H432.4z M51.7,415V126.5l190,193.3c10.3,10.9,18.6,9,29.1,0    l189.3-192.5V415H51.7z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-center font-bold">
                                        {{ $notification->title }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                        {{ \Carbon\Carbon::make($notification->created_at)->format("d.m.Y H:i:s") }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('public/js/app.js') }}"></script>
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
        function goNotification(id){
            window.location.href = "{{ url("notification") }}" + "/" + id;
        }
    </script>
@endsection
