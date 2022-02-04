<?php

namespace App\Http\Controllers\api;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
    public function index()
    {
        $waktuskrng = date('H:i:s');
        $buka = date('H:i:s', strtotime('10:00:00'));
        $tutup = date('H:i:s', strtotime('21:00:00'));
        $status = Status::first();
        if ($waktuskrng < $buka || $waktuskrng > $tutup) {
            $response = [
                'message' => 'reservasi online dibuka pada pukul 10:00 - 20:30',
                'status' => false,
                'data' => $status,
            ];
        } elseif ($status['keterangan'] == 1) {
            $response = [
                'message' => 'reservasi aktif',
                'status' => true,
                'data' => $status,
            ];
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response = [
                'message' => 'reservasi non aktif',
                'status' => false,
                'data' => $status,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }
}
