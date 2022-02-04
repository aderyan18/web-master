<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index(){
        $data=Obat::where('stok','>',0)->get();
        return response()->json([
                'status' => true,
                'message' => "Data Obat",
                'data' => $data
            ], 200);
    }
    public function cari(Request $request){
        $data = Obat::where('nama', 'like', "%{$request->input('cari')}%")->get();
        return response()->json([
            'status' => true,
            'message' => "Search Obat",
            'data' => $data
        ], 200);
    }
}
