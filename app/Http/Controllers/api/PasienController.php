<?php

namespace App\Http\Controllers\api;

use App\Models\Akun;
use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\Response;

class PasienController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'agama' => ['required'],
            'pekerjaan' => ['required'],
            'alamat' => ['required'],
            'status' => ['required'],
            'jenis_pasien' => ['required'],
            'no_BPJS' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $post = $request->all();
        $data = Pasien::max('id') + 1;
        if ($post['jenis_kelamin'] == 'laki-laki') {
            $kode = 10000 + $data;
        } else {
            $kode = 20000 + $data;
        }
        $tahun = date('Y');
        $tahun = (string) $tahun;
        $post['id_register'] = '1' . $tahun . $kode;
        $pasien = Pasien::create($post);
        try {
            $user['name'] = $post['nama'];
            $user['username'] = $post['id_register'];
            $user['password'] = bcrypt($post['id_register']);
            $user['password_default'] = bcrypt($post['id_register']);
            $user['role'] = 'user';
            Akun::create($user);
            $response = [
                'message' => 'Daftar Pasien Berhasil',
                'status' => true,
                'data' => $pasien
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Daftar Pasien Gagal ' . $e->getMessage(),
                'status' => false
            ]);
        }
    }

    public function edit($id)
    {
        $data = Pasien::where('id', $id)->first();
        if (!$data) {
            $response = [
                'message' => 'data tidak ada',
                'status' => false,
            ];
            return response()->json($response, Response::HTTP_OK);
        } else {
            $tanggal = date('d F Y', strtotime($data['tanggal_lahir']));
            $data['tanggal_lahir'] = $tanggal;
            $response = [
                'message' => 'data pasien',
                'status' => true,
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();
        try {
            Pasien::find($data['id'])->update($data);
            $response = [
                'message' => 'update berhasil',
                'status' => true
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'update data gagal ' . $e->errorInfo,
                'status' => false
            ]);
        }

        return back();
    }
}
