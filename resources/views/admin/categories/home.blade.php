@extends('admin.master')
@section('title', 'Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/0') }}"><i class="fa-solid fa-folder-open"></i> Categorias</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-plus"></i> Agregar categoría</a></h2>
                    </div>
                    <div class="inside">
                        @if(kvfj(Auth::user()->permissions, 'categories_add'))
                        <form action="{{ url('/admin/category/add/'.$module) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <label for="parent" class="mtop16">Categoría padre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <select class="form-select" name="parent">
                                    <option value="0">Sin categoría padre</option>
                                    @foreach($cats as $cat) 
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="module" class="mtop16">Módulo:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <select class="form-select" name="module" disabled readonly>
                                    @foreach(getModulesArray() as $opt => $val) 
                                        <option value="{{ $module }}">
                                            @if($module == 0) Productos @endif
                                            @if($module == 1) Blog @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="icon" class="mtop16">Ícono:</label>
                            <input type="file" class="form-control" name="icon" accept="image/*">
                            <button type="submit" class="btn btn-success mtop16">Guardar</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!--Mostrar categories-->
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-folder-open"></i> Categorias</a></h2>
                    </div>
                    <div class="inside">
                        <nav class="nav nav-pills ">
                            @foreach(getModulesArray() as $m => $k)
                                <a href="{{ url('/admin/categories/'.$m) }}" class="nav-link">
                                    <i class="fa-solid fa-clipboard-list"></i> {{ $k }}</a>
                            @endforeach
                        </nav>
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td width="64"></td>
                                    <td>Nombre</td>
                                    <td width="160"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cats as $cat)
                                    <tr>
                                        <td>
                                            @if(!is_null($cat->icon))
                                            <img src="{{ getUrlFileFromUploads($cat->icon) }}" class="img-fluid">
                                            @endif
                                        </td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            <div class="opts">
                                                @if(kvfj(Auth::user()->permissions, 'categories_edit'))
                                                <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" class="edit" 
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ url('/admin/category/'.$cat->id.'/subs') }}" class="inventory"
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Subcategorías">
                                                    <i class="fa-solid fa-list-ol"></i>
                                                </a>
                                                @endif
                                                @if(kvfj(Auth::user()->permissions, 'categories_deleted'))
                                                <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" class="btn-delete deleted" 
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar"
                                                    data-object="{{ $cat->id }}" data-path="admin/category" data-action="delete">
                                                    <i class="fa-solid fa-trash-can"></i>
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