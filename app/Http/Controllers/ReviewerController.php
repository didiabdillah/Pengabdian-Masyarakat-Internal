<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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

    public function insert()
    {
        $user = User::orderBy('user_name', 'asc')->get();

        return view('reviewer.insert', ['user' => $user]);
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate([
            'name'  => 'required|max:255',
            'email'  => 'required|max:255',
            'password'  => 'required|max:100|min:8',
        ]);

        $id = str_replace('-', '', Str::uuid());
        $name = htmlspecialchars($request->name);
        $email = htmlspecialchars($request->email);
        $password = htmlspecialchars($request->password);
        $image = "default.jpg";

        //check is email exist in DB
        if (User::where('user_email', $email)->where('user_role', 'reviewer')->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Add Failed', //Alert Message 
                'User Email Already Exist' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'user_id' => $id,
            'user_password' => Hash::make($password),
            'user_name' => $name,
            'user_email' => $email,
            'user_role' => 'reviewer',
            'user_image' => $image,
        ];

        //Insert Data
        User::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Add Success', //Alert Message 
            'Reviewer Added' //Sub Alert Message
        );

        return redirect()->route('reviewer');
    }
}
