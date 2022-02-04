<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class DataObatController extends Controller
{
    public function show()
    {
        $obat = Obat::all();
        return view('admin.dataobat', ['obat' => $obat]);
    }

    public function create(Request $request)
    {
        $post = $request->all();
        $post['nama'] = strtolower($post['nama']);
        $cek = Obat::where([['nama', $post['nama']], ['satuan', $post['satuan']]])->count();
        if ($cek < 1) {
            Obat::create($post);
        } else {
            $stok = Obat::where([['nama', $post['nama']], ['satuan', $post['satuan']]])->first();
            Obat::where([['nama', $post['nama']], ['satuan', $post['satuan']]])->update(['stok' => $stok['stok'] + $post['stok']]);
        }
        return back()->with('berhasil', 'Tambah Data Berhasil');
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $post = Obat::where($where)->first();
        return response()->json($post);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        Obat::find($data['id'])->update($data);
        return back()->with('berhasil', 'Edit Data Berhasil');
    }

    public function delete($id)
    {

        Obat::find($id)->delete();
        return back()->with('berhasil', 'Delete Data Berhasil');
    }
}
