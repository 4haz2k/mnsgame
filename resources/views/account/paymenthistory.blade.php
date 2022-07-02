@extends("layouts.main")

@section("title", "MNS Game | История моих платежей")

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
            <div class="text-2xl font-bold tracking-tight mdm:text-center">MNS Game<span class="text-indigo-500 text-3xl">.</span> История моих платежей</div>
            <div class="text-lg font-medium tracking-tight mdm:text-center">На этой странице отображаются все платежи серверов за всё время</div>
        </div>
    </section>
    <div class="container max-w-4xl lg:mx-auto mb-12">
        @if($payments->isEmpty())
            <div class="text-center text-xl font-bold mt-4 mb-10">Ваш список платежей пуст!</div>
        @else
            <div class="shadow-md mt-2">
                @foreach($payments as $payment)
                    <div class="tab w-full overflow-hidden border-t">
                        <input class="absolute opacity-0" id="{{ "item-".$payment->id }}" type="radio" name="tabs">
                        <label class="block p-4 leading-normal cursor-pointer text-md" for="{{ "item-".$payment->id }}">{{ $payment->server->title }}</label>
                        <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-indigo-500 leading-normal">
                            <div class="px-4 py-2 flex text-md">
                                <div class="w-1/3 text-center ml-2 mr-1">
                                    Пополнение
                                </div>
                                <div class="w-1/3 text-center ml-1 mr-1">
                                    Статус
                                </div>
                                <div class="w-1/3 text-center ml-1 mr-1">
                                    Дата пополнения
                                </div>
                            </div>
                            <div class="px-4 pt-1 pb-2 flex text-md">
                                <div class="w-1/3 text-center ml-2 mr-1">
                                    <span class="text-green-500 font-bold">{{ $payment->balance_change }} РУБ</span>
                                </div>
                                <div class="w-1/3 text-center ml-1 mr-1">
                                    @if(!$payment->is_active) <span class="text-red-500 font-bold">Активен до: {{ \Carbon\Carbon::make($payment->end_date)->format("d.m.Y H:i:m") }}</span> @else <span class="text-green-500 font-bold">Исполнено</span> @endif
                                </div>
                                <div class="w-1/3 text-center ml-1 mr-1">
                                    <span class="font-bold">{{ \Carbon\Carbon::make($payment->created_at)->format("d.m.Y H:i:m") }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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
@endsection
