@extends('master')
@section('title', 'Mis direcciones')

@section('content')
    <div class="row mtop32">
        <div class="col-md-5">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-location-dot"></i> Agrega un domicilio</h2>
                </div>
                <div class="inside">
                    <form action="{{ url('/account/address/add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <label for="name">Nombre y apellido de quien recibe</label>
                                <label for="name"><small>(Tal cual figure en el INE o IFE.)</small></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-8">
                                <label for="cpostal">Código postal</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="cpostal" class="form-control">
                                    <a href="#" class="cpostal form-control"><small>No sé mi código</small></a>
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-6">
                                <label for="state" class="mtop16">Estado</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <select class="form-select" name="state" id="state">
                                            @foreach ($states as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="mtop16">Ciudad/Municipio/Alcaldia</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <select class="form-select" name="city" id="address_city">
                                            <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-6">
                                <label for="col" class="mtop16">Colonia</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="col" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="street" class="mtop16">Calle</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="street" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-6">
                                <label for="numex" class="mtop16">Número exterior</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="numex" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="numin" class="mtop16">Nº interior/Depto (opcional)</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="numin" class="form-control">
                                </div>
                            </div>
                        </div>
                        <label class="mtop32">¿Entre qué calles está? (opcional)</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="street1" class="mtop16">Calle 1</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="street1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="street2" class="mtop16">Calle 2</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="street2" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="phone" class="mtop16">Teléfono de contacto</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="indications" class="mtop16">Indicaciones adicionales para las entregas en esta dirección</label>
                                <div class="input-group">
                                    <textarea name="indications" cols="60" class="dindi form-control" placeholder="Descripción de la fachada, puntos de referencia para encontrarla, indicaciones de seguridad, etc."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
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
        <div class="col-md-7">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-location-dot"></i> Mis direcciones</h2>
                </div>
                <div class="inside">
                    <table class="table">
                        <thead>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->getAddress as $address)
                                <tr>
                                    <td><i class="fa-solid fa-house icon_address"></i></td>
                                    <td><strong>{{ kvfj($address->addr_info, 'street') }} {{ kvfj($address->addr_info, 'numex') }} 
                                        {{ kvfj($address->addr_info, 'col') }}</strong><br>
                                        Código postal {{ kvfj($address->addr_info, 'cpostal') }} - {{ $address->getCity->name }}
                                        - {{ $address->getState->name }}<br>
                                        {{ kvfj($address->addr_info, 'name') }} - {{ kvfj($address->addr_info, 'phone') }}<br>
                                        <small>@if($address->default == "0") 
                                            <a href="{{url('/account/address/'.$address->id.'/setdefault')}}">Definir como principal</a>
                                        @endif
                                        @if($address->default == "1")Dirección Principal @endif
                                        </small>
                                    </td>
                                    <td>
                                        @if($address->default == "0")
                                        <a href="#" class="btn-delete btn-deleted"
                                        data-object="{{ $address->id }}"
                                        data-path="account/address" data-action="delete"
                                        data-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection