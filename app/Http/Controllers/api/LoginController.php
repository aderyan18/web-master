<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Pasien;


class LoginController extends Controller
{
    public function cek(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $post = $request->only('username', 'password');

        if (Auth::attempt($post)) {
            $user = Auth::user();
            $data = Pasien::where('id_register',$post['username'])->first();
            $user['id']= $data['id'];
            if ($user->role == 'user') {
                $response = [
                    'message' => 'Berhasil login',
                    'status' => true,
                    'data' => $user
                ];
                return response()->json($response, Response::HTTP_CREATED);
            } else {
                $response = [
                    'message' => 'aplikasi hanya untuk pasien',
                    'status' => false,
                ];
                return response()->json($response, Response::HTTP_OK);
            }
        } else {
            $response = [
                'message' => 'gagal login',
                'status' => false,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }
}
