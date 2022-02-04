<?php

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
// fungsi upload file
function uploadFile_old($file_name, $path, $file_old)
{
    $tgl = date('Ymd');
    $file = array('file' => $file_name);
    $rules = array('file' => 'mimes:pdf,png,jpeg,jpg');
    $validator = Validator::make($file, $rules);

    $path_dir = public_path() . '/' . $path . '/';
    Storage::makeDirectory($path_dir, 0777);

    if ($validator->fails() or $file_name == null) {
        $fileName = $file_old == '' ? null : $file_old;
    } else {
        $extension = strstr($file_name->getClientOriginalName(), '.');
        $uniq = uniqid();
        $fileName = $tgl . "_" . $uniq . $extension;
        $file_name->move($path, $fileName);
        deleteFile($file_old, $path_dir);
    }
    return $fileName;
}

function deleteFile($image, $path)
{
    File::delete($path . $image);
}

function validSize($file)
{
    $data = array('file' => $file);
    $rules = array('file' => 'mimes:pdf|max:100');
    $valid = Validator::make($data, $rules);
    return $valid->fails();
}

function uploadFile($file, $path, $fileOld)
{
    if ($file == null) {
        $fileName = $fileOld;
    } else {
        if ($fileOld != null) {
            $file_path = storage_path('app/public/' . $path . '/' . $fileOld);
            File::delete($file_path);
        }
        $fileName = Carbon::now()->format('Ymd') . Str::random(15) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/' . $path, $fileName);
    }
    return $fileName;
}
