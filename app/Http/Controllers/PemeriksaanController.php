<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Resep;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    public function index($id)
    {
        $data = Pasien::where('id', $id)->firstOrFail();
        $obat = Obat::orderBy('nama')->get();
        return view('admin.pemeriksaan', compact('data', 'obat'));
    }

    public function pemeriksaan(Request $request)
    {

        $post = $request->all();
        $sekarang = date('Y-m-d');
        $post['tanggal'] = date('Y-m-d');

        $pasien = Pasien::where('id_register', $post['id_register'])->first();
        $data = Reservasi::where([['tanggal', $sekarang], ['pasien_id', $pasien['id']], ['status', 0]])->first();
        $post['poli_id'] = $data['poli_id'];
        $post['pasien_id'] = $pasien['id'];
        $login = auth()->user()->username;
        $iddokter = Dokter::where('nip', $login)->first();
        $post['dokter_id'] = $iddokter['id'];
        $cek = Pemeriksaan::create($post);
        $no = 0;
        foreach ($post['obat_id'] as $data) {
            $resep = new Resep;
            $resep->pemeriksaan_id = $cek['id'];
            $resep->obat_id = $data;
            $resep->aturan = $post['aturan'][$no];
            $resep->jumlah = $post['jumlah'][$no];

            $resep->save();
            $no++;
        }
        $data = Reservasi::where([['tanggal', $sekarang], ['pasien_id', $pasien['id']], ['status', 0]])->update(['status' => 1]);
        return redirect('/daftarreservasi');
    }

    public function riwayat()
    {
        $riwayat = Pemeriksaan::all();
        return view('admin.riwayat', ['riwayat' => $riwayat]);
    }

    public function riwayatpasien($id)
    {
        $riwayat = Pemeriksaan::where('pasien_id', $id)->orderBy('tanggal', 'desc')->get();
        $nama = Pasien::where('id', $id)->first();

        $namapasien = $nama->nama;
        return view('admin.riwayat', compact('riwayat', 'namapasien'));
    }
}
