@extends('master')
@section('title', 'Mi perfil')

@section('content')
    <div class="row mtop32">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-regular fa-circle-user"></i> Editar avatar</h2>
                </div>
                <div class="inside">
                    <div class="edit_avatar">
                        <form action="{{ url('/account/edit/avatar')}}" method="POST" enctype="multipart/form-data" id="form_avatar_change">
                            @csrf
                            <a href="#" id="btn_avatar_edit">
                                <div class="overlay" id="avatar_change_overlay">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                                @if(is_null(Auth::user()->avatar))
                                    <img src="{{ url('/static/img/default_avatar.jpg') }}">
                                @else
                                    <img src="{{ getUrlFileFromUploads(Auth::user()->avatar) }}">
                                @endif 
                            </a>
                            <input type="file" name="avatar" id="input_file_avatar" class="form-control" accept="image/*">
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel shadow mtop32">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-lock"></i> Cambiar Contraseña</h2>
                </div>
                <div class="inside">
                    <form action="{{ url('/account/edit/password') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Contraseña actual:</label>
                                    <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="password" name="apassword" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="name">Actualizar contraseña:</label>
                                    <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="password" name="password" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="name">Confirmar contraseña:</label>
                                    <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="password" name="cpassword" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-address-card"></i> Informacion de usuario</h2>
                </div>
                <div class="inside">
                    <form action="{{ url('/account/edit/info') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="lastname">Apellido:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="lastname" class="form-control" value="{{Auth::user()->lastname}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Correo electrónico:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="mail" name="email" class="form-control" disabled readonly value="{{Auth::user()->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-4">
                                <label for="phone">Teléfono:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="number" name="phone" class="form-control" value="{{Auth::user()->phone}}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="year">Fecha de nacimiento: Año - Mes - Día</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="number" class="form-control" name="year" min="{{geyUserYears()[1]}}"
                                    max="{{geyUserYears()[0]}}" value="{{$birthday[0]}}">
                                    <select class="form-select" name="month">
                                        @foreach(getMonths('list', null) as $opt => $val) 
                                            <option value="{{$opt}}" {{ $birthday[1] == $opt ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" class="form-control" name="day" min="1"
                                    max="31" value="{{$birthday[2]}}">
                                </div>
                            </div>
                            <div class="row mtop16">
                                <div class="col-md-4">
                                    <label for="gender">Genero:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                        <select class="form-select" name="gender">
                                            <option value="@if(Auth::user()->gender) Auth::user()->gender @endif
                                                @if(Auth::user()->gender == null) 0 @endif
                                                ">
                                                @if(Auth::user()->gender == "0" || Auth::user()->gender == null) Sin especificar @endif
                                                @if(Auth::user()->gender == "1") Masculino @endif
                                                @if(Auth::user()->gender == "2") Femenino @endif
                                            </option>
                                                <option value="0">Sin especificar</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mtop16">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection