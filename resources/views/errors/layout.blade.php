@extends("layouts.main")

@section("title")
    MNS Game | Ошибка @yield("code")
@endsection

@section("styles")
    <link rel="stylesheet" href="{{ asset("css/mainpage.css") }}">
    <style type="text/css">
        .content {
            min-height: calc(100vh - 550px);
        }
    </style>
@endsection

@section("body")
    <div class="container max-w-4xl mx-auto content">
        <div class="text-4xl font-bold tracking-tight text-center mt-[20%]">MNS Game<span class="text-indigo-500 text-3xl">.</span> Ошибка <span class="text-indigo-500 text-3xl">@yield("code")</span></div>
        <div class="text-lg font-medium tracking-tight text-center mt-10">@yield("desc")</div>
    </div>
@endsection
