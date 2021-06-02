<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengabdianController extends Controller
{
    public function index()
    {
        return view('pengusul.pengabdian.index');
    }
}
