@extends('emails.master')
@section('content')
    <p>Hola: <strong>{{$name}}</strong></p>
    <p>Hemos recibido una nueva orden y estos son los detalles de la compra:</p>
    <p>Numero de orden: <strong>{{$order->o_number}}</strong></p>
    <table class="table align-middle table-hover">
        <thead>
            <tr>
                <td width="80"></td>
                <td><strong>Producto</strong></td>
                <td width="160"><strong>Cantidad</strong></td>
                <td><strong>Subtotal</strong></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->getItems as $item)
            <tr>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    <img src="{{ getUrlFileFromUploads($item->getProduct->image) }}" style="width: 70px; border-radius: 4px;">
                </td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    <a href="{{ url('/products/'.$item->getProduct->id.'/'.$item->getProduct->slug) }}"
                        style="color: #333; text-decoration: none;">
                        {{ $item->label_item }}
                        <div class="price_discount" style="font-weight: 700;">
                            <small>
                                Precio:
                                @if($item->discount_status == "1")
                                <span class="price_initial">{{ number($item->price_initial) }}</span> / 
                                @endif
                                <span>
                                    {{ number($item->price_unit) }} 
                                    @if($item->discount_status == "1")
                                    ({{$item->discount}}% de descuento.)
                                    @endif
                                </span>
                            </small>
                        </div>
                    </a>
                </td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    {{$item->quantity}}
                </td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    <strong>{{ number($item->total) }}</strong>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;"></td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    <strong>Subtotal:</strong>
                </td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    <strong>{{ number($order->getSubtotal()) }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;"></td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    <strong>Envió:</strong>
                </td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    <strong>{{ number($order->delivery) }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;"></td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    <strong>Total:</strong>
                </td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    <strong>{{ number($order->total) }}</strong>
                </td>
            </tr>
        </tbody>
    </table>
    <p>Detalles de pago y envío:</p>
    <table class="table align-middle table-hover">
        <thead>
            <tr>
                <td width="80"></td>
                <td></td>
                <td width="160"></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;"></td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    @if (!is_null($order->user_address_id))
                        Envío a domicilio
                        <br>
                        {{kvfj($order->getUserAddress->addr_info, 'street')}} {{kvfj($order->getUserAddress->addr_info, 'numex')}}
                        - {{kvfj($order->getUserAddress->addr_info, 'col')}}, {{$order->getUserAddress->getCity->name}},
                        {{$order->getUserAddress->getState->name}} <br>
                        {{kvfj($order->getUserAddress->addr_info, 'name')}} - {{kvfj($order->getUserAddress->addr_info, 'phone')}}
                    @else
                        Recoger en tienda
                        <br>
                        {{config('cms.map')}}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;"></td>
                <td style="vertical-align: top; border-bottom: 1px solid #f0f0f0; padding: 4px 0px;">
                    Pago: {{ number($order->total) }} <br>con {{ getPaymentsMethods($order->payment_method) }}
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <p><strong><a href="{{url('/admin/order/'.$order->id.'/view')}}">Más detalles de la compra en el administrador.</a></strong></p>
@endsection