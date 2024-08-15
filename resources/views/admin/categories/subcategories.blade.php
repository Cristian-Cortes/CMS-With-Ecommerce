@extends('admin.master')
@section('title', 'Subcategorias')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/0') }}"><i class="fa-solid fa-folder-open"></i> Categorias</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/category/'.$category->id.'/subs') }}"><i class="fa-solid fa-folder-open"></i> Subcategorias: {{$category->name}}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!--Mostrar categories-->
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-folder-open"></i> Subcategorias de <strong>{{$category->name}}</strong></a></h2>
                    </div>
                    <div class="inside">
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td width="64"></td>
                                    <td>Nombre</td>
                                    <td width="140"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->getSubcategories as $cat)
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
                                                @endif
                                                @if(kvfj(Auth::user()->permissions, 'categories_deleted'))
                                                <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" class="btn-delete deleted"
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
        </div>
    </div>
@endsection