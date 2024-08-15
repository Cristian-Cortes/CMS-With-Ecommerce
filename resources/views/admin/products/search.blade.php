@extends('admin.master')
@section('title', 'productos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/1') }}"><i class="fa-solid fa-boxes-stacked"></i> Productos</a></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fa-solid fa-boxes-stacked"></i> Productos</a></h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'products_add'))
                        <li>
                            <a href="{{ url('/admin/products/add') }}">
                                <i class="fa-solid fa-plus"></i> Agregar Producto
                            </a>
                        </li>
                    @endif
                        <li>
                            <a href="#" class="dropdown">Filtrar <i class="fa-solid fa-chevron-down"></i></a>
                            <ul class="shadow">
                                <li><a href="{{ url('/admin/products/1')}}"><i class="fa-solid fa-earth-americas"></i> Públicos</a></li>
                                <li><a href="{{ url('/admin/products/0')}}"><i class="fa-solid fa-eraser"></i> Borradores</a></li>
                                <li><a href="{{ url('/admin/products/trash')}}"><i class="fa-regular fa-trash-can"></i> Papelera</a></li>
                                <li><a href="{{ url('/admin/products/all')}}"><i class="fa-solid fa-list-ul"></i> Todos</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" id="btn_search"><i class="fa-solid fa-magnifying-glass"></i> Buscar</a>
                        </li>
                </ul>
            </div>
            <div class="inside">
                <div class="form_search" id="form_search">
                    <form action="{{ url('/admin/products/search')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Ingrese su busqueda">
                            </div>
                            <div class="col-md-4">
                                <select name="filter" id="" class="form-select">
                                    <option value="0">Nombre del producto</option>
                                    <option value="1">Código</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="status" id="" class="form-select">
                                    <option value="0">Borrador</option>
                                    <option value="1">Público</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td></td>
                            <td>Nombre</td>
                            <td>Categoria</td>
                            <td>Precio</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td width="50">{{ $p->id }}</td>
                                <td width="64"> 
                                    <a href="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" data-fancybox="gallery">
                                        <img src="{{ url('/uploads/'.$p->file_path.'/t_'.$p->image) }}" width="64">
                                    </a> 
                                </td>
                                <td>{{ $p->name }}  @if ($p->status == "0") <i class="fa-solid fa-eraser"
                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Estado: Borrado"></i> @endif</td>
                                <td>{{ $p->cat->name }} @if($p->subcategory_id != "0")<i class="fa-solid fa-angles-right"></i> {{$p->getSubcategory->name}} @endif</td>
                                <td>{{ $p->price }}</td>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'products_edit'))
                                        <a href="{{ url('/admin/products/'.$p->id.'/edit') }}" 
                                            data-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'products_delete'))
                                        <a href="{{ url('/admin/products/'.$p->id.'/delete') }}"
                                            data-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar">
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
@endsection