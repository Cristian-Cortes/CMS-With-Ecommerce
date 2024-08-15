<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ url('/static/img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <title>@yield('title') | {{Config::get('cms.name')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/static/css/admin.css?v='.time()) }}">
    <link rel="stylesheet" href="{{ url('/static/css/ccalert.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
    <script src="https://kit.fontawesome.com/3f9fb16a58.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('/static/js/ccalert.js') }}"></script>
    <script src="{{ url('/static/js/admin.js?v='.time()) }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
</head>
<body>
    <div class="ccalert" id="cc_alert_dom">
        <div class="ccalert_inside" id="ccalert_inside">
            <div class="ccalert_content" id="ccalert_content"></div>
            <div class="ccalert_footer" id="ccalert_footer">
                <div class="ccalert_footer_other_btns" id="ccalert_footer_other_btns"></div>
                <a href="#" class="ccalert_btn_close" id="ccalert_btn_close">CERRAR</a>
            </div>
        </div>
    </div>
    
    <div class="wrapper">
        <div class="col1">@include('admin.sidebar')</div>
        <div class="col2">
            <nav class="navbar navbar-expand-lg shadow">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}" class="nav-link">
                                <i class="fa-solid fa-house-chimney"></i> Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="page">
                
                <div class="container-fluid">
                    <nav aria-label="breadcrumb shadow">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin') }}"><i class="fa-solid fa-house-chimney"></i> Dashboard</a>
                            </li>
                            @section('breadcrumb')                
                            @show
                        </ol>
                    </nav>
                </div>

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

                @section('content')
                @show
            </div>
        </div>
    </div>
</body>
</html>