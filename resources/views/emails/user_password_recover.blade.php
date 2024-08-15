@extends('emails.master')
@section('content')
    <p>Hola: <strong>{{$name}}</strong>,</p>
    <p>¿Problemas para entrar? Restablecer su contraseña es fácil.</p>
    <p>Simplemente presione el botón de abajo e ingrese el siguiente código:<h2>{{$code}}</h2></p>
    <a href="{{ url('/reset?email='.$email) }}" style="display:inline-block; background-color:#2caaff; color:#fff; 
    padding:12px; border-radius:4px; text-decoration:none;">Restablecer contraseña</a>
    <p>O copie y pegue la siguiente URL en su navegador:</p>
    <p>{{ url('/reset?email='.$email) }}</p>
    <p>Lo tendremos listo y funcionando en poco tiempo.</p>
    <p>Si no realizó esta solicitud, ignore este correo electrónico.</p>
@endsection