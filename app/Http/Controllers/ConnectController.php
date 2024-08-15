<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator, Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\UserSendRecover;
use App\Mail\UserSendNewPassword;

use function Ramsey\Uuid\v1;

class ConnectController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['getlogout']);
    }

    public function getlogin()
    {
        Return view('connect.login');
    }

    public function postlogin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
        $message = [
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato del correo electrónico ingresado es inválido.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' => 'La contraseña debe de contra con al menos 8 caracteres.',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger');
        }else{
            if(Auth::attempt(['email' => $request -> input('email'), 'password' => $request -> input('password')], true)){
                if(Auth::user()->status == '100'):
                    return redirect('/logout');
                else:
                    return redirect('/');
                endif;
            }else{
                return back()->with('message', 'El correo electrónico o la contraseña es incorrecta.')->with('typealert', 'danger');
            }
        }
    }

    public function getregister()
    {
        Return view('connect.register');
    }

    public function postregister(Request $request)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];
        $message = [
            'name.required' => 'Su nombre es requerido.',
            'lastname.required' => 'Su apellido es requerido.',
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato del correo electrónico ingresado es inválido.',
            'email.unique' => 'Ya existe un usuario registrado con el correo electrónico ingresado.',
            'password.required' => 'Por favor escriba una contraseña.',
            'password.min' => 'La contraseña debe de contra con al menos 8 caracteres.',
            'cpassword.required' => 'Por favor confirme su contraseña.',
            'cpassword.min' => 'La confirmacion de la contraseña debe de contra con al menos 8 caracteres.',
            'cpassword.same' => 'Las contraseñas no coinciden.'
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger');
        }else{
            $user = new user;
            $user -> name = e($request -> input('name'));
            $user -> lastname = e($request -> input('lastname'));
            $user -> email = e($request -> input('email'));
            $user -> password = Hash::make($request -> input('password'));
            if ($user->save()){
                return redirect('/login')->with('message', 'Registro exitoso.')->with('typealert', 'success');
            }
        }

        
    }

    public function getlogout()
    {
        $status = Auth::user()->status; 
        Auth::logout();
        if($status == "100"):
            return redirect('/login')->with('message', 'Su usuario fue suspendido.')->with('typealert', 'danger');
        else:
            return redirect('/'); 
        endif;  
    }

    public function getRecover()
    {
        return view('connect.recover');
    }

    public function postRecover(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];
        $message = [
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato del correo electrónico ingresado es inválido.'
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger');
        }else{
            $user = User::where('email', $request->input('email'))->count();
            if($user == "1"):
                $user = User::where('email', $request->input('email'))->first();
                $code = rand(100000, 999999);
                $data = ['name' => $user->name, 'email' => $user->email, 'code' => $code];
                $u = User::find($user->id);
                $u->password_code = $code;
                if($u->save()):
                    Mail::to($user->email)->send(new UserSendRecover($data));
                    return redirect('/reset?email='.$user->email)->with('message', 'Ingrese el código que hemos enviado a su correo electrónico.')
                        ->with('typealert', 'success');;
                    //return view('emails.user_password_recover', $data);
                endif;
            else:
                return back()->with('message', 'El correo electrónico ingresado no existe.')->with('typealert', 'danger');
            endif;
        }
    }

    public function getReset(Request $request)
    {
        $data = ['email' => $request->get('email')];
        return view('connect.reset', $data);
    }

    public function postReset(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'code' => 'required'
        ];
        $message = [
            'email.required' => 'Su correo electrónico es requerido.',
            'email.email' => 'El formato del correo electrónico ingresado es inválido.',
            'code.required' => 'El código de recuperación es requerido.'
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger');
        }else{
            $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->count();
            if($user == "1"):
                $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->first();
                $new_password = Str::random(8);
                $user->password = Hash::make($new_password);
                $user->password_code = null;
                if($user->save()):
                    $data = ['name' => $user->name, 'password' => $new_password];
                    Mail::to($user->email)->send(new UserSendNewPassword($data));
                    return redirect('/login')->with('message', 'La contraseña fue restablecida con éxito, le hemos enviado un correo electrónico con su nueva contraseña para que pueda iniciar sesión.')
                        ->with('typealert', 'success');;
                endif;
            else:
                return back()->with('message', 'El correo electrónico o el código de recuperación son erróneos.')->with('typealert', 'danger');
            endif;
        }
    }
}
