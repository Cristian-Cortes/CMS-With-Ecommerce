<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ url('/static/img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <title>@yield('title') | Herradura Mexicana</title>
    <link rel="stylesheet" href="{{ url('/static/css/connect.css?v='.time()) }}">
    <link rel="stylesheet" href="{{ url('/static/css/style.css?v='.time()) }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3f9fb16a58.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
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
                        <a href="{{ url('/') }}" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/store') }}" class="nav-link">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Contacto</a>
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
                                <img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}"> 
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
    @section('content')
    @show
    <footer class="section-footer border-top padding-y">
        <div class="container">
            <p class="float-md-right"> 
                &copy Copyright 2022 Todos los derechos reservados a Herradura Mexicana, Sombreros Actopan.
            </p>
            <p>
                <a href="terms_and_conditions.php">Terminos y condiciones</a>
            </p>
        </div>
    </footer>
</body>
</html>