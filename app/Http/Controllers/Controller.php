<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Models\Order;
use App\Mail\OrderSendDetails;
use App\Mail\OrderSendDetailsAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getOrderEmialDetails($orderid)
    {
        $order = Order::find($orderid);
        $data = ['order' => $order];
        Mail::to($order->getUser->email)->send(new OrderSendDetails($data));
        foreach ($this->getAdminsEmials() as $admin) {
            $data = ['order' => $order, 'name' => $admin->name.' '.$admin->lastname];
            Mail::to($admin->email)->send(new OrderSendDetailsAdmin($data));
        }
    }

    public function getAdminsEmials()
    {
        return DB::table('users')->where('role', '1')->get();
    }

    public function getProcessOrder($id)
    {
        $order = Order::find($id);
        $order->o_number = $this->getOrderNumberGenerate();
        $order->status = '1';
        $order->request_at = date('y-m-d h:i:s');
        $order->save();
    }

    public function getOrderNumberGenerate(){
        $orders = Order::where('status', '>', '0')->count();
        $orderNumber = $orders + 1;
        return $orderNumber;
    }

    public function postFileUpload($field, $request, $thumbnails = null){
        $path = date('y/m/d');
        $original_name = $request->file($field)->getClientOriginalName();
        $final_name = Str::slug($request->file($field)->getClientOriginalName().'_'.time()).'.'.trim($request->file($field)->getClientOriginalExtension());
        
        if($request->$field->storeAs($path, $final_name, 'uploads')):
            $data = json_encode(['upload' => 'success', 'path' => $path, 'original_name' => $original_name, 'final_name' => $final_name]);
        else:
            $data = ['upload' => 'error'];
        endif;

        if($thumbnails):
            $file_path = Config::get('filesystems.disks.uploads.root').'/'.$path.'/'.$final_name;
            foreach($thumbnails as $thumbnail):
                $img = Image::make($file_path)->orientate();
                $img->fit($thumbnail[0], $thumbnail[1], function($constraint){
                    $constraint->aspectRatio();
                });
                $img->save(Config::get('filesystems.disks.uploads.root').'/'.$path.'/'.$thumbnail[2].'_'.$final_name, 75);
            endforeach;
        endif;

        return $data;
    }

    public function getFileDelete($disk, $file, $thumbnails = null){
        $file = json_decode($file, true);
        $file_path = Config::get('filesystems.disks.'.$disk.'.root').'/'.$file['path'].'/'.$file['final_name'];
        if(file_exists($file_path)):
            unlink($file_path);
            if($thumbnails):
                foreach($thumbnails as $thumbnail):
                    $thumbnail_path = Config::get('filesystems.disks.'.$disk.'.root').'/'.$file['path'].'/'.$thumbnail.'_'.$file['final_name'];
                    if(file_exists($thumbnail_path)):
                        unlink($thumbnail_path);
                    endif;
                endforeach;
            endif;
        endif;
    }
}
