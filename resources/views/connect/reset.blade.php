@extends('connect.master')
@section('title', 'Recuperar contraseña')

@section('content')
<div class="body">
    <div class="box box_login shadow">
        <h4 class="card-title mb-4">Recuperar contraseña</h4>
        <form action="{{ url('/reset') }}" method="POST">
            @csrf
            <label for="exampleInputPassword1" class="form-label">Correo electrónico</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-envelope"></i></span>
                <input type="email" class="form-control" name="email" value="{{$email}}">
            </div>
            <label for="code" class="form-label mtop16">Código de recuperación</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-envelope"></i></span>
                <input type="number" class="form-control" name="code">
            </div>
            <div id="NoCount" class="form-text"><a href="{{ url('/login') }}" class="float-right">Ingresar a mi cuenta</a></div>
            <button type="submit" class="btn btn-primary">Enviar</button>
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