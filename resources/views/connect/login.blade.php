@extends('connect.master')
@section('title', 'Inicio de sesión')

@section('content')
<div class="body">
    <div class="box box_login shadow">
        <h4 class="card-title mb-4">Inicio de sesión</h4>
        <form action="" method="POST">
            @csrf
            <label for="exampleInputPassword1" class="form-label">Correo electrónico</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-envelope"></i></span>
                <input type="email" class="form-control" name="email">
            </div>
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div id="NoCount" class="form-text"><a href="{{ url('/recover') }}" class="float-right">¿Olvidaste tu contraseña?</a></div>
            <button type="submit" class="btn btn-primary">Iniciar</button>
            <div id="NoCount" class="form-text">¿No tienes una cuenta? <a href="{{ url('/register') }}">Registrate</a></div>
        </form>

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
        
    </div>
</div>
@endsection