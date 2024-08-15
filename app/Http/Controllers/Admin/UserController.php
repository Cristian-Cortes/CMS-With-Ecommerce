<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
        $this -> middleware('isadmin');
        $this -> middleware('user.status');
        $this -> middleware('user.permissions');
    }

    public function getUsers($status)
    {
        if($status == 'all'){
            $users = User::orderBy('id', 'Desc')->paginate(25);
        }else{
            $users = User::where('status', $status)->orderBy('id', 'Desc')->paginate(25);
        }
        $data = ['users' => $users];
        return view('admin.users.home', $data);
    }

    public function getUsersView($id)
    {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.users_view', $data);
    }

    public function postUsersEdit($id, Request $request)
    {
        $u = User::findOrFail($id);
        $u->role = $request->input('user_type');
        if($request->input('user_type') == "1"):
            if(is_null($u->permissions)):
                $permissions = [
                    'dashboard' => true
                ];
                $permissions = json_encode($permissions);
                $u->permissions = $permissions;
            endif;
        else:
            $u->permissions = null;
        endif;
        if($u->save()):
            if($request->input('user_type') == "1"):
                return redirect('/admin/users/'.$u->id.'/permissions')->with('message', 'El rango del usuario, se actualizó con éxito.')->with('typealert', 'success');
            else:
                return back()->with('message', 'El rango del usuario, se actualizó con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getUsersBanned($id)
    {
        $u = User::findOrFail($id);
        if($u->status == "100"){
            $u->status = "0";
            $msg = "Usuario activado con éxito.";
        }else{
            $u->status = "100";
            $msg = "Usuario suspendido con éxito.";
        }
        if($u->save()):
            return back()->with('message', $msg)->with('typealert', 'success');
        endif;
    }

    public function getUsersPermissions($id)
    {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.permissions', $data);
    }

    public function postUsersPermissions($id, Request $request)
    {
        $u = User::findOrFail($id);
        $u->permissions = $request->except(['_token']);
        if($u->save()):
            return back()->with('message', 'Los permisos del usuario fueron actualizados con éxito.')->with('typealert', 'success');
        endif;
    }
}
