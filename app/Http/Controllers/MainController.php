<?php

namespace App\Http\Controllers;

use App\Jobs\ExportPdf;
use Illuminate\Http\Request;
use App\Models\Notifikasi;

class MainController extends Controller
{
    public function notifikasi(){
        $notifikasi = Notifikasi::all();
        return view('notifikasi', compact('notifikasi'));

    }
    public function exportPdf(Request $request)
    {
        // Jalankan job untuk melakukan
        // export PDF. Job ini mungkin akan
        // prosesnya memakan waktu yang lama
        // Jadi kita akan menggunakan queue


        $idNotifikasi = Notifikasi::insertGetId([
            'title' => 'Export PDF',
            'status' => 'running',
        ]);

        ExportPdf::dispatch($idNotifikasi)
            ->delay(now()->addMinutes(1))
            ; // jalan di background

        return 'Export PDF sedang diproses';

    }
}
