<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $role = Session::get('user_role');

        if ($role == 'admin') {
            echo "Admin";
        } else if ($role == 'reviewer') {
            echo "Reviewer";
        } else if ($role == 'pengusul') {
            echo "Pengusul";
        }
    }
}
