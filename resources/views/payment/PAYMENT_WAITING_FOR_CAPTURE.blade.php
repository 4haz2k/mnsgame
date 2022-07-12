@extends("payment.layout")

@section("status", "Ожидание оплаты")

@section("icon")
    <svg viewBox="0 0 50 50">
        <circle style="fill:#EFCE4A;" cx="25" cy="25" r="25"/>
        <line style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;" x1="25" y1="10" x2="25" y2="32"/>
        <line style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;" x1="25" y1="37" x2="25" y2="39"/>
    </svg>
@endsection

@section("desc")
    Ожидание оплаты. Для повторной проверки оплаты нажмите <a href="{{ route("payment.callback") }}" class="text-blue-500 underline">здесь</a>.
@endsection
