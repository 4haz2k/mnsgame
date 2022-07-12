@extends("layouts.main")

@section("title")
    MNS Game | @yield("status")
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
        <div class="mx-auto w-24 h-24">
            @yield("icon")
        </div>
        <div class="text-4xl font-bold tracking-tight text-center mt-[5%]">
            MNS Game<span class="text-indigo-500 text-3xl">.</span> @yield("status")
        </div>
        <div class="text-lg font-medium tracking-tight text-center mt-10">@yield("desc")</div>
    </div>
@endsection
