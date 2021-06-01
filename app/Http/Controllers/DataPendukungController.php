<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DataPendukungController extends Controller
{
    public function index()
    {
        return view('data_pendukung.index');
    }
}
