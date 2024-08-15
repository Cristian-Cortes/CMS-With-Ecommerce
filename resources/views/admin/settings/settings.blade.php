@extends('admin.master')
@section('title', 'Configuraciones')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/settings') }}"><i class="fa-solid fa-gears"></i> Configuraciones</a></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ url('/admin/settings') }}" method="POST">
            @csrf
            <div class="row mtop16">
                <div class="col-md-4 d-flex">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-gears"></i> General</a></h2>
                        </div>
                        <div class="inside">
                            <label for="name">Nombre del la empresa:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="name" class="form-control" value="{{Config::get('cms.name')}}">
                            </div>

                            <label for="website" class="mtop16">Sitio web:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="website" class="form-control" value="{{Config::get('cms.website')}}">
                            </div>

                            <label for="company_phone" class="mtop16">Teléfono:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="company_phone" class="form-control" value="{{Config::get('cms.company_phone')}}">
                            </div>

                            <label for="company_email" class="mtop16">Correo electrónico:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="email" name="company_email" class="form-control" value="{{Config::get('cms.company_email')}}">
                            </div>

                            <label for="map" class="mtop16">Ubicación:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="map" class="form-control" value="{{Config::get('cms.map')}}">
                            </div>

                            <label for="template" class="mtop16">Template</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                                <select class="form-select" name="template">
                                    @foreach (getTemplatesOfPlatform() as $val => $item)
                                        <option value="{{$val}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="maintenance_mode" class="mtop16">Modo mantenimiento</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                                <select class="form-select" name="maintenance_mode">
                                    <option value="{{Config::get('cms.maintenance_mode')}}">
                                        @if(Config::get('cms.maintenance_mode') == "0") Desactivado @endif
                                        @if(Config::get('cms.maintenance_mode') == "1") Activo @endif
                                    </option>
                                    @if(Config::get('cms.maintenance_mode') == "1")<option value="0">Desactivado</option>@endif
                                    @if(Config::get('cms.maintenance_mode') == "0")<option value="1">Activo</option>@endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-coins"></i> Moneda y precios</a></h2>
                        </div>
                        <div class="inside">
                            <label for="currency">Simbolo de moneda:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="currency" class="form-control" value="{{Config::get('cms.currency')}}">
                            </div>

                            <label for="shop_min_amount" class="mtop16">Monto mínimo de compra:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="shop_min_amount" class="form-control" value="{{Config::get('cms.shop_min_amount')}}" min="1">
                            </div>

                            <label for="shipping_method" class="mtop16">Configuración de precio de envío:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <select class="form-select" name="shipping_method">
                                    <option value="{{Config::get('cms.shipping_method')}}">
                                        @foreach (getShippingMethod() as $val => $item)
                                            @if(Config::get('cms.shipping_method') == $val) {{$item}} @endif
                                        @endforeach
                                    </option>
                                    @foreach (getShippingMethod() as $val => $item)
                                        @if(Config::get('cms.shipping_method') != $val)
                                            <option value="{{$val}}">{{$item}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <label for="shipping_default_value" class="mtop16">Valor del envío:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="shipping_default_value" class="form-control" value="{{Config::get('cms.shipping_default_value')}}" min="1">
                            </div>

                            <label for="shipping_amount_min" class="mtop16">Envió gratis, monto mínimo:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="shipping_amount_min" class="form-control" value="{{Config::get('cms.shipping_amount_min')}}" min="0">
                            </div>

                            <label for="to_go" class="mtop16">Recoger en tienda:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-shop"></i></span>
                                <select class="form-select" name="to_go">
                                    <option selected value="{{Config::get('cms.to_go')}}">
                                        @foreach (getEnableOrNot() as $val => $item)
                                            @if(Config::get('cms.to_go') == $val) {{$item}} @endif
                                        @endforeach
                                    </option>
                                    @foreach (getEnableOrNot() as $val => $item)
                                        @if(Config::get('cms.to_go') != $val)
                                            <option value="{{$val}}">{{$item}}</option>
                                        @endif
                                    @endforeach
                                </select>                           
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-globe"></i> Redes sociales</a></h2>
                        </div>
                        <div class="inside">
                            <label for="social_facebook">Facebook:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-brands fa-facebook"></i></span>
                                <input type="text" name="social_facebook" class="form-control" value="{{Config::get('cms.social_facebook')}}">
                            </div>

                            <label for="social_instagram" class="mtop16">Instagram:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-brands fa-instagram"></i></span>
                                <input type="text" name="social_instagram" class="form-control" value="{{Config::get('cms.social_instagram')}}">
                            </div>

                            <label for="social_twitter" class="mtop16">Twitter:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-brands fa-twitter"></i></span>
                                <input type="text" name="social_twitter" class="form-control" value="{{Config::get('cms.social_twitter')}}">
                            </div>

                            <label for="social_youtube" class="mtop16">Youtube:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-brands fa-youtube"></i></span>
                                <input type="tex" name="social_youtube" class="form-control" value="{{Config::get('cms.social_youtube')}}">
                            </div>

                            <label for="social_whatsapp" class="mtop16">Whatsapp:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-brands fa-whatsapp"></i></span>
                                <input type="text" name="social_whatsapp" class="form-control" value="{{Config::get('cms.social_whatsapp')}}">
                            </div>

                            <label for="social_tiktok" class="mtop16">Tiktok:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-brands fa-tiktok"></i></span>
                                <input type="text" name="social_tiktok" class="form-control" value="{{Config::get('cms.social_tiktok')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mtop16">
                <div class="col-md-4 d-flex">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-wallet"></i> Pagos / Integración</a></h2>
                        </div>
                        <div class="inside">
                            <label for="payment_method_cash">Pagos en efectivo:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-cash-register"></i></span>
                                <select class="form-select" name="payment_method_cash">
                                    <option selected value="{{Config::get('cms.payment_method_cash')}}">
                                        @foreach (getEnableOrNot() as $val => $item)
                                            @if(Config::get('cms.payment_method_cash') == $val) {{$item}} @endif
                                        @endforeach
                                    </option>
                                    @foreach (getEnableOrNot() as $val => $item)
                                        @if(Config::get('cms.payment_method_cash') != $val)
                                            <option value="{{$val}}">{{$item}}</option>
                                        @endif
                                    @endforeach
                                </select>                           
                            </div>

                            <label for="payment_method_transfer" class="mtop16">Tranferencia / Deposito bancario:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-money-bill-transfer"></i></span>
                                <select class="form-select" name="payment_method_transfer">
                                    <option selected value="{{Config::get('cms.payment_method_transfer')}}">
                                        @foreach (getEnableOrNot() as $val => $item)
                                            @if(Config::get('cms.payment_method_transfer') == $val) {{$item}} @endif
                                        @endforeach
                                    </option>
                                    @foreach (getEnableOrNot() as $val => $item)
                                        @if(Config::get('cms.payment_method_transfer') != $val)
                                            <option value="{{$val}}">{{$item}}</option>
                                        @endif
                                    @endforeach
                                </select>                           
                            </div> 

                            <label for="payment_method_transfer" class="mtop16">Cuentas bancarias:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-money-bill-transfer"></i></span>
                                <textarea name="payment_method_transfer_accounts_bank" class="form-control" value="{{Config::get('cms.payment_method_transfer_accounts_bank')}}" rows="3">{{ Config::get('cms.payment_method_transfer_accounts_bank') }}</textarea>                       
                            </div> 

                            <label for="payment_method_paypal" class="mtop16">Paypal:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-brands fa-paypal"></i></span>
                                <select class="form-select" name="payment_method_paypal">
                                    <option selected value="{{Config::get('cms.payment_method_paypal')}}">
                                        @foreach (getEnableOrNot() as $val => $item)
                                            @if(Config::get('cms.payment_method_paypal') == $val) {{$item}} @endif
                                        @endforeach
                                    </option>
                                    @foreach (getEnableOrNot() as $val => $item)
                                        @if(Config::get('cms.payment_method_paypal') != $val)
                                            <option value="{{$val}}">{{$item}}</option>
                                        @endif
                                    @endforeach
                                </select>                           
                            </div>
                            
                            <label for="payment_method_credit_card" class="mtop16">Tarjeta de crédito:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-credit-card"></i></span>
                                <select class="form-select" name="payment_method_credit_card">
                                    <option selected value="{{Config::get('cms.payment_method_credit_card')}}">
                                        @foreach (getEnableOrNot() as $val => $item)
                                            @if(Config::get('cms.payment_method_credit_card') == $val) {{$item}} @endif
                                        @endforeach
                                    </option>
                                    @foreach (getEnableOrNot() as $val => $item)
                                        @if(Config::get('cms.payment_method_credit_card') != $val)
                                            <option value="{{$val}}">{{$item}}</option>
                                        @endif
                                    @endforeach
                                </select>                           
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-file"></i> Paginación</a></h2>
                        </div>
                        <div class="inside">
                            <label for="products_per_page">Productos a mostrar por página:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="products_per_page" class="form-control" value="{{Config::get('cms.products_per_page')}}" min="1">
                            </div>

                            <label for="products_per_page_random" class="mtop16">Productos a mostrar por página (Aleatorios):</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="products_per_page_random" class="form-control" value="{{Config::get('cms.products_per_page_random')}}" min="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-brands fa-linux"></i> Servidor</a></h2>
                        </div>
                        <div class="inside">
                            <label for="server_uploads_path">Uploads server path:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="server_uploads_path" class="form-control" value="{{Config::get('cms.server_uploads_path')}}" min="1">
                            </div>

                            <label for="server_uploads_user_path" class="mtop16">Uploads server user path:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="server_uploads_user_path" class="form-control" value="{{Config::get('cms.server_uploads_user_path')}}" min="1">
                            </div>

                            <label for="server_webapp_path" class="mtop16">Webapp path:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="server_webapp_path" class="form-control" value="{{Config::get('cms.server_webapp_path')}}" min="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mtop16">
                <div class="col-md-12">
                    <div class="panel shadow">
                        <div class="inside">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection