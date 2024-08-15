@extends('admin.master')
@section('title', 'Inventario de Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/1') }}"><i class="fa-solid fa-boxes-stacked"></i> Productos</a></a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/'.$inventory->getProduct->id.'/edit') }}"><i class="fa-solid fa-boxes-stacked"></i> 
        {{ $inventory->getProduct->name }}</a></a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/'.$inventory->getProduct->id.'/inventory') }}"><i class="fa-solid fa-box"></i></i> 
        Inventario</a></a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/inventory/'.$inventory->id.'/edit') }}"><i class="fa-solid fa-box"></i></i> 
        {{ $inventory->name }}</a></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-box"></i> Editar inventario</a></h2>
                    </div>
                    <div class="inside">
                        <form action="{{ url('/admin/products/inventory/'.$inventory->id.'/edit') }}" method="POST">
                            @csrf
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="name" class="form-control" value="{{$inventory->name}}">
                            </div>
                            <label for="inventory" class="mtop16">Cantidad en inventario:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-cart-flatbed"></i></span>
                                <input type="number" name="inventory" class="form-control" value="{{$inventory->quantity}}" min="1">
                            </div>
                            <label for="price" class="mtop16">Precio:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">{{ config('cms.currency') }}</span>
                                <input type="number" name="price" class="form-control" value="{{$inventory->price}}" step="any">
                            </div>
                            <label for="limited" class="mtop16">Límite de inventario:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-warehouse"></i></span>
                                <select class="form-select" name="limited">
                                        <option value="{{$inventory->limited}}" selected>
                                            @if($inventory->limited == "0")
                                            Limitado
                                            @elseif($inventory->limited == "1")
                                            Ilimitado
                                            @endif
                                        </option>
                                        <option value="0">Limitado</option>
                                        <option value="1">Ilimitado</option>
                                </select>
                            </div>
                            <label for="minimum" class="mtop16">Inventario minimo:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-boxes-stacked"></i></span>
                                <input type="number" name="minimum" class="form-control" value="{{$inventory->minimum}}">
                            </div>
                            <button type="submit" class="btn btn-success mtop16">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-box"></i> Variantes</a></h2>
                    </div>
                    <div class="inside">
                        <form action="{{ url('/admin/products/inventory/'.$inventory->id.'/variant') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                        <input type="text" name="name" class="form-control" placeholder="Nombre de la variante">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" value="Guardar" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                        <hr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td width="30">ID</td>
                                    <td>Nombre</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventory->getVariants as $variant)
                                    <tr>
                                        <td>{{ $variant->id }}</td>
                                        <td>{{ $variant->name }}</td>
                                        <td>
                                            <div class="opts">
                                                <a href="" data-object="{{ $variant->id }}"
                                                    data-path="admin/products/variant" data-action="delete"
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar"
                                                    class="btn-delete deleted">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
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