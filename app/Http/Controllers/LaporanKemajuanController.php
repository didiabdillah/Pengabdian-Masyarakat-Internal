<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanKemajuanController extends Controller
{
    public function index()
    {
        return view('laporan_kemajuan.index');
    }
}
