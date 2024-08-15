@extends('admin.master')
@section('title', 'Órdenes')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/orders/'.$status) }}"><i class="fa-solid fa-clipboard-list"></i> Órdenes</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-clipboard-list"></i> Filtrar por estado</h2>
                    </div>
                    <div class="list-group">
                        <a href="{{url('/admin/orders/all/'.$type)}}" 
                        class="list-group-item list-group-item-action @if($status == "all") active @endif" aria-current="true">
                            <i class="fa-solid fa-chevron-right"></i> Todas
                            <span class="float-end badge text-bg-primary rounded-pill">{{ $all_orders->count() }}</span>
                        </a>
                        @foreach (Arr::except(getOrderStatus(), ['0']) as $key => $value)
                            <a href="{{url('/admin/orders/'.$key.'/'.$type)}}" 
                            class="list-group-item list-group-item-action @if($status == $key) active @endif" aria-current="true">
                                <i class="fa-solid fa-chevron-right"></i> {{$value}}
                                <span class="float-end badge text-bg-primary rounded-pill">{{ $all_orders->where('status', $key)->count() }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-clipboard-list"></i> Órdenes</h2>
                    </div>
                    <div class="inside">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a class="nav-link @if($type == "all") active @endif" aria-current="page" href="{{ url('/admin/orders/'.$status.'/all') }}">Todas</a>
                            </li>
                            @foreach(getOrderType() as $key => $value)
                            <li class="nav-item">
                                <a class="nav-link @if($type == $key) active @endif" aria-current="page" href="{{ url('/admin/orders/'.$status.'/'.$key) }}">{{ $value }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td><strong>#</strong></td>
                                    <td><strong>Usuario</strong></td>
                                    <td><strong>Tipo</strong></td>
                                    <td><strong>Metodo de pago</strong></td>
                                    <td><strong>Fecha</strong></td>
                                    <td><strong>Total</strong></td>
                                    <td><strong></strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->o_number}}</td>
                                        <td>
                                            <a href="{{ url('admin/users/'.$order->user_id.'/view') }}" style="text-decoration: none">
                                                {{$order->getUser->name}} @if($order->getUser->lastname) {{$order->getUser->lastname}} @endif
                                            </a>
                                        </td>
                                        <td>{{getOrderType($order->o_type)}}</td>
                                        <td>{{getPaymentsMethods($order->payment_method)}}</td>
                                        <td>{{$order->request_at}}</td>
                                        <td>{{number($order->total)}}</td>
                                        <td>
                                            <a href="{{ url('/admin/order/'.$order->id.'/view') }}" class="btn btn-primary btn-sm">Abrir</a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">{!!$orders->render()!!}</td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </div>        
@endsection