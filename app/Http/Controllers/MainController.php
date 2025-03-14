<?php

namespace App\Http\Controllers;

use App\Jobs\ExportPdf;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

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
            ->delay(now()->addSeconds(15))
            ; // jalan di background

        return redirect()->route('notifikasi');

    }

    public function getUser(){
        // $cacheKey = 'user-all';
        // $user = null;

        // if(Cache::has($cacheKey)){
        //     $user = Cache::get($cacheKey);
        // } else {
        //     $user = User::query()
        //         ->select('id', 'name', 'email', 'created_at')
        //         ->get();
        //     Cache::add($cacheKey, $user, 60);
        // }


        // return view('user', compact('user'));
        return view('user');
    }

    function addDummyUser(){
        User::factory()
            ->count(5)
            ->create();
        Cache::forget('user-all');
        return redirect()->route('get-user');
    }

    function ajaxUser(){
        $user = User::query()->select('name', 'email', 'created_at');

        return DataTables::of($user)
            ->make(true);
    }
}
