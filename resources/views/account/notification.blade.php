@extends("layouts.main")

@section("title", "MNS Game | $notification->title")

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
@endsection

@section("mainHeroContent")

@endsection

@section("body")
    <div class="relative w-full px-6 py-6 bg-white ring-1 ring-gray-900/5 md:max-w-3xl md:mx-auto lg:max-w-4xl lg:pt-8 lg:pb-14 lg:!px-0 mb-5 rounded-2">
        <div class="mt-4 prose prose-slate mx-auto">
            <h1 class="text-left">
                <span class="text-2xl font-black leading-none text-gray-900">
                    <span>{{$notification->title}}</span>
                </span>
            </h1>
            <div class="text-sm">
                {!! $notification->body !!}
            </div>
        </div>
        <div class="relative flex py-3 items-center mt-5 mb-5">
            <div class="flex-grow border-t border-gray-400"></div>
        </div>
        <div class="prose prose-slate mx-auto text-center lg:!text-left">
            <span class="lg:inline font-medium mr-4 font-[500]" id="feedback-text">
                Дата получения: <span class="font-bold">{{\Carbon\Carbon::make($notification->created_at)->format("d.m.Y H:i:s") }}</span>
                <br>
                Отправитель: <span class="font-bold">MNS Game</span>
            </span>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
@endsection
