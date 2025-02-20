@extends('master')
@section('title', 'Búsqueda')

@section('content')
    <div class="store">
        <div class="row mtop32">
            <div class="col-md-3">
                <div class="categories_list shadow">
                    <h2 class="title"><i class="fas fa-stream"></i> CATEGORIAS</h2>
                    
                </div>
            </div>
            <div class="col-md-9">
                <div class="home_action_bar shadow nomargin">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ url('/search') }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input type="text" name="search_query" class="form-control" placeholder="¿Buscas algo?">
                                    <button class="btn" type="submit">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="store_white mtop32">
                    <section>
                        <h2 class="home_title "><i class="fa-solid fa-magnifying-glass"></i> Resultados de: {{ $query }}</h2>
                        <div id="products_list" class="products_list">
                            @foreach ($products as $product)
                                <div class="product">
                                    <div class="image">
                                        <div class="overlay">
                                            <div class="btns">
                                                <a href="{{ url('/products/'.$product->id.'/'.$product->slug) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa-solid fa-cart-plus"></i>
                                                </a>
                                                <!--@if(Auth::check())
                                                    <a href="#" id="favorite_1_{{ $product->id }}" 
                                                        onclick="add_to_favorites('{{ $product->id }}'); return false;">
                                                        <i class="fa-solid fa-heart"></i>
                                                    </a>
                                                @else 

                                                @endif-->
                                            </div>
                                        </div>
                                        <img src="{{ url('/uploads/'.$product->file_path.'/t_'.$product->image) }}" alt="">
                                    </div>
                                    <a href="{{ url('/products/'.$product->id.'/'.$product->slug) }}">
                                        <div class="title">{{ $product->name }}</div>
                                        <div class="price">{{ Config::get('hm.currency') }} {{ $product->price }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection