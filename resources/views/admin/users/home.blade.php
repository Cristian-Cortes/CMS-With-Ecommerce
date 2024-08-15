@extends('admin.master')
@section('title', 'Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users/all') }}"><i class="fa-solid fa-user-group"></i> Usuarios</a></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fa-solid fa-user-group"></i> Usuarios</a></h2>
            </div>
            <div class="inside">
                <div class="row">
                    <div class="col-md-2 offset-md-10">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                                <i class="fa-solid fa-filter"></i> Filtrar
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/admin/users/all') }}"><i class="fa-solid fa-bars-staggered"></i> Todos</a></li>
                                <li><a class="dropdown-item" href="{{ url('/admin/users/0') }}"><i class="fa-solid fa-link-slash"></i> No verificados</a></li>
                                <li><a class="dropdown-item" href="{{ url('/admin/users/1') }}"><i class="fa-solid fa-user-check"></i> Verificados</a></li>
                                <li><a class="dropdown-item" href="{{ url('/admin/users/100') }}"><i class="fa-solid fa-heart-crack"></i> Suspendidos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="table mtop16">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td></td>
                            <td>Nombre</td>
                            <td>Apellido</td>
                            <td>Emial</td>
                            <td>Estado</td>
                            <td>Role</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user -> id }}</td>
                                <td width="48">
                                    @if (is_null($user->avatar))
                                        <img src="{{ url('/static/img/default_avatar.jpg') }}" class="img-fluid rounded-circle">
                                    @else
                                        <img src="{{ getUrlFileFromUploads($user->avatar) }}" class="img-fluid rounded-circle">
                                    @endif
                                </td>
                                <td>{{ $user -> name }}</td>
                                <td>{{ $user -> lastname }}</td>
                                <td>{{ $user -> email }}</td>
                                <td>{{  getUserStatusArray(null, $user->status) }}</td>
                                <td>{{  getRoleUserArray(null, $user->role) }}</td>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'users_view'))
                                        <a href="{{ url('/admin/users/'.$user->id.'/view') }}" class="edit"
                                            data-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver perfil">
                                            <i class="fa-solid fa-id-card-clip"></i>
                                        </a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'users_permissions'))
                                        <a href="{{ url('/admin/users/'.$user->id.'/permissions') }}" class="inventory"
                                            data-toggle="tooltip" data-bs-placement="top" data-bs-title="Permisos de usuario">
                                            <i class="fa-solid fa-user-gear"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="8">{!! $users->render() !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection