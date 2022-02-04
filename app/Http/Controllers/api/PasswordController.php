<?php

namespace App\Http\Controllers\api;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function change(Request $request, $id)
    {
        $user = Akun::where('username', $id)->first();
        $password = $user['password'];
        $lama = $request['password_lama'];

        if (Hash::check($lama, $password)) {
            if (strcmp($request['password_baru'], $request['password_confirm']) == 0) {
                $akun = Akun::where('username', $id)->update([
                    'password' => bcrypt($request['password_baru']),
                ]);
                $response = [
                    'message' => 'ganti password berhasil',
                    'status' => true,
                ];
                return response()->json($response, Response::HTTP_OK);
            } else {
                $response = [
                    'message' => 'password confirm salah',
                ];
                return response()->json($response, Response::HTTP_OK);
            }
        } else {
            $response = [
                'message' => 'password lama salah',
                'status' => $user,
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }
}
