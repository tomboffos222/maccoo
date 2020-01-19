<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Validator;
use File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function validator($errors,$rules,$messages = []) {
        return Validator::make($errors,$rules,$messages);
    }
    protected function uploadFile($file,$dir = 'uploads'){
        if (isset($file)){
            File::isDirectory($dir) or File::makeDirectory($dir, 0777, true, true);

            $file_type = File::extension($file->getClientOriginalName());
            $file_name = time().str_random(5).'.'.$file_type;
            $file->move($dir, $file_name);
            return $dir.'/'.$file_name;
        }
    }
    protected function deleteFile(string $path){
        if (File::exists($path)) {
            File::delete($path);
            return true;
        }
        else{
            return false;
        }
    }

}
