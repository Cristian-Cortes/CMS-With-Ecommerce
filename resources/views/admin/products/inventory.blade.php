@extends('admin.master')
@section('title', 'Inventario de Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/1') }}"><i class="fa-solid fa-boxes-stacked"></i> Productos</a></a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/'.$product->id.'/edit') }}"><i class="fa-solid fa-boxes-stacked"></i> 
        {{ $product->name }}</a></a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/'.$product->id.'/inventory') }}"><i class="fa-solid fa-box"></i></i> 
        Inventario</a></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-box"></i> Crear inventario</a></h2>
                    </div>
                    <div class="inside">
                        <form action="{{ url('/admin/products/'.$product->id.'/inventory') }}" method="POST">
                            @csrf
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <label for="inventory" class="mtop16">Cantidad en inventario:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-cart-flatbed"></i></span>
                                <input type="number" name="inventory" class="form-control" value="1" min="1">
                            </div>
                            <label for="price" class="mtop16">Precio:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">{{ config('cms.currency') }}</span>
                                <input type="number" name="price" class="form-control" value="1.00" step="any">
                            </div>
                            <label for="limited" class="mtop16">Límite de inventario:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-warehouse"></i></span>
                                <select class="form-select" name="limited">
                                        <option value="0">Limitado</option>
                                        <option value="1">Ilimitado</option>
                                </select>
                            </div>
                            <label for="minimum" class="mtop16">Inventario minimo:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-boxes-stacked"></i></span>
                                <input type="number" name="minimum" class="form-control" value="1">
                            </div>
                            <button type="submit" class="btn btn-success mtop16">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-box"></i> Inventarios</a></h2>
                    </div>
                    <div class="inside">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Existencias</td>
                                    <td>Minimo</td>
                                    <td>Precio</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->getInventory as $inventory)
                                    <tr>
                                        <td>{{ $inventory->id }}</td>
                                        <td>{{ $inventory->name }}</td>
                                        <td>
                                            @if($inventory->limited == "1")
                                                Ilimitada
                                            @else
                                                {{ $inventory->quantity }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($inventory->limited == "1")
                                                Ilimitada
                                            @else
                                                {{ $inventory->minimum }}
                                            @endif
                                        </td>
                                        <td>{{ config('cms.currency') }} {{ $inventory->price }}</td>
                                        <td width="160">
                                            <div class="opts">
                                                <a href="{{ url('/admin/products/inventory/'.$inventory->id.'/edit') }}" 
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar" class="edit">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                                <a href="" data-object="{{ $inventory->id }}"
                                                    data-path="admin/products/inventory" data-action="delete"
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