@extends("errors.layout")

@section("code", "500")

@section("desc")
    Страница, на которую вы пытаетесь перейти, недоступна сервером, обратитесь к администрации проекта! <br><a href="{{ url("/") }}" class="text-blue-500 underline">Перейти на главную страницу</a>
@endsection
