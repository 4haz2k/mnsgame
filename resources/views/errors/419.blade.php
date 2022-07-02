@extends("errors.layout")

@section("code", "419")

@section("desc")
    Время сеанса истекло! Обновите страницу. <br><a href="{{ url("/") }}" class="text-blue-500 underline">Перейти на главную страницу</a>
@endsection

