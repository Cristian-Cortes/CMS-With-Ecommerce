@extends('master')
@section('title', 'Tienda - '.$category->name)

@section('custom_meta')
    <meta name="category_id" content="{{ $category->id }}">
@stop

@section('content')
    <div class="store">
        <div class="row mtop32">
            <div class="col-md-3">
                <div class="categories_list shadow">
                    <h2 class="title"><i class="fa-solid fa-bars-staggered"></i> {{strtoupper($category->name)}}</h2>
                    <ul>
                        @if($category->parent != "0")
                            <li><a href="{{ url('/store/category/'.$category->getParent->id.'/'.$category->getParent->slug) }}">
                                    <small><i class="fa-solid fa-chevron-left"></i> 
                                    Regresar a {{ $category->getParent->name }}</small>
                                </a>
                            </li>
                        @endif
                        @if($category->parent == "0")
                            <li><a href="{{ url('/store') }}">
                                    <small><i class="fa-solid fa-chevron-left"></i> 
                                    Regresar a la tienda</small>
                                </a>
                            </li>
                            <li><a href="{{ url('/store/category/'.$category->id.'/'.$category->slug) }}">
                                    <small><i class="fa-solid fa-caret-down"></i> Subcategorías </small>
                                </a>
                            </li>
                        @endif
                        @foreach ($categories as $cat)
                            <li>
                                <a href="{{ url('/store/category/'.$cat->id.'/'.$cat->slug) }}">
                                    <img src="{{ getUrlFileFromUploads($cat->icon) }}" alt="{{ $cat->name }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="store_white">
                    <section>
                        <h2 class="home_title "><i class="fas fa-store-alt"></i> {{ $category->name }}</h2>
                        <div id="products_list" class="products_list"></div>
                        <div class="load_more_products">
                            <a href="#" id="load_more_products"><i class="fa-regular fa-paper-plane"></i> Mostrar mas</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection