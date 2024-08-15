@extends('emails.master')
@section('content')
    <p>Hola: <strong>{{$name}}</strong></p>
    <p>Su pedido con numero de orden {{ $o_number }} ha cambiado su estado a: <strong>{{ getOrderStatus($status) }}</strong></p>

    @if($status == "6")
        <p>Muchas gracias por comprar en Herradura Mexicana.</p>
    @endif
@endsection