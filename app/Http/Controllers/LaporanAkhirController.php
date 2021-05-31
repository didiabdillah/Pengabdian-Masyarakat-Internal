<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanAkhirController extends Controller
{
    public function index()
    {
        return view('laporan_akhir.index');
    }
}
