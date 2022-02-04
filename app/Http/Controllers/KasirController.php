<?php

namespace App\Http\Controllers;

use App\Models\Apoteker;
use App\Models\Barangtransaksi;
use App\Models\Obat;
use App\Models\Temptransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        $login = auth()->user()->username;
        $idapoteker = Apoteker::where('nip', $login)->first();
        $apoteker_id = $idapoteker['id'];
        $now = date('Y-m-d');
        $transaksi = Temptransaksi::where([['tanggal', $now], ['apoteker_id', $apoteker_id]])->get();
        return view('admin.kasir', compact('obat', 'transaksi'));
    }
    public function stock($id)
    {
        $data = Obat::where('id', $id)->first();
        return response()->json($data);
    }

    public function temporary(Request $request)
    {
        $data = $request->all();
        $tanggal = date('Y-m-d');
        $data['tanggal'] = $tanggal;
        $data['sub_total'] = $data['hs'] * $data['banyak'];
        $login = auth()->user()->username;
        $idapoteker = Apoteker::where('nip', $login)->first();
        $data['apoteker_id'] = $idapoteker['id'];
        $nama = $data['obat_id'];
        $cek = Temptransaksi::where([['obat_id', $nama], ['tanggal', $tanggal], ['apoteker_id', $data['apoteker_id']]])->first();
        if ($cek != null) {
            $banyak = $cek['banyak'] + $data['banyak'];
            $sub_total = $cek['sub_total'] + $data['sub_total'];
            $update = Temptransaksi::where([['obat_id', $nama], ['tanggal', $tanggal], ['apoteker_id', $data['apoteker_id']]]);
            $update->update([
                'banyak' => $banyak,
                'sub_total' => $sub_total,
            ]);
            $obat = Obat::where('id', $nama)->first();
            $banyakbaru = $obat['stok'] - $data['banyak'];
            Obat::where('id', $nama)->update([
                'stok' => $banyakbaru,
            ]);
            return redirect(url('kasir'));
        } else {
            Temptransaksi::create($data);
        }
        $obat = Obat::where('id', $nama)->first();
        $banyakbaru = $obat['stok'] - $data['banyak'];
        Obat::where('id', $nama)->update([
            'stok' => $banyakbaru,
        ]);
        return redirect('/kasir');
    }

    public function edit($id)
    {
        $post = Temptransaksi::where('id', $id)->first();
        $obat_id = $post['obat_id'];
        $batas = Obat::where('id', $obat_id)->first();
        $post['max'] = $batas['stok'];
        return response()->json($post);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $cek = Temptransaksi::where('id', $data['id'])->first();
        $banyak = $data['banyak'] - $cek['banyak'];
        $obat = Obat::where('id', $cek['obat_id'])->first();
        $banyakbaru = $obat['stok'] - $banyak;
        Obat::where('id', $cek['obat_id'])->update([
            'stok' => $banyakbaru,
        ]);
        $data['sub_total'] = ($cek['sub_total'] / $cek['banyak']) * $data['banyak'];
        Temptransaksi::find($data['id'])->update($data);
        return back();
    }

    public function hapus($id)
    {
        $cek = Temptransaksi::where('id', $id)->first();
        $obat = Obat::where('id', $cek['obat_id'])->first();
        $banyakbaru = $obat['stok'] + $cek['banyak'];
        Obat::where('id', $cek['obat_id'])->update([
            'stok' => $banyakbaru,
        ]);
        Temptransaksi::where('id', $id)->delete();
        return back();
    }

    public function batal()
    {
        $data = [];
        $login = auth()->user()->username;
        $idapoteker = Apoteker::where('nip', $login)->first();
        $data['apoteker_id'] = $idapoteker['id'];
        $now = date('Y-m-d');
        $tempt = Temptransaksi::where([['tanggal', $now], ['apoteker_id', $data['apoteker_id']]])->get();
        foreach ($tempt as $a) {
            $obat = Obat::where('id', $a['obat_id'])->first();
            $banyakbaru = $obat['stok'] + $a['banyak'];
            Obat::where('id', $a['obat_id'])->update([
                'stok' => $banyakbaru,
            ]);
        }
        $data = Temptransaksi::where([['tanggal', $now], ['apoteker_id', $data['apoteker_id']]])->delete();
        return back();
    }

    public function selesai()
    {
        $data = [];
        $login = auth()->user()->username;
        $idapoteker = Apoteker::where('nip', $login)->first();
        $data['apoteker_id'] = $idapoteker['id'];
        $now = date('Y-m-d');
        $temporary = Temptransaksi::where([['tanggal', $now], ['apoteker_id', $data['apoteker_id']]])->get();
        $total = Temptransaksi::where([['tanggal', $now], ['apoteker_id', $data['apoteker_id']]])->sum('sub_total');
        $data['total'] = $total;
        $data['tanggal'] = $now;
        $no = 0;
        $transaksi = Transaksi::create($data);
        foreach ($temporary as $a) {
            $barang = new Barangtransaksi;
            $barang->transaksi_id = $transaksi['id'];
            $barang->obat_id = $temporary[$no]['obat_id'];
            $barang->banyak = $temporary[$no]['banyak'];
            $barang->sub_total = $temporary[$no]['sub_total'];

            $barang->save();
            $no++;
        }
        Temptransaksi::where([['tanggal', $now], ['apoteker_id', $data['apoteker_id']]])->delete();
        return back();
    }

    public function penjualan()
    {
        $transaksi = Transaksi::all();
        return view('admin.riwayattransaksi', compact('transaksi'));
    }
}
