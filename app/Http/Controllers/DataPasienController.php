<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Akun;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;


class DataPasienController extends Controller
{
    public function show()
    {
        $pasien = Pasien::all();
        return view('admin.datapasien', ['pasien' => $pasien]);
    }

    public function create(Request $request)
    {
        $post = $request->all();
        $data = Pasien::max('id') + 1;
        if ($post['jenis_kelamin'] == 'laki-laki') {
            $kode = 10000 + $data;
        } else {
            $kode = 20000 + $data;
        }
        $tahun = date('Y');
        $tahun = (string) $tahun;
        $post['id_register'] = 1 . $tahun . $kode;
        Pasien::create($post);
        // $now = Carbon::now();
        // $bday = $post[2];
        // $b= Carbon::parse($bday);
        // $post['umur']=$b->diffInYears($now);
        $user['name'] = $post['nama'];
        $user['username'] = $post['id_register'];
        $user['password'] = bcrypt($post['id_register']);
        $user['password_default'] = bcrypt($post['id_register']);
        $user['role'] = 'user';
        Akun::create($user);

        $post['id'] = $data;
        return back()->with('register', 'tess')->with(['post' => $post]);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $post = Pasien::where($where)->first();
        return response()->json($post);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        Pasien::find($data['id'])->update($data);
        return back()->with('berhasil', 'Edit Data Berhasil');
    }

    public function delete($id)
    {

        Pasien::find($id)->delete();
        return back()->with('berhasil', 'Delete Data Berhasil');
    }

    public function cetak_PDF($id)
    {
        $where = array('id' => $id);
        $pasien = Pasien::where($where)->first();
        $pdf = PDF::loadview('pdf.kartu_pasien', ['pasien' => $pasien])->setPaper('A5', 'landscape');
        $namafile = "kartu pasien " . $pasien['nama'] . ".pdf";
        return $pdf->stream('kartupasien.pdf');
    }

    public function kartu($id)
    {
        $where = array('id' => $id);
        $post = Pasien::where($where)->first();
        $now = Carbon::now(); // Tanggal sekarang
        $b_day = Carbon::parse($post['tanggal_lahir']); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur
        // $post['tanggal_lahir'] = $age;
        $post['tanggal_lahir'] = date('d F Y', strtotime($post['tanggal_lahir']));

        return response()->json($post);
    }
}
