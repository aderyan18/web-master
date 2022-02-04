<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Apoteker;
use Illuminate\Http\Request;

class DataApotekerController extends Controller
{
    public function show()
    {
        $apoteker = Apoteker::all();
        return view('admin.dataapoteker', ['apoteker' => $apoteker]);
    }

    public function create(Request $request)
    {
        $post = $request->all();
        $data = Apoteker::max('id') + 1;
        if ($post['jenis_kelamin'] == 'laki-laki') {
            $kode = 10000 + $data;
        } else {
            $kode = 20000 + $data;
        }
        $tahun = date('Y');
        $tahun = (string) $tahun;
        $post['nip'] = 3 . $tahun . $kode;
        Apoteker::create($post);
        $user['name'] = $post['nama'];
        $user['username'] = $post['nip'];
        $user['password'] = bcrypt($post['nip']);
        $user['password_default'] = bcrypt($post['nip']);
        $user['role'] = 'apoteker';
        Akun::create($user);
        return back()->with('berhasil', 'Tambah Data Berhasil');
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $post = Apoteker::where($where)->first();
        return response()->json($post);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        Apoteker::find($data['id'])->update($data);
        return back()->with('berhasil', 'Edit Data Berhasil');
    }

    public function delete($id)
    {
        Apoteker::find($id)->delete();
        return back()->with('berhasil', 'Delete Data Berhasil');
    }
}
