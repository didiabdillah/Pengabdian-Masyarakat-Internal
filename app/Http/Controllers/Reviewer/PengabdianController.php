<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengabdianController extends Controller
{
    public function index()
    {
        return view('reviewer.pengabdian.index');
    }
}
