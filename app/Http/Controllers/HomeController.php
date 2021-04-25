<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $role = Session::get('user_role');
        $userId = Session::get('user_id');

        if ($role == 'admin') {
            return view('home.admin.home_admin');
        } else if ($role == 'reviewer') {
            return view('home.reviewer.home_reviewer');
        } else if ($role == 'pengusul') {
            return view('home.pengusul.home_pengusul');
        }
    }
}
