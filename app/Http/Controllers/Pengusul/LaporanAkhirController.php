<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanAkhirController extends Controller
{
    public function index()
    {
        return view('pengusul.laporan_akhir.index');
    }
}
