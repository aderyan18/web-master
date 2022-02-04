<?php

namespace App\Http\Controllers;

use id;
use App\Models\Akun;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function tes()
    {
        return view('admin.tes');
    }

    public function edit($id)
    {

        $where = array('id' => $id);
        $post = Akun::where($where)->first();
        return response()->json($post);
    }

    public function coba()
    {
        return 'tes';
    }

    public function tess()
    {
        $user = Akun::all();
        return response()->json($user);
    }
}
