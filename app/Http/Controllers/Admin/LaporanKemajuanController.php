<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanKemajuanController extends Controller
{
    public function index()
    {
        return view('admin.laporan_kemajuan.index');
    }
}
