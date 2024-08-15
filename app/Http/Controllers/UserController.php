<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Http\Models\Coverage;
use App\Http\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAccountEdit()
    {
        $birthday = (is_null(Auth::user()->birthday)) ? [null,null,null] : explode('-', Auth::user()->birthday);
        $data = ['birthday' => $birthday];
        return view('user.account_edit', $data);
    }

    public function postAccountAvatar(Request $request)
    {
        $rules = [
            'avatar' => 'required'
        ];
        $message = [
            'avatar.required' => 'Seleccione una imagen.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger')
            ->withInput();
        }else{
            if($request->hasFile('avatar')):

                $u = User::find(Auth::id());
                $u->avatar = $this->postFileUpload('avatar', $request, [[64, 64, '64x64'], [128, 128, '128x128'], [256, 256, '256x256']]);

                if($u->save()):
                    return back()->with('message', 'Imagen subida con éxito.')->with('typealert', 'success');
                endif;
            endif;
        }
    }

    public function postAccountPassword(Request $request)
    {
        $rules = [
            'apassword' => 'required|min:8',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];
        $message = [
            'apassword.required' => 'Ingrese su contraseña actual.',
            'apassword.min' => 'La contraseña actual debe contener al menos 8 caracteres.',
            'password.required' => 'Ingrese una nueva contraseña.',
            'password.min' => 'Su nueva contraseña debe contener al menos 8 caracteres.',
            'cpassword.required' => 'Confirme su nueva contraseña.',
            'cpassword.min' => 'La confirmación de su contraseña debe contener al menos 8 caracteres.',
            'cpassword.same' => 'La contraseñas no coinciden.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger')
            ->withInput();
        }else{
            $u = User::find(Auth::id());
            if(Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password'));
                if($u->save()):
                    return back()->with('message', 'La contraseña se actualizó con éxito.')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', 'Su contraseña actual es errónea.')->with('typealert', 'danger');
            endif;
        }
    }

    public function postAccountInfo(Request $request)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required ',
            'phone' => 'required|min:10',
            'year' => 'required ',
            'day' => 'required '
        ];
        $message = [
            'name.required' => 'Su nombre es requerido.',
            'lastname.required' => 'Su apellido es requerido.',
            'phone.required' => 'Su número de teléfono es requerido.',
            'phone.min' => 'Su número de teléfono debe contener 10 caracteres.',
            'year.required' => 'El año de nacimiento es requerido.',
            'day.required' => 'El día de nacimiento es requerido.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger')
            ->withInput();
        }else{
            $date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
            $u = User::find(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->birthday = date("Y-m-d",strtotime($date));
            $u->gender = e($request->input('gender'));
            if($u->save()):
                return back()->with('message', 'Su información se actualizó con éxito.')->with('typealert', 'success');
            endif;
        }
    }

    public function getAccountAddress()
    {
        $states = Coverage::where('ctype', '0')->get();
        $data = ['states' => $states];
        return view('user.account_address', $data);
    }

    public function postAccountAddressAdd(Request $request)
    {
        $rules = [
            'name' => 'required',
            'cpostal' => 'required',
            'state' => 'required',
            'city' => 'required',
            'col' => 'required',
            'street' => 'required',
            'numex' => 'required',
            'phone' => 'required|digits:10|numeric'
        ];
        $message = [
            'name.required' => 'Su nombre o nombre de quien recibirá el pedido es requerido.',
            'cpostal.required' => 'Su Código postal es requerido.',
            'state.required' => 'Por favor seleccione su estado.',
            'city.required' => 'Por favor seleccione su ciudad, municipio o alcaldia. ',
            'col.required' => 'Por favor ingrese el nombre de su colonia.',
            'street.required' => 'Por favor ingrese el nombre de su calle.',
            'numex.required' => 'El campo numero exterior es requerido.',
            'phone.required' => 'Por favor ingrese un número de teléfono.',
            'phone.digits' => 'El número de teléfono debe de contener 10 dígitos.',
            'phone.numeric' => 'Por favor ingres un número de teléfono valido.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger')
            ->withInput();
        }else{
            $address = new UserAddress;
            $address->user_id = Auth::id();
            $address->state_id = $request->input('state');
            $address->city_id = $request->input('city');
            $info = ['name' => e($request->input('name')),
                'cpostal' => $request->input('cpostal'),
                'col' => e($request->input('col')),
                'street' => e($request->input('street')),
                'numex' => $request->input('numex'),
                'numin' => $request->input('numin'),
                'street1' => e($request->input('street1')),
                'street2' => e($request->input('street2')),
                'phone' => $request->input('phone'),
                'indications' => e($request->input('indications'))
            ];
            $address->addr_info = json_encode($info);
            if(count(collect(Auth::user()->getAddress)) == "0"):
                $address->default = "1";
            endif;
            if($address->save()):
                return back()->with('message', 'Dirección guardada con éxito.')->with('typealert', 'success');
            endif;
        }
    }

    public function getAccountAddressSetdefault(UserAddress $address)
    {
        if(Auth::id() != $address->user_id):
            return back()->with('message', 'No puedes editar esta dirección de entrega.')->with('typealert', 'danger');
        else:
            $default = Auth::user()->getAddressDefault->id;
            $default = UserAddress::find(Auth::user()->getAddressDefault->id);
            $default->default = "0";
            $default->save();

            $address->default = "1";
            if($address->save()):
                return back()->with('message', 'La dirección principal se cambió con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getAccountAddressDelete(UserAddress $address)
    {
        if(Auth::id() != $address->user_id):
            return back()->with('message', 'No puedes eliminar esta dirección.')->with('typealert', 'danger');
        else:
            if($address->default == "0"):
                if($address->delete()):
                    return back()->with('message', 'Dirección eliminada exitosamente.')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', 'No puede eliminar una dirección principal.')->with('typealert', 'danger');
            endif;
        endif;
    }
}
