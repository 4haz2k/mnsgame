@extends("payment.layout")

@section("status", "Оплата отменена")

@section("icon")
    <svg viewBox="0 0 50 50">
        <circle style="fill:#D75A4A;" cx="25" cy="25" r="25"/>
        <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;" points="16,34 25,25 34,16"/>
        <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;" points="16,16 25,25 34,34"/>
    </svg>
@endsection

@section("desc")
    Оплата была отменена вами. <br><a href="{{ url("/promote") }}" class="text-blue-500 underline">Вернуться на страницу продвижения</a>
@endsection
