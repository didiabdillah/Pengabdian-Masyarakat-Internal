<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $id = Session::get('user_id');
        $user = User::find($id);

        return view('reviewer.home.home_reviewer', ['user' => $user, 'user_id' => $id]);
    }
}
