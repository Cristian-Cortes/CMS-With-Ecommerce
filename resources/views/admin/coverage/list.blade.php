@extends('admin.master')
@section('title', 'Cobertura de envíos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage') }}"><i class="fas fa-shipping-fast"></i> Cobertura de envíos</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @if(kvfj(Auth::user()->permissions, 'coverage_add'))
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-plus"></i> Nuevo Estado</a></h2>
                    </div>
                    <div class="inside">
                        <form action="{{ url('/admin/coverage/state/add/') }}" method="POST">
                            @csrf
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <label for="days" class="mtop16">Días estimados de entrega:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                <input type="number" name="days" class="form-control"
                                value="0" min="0" step="any">
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
                        <h2 class="title"><i class="fas fa-shipping-fast"></i> Listado de estados</i></h2>
                    </div>
                    <div class="inside">
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td><strong>Estatus</strong></td>
                                    <td><strong>Estado</strong></td>
                                    <td><strong>Entrega estimada</strong></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($states as $state)
                                    <tr>
                                        <td>{{ getCoverageStatus($state->status) }}</td>
                                        <td>{{ $state->name }}</td>
                                        <td>{{ $state->days }} dias</td>
                                        <td>
                                            <div class="opts">
                                                @if(kvfj(Auth::user()->permissions, 'coverage_edit'))
                                                <a href="{{ url('/admin/coverage/'.$state->id.'/edit') }}" class="edit"
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                @endif
                                                <a href="{{ url('/admin/coverage/'.$state->id.'/cities') }}" class="inventory"
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Ciudades">
                                                    <i class="fa-solid fa-list-ol"></i>
                                                </a>
                                                @if(kvfj(Auth::user()->permissions, 'coverage_delete'))
                                                <a href="{{ url('/admin/coverage/'.$state->id.'/delete') }}" data-object="{{ $state->id }}"
                                                    data-path="admin/coverage" data-action="delete"
                                                    data-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar"
                                                    class="btn-delete deleted">
                                                    <i class="fas fa-trash-alt"></i>
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