@extends('master')
@section('title', $product->name)

@section('custom_meta')
    <meta name="product_id" content="{{ $product->id }}">
@stop

@section('content')
    <div class="product_single shadow-lg">
        <div class="inside">
            <div class="container">
                <div class="row">
                    <!--Featured Img & Gallery-->
                    <div class="col-md-4 pleft0">
                        <div class="slick-slider">
                            <div>
                                <a href="{{ getUrlFileFromUploads($product->image) }}" data-fancybox="gallery">
                                    <img src="{{ getUrlFileFromUploads($product->image) }}" class="img-fluid">
                                </a>
                            </div>
                            @if(count($product->getGallery) > 0)
                                @foreach ($product->getGallery as $gallery)
                                    <div>
                                        <a href="{{ getUrlFileFromUploads($gallery->file_name) }}" data-fancybox="gallery">
                                            <img src="{{ getUrlFileFromUploads($gallery->file_name) }}" class="img-fluid">
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h2 class="title">{{ $product->name }}</h2>
                        <div class="category">
                            <ul>
                                <li><a href="{{url('/')}}"><i class="fa-solid fa-house-user"></i> Inicio</a></li>
                                <li><span class="next"><i class="fa-solid fa-chevron-right"></i></span></li>
                                <li><a href="{{url('/store')}}"><i class="fa-solid fa-store"></i> Tienda</a></li>
                                <li><span class="next"><i class="fa-solid fa-chevron-right"></i></span></li>
                                <li><a href="{{url('/store')}}"><i class="fa-solid fa-folder"></i> {{ $product->cat->name }}</a></li>
                                @if($product->subcategory_id != "0")
                                <li><span class="next"><i class="fa-solid fa-chevron-right"></i></span></li>
                                <li><a href="{{url('/store')}}"><i class="fa-regular fa-folder-open"></i> {{$product->getSubcategory->name}}</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="add_cart">
                            <form action="{{ url('/cart/product/'.$product->id.'/add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="inventory" id="field_inventory">
                                <input type="hidden" name="variant" id="field_variant">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="variants">
                                            <p><strong>Opciones del producto:</strong></p>
                                            <ul id="inventory">
                                                @foreach ($product->getInventory as $inventory)
                                                    <li><a href="#" class="inventory" id="inventory_{{ $inventory->id }}" data-inventory-id="{{ $inventory->id }}">
                                                        {{ $inventory->name }} - 
                                                        <span class="price">{{ Config::get('cms.currency') }}{{ number_format($inventory->price, 2,'.',',') }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="variants hidden btop1 ptop16 mtop16" id="variants_div">
                                            <p><strong>Variaciones del producto:</strong></p>
                                            <ul id="variants">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="before_quantity">
                                    <h5 class="title">Cantidad de elementos a agregar</h5>
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="quantity">
                                                <a href="#" class="amount_action" data-action="minus">
                                                    <i class="fa-solid fa-minus"></i>
                                                </a>
                                                <input type="number" name="quantity" value="1" id="add_to_cart_quantity" class="form-control"  max="{{$product->inventory}}">
                                                <a href="#" class="amount_action" data-action="plus">
                                                    <i class="fa-solid fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-cart-plus"></i> Agregar al carrito</button>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <a href="#" class="btn btn-favorite" id="favorite_1_{{ $product->id }}" onclick="add_to_favorites({{ $product->id }}, '1'); return false;">
                                                <i class="fa-solid fa-heart"></i> Agregar a favoritos
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="content">
                            {!! html_entity_decode($product->content) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection