@extends("errors.layout")

@section("code", "403")

@section("desc")
    Ошибка {{ __($exception->getMessage() ?: 'Forbidden') }}! Обратитесь к администрации проекта!
@endsection

