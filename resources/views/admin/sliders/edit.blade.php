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
            <div class="col-md-12">
                @if(kvfj(Auth::user()->permissions, 'sliders_edit'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Editar slider</a></h2>
                        </div>
                        <div class="inside">
                            <form action="{{ url('/admin/sliders/'.$slider->id.'/edit') }}" method="POST">
                                @csrf
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="text" name="name" class="form-control" value="{{$slider->name}}">
                                </div>
                                <label for="module" class="mtop16">Visible:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <select class="form-select" name="visible">
                                        <option value="{{$slider->status}}">
                                            @if($slider->status == "0") No visible @endif
                                            @if($slider->status == "1") Visible @endif
                                        </option>
                                        <option value="0">No visible</option>
                                        <option value="1">Visible</option>
                                    </select>
                                </div>
                                <label for="icon" class="mtop16">Imagen destacada:</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid">
                                    </div>
                                </div>

                                <label for="content" class="mtop16">Contenido:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <textarea name="content" cols="30" rows="3" class="form-control">
                                        {!! html_entity_decode($slider->content) !!}
                                    </textarea>
                                </div>
                                <label for="name" class="mtop16">Orden de aparición:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                    <input type="number" name="sorder" class="form-control" min="0" value="{{$slider->sorder}}">
                                </div>
                                <button type="submit" class="btn btn-success mtop16">Guardar</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection