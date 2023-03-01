<?php

namespace App\Traits;


use Illuminate\Support\Facades\File;

trait FilesTrait
{

    function saveFile($file, $folder)
    {
        $filename = $file->getClientOriginalName();
        $f_name_array = explode('.', $filename);
        $f_file_name = $f_name_array[0];
        $f_file_ext = end($f_name_array);
        $file_name = rand(111, 999) . time().'.'.$f_file_ext;
        $file->move($folder, $file_name);
        return [
            'name' => $file_name,
            'type' => $f_file_ext
        ];
    }

    function deleteFile($file_path)
    {
        if(File::exists($file_path)){
            File::delete($file_path);
            return true;
        }else{
            return false;
        }
    }

}




