@extends("errors.layout")

@section("code", "404")

@section("desc")
    Страница, на которую вы пытаетесь перейти не существует! <br><a href="{{ url("/") }}" class="text-blue-500 underline">Перейти на главную страницу</a>
@endsection
