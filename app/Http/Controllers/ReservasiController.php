<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Reservasi;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReservasiController extends Controller
{
    public function show()
    {
        $sekarang = date('Y-m-d');
        if (auth()->user()->role == 'dokter') {
            $username = auth()->user()->username;
            $dokter = Dokter::where('nip', $username)->first();
            $poli = $dokter['poli_id'];
            $reservasi = Reservasi::where([['tanggal', $sekarang], ['status', 0], ['poli_id', $poli]])->orderBy('nomor_antrian')->get();
        } else {
            $reservasi = Reservasi::where([['tanggal', $sekarang], ['status', 0]])->orderBy('poli_id')->orderBy('nomor_antrian')->get();
        }
        $pasien = Pasien::orderBy('nama')->get();
        $poli = Poli::orderBy('nama')->get();
        return view('admin.reservasi', compact('reservasi', 'pasien', 'poli'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pasien_id' => ['required'],
            'poli_id' => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'gagal tambah');
        }
        $post = $request->all();
        $poli = $post['poli_id'];
        $sekarang = date('Y-m-d');

        //waktu sekarang
        $waktuskrng = date('H:i:s');
        $post['tanggal'] = $sekarang;
        $post['status'] = 0;
        $idpasien = $post['pasien_id'];
        $cek = Reservasi::where([['tanggal', $sekarang], ['poli_id', $poli]])->max('waktu');
        //menentukan waktu kedatangan
        if ($cek == null) {
            $waktu = date('H:i:s', strtotime('16:00:00'));
            if ($waktuskrng > $waktu) {
                $waktu = tambah20($waktuskrng);
            }
        } elseif ($waktuskrng < $cek) {
            $waktu = tambah20($cek);
        } else {
            $waktu = tambah20($waktuskrng);
        }
        //end menentukan waktu kedatangan

        //cek tutup
        $tutup = date('H:i:s', strtotime('20:30:00'));
        if ($waktu > $tutup) {
            return back()->with('gagal', 'reservasi gagal, reservasi sudah tutup');
        }
        //end cek tutup

        //cek apakah pasien sudah reservasi atau tidak
        $data = Reservasi::where([['tanggal', $sekarang], ['pasien_id', $idpasien], ['status', 0]])->count();

        if ($data == 0) {
            $jumlah = Reservasi::where([['tanggal', $sekarang], ['poli_id', $poli]])->count();
            if ($jumlah == 0) {
                $post['nomor_antrian'] = 1;
                $post['waktu'] = $waktu;
            } else {
                $cek = Reservasi::where([['tanggal', $sekarang], ['poli_id', $poli]])->max('nomor_antrian') + 1;
                $post['nomor_antrian'] = $cek;
                $post['waktu'] = $waktu;
            }
            Reservasi::create($post);
            return back()->with('berhasil', 'Reservasi Berhasil');
        } else {
            return back()->with('gagal', 'Pasien Sudah Reservasi');
        }
    }
}
