@extends('admin.master')
@section('title', 'Cobertura de envíos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage') }}"><i class="fas fa-shipping-fast"></i> Cobertura de envíos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage/'.$state->id.'/cities') }}"><i class="fas fa-shipping-fast"></i> Ciudades de: {{ $state->name }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @if(kvfj(Auth::user()->permissions, 'coverage_add'))
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-plus"></i> Nueva Ciudad</a></h2>
                    </div>
                    <div class="inside">
                        <form action="{{ url('/admin/coverage/city/add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="state_id" value="{{$id}}">
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <label for="shipping_value" class="mtop16">Valor del envío:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="shipping_value" class="form-control"
                                value="{{Config::get('cms.shipping_default_value')}}" min="0" step="any">
                            </div>
                            <label for="days" class="mtop16">Días estimados de entrega:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="days" class="form-control"
                                value="0" min="0" step="any">
                            </div>
                            <button type="submit" class="btn btn-success mtop16">Guardar</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-shipping-fast"></i> Ciudades de: {{$state->name}}</h2>
                    </div>
                    <div class="inside">
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td><strong>Estatus</strong></td>
                                    <td><strong>Ciudad</strong></td>
                                    <td><strong>Valor del envío</strong></td>
                                    <td><strong>Entrega estimada</strong></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $city)
                                    <tr>
                                        <td>{{ getCoverageStatus($city->status) }}</td>
                                        <td>{{ $city->name }}</td>
                                        <td>{{ Config::get('cms.currency') }} {{ $city->price }}</td>
                                        <td>{{ $city->days }} dias</td>
                                        <td>
                                            <div class="opts">
                                                @if(kvfj(Auth::user()->permissions, 'coverage_edit'))
                                                <a href="{{ url('/admin/coverage/city/'.$city->id.'/edit') }}" class="edit"
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                @endif
                                                @if(kvfj(Auth::user()->permissions, 'coverage_delete'))
                                                <a href="{{ url('/admin/coverage/'.$city->id.'/delete') }}" data-object="{{ $city->id }}"
                                                    data-path="admin/coverage" data-action="delete"
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar"
                                                    class="btn-delete deleted">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection