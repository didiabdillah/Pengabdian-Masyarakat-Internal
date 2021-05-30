<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class ReviewerController extends Controller
{
    public function index()
    {
        $user = User::where('user_role', '=', 'reviewer')
            ->where('user_id', '!=', Session::get('user_id'))
            ->orderBy('user_name', 'asc')->get();

        return view('reviewer.index', ['user' => $user]);
    }
}
