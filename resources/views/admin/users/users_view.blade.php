@extends('admin.master')
@section('title', 'Editar Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users/all') }}"><i class="fa-solid fa-user-group"></i> Usuarios</a></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-user"></i> Información</a></h2>
                        </div>
                        <div class="inside">
                            <div class="mini_profile">
                                @if (is_null($u->avatar))
                                    <img src="{{ url('/static/img/default_avatar.jpg') }}" class="avatar">
                                @else
                                    <img src="{{ getUrlFileFromUploads($u->avatar) }}" class="avatar">
                                @endif
                                <div class="info">
                                    <span class="title"><i class="fa-regular fa-address-card"></i> Nombre:</span>
                                    <span class="text">{{  $u->name}} {{  $u->lastname}}</span>
                                    <span class="title"><i class="fa-solid fa-user-shield"></i> Estado del usuario:</span>
                                    <span class="text">{{  getUserStatusArray(null, $u->status) }}</span>
                                    <span class="title"><i class="fa-regular fa-envelope"></i> Correo electrónico:</span>
                                    <span class="text">{{  $u->email}}</span>
                                    <span class="title"><i class="fa-solid fa-calendar-days"></i> Fecha de registro:</span>
                                    <span class="text">{{  $u->created_at}}</span>
                                    <span class="title"><i class="fa-solid fa-user-tie"></i> Rol del usuario:</span>
                                    <span class="text">{{  getRoleUserArray(null, $u->role) }}</span>
                                </div>
                                @if(kvfj(Auth::user()->permissions, 'users_banned'))
                                    @if ($u->status == "100"):
                                        <a href="{{ url('/admin/users/'.$u->id.'/banned') }}" class="btn btn-success mtop16">Activar usuario</a>
                                    @else
                                        <a href="{{ url('/admin/users/'.$u->id.'/banned') }}" class="btn btn-danger mtop16">Suspender usuario</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-clipboard-list"></i> Historial de compras</a></h2>
                        </div>
                        <div class="inside">
                            <table class="table mtop16">
                                <thead>
                                    <tr>
                                        <td><strong>#</strong></td>
                                        <td><strong>Estado</strong></td>
                                        <td><strong>Tipo</strong></td>
                                        <td><strong>Fecha</strong></td>
                                        <td><strong>Total</strong></td>
                                        <td><strong></strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($u->getOrders as $order)
                                        <tr>
                                            <td>{{$order->o_number}}</td>
                                            <td>{{ getOrderStatus($order->status) }}</td>
                                            <td>{{getOrderType($order->o_type)}}</td>
                                            <td>{{$order->request_at}}</td>
                                            <td>{{number($order->total)}}</td>
                                            <td>
                                                @if(kvfj(Auth::user()->permissions, 'users_view'))
                                                <a href="{{ url('/admin/order/'.$order->id.'/view') }}" class="btn btn-primary btn-sm">Abrir</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>

                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-user-pen"></i> Editar Información</a></h2>
                        </div>
                        <div class="inside">
                            @if(kvfj(Auth::user()->permissions, 'users_edit'))
                                <form action="{{ url('/admin/users/'.$u->id.'/edit') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="module">Tipo de usuario:</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                                <select class="form-select" name="user_type">
                                                    <option selected value="{{$u->role}}">
                                                        @if($u->role == "0")Usuario normal @endif
                                                        @if($u->role == "1")Administrador @endif
                                                    </option>
                                                    @foreach(getRoleUserArray('list', null) as $opt => $val) 
                                                        <option value="{{$opt}}">{{ $val }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mtop16">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection