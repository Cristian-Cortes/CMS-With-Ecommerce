@extends('admin.master')
@section('title', 'Agregar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/1') }}"><i class="fa-solid fa-boxes-stacked"></i> Productos</a></a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/add') }}"><i class="fa-solid fa-plus"></i> Agregar Producto</a></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fa-solid fa-plus"></i> Agregar Producto</a></h2>
            </div>
            <div class="inside">
                <form action="{{ url('/admin/products/add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Nombre del producto:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mtop16">
                        <div class="col-md-6">
                            <label for="category">Categoría:</label>
                            <select class="form-select" name="category" id="category">
                                @foreach($cats as $opt => $val) 
                                    <option value="{{ $opt }}" {{ (old("category") == $opt ? "selected":"") }}>{{ $val }}</option>
                                @endforeach
                                <input type="hidden" name="subcategory_actual" value="0" id="subcategory_actual">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="subcategory">Subcategoría:</label>
                            <select class="form-select" name="subcategory" id="subcategory">
                                @foreach($cats as $opt => $val) 
                                    <option value="" {{ ($opt == [] ? "selected":"") }}>{{ null }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mtop16">
                        <div class="col-md-3">
                            <label for="indiscount">¿En descuento?</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
                                <select class="form-select" name="indiscount">
                                    <option value="0" {{ old('indiscount') == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('indiscount') == 1 ? 'selected' : '' }}>Si</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="discount">Descuento:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-percent"></i></span>
                                <input type="number" name="discount" class="form-control" min="0.00" step="any"
                                value="{{ old('discount') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="code">Codígo de sistema:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="img">Imagen destacada:</label>
                            <input type="file" class="form-control" name="img" accept="image/*">
                        </div>
                    </div>
                    <div class="row mtop16">
                        <div class="col-md-12">
                            <label for="content">Descripcíon:</label>
                            <textarea name="content" id="editor" class="form-control" cols="30" rows="10">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="row mtop16">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection