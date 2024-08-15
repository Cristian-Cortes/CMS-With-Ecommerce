@extends('admin.master')
@section('title', 'Editar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/1') }}"><i class="fa-solid fa-boxes-stacked"></i> Productos</a></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Editar Producto</a></h2>
                    </div>
                    <div class="inside">
                        <form action="{{ url('/admin/products/'.$p->id.'/edit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Nombre del producto:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                        <input type="text" name="name" class="form-control" value="{{ $p->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mtop16">
                                <div class="col-md-6">
                                    <label for="category">Categoría padre:</label>
                                    <select class="form-select" name="category" id="category">
                                        @foreach($cats as $opt => $val) 
                                            <option value="{{ $opt }}" {{ ($p->category_id == $opt ? "selected":"") }}>{{ $val }}</option>
                                        @endforeach
                                        <input type="hidden" name="subcategory_actual" value="{{ $p->subcategory_id }}" id="subcategory_actual">
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="subcategory">Subcategoría:</label>
                                    <select class="form-select" name="subcategory" id="subcategory">
                                        @foreach($cats as $opt => $val) 
                                            <option value="" {{ ($p->category_id == [] ? "selected":"") }}>{{ $p->category_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="price">¿En descuento?</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
                                        <select class="form-select" name="indiscount">
                                            <option value="0" {{ $p->in_discount == 0 ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ $p->in_discount == 1 ? 'selected' : '' }}>Si</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="price">Descuento:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-percent"></i></span>
                                        <input type="number" name="discount" class="form-control" min="0.00" step="any"
                                        value="{{ $p->discount }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="discount_until_date">Fecha limite del descuento:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-percent"></i></span>
                                        <input type="date" name="discount_until_date" class="form-control" value="{{ $p->discount_until_date }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Imagen destacada:</label>
                                    <input type="file" class="form-control" name="img" accept="image/*">
                                </div>
                            </div>
                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="code">Codígo de sistema:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-barcode"></i></span>
                                        <input type="text" name="code" class="form-control" value="{{ $p->code }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="price">Estado</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
                                        <select class="form-select" name="status">
                                            <option value="0" {{ $p->status == 0 ? 'selected' : '' }}>Borrado</option>
                                            <option value="1" {{ $p->status == 1 ? 'selected' : '' }}>Publico</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mtop16">
                                <div class="col-md-12">
                                    <label for="content">Descripcíon:</label>
                                    <textarea name="content" id="editor" class="form-control" cols="30" rows="10">{!!$p->content!!}</textarea>
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
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-image"></i> Imagen destacada</a></h2>
                        <div class="inside">
                            <img src="{{ getUrlFileFromUploads($p->image) }}" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="panel shadow mtop16">
                    <div class="header">
                        <h2 class="title"><i class="fa-regular fa-images"></i> Galeria</a></h2>
                    </div>
                    <div class="inside product_gallery">
                        @if(kvfj(Auth::user()->permissions, 'products_gallery_add'))
                        <form action="{{ url('/admin/products/'.$p->id.'/gallery/add') }}" method="POST" 
                            enctype="multipart/form-data" id="form_product_gallery">
                            @csrf
                            <input type="file" id="product_file_image" name="file_image" accept="image/*" 
                            style="display: none;" required>
                        </form>
                        <div class="btn_submit">
                            <a href="#" id="btn_product_file_image"><i class="fa-solid fa-plus"></i></a>
                        </div>
                        @endif
                        <div class="tumbs">
                            @foreach ($p->getGallery as $img)
                                <div class="tumb">
                                    @if(kvfj(Auth::user()->permissions, 'products_gallery_deleted'))
                                    <a href="{{ url('/admin/products/'.$p->id.'/gallery/'.$img->id.'/delete') }}"
                                        data-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                    @endif
                                    <img src="{{ getUrlFileFromUploads($img->file_name) }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection