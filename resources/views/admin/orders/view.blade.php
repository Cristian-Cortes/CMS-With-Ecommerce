@extends('admin.master')
@section('title', 'Orden #'.$order->o_number)

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/orders/all/all') }}"><i class="fa-solid fa-clipboard-list"></i> Órdenes</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#"><i class="fa-solid fa-clipboard-list"></i> Orden #{{$order->o_number}}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="order">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-user"></i> Usuario</h2>
                        </div>
                        <div class="inside">
                            <div class="profile">
                                <div class="photo">
                                    @if (is_null($order->getUser->avatar))
                                        <img src="{{ url('/static/img/default_avatar.jpg') }}" class="img-fluid rounded-circle">
                                    @else
                                        <img src="{{ getUrlFileFromUploads($order->getUser->avatar) }}" class="img-fluid rounded-circle">
                                    @endif
                                </div>
                                <div class="info mtop16">
                                    <ul>
                                        <li><i class="fa-solid fa-user"></i> Nombre: {{$order->getUser->name.' '.$order->getUser->lastname}}</li>
                                        <li><i class="fa-solid fa-envelope"></i> E-mail: {{$order->getUser->email}}</li>
                                        @if($order->getUser->phone)
                                            <li><i class="fa-solid fa-phone"></i> Teléfono: {{$order->getUser->phone}}</li>
                                        @endif
                                    </ul>
                                    <a href="{{url('/admin/user/'.$order->user_id.'/view')}}" class="btn btn-primary btn-sm mtop16">Ver usuario</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-clipboard-list"></i> Tipo de orden</h2>
                        </div>
                        <div class="inside">
                            <div class="profile">
                                <div class="mdswitch">
                                    <a href="#" class="sl @if($order->o_type == "0") active @endif">
                                        <i class="fa-solid fa-truck"></i> Domicilio
                                    </a>
                                    <a href="#" class="sl @if($order->o_type == "1") active @endif">
                                        <i class="fa-solid fa-shop"></i> En tienda
                                    </a>
                                </div>
                                @if($order->o_type == "0")
                                    <p style="margin-botton: 2px;">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <strong>{{ kvfj($order->getUserAddress->addr_info, 'street' )}} #{{ kvfj($order->getUserAddress->addr_info, 'numex') }} {{ kvfj($order->getUserAddress->addr_info, 'col') }}</strong>
                                        <br>
                                        {{ kvfj($order->getUserAddress->addr_info, 'cpostal') }} - 
                                        {{ $order->getUserAddress->getCity->name }} - 
                                        {{ $order->getUserAddress->getState->name }} 
                                        
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
                    </div>
                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="fa-regular fa-envelope-open"></i> Más</h2>
                        </div>
                        <div class="inside">
                            <label for="order_msg">Comentario:</label>
                            @if($order->user_comment)
                            <p>{{$order->user_comment}}</p>
                            @endif
                        </div>
                    </div>
                </div>
    
                <div class="col-md-6">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-clipboard-list"></i> Órdenes</h2>
                        </div>
                        <div class="inside">
                                <table class="table align-middle table-hover">
                                    <thead>
                                        <tr>
                                            <td width="80"></td>
                                            <td><strong>Producto</strong></td>
                                            <td width="160"><strong>Cantidad</strong></td>
                                            <td><strong>Precio</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->getItems as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ getUrlFileFromUploads($item->getProduct->image) }}" class="img-fluid rounded">
                                            </td>
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
                            <div class="order_status mtop16">
                                <form action="{{ url('/admin/order/'.$order->id.'/view') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>Estado de la orden:</strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            @if ($order->o_type == "0")
                                                <select name="status" class="form-select">
                                                        <option selected value="{{$order->status}}">{{ getOrderStatus($order->status) }}</option>
                                                    @foreach (Arr::except(getOrderStatus(), ['5']) as $key => $value)
                                                        <option value="{{$key}}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="status" class="form-select">
                                                        <option selected value="{{$order->status}}">{{ getOrderStatus($order->status) }}</option>
                                                    @foreach (Arr::except(getOrderStatus(), ['4']) as $key => $value)
                                                        <option value="{{$key}}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($order->status == "6" || $order->status == "100")
                                                <button type="submit" class="btn btn-success w-100" disabled>Actualizar</button>
                                            @else
                                                <button type="submit" class="btn btn-success w-100">Actualizar</button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-money-check-dollar"></i> Método de pago</h2>
                        </div>
                        <div class="inside">
                            <div class="payment_methods">
                                <a href="#" class="active w-100" id="payment_method_cash" data-payment-method-id="0">
                                    <i class="fa-solid fa-cash-register"></i> {{getPaymentsMethods($order->payment_method)}}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if($order->payment_method == "1")
                        <div class="panel shadow mtop16">
                            <div class="header">
                                <h2 class="title"><i class="fa-solid fa-ticket"></i> Comprobante de pago</h2>
                            </div>
                            <div class="inside">
                                <a href="{{ getUrlFileFromUploads($order->voucher) }}" target="_blank">
                                    <img src="{{ getUrlFileFromUploads($order->voucher) }}" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-calendar-check"></i> Actividad</h2>
                        </div>
                        <div class="inside">
                            <div class="profile">
                                <div class="info">
                                    <ul>
                                        <li><strong><i class="fa-solid fa-clock"></i> Solicitada:</strong> {{ $order->request_at }}</li>
                                        <li><strong><i class="fa-solid fa-credit-card"></i> Pagada:</strong> {{ $order->paid_at }}</li>
                                        <li><strong><i class="fa-solid fa-box"></i> Procesando:</strong> {{ $order->process_at }}</li>
                                        @if($order->o_type == "0")
                                            <li><strong><i class="fa-solid fa-motorcycle"></i> Enviada:</strong> {{ $order->send_at }}</li>
                                        @else
                                            <li><strong><i class="fa-solid fa-motorcycle"></i> Lista:</strong> {{ $order->send_at }}</li>
                                        @endif
                                        <li><strong><i class="fa-solid fa-truck-fast"></i> Entregada:</strong> {{ $order->delivery_at }}</li>
                                        @if($order->rejected_at)
                                            <li><strong><i class="fa-solid fa-recycle"></i> Rechazada:</strong> {{ $order->rejected_at }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
@endsection