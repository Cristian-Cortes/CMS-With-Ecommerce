@extends('admin.master')
@section('title', 'Editar Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/0') }}"><i class="fa-solid fa-folder-open"></i> Categorias</a>
    </li>
    @if($cat->parent != "0")
        <li class="breadcrumb-item">
            <a href="{{ url('/admin/category/'.$cat->parent.'/subs') }}"><i class="fa-solid fa-folder-open"></i> {{$cat->getParent->name}}</a>
        </li>
    @endif
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}"><i class="fa-solid fa-pen-to-square"></i> Editando: {{$cat->name}}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Editar categoria</a></h2>
                    </div>
                    <div class="inside">
                        <form action="{{ url('/admin/category/'.$cat->id.'/edit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="name" class="form-control" value="{{$cat->name}}">
                            </div>
                            <label for="icon" class="mtop16">Ícono:</label>
                            <input type="file" class="form-control" name="icon" accept="image/*">

                            <label for="order" class="mtop16">Orden:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="order" class="form-control" value="{{$cat->order}}">
                            </div>
                            <button type="submit" class="btn btn-success mtop16">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            @if(!is_null($cat->icon))
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Icono</a></h2>
                    </div>
                    <div class="inside">
                        <img src="{{ getUrlFileFromUploads($cat->icon) }}" class="img-fluid">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection