<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use App\Http\Models\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
        $this -> middleware('user.status');
        $this -> middleware('user.permissions');
        $this -> middleware('isadmin');
    }

    public function getHome($module)
    {
        $cats = Category::where('module', $module)->where('parent', '0')->orderBy('order', 'Asc')->get();
        $data = ['cats' => $cats, 'module' => $module];
        return view('admin.categories.home', $data);
    }

    public function postCategoryAdd(Request $request, $module)
    {
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];
        $message = [
            'name.required' => 'Ingrese un nombre a la categoría.',
            'icon.required' => 'Se requiere de un icono para la categoría.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger');
        }else{
            /*
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request -> file('icon') -> getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('icon')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            *//*
            $upload_icon = $this->postFileUpload('icon', $request);
            $icon = json_decode($upload_icon, true);
            if($icon['upload'] == "error"):
                
                return back()->with('message', 'No se pudo subir el archivo.')->with('typealert', 'danger');
            endif;*/
            $c = new Category;
            $c -> module = $module;
            $c -> parent = $request -> input('parent');
            $c -> name = e($request -> input('name'));
            $c -> slug = Str::slug($request -> input('name'));
            $c -> icon = $this->postFileUpload('icon', $request);
            if($c->save()):
                return back()->with('message', 'Guardado con éxito.')->with('typealert', 'success');
            endif;
        }
    }

    public function getCategoryEdit($id)
    {
        $cat = Category::find($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

    public function postCategoryEdit(Request $request, $id)
    {
        $rules = [
            'name' => 'required'
        ];
        $message = [
            'name.required' => 'Ingrese un nombre a la categoría.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se a producido un error:')->with('typealert', 'danger');
        }else{
            $c = Category::find($id);
            $c -> name = e($request -> input('name'));
            $c -> slug = Str::slug($request -> input('name'));
            if($request->hasFile('icon')):
                $actual_icon = $c->icon;
                if(!is_null($c->icon)):
                    $this->getFileDelete('uploads', $actual_icon);
                endif;
                $c->icon = $this->postFileUpload('icon', $request);
            endif;
            $c->order = $request->input('order');
            if($c->save()):
                return back()->with('message', 'Guardado con éxito.')->with('typealert', 'success');
            endif;
        }
    }

    public function getSubCategories($id)
    {
        $cat = Category::FindOrFail($id);
        $data = ['category' => $cat];
        return view('admin.categories.subcategories', $data);
    }

    public function getCategoryDelete($id)
    {
        $c = Category::find($id);
        if($c->delete()):
            return back()->with('message', 'Eliminado éxitosamente.')->with('typealert', 'success');
        endif;
    }
}
