@extends('admin.master')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        @if(kvfj(Auth::user()->permissions, 'dashboard_small_stats'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-chart-simple"></i> Estadísticas rápidas</h2>
                </div>
            </div>
            <div class="row mtop16">
                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-users"></i> Usuarios registrados</h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">{{ $users }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-boxes-stacked"></i> Listado de productos</h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">{{ $products }}</div>
                        </div>
                    </div>
                </div>
                @if(kvfj(Auth::user()->permissions, 'dashboard_sell_today'))
                    <div class="col-md-3">
                        <div class="panel shadow">
                            <div class="header">
                                <h2 class="title"><i class="fa-solid fa-basket-shopping"></i> Ordenes hoy</h2>
                            </div>
                            <div class="inside">
                                <div class="big_count">
                                    {{ $orders->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel shadow">
                            <div class="header">
                                <h2 class="title"><i class="fa-solid fa-credit-card"></i> Facturado hoy</h2>
                            </div>
                            <div class="inside">
                                <div class="big_count">
                                    {{ number($orders->sum('total')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @if($orders->count() > 0)
                <div class="row mtop16">
                    <div class="col-md-6">
                        <div class="panel shadow">
                            <div class="header">
                                <h2 class="title"><i class="fa-solid fa-clipboard-list"></i> Ultimas ordenes de hoy</h2>
                            </div>
                            <div class="inside">
                                <table class="table mtop16">
                                    <thead>
                                        <tr>
                                            <td><strong>#</strong></td>
                                            <td><strong>Tipo</strong></td>
                                            <td><strong>Metodo de pago</strong></td>
                                            <td><strong>Total</strong></td>
                                            <td><strong></strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{$order->o_number}}</td>
                                                <td>{{getOrderType($order->o_type)}}</td>
                                                <td>{{getPaymentsMethods($order->payment_method)}}</td>
                                                <td>{{number($order->total)}}</td>
                                                <td>
                                                    <a href="{{ url('/admin/order/'.$order->id.'/view') }}" class="btn btn-primary btn-sm">Abrir</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection