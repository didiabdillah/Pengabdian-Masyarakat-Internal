<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengabdianController extends Controller
{
    public function usulan_pengabdian()
    {
        return view('admin.pengabdian.usulan');
    }

    public function pelaksanaan_pengabdian()
    {
        return view('admin.pengabdian.pelaksanaan');
    }
}
