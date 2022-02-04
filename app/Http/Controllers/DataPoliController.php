<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class DataPoliController extends Controller
{
    public function show()
    {
        $poli = Poli::all();
        return view('admin.datapoli', ['poli' => $poli]);
    }

    public function create(Request $request)
    {
        $post = $request->all();
        Poli::create($post);
        return back()->with('berhasil', 'Tambah Data Berhasil');
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $post = Poli::where($where)->first();
        return response()->json($post);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        Poli::find($data['id'])->update($data);
        return back()->with('berhasil', 'Edit Data Berhasil');
    }

    public function delete($id)
    {
        Poli::find($id)->delete();
        return back()->with('berhasil', 'Delete Data Berhasil');
    }
}
