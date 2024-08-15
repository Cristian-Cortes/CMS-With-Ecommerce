@extends('emails.master')
@section('content')
    <p>Hola: <strong>{{$name}}</strong>,</p>
    <p>Has restablecido tu contraseña con éxito.</p>
    <p>Esta es tu nueva contraseña para tu cuenta:<h2>{{$password}}</h2></p>
    <p>Para iniciar sesión haga click en el siguiente botón.</p>
    <a href="{{ url('/login') }}" style="display:inline-block; background-color:#2caaff; color:#fff; 
    padding:12px; border-radius:4px; text-decoration:none;">Iniciar sesión</a>
    <p>O copie y pegue la siguiente URL en su navegador:</p>
    <p>{{ url('/login') }}</p>
    <p>Por seguridad, es importante que después de acceder cambie su contraseña por una propia dentro de nuestro sistema.</p>
    <p>Si no realizó esta solicitud, por favor verifique o cambie su contraseña.</p>
@endsection