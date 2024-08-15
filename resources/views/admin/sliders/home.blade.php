@extends('admin.master')
@section('title', 'Modulo de Sliders')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/sliders') }}"><i class="fa-regular fa-images"></i> Sliders</a></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @if(kvfj(Auth::user()->permissions, 'sliders_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-plus"></i> Agregar slide</a></h2>
                        </div>
                        <div class="inside">
                            <form action="{{ url('/admin/sliders/add') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <label for="module" class="mtop16">Visible:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <select class="form-select" name="visible">
                                        <option value="1">Visible</option>
                                        <option value="0">No visible</option>
                                    </select>
                                </div>
                                <label for="icon" class="mtop16">Imagen destacada:</label>
                                <input type="file" class="form-control" name="img" accept="image/*">

                                <label for="content" class="mtop16">Contenido:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <textarea name="content" id="" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                                <label for="name" class="mtop16">Orden de aparición:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="number" name="sorder" class="form-control" min="0" value="0">
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
                            <h2 class="title"><i class="fa-regular fa-images"></i> Sliders</a></h2>
                        </div>
                        <div class="inside">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td width="180">
                                                <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}"
                                                class="img-fluid">
                                            </td>
                                            <td>
                                                <div class="slider-content">
                                                    <h1>{{ $slider->name }}</h1>
                                                    {!! html_entity_decode($slider->content) !!}
                                                </div>
                                            </td>
                                            <td width="110">
                                                <div class="opts">
                                                    @if(kvfj(Auth::user()->permissions, 'sliders_edit'))
                                                    <a href="{{ url('/admin/sliders/'.$slider->id.'/edit') }}" class="edit"
                                                        data-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    @endif
                                                    @if(kvfj(Auth::user()->permissions, 'sliders_delete'))
                                                        <a href="#" data-object="{{ $slider->id }}" class="btn-delete deleted"
                                                            data-path="admin/sliders" data-action="delete"
                                                            data-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar"
                                                            class="btn-delete">
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