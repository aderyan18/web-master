<?php

namespace App\Http\Controllers\api;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Status;
use Illuminate\Support\Facades\Validator;


class ReservasiController extends Controller
{
    public function index($id)
    {
        $sekarang = date('Y-m-d');
        $data = Reservasi::where([['tanggal', $sekarang], ['pasien_id', $id], ['status', 0]])->first();
        if (!$data) {
            $response = [
                'message' => 'belum ada',
                'status' => false
            ];
            return response()->json($response, Response::HTTP_OK);
        } else {
            $tanggal = date('d F Y', strtotime($data['tanggal']));
            $waktu = date('H:i ', strtotime($data['waktu']));
            $data['waktu'] = $waktu;
            $data['tanggal'] = $tanggal;
            $response = [
                'message' => 'data reservasi sesuai id',
                'status' => true,
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pasien_id' => ['required'],
            'poli_id' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $cek = Status::where('keterangan', 1)->first();
        if ($cek == null) {
            $response = [
                'message' => 'Reservasi Online Sudah Tutup',
                'status' => false
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
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
                $response = [
                    'message' => 'Reservasi Sudah Tutup',
                    'status' => false
                ];
                return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
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
                $waktu = date('H:i ', strtotime($post['waktu']));
                $post['waktu'] = $waktu;
                $response = [
                    'message' => 'Reservasi berhasil',
                    'status' => true,
                    'data' => $post,
                ];
                return response()->json($response, Response::HTTP_OK);
            } else {
                $response = [
                    'message' => 'Anda Sudah Reservasi hari ini',
                    'status' => false,
                ];
                return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
    }

    public function batal($id)
    {

        $sekarang = date('Y-m-d');
        $reservasi = Reservasi::where([['tanggal', $sekarang], ['status', 0], ['pasien_id', $id]])->update(['status' => 2]);
        $response = [
            'message' => 'reservasi berhasil di batalkan',
            'status' => true,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
