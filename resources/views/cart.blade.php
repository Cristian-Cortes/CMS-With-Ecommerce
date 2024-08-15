@extends('master')

@section('title', 'Carrito de compra')

@section('content')
    <div class="cart mtop32">
        <div class="container">
            @if(count(collect($items)) == "0")
                <div class="no_items shadow">
                    <div class="inside">
                        <p><img src="{{ url('/static/img/loading_car.png') }}"></p>
                        <p><strong>Hola {{ Auth::user()->name }}</strong>. 
                        Aun no has agregado ningún producto a tu carrito de compras.</p> 
                        <p>¿No sabes qué comprar? !Anímate increíbles productos te esperan!</p>
                        <p>
                            <a href="{{ url('/store') }}">Descubrir productos</a>
                        </p>
                    </div>
                </div>
            @else
                <div class="items shadow mtop32">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel">
                                <div class="header">
                                    <h2 class="title"><i class="fa-solid fa-cart-shopping"></i> Carrito de compras</h2>
                                </div>
                                <div class="inside">
                                    <table class="table align-middle table-hover">
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <td width="80"></td>
                                                <td><strong>Producto</strong></td>
                                                <td width="160"><strong>Cantidad</strong></td>
                                                <td><strong>Subtotal</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('/cart/item/'.$item->id.'/delete') }}" class="btn-delete"
                                                        data-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <img src="{{ getUrlFileFromUploads($item->getProduct->image) }}" class="img-fluid rounded">                                                </td>
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
                                                    <div class="form-quantity">
                                                        <form action="{{url('/cart/item/'.$item->id.'/update')}}" method="POST">
                                                            @csrf
                                                            <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control" min="1">
                                                            <button type="submit" data-toggle="tooltip" data-bs-placement="top" data-bs-title="Actualizar carrito">
                                                                <i class="fa-regular fa-floppy-disk"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
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
                                                <td><strong>{{ number($shipping) }}</strong></td>
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
                            <div class="row mtop32" id="payment_method_transfer_info" style="display: none">
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
                                            <h2 class="title"><i class="fa-solid fa-file-arrow-up"></i> Subir comprobante de pago</h2>
                                        </div>
                                        <div class="inside">
                                            <a href="#" id="payment_method_transfer_select_file" class="file_select">
                                                <img src="{{ url('/static/img/uploads_image_pay.png') }}" alt="">
                                            </a>
                                            <img src="" class="img-fluid mtop16" id="payment_method_transfer_img_prew">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <form action="{{url('/cart')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="payment_method" id="field_payment_method_id">
                                <input type="file" name="payment_method_transfer_file" id="payment_method_transfer_file" accept="image/*" style="display: none">
                                <div class="panel">
                                    <div class="header">
                                        <h2 class="title"><i class="fa-solid fa-map-location-dot"></i> 
                                        Tipo de orden</h2>
                                    </div>
                                    <div class="inside">
                                        <div class="mdswitch">
                                            <a href="{{url('/cart/'.$order->id.'/type/0')}}" class="sl @if($order->o_type == "0") active @endif">
                                                <i class="fa-solid fa-truck"></i> Domicilio
                                            </a>
                                            @if(config('cms.to_go') == "1")
                                            <a href="{{url('/cart/'.$order->id.'/type/1')}}" class="sl @if($order->o_type == "1") active @endif">
                                                <i class="fa-solid fa-shop"></i> En tienda
                                            </a>
                                            @endif
                                        </div>
                                        @if($order->o_type == "0")
                                            @if(!is_null(Auth::user()->getAddressDefault))
                                                <p>
                                                    {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'street') }} 
                                                    {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'numex') }} 
                                                    {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'col') }}
                                                    <br>
                                                    CP {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'cpostal') }} - 
                                                    {{ Auth::user()->getAddressDefault->getCity->name }} - 
                                                    {{ Auth::user()->getAddressDefault->getState->name }}
                                                    <br>
                                                    {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'name') }}
                                                    <br> 
                                                    {{ kvfj(Auth::user()->getAddressDefault->addr_info, 'phone') }}
                                                </p>
                                                <a href="{{url('/account/address')}}" class="btn btn-dark">Cambiar dirección</a>
                                            @else
                                                <p>No tiene direcciones registradas</p>
                                                <a href="{{url('/account/address')}}" class="btn btn-dark">Agregar dirección</a>
                                            @endif
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
                                            @if(config('cms.payment_method_cash') == "1")
                                                <a href="#" class="btn_payment_method w-100" id="payment_method_cash" 
                                                data-payment-method-id="0">
                                                    <i class="fa-solid fa-cash-register"></i> Pagar en efectivo
                                                </a>
                                            @endif
                                            @if(config('cms.payment_method_transfer') == "1")
                                                <a href="#" class="btn_payment_method w-100" id="payment_method_transfer" 
                                                data-payment-method-id="1">
                                                    <i class="fa-solid fa-money-bill-transfer"></i> Transferencia o deposito
                                                </a>
                                            @endif
                                            @if(config('cms.payment_method_paypal') == "1")
                                                <a href="#" class="btn_payment_method w-100" id="payment_method_paypal" 
                                                data-payment-method-id="2">
                                                    <i class="fa-brands fa-paypal"></i> Paypal
                                                </a>
                                            @endif
                                            @if(config('cms.payment_method_credit_card') == "1")
                                                <a href="#" class="btn_payment_method w-100" id="payment_method_credit_card" 
                                                data-payment-method-id="3">
                                                    <i class="fa-solid fa-credit-card"></i> Tarjeta de crédito
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="panel mtop16">
                                    <div class="header">
                                        <h2 class="title"><i class="fa-regular fa-envelope-open"></i> Más</h2>
                                    </div>
                                    <div class="inside">
                                        <label for="order_msg">Enviar Comentario:</label>
                                        <textarea name="order_msg" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                @if(!is_null(Auth::user()->getAddressDefault))
                                <div class="panel mtop16">
                                    <div class="inside">
                                        <input type="submit" value="Continuar compra" class="btn btn-success w-100 disabled"
                                        id="pay_btn_complete">
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection