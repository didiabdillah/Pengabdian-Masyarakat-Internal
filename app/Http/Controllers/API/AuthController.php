<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Rules\Captcha;

use App\Models\User;
use App\Models\Forgot_token;

class AuthController extends Controller
{
    public function post_login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::firstWhere('user_email', $email);

        //Check Email Account Available
        if ($user) {
            //Check Email Match
            if ($email == $user->user_email) {
                //Check Password Match
                if (Hash::check($password, $user->user_password)) {
                    return $user;
                } else {
                    return " Password Salah";
                }
            } else {
                return "Email Salah";
            }
        } else {
            return "Akun Tidak Terdaftar";
        }

        return "Something Wrong";
    }
}
