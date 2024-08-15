@extends('master')
@section('title', 'Inicio')

@section('content')
    <section>
        <div class="home_action_bar shadow">
            <div class="row">
                <div class="col-md-2">
                    <div class="categories">
                        <a href="#"><i class="fa-solid fa-bars-staggered"></i> Categorias</a>
                        <ul class="shadow">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ url('/store/category/'.$category->id.'/'.$category->slug) }}">
                                    <img src="{{ getUrlFileFromUploads($category->icon) }}" alt="{{ $category->name }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
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
    </section>
    <section>
        @include('components/slider_home')
    </section>
    <section>
        <h2 class="home_title mtop32">Productos Destacados</h2>
        <div id="products_list" class="products_list"></div>
        <!--<div class="load_more_products">
            <a href="#" id="load_more_products">Mostrar mas</a>
        </div>-->
    </section>
@endsection