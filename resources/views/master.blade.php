<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ url('/static/img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <title>@yield('title') | {{Config::get('cms.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <meta name="currency" content="{{ Config::get('cms.currency') }}">
    <meta name="auth" content="{{ Auth::check() }}">

    @yield('custom_meta')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="{{ url('/static/css/style.css?v='.time()) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
    <script src="https://kit.fontawesome.com/3f9fb16a58.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ url('/static/js/hmslider.js?v='.time()) }}"></script>
    <script src="{{ url('/static/js/site.js?v='.time()) }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
</head>
<body>
    <div class="loader" id="loader">
        <div class="box">
            <div class="car">
                <img src="{{ url('/static/img/loading_car.png') }}">
            </div>
            <div class="load">
                <div class="spinner-border text-warning" role="status">
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/static/img/hm_logo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navigationMain" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigationMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link lk-home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/store') }}" class="nav-link lk-store lk-store_category lk-get_product lk-search">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/cart') }}" class="nav-link lk-cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="carnumber">0</span>
                        </a>
                    </li>
                    @if(Auth::guest())
                    <li class="nav-item link-acc">
                        <div class="widget-header icontext">
                            <a href="{{ url('/login') }}" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                            <div class="text">
                                <span class="text-muted">¡Bienvenido!</span>
                                <div> 
                                    <a href="{{ url('/login') }}" class="ti">Iniciar sesión</a> |  
                                    <a href="{{ url('/register') }}" class="ti"> Registro</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @else
                    <li class="nav-item link-acc link-user dropdown">
                        <div class="widget-header icontext">
                            <a href="#" class="icon icon-sm rounded-circle border">
                                @if(is_null(Auth::user()->avatar))
                                    <img src="{{ url('/static/img/default_avatar.jpg') }}">
                                @else
                                    <img src="{{ getUrlFileFromUploads(Auth::user()->avatar, '64x64') }}" class="circule">  
                                @endif 
                            </a>
                            <div class="text">
                                <span class="text-muted">¡Bienvenido!</span>
                                <div> 
                                    <a href="{{ url('/login') }}" class="ti dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                        {{Auth::user()->name}} {{Auth::user()->lastname}}
                                    </a>
                                    <ul class="dropdown-menu shadow">
                                        @if(Auth::user()->role == "1")
                                        <li><a class="dropdown-item" href="{{ url('/admin') }}">
                                            <i class="fa-solid fa-chalkboard-user"></i> Administración
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        @endif
                                        <li><a class="dropdown-item" href="{{ url('/account/history/orders') }}">
                                            <i class="fa-solid fa-bag-shopping"></i> Mis compras
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('/account/address') }}">
                                            <i class="fa-solid fa-location-dot"></i> Direcciones
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('/account/favorites') }}">
                                            <i class="fa-solid fa-heart"></i> Favoritos
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('/account/edit') }}">
                                                <i class="fa-solid fa-address-card"></i> Mi perfil
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('/logout') }}">
                                            <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @if (Session::has('message'))
        <div class="container mtop16">
            <div class="alert alert-{{ Session::get('typealert') }}" style="display:none;">
                {{Session::get('message')}}
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                         @endforeach
                    </ul>
                @endif
                <script>
                    $('.alert').slideDown();
                    setTimeout(function(){ $('.alert').slideUp(); }, 10000);
                </script>
            </div>
        </div>
    @endif
    <div class="wrapper">
        <div class="container">
            @section('content')
            @show
        </div>
    </div>
</body>
</html>