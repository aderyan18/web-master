<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use App\Models\Resep;
use App\Models\Obat;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RiwayatController extends Controller
{
    public function index($id)
    {
        $data = Pemeriksaan::where('pasien_id', $id)->get();
        $cek = [];

        foreach ($data as $b) {
            $resep = Resep::where('pemeriksaan_id', $b['id'])->get();
            $obat = [];
            foreach ($resep as $c) {
                $obat[] = Obat::where('id', $c['obat_id'])->get();
            }
            $cek[] = [
                'tanggal' => date('d F Y', strtotime($b['tanggal'])),
                "id" => $b['id'],
                'resep' => $resep,
                'namaobat' => $obat,
                'diagnosa' => $b['diagnosa'],
                'nama_dokter' => $b['dokter']['nama'],
            ];
        }
        $response = [
            'message' => 'data riwayat sesuai id',
            'status' => true,
            'data' => $cek,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
