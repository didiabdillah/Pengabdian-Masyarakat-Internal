<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class ProposerController extends Controller
{
    public function index()
    {
        $user = User::where('user_role', '=', 'pengusul')
            ->where('user_id', '!=', Session::get('user_id'))
            ->orderBy('user_name', 'asc')->get();

        return view('proposer.index', ['user' => $user]);
    }
}
