@extends('admin.master')
@section('title', 'Cobertura de envíos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage') }}"><i class="fas fa-shipping-fast"></i> Cobertura de envíos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage/'.$coverage->state_id.'/cities') }}">
            <i class="fas fa-shipping-fast"></i> {{ $coverage->getState->name }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage/city/'.$coverage->id.'/edit') }}">
            <i class="fas fa-shipping-fast"></i> {{ $coverage->name }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @if(kvfj(Auth::user()->permissions, 'coverage_edit'))
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Editar ciudad de envío</a></h2>
                    </div>
                    <div class="inside">
                        <form action="{{ url('/admin/coverage/city/'.$coverage->id.'/edit') }}" method="POST">
                            @csrf
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="name" class="form-control" value="{{$coverage->name}}">
                            </div>
                            <label for="shipping_value" class="mtop16">Valor del envío:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="shipping_value" class="form-control"
                                value="{{$coverage->price}}" min="0" step="any">
                            </div>
                            <label for="status" class="mtop16">Estatus:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <select class="form-select" name="status">
                                    <option selected value="{{$coverage->status}}">
                                        {{getCoverageStatus($coverage->status)}}
                                    </option>
                                    @foreach (getCoverageStatus() as $val => $item)
                                        <option value="{{$val}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="days" class="mtop16">Días estimados de entrega:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="days" class="form-control"
                                value="{{$coverage->days}}" min="0" step="any">
                            </div>
                            <button type="submit" class="btn btn-success mtop16">Guardar</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-shipping-fast"></i> Información general</a></h2>
                    </div>
                    <div class="inside">
                        @if($coverage->ctype == "1")
                        <p><strong>Tipo:</strong> Ciudad</p>
                            <p><strong>Estado: </strong>{{$coverage->getState->name}}</p>
                            <p><strong>Nombre: </strong>{{$coverage->name}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection