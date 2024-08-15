@extends('master')
@section('title', 'Mis compras')

@section('content')
<div class="row mtop32">
    <div class="col-md-12">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fa-solid fa-bag-shopping"></i> Mis compras</h2>
            </div>
            <div class="inside">
                <table class="table table-striped align-middle table-hover">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Estado</td>
                            <td>Metodo de pago</td>
                            <td>Tipo</td>
                            <td>Pago total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach (Auth::user()->getOrders as $order)
                                <tr>
                                    <td>{{ $order->o_number }}</td>
                                    <td>
                                        @switch($order->status)
                                            @case(0)
                                            @case(1)
                                                <strong><p style="color: #ddb12f;">{{ getOrderStatus($order->status) }}</p></strong>
                                                @break
                                            @case(2)
                                            @case(3)
                                            @case(4)
                                                <strong><p style="color: #0000ff;">{{ getOrderStatus($order->status) }}</p></strong>
                                                @break
                                            @case(5)
                                                <strong><p style="color: #00a650;">{{ getOrderStatus($order->status) }}</p></strong>
                                                @break
                                            @case(100)
                                                <strong><p style="color: #ff0000;">{{ getOrderStatus($order->status) }}</p></strong>
                                                @break
                                            @default
                                                <strong><p style="color: #ff0000;">Sin estatus</p></strong>
                                            @break
                                        @endswitch
                                        <strong>{{ $order->updated_at }}</strong>
                                    </td>
                                    <td>{{ getPaymentsMethods($order->payment_method) }}</td>
                                    <td>{{ getOrderType($order->o_type) }}</td>
                                    <td>{{ number($order->total) }}</td>
                                    <td>
                                        <a href="{{ url('/account/history/order/'.$order->id) }}" class="btn btn-primary btn-sm">Ver compra</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection