<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Product;
use Illuminate\Support\Facades\Config;
use App\Http\Models\Favorite;
use App\Http\Models\Inventory;
use App\Http\Models\Category;
use App\Http\Models\Coverage;
use Illuminate\Support\Facades\Auth;

class ApiJsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['getProductsSection']);
    }

    public function getProductsSection($section, Request $request)
    {
        $items_x_pagina = Config::get('hm.products_per_page');
        $items_x_pagina_random = Config::get('hm.products_per_page_random');
        switch ($section):
            case 'home':
                $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_pagina_random);
                break;
            
            case 'store':
                $products = Product::where('status', 1)->orderBy('id', 'Desc')->paginate($items_x_pagina);
                break;

            case 'store_category':
                $products = $this->getProductsCategory($request->get('object_id'), $items_x_pagina);
                break;
            
            default:
                $products = Product::where('status', 1)->inRandomOrder()->paginate($items_x_pagina_random);
                break;
        endswitch;

        return $products;
    }

    public function getProductsCategory($id, $ipp)
    {
        $category = Category::find($id);
        if($category->parent == "0"):
            $query = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'Desc')->paginate($ipp);
        else:
            $query = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'Desc')->paginate($ipp);
        endif;
        return $query;
    }

    public function postFavoriteAdd($object, $module, Request $request)
    {
        $query = Favorite::where('user_id', Auth::id())->where('module', $module)->where('object_id', $object)->count();
        if($query > 0):
            $data = ['status' => 'error', 'msg' => 'Este elemento ya se encuentra en sus favoritos.'];
        else:
            $favorite = new Favorite;
            $favorite->user_id = Auth::id();
            $favorite->module = $module;
            $favorite->object_id = $object;
            if($favorite->save()):
                $data = ['status' => 'success', 'msg' => 'Elemento guardado en favoritos exitosamente.'];
            endif;
        endif;

        return response()->json($data);
    }

    public function postUserFavorites(Request $request)
    {
        $objects = json_decode($request->input('objects'), true);
        $query = Favorite::where('user_id', Auth::id())->where('module', $request->input('module'))
        ->whereIn('object_id', explode(",", $request->input('objects')))->pluck('object_id');
        if(count(collect($query)) > 0):
            $data = ['status' => 'success', 'count' => count(collect($query)), 'objects' => $query];
        else:
            $data = ['status' => 'success', 'count' => count(collect($query))];
        endif;
        return response()->json($data);
        //return response()->json($request->input('objects'));
    }

    public function postProductInventoryVariants($id)
    {
        $query = Inventory::find($id);
        return response()->json($query->getVariants);
    }

    public function postCoverageCitiesFromState($state_id)
    {
        $cities = Coverage::where('ctype', '1')->where('state_id', $state_id)->get();
        return response()->json($cities);
    }
}
