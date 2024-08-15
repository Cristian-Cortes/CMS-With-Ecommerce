@extends('master')
@section('title', 'Orden #'.$order->o_number)

@section('content')
    <div class="cart mtop32">
        <div class="container">
            <div class="items shadow mtop32">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="header">
                                <h2 class="title"><i class="fa-solid fa-cart-shopping"></i> Detalles de orden #{{$order->o_number}}</h2>
                            </div>
                            <div class="inside">
                                <table class="table align-middle table-hover">
                                    <thead>
                                        <tr>
                                            <td width="80"></td>
                                            <td><strong>Producto</strong></td>
                                            <td></td>
                                            <td width="160"><strong>Cantidad</strong></td>
                                            <td><strong>Precio</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->getItems as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ getUrlFileFromUploads($item->getProduct->image) }}" class="img-fluid rounded">                                             </td>
                                            <td>
                                                <a href="{{ url('/products/'.$item->getProduct->id.'/'.$item->getProduct->slug) }}">
                                                    {{ $item->label_item }}
                                                    <div class="price_discount">
                                                        @if($item->discount_status == "1")
                                                        <span class="price_initial">{{Config('cms.currency').$item->price_initial}}</span> / 
                                                        @endif
                                                        <span>
                                                            {{Config('cms.currency').$item->price_unit}} 
                                                            @if($item->discount_status == "1")
                                                            ({{$item->discount}}% de descuento.)
                                                            @endif
                                                        </span>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" style="color: #fff;">Volver a comprar</a>
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td><strong>{{ number($item->total) }}</strong></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3"></td>
                                            <td><strong>Subtotal:</strong></td>
                                            <td><strong>{{ number($order->getSubtotal()) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td><strong>Envió:</strong></td>
                                            <td><strong>{{ number($order->delivery) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td><strong>Total:</strong></td>
                                            <td><strong>{{ number($order->total) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($order->payment_method == "1")
                            <div class="row mtop32" id="payment_method_transfer_info">
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="header">
                                            <h2 class="title"><i class="fa-solid fa-money-bill-transfer"></i> Datos de transferencia o deposito</h2>
                                        </div>
                                        <div class="inside">
                                            <p>{!! Config::get('cms.payment_method_transfer_accounts_bank') !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="header">
                                            <h2 class="title"><i class="fa-solid fa-ticket"></i> Comprobante de pago</h2>
                                        </div>
                                        <div class="inside">
                                            <img src="{{ getUrlFileFromUploads($order->voucher) }}" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-3">
                            <div class="panel">
                                <div class="header">
                                    <h2 class="title"><i class="fa-solid fa-map-location-dot"></i> Tipo de orden</h2>
                                </div>
                                <div class="inside">
                                    <div class="mdswitch">
                                        <a href="#" class="sl @if($order->o_type == "0") active @endif">
                                            <i class="fa-solid fa-truck"></i> Domicilio
                                        </a>
                                        <a href="#" class="sl @if($order->o_type == "1") active @endif">
                                            <i class="fa-solid fa-shop"></i> En tienda
                                        </a>
                                    </div>
                                    @if($order->o_type == "0")
                                            <p>
                                                {{ kvfj($order->getUserAddress->addr_info, 'street') }} 
                                                {{ kvfj($order->getUserAddress->addr_info, 'numex') }} 
                                                {{ kvfj($order->getUserAddress->addr_info, 'col') }}
                                                <br>
                                                CP {{ kvfj($order->getUserAddress->addr_info, 'cpostal') }} - 
                                                {{ $order->getUserAddress->getCity->name }} - 
                                                {{ $order->getUserAddress->getState->name }}
                                                <br>
                                                {{ kvfj($order->getUserAddress->addr_info, 'name') }}
                                                <br> 
                                                {{ kvfj($order->getUserAddress->addr_info, 'phone') }}
                                            </p>
                                    @endif
                                    @if($order->o_type == "1")
                                        <p>
                                            <Strong>Tienda: </Strong>{{ config('cms.map')}}
                                        </p>
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3742.6003558182747!2d-98.94818908839487!3d20.275402695960068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d171a0cd1299fb%3A0x8b0c28b96956141d!2sSombreros%20y%20botines%20%22ACTOPAN%22!5e0!3m2!1ses!2smx!4v1670793892457!5m2!1ses!2smx" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    @endif
                                </div>
                            </div>
                            <div class="panel mtop16">
                                <div class="header">
                                    <h2 class="title"><i class="fa-solid fa-money-check-dollar"></i> Método de pago</h2>
                                </div>
                                <div class="inside">
                                    <div class="payment_methods">
                                        <a href="#" class="active w-100" id="payment_method_cash" 
                                        data-payment-method-id="0">
                                            <i class="fa-solid fa-cash-register"></i> {{getPaymentsMethods($order->payment_method)}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel mtop16">
                                <div class="header">
                                    <h2 class="title"><i class="fa-regular fa-envelope-open"></i> Más</h2>
                                </div>
                                <div class="inside">
                                    <label for="order_msg">Comentario:</label>
                                    @if($order->user_comment)
                                    <p>{{!!$order->user_comment!!}}</p>
                                    @endif
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection