<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class DataDokterController extends Controller
{
    public function show()
    {
        $dokter = Dokter::all();
        $poli = Poli::all();
        return view('admin.datadokter', compact('dokter', 'poli'));
    }

    public function create(Request $request)
    {

        $post = $request->all();
        $data = Dokter::max('id') + 1;
        if ($post['jenis_kelamin'] == 'laki-laki') {
            $kode = 10000 + $data;
        } else {
            $kode = 20000 + $data;
        }
        $tahun = date('Y');
        $tahun = (string) $tahun;
        $post['nip'] = 2 . $tahun . $kode;
        Dokter::create($post);
        $user['name'] = $post['nama'];
        $user['username'] = $post['nip'];
        $user['password'] = bcrypt($post['nip']);
        $user['password_default'] = bcrypt($post['nip']);
        $user['role'] = 'dokter';
        Akun::create($user);
        return back()->with('berhasil', 'Tambah Data Berhasil');
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $post = Dokter::where($where)->first();
        return response()->json($post);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        Dokter::find($data['id'])->update($data);
        return back()->with('berhasil', 'Edit Data Berhasil');
    }

    public function delete($id)
    {

        Dokter::find($id)->delete();
        return back()->with('berhasil', 'Delete Data Berhasil');
    }
}
