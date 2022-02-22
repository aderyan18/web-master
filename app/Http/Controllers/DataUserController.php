<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Apoteker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataUserController extends Controller
{
    public function show()
    {
        $user = Akun::all();
        return view('admin.datauser', ['user' => $user]);
    }

    public function create(Request $request)
    {
        $post = $request->all();
        // $validate = $request->validate([
                
        //     ])
        $post['password'] = bcrypt($request->password);
        $post['password_default'] = $post['password'];
        $where = array('username' => $post['username']);
        $cek = Akun::where($where)->first();
        if (!$cek) {
            Akun::create($post);
            if($post['role']=="super admin" || $post['role']=="apoteker"){
                Apoteker::create([
                        'nip'=>$post['username'],
                        'nama'=>$post['name'],
                        'jenis_kelamin'=>"laki-laki",
                    ]);
            }
        }
        
        return back();
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $post = Akun::where($where)->first();
        return response()->json($post);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        Akun::find($data['id'])->update($data);
        return back();
    }

    public function delete($id)
    {

        Akun::find($id)->delete();
        return back();
    }

    public function reset($id)
    {
        $where = array('id' => $id);
        $data = Akun::where($where)->first();
        Akun::where($where)->update(['password' => $data['password_default']]);
        return back();
    }
}
