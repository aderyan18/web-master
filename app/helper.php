<?php

use Carbon\Carbon;

function tes($a)
{
    $now = Carbon::now(); // Tanggal sekarang
    $b_day = Carbon::parse($a); // Tanggal Lahir
    $age = $b_day->diffInYears($now);  // Menghitung umur
    echo $age . " Tahun";
}

function tambah20($a)
{
    $waktu = strtotime($a);
    $tambah = strtotime('+20 minutes', $waktu);
    return date('H:i:s', $tambah);
}
function tambah10($a)
{
    $waktu = strtotime($a);
    $tambah = strtotime('+10 minutes', $waktu);
    return date('H:i:s', $tambah);
}

// function batas()
// {
//     //cek batas waktu
//     $waktusekarang = date('H:i:s');
//     $tutup = date('H:i:s', strtotime('20:30:00'));
//     if ($waktusekarang > $tutup) {
//         // return back()->with('gagal', 'reservasi sudah tutup');
//         dd('tes');
//     } else {
//         dd('tes');
//     }
// }
