@extends("errors.layout")

@section("code", "401")

@section("desc")
    Страница, на которую вы пытаетесь перейти доступна только авторизованным пользователям! <br><a href="{{ url("login") }}" class="text-blue-500 underline">Перейти на страницу авторизации</a>
@endsection

