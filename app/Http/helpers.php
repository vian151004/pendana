<?php

use Illuminate\Support\Facades\Storage;


if (!function_exists('upload')) {
    function upload($directory, $file, $filename = "")
    {
        $extensi  = $file->getClientOriginalExtension();
        $filename = "{$filename}_" . date('Ymdhis') . ".{$extensi}";

        Storage::disk('public')->putFileAs("/$directory", $file, $filename);

        return "/$directory/$filename";
    }
}

if (!function_exists('format_uang')) {
    function format_uang($angka) {
        return number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tgl, $tampil_hari = false) {
        $nama_hari = array(
            'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'
        );
        $nama_bulan = array(
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );

        $tahun  = substr($tgl, 0, 4);
        $bulan  = $nama_bulan[(int) substr($tgl, 5, 2)];
        $tanggal  = substr($tgl, 8, 2);
        $text   = '';

        if ($tampil_hari) {
            $urutan_hari = date('w', mktime(0,0,0, substr($tgl, 5, 2), $tanggal, $tahun));
            $hari        = $nama_hari[$urutan_hari];
            $text        .= "$hari, $tanggal $bulan $tahun";
        } else {
            $text        .="$tanggal $bulan $tahun";
        }

        return $text;
    }
}