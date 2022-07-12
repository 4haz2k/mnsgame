@extends("payment.layout")

@section("status", "Успешная оплата")

@section("icon")
    <svg viewBox="0 0 50 50">
        <circle style="fill:#25AE88;" cx="25" cy="25" r="25"/>
        <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="38,15 22,33 12,25"/>
    </svg>
@endsection

@section("desc")
    Оплата произведена успешна. Историю платежа можно посмотреть в личном кабинете.<br><a href="{{ url("/") }}" class="text-blue-500 underline">Вернуться на главную страницу</a>
@endsection
