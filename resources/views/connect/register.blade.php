@extends('connect.master')
@section('title', 'Registro')

@section('content')
<div class="body">
    <div class="box box_register shadow">
        <h4 class="card-title mb-4">Registrarse</h4>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <label for="exampleInputPassword1" class="form-label">Nombre</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" name="name">
            </div>
            <label for="exampleInputPassword1" class="form-label">Apellido</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-user"></i></span>
                <input type="text" class="form-control" name="lastname">
            </div>
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
            <label for="exampleInputPassword1" class="form-label">Confirmar Contraseña</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                <input type="password" class="form-control" id="exampleInputPassword1" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
            <div id="NoCount" class="form-text">¿Ya tienes una cuenta? <a href="{{ url('/login') }}">Ingresar</a></div>
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