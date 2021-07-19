<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\Biodata;

class ReviewerController extends Controller
{
    public function index()
    {
        $user = User::where('user_role', '=', 'reviewer')
            ->where('user_id', '!=', Session::get('user_id'))
            ->orderBy('user_name', 'asc')->get();

        return view('admin.reviewer.index', ['user' => $user]);
    }

    public function insert()
    {
        $user = User::orderBy('user_name', 'asc')->get();

        return view('admin.reviewer.insert', ['user' => $user]);
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate([
            'nidn'  => 'required|max:255',
            'name'  => 'required|max:255',
            'email'  => 'required|max:255',
            'password'  => 'required|max:100|min:8',
        ]);

        $id = hexdec(uniqid()) . strtotime(now());
        $nidn = htmlspecialchars($request->nidn);
        $name = htmlspecialchars($request->name);
        $email = htmlspecialchars($request->email);
        $password = htmlspecialchars($request->password);
        $image = "default.jpg";

        //check is email exist in DB
        if (User::where('user_email', $email)->where('user_role', 'reviewer')->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Email Sudah Terdaftar' //Sub Alert Message
            );


            return redirect()->back();
        }

        $data = [
            'user_id' => $id,
            'user_password' => Hash::make($password),
            'user_nidn' => $nidn,
            'user_name' => $name,
            'user_email' => $email,
            'user_role' => 'reviewer',
            'user_image' => $image,
        ];

        //Insert Data
        $query = User::create($data);

        $data_biodata = [
            'biodata_user_id' => $query->user_id
        ];

        Biodata::create($data_biodata);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Reviewer Ditambahkan' //Sub Alert Message
        );


        return redirect()->route('admin_reviewer');
    }

    public function edit($id)
    {
        $user = User::where('user_id', $id)->first();

        return view('admin.reviewer.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        if (htmlspecialchars($request->password) != NULL) {
            $request->validate([
                'nidn'  => 'required|max:255',
                'name'  => 'required|max:255',
                'email'  => 'required|max:255',
                'password'  => 'max:100|min:8',
            ]);
        } else {
            $request->validate([
                'nidn'  => 'required|max:255',
                'name'  => 'required|max:255',
                'email'  => 'required|max:255',
            ]);
        }

        $user = User::where('user_id', $id)->first();

        $nidn = htmlspecialchars($request->nidn);
        $name = htmlspecialchars($request->name);
        $email = htmlspecialchars($request->email);
        $password = (htmlspecialchars($request->password) != NULL) ? Hash::make($request->password) : $user->user_password;
        $active = ($request->active == 'on') ? true : false;
        $suspend = ($request->suspend == 'on') ? true : false;

        //check is Email exist in DB
        if (User::where('user_email', $email)->where('user_role', 'reviewer')->where('user_id', '!=', $user->user_id)->count() > 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Email Sudah Terdaftar' //Sub Alert Message
            );

            return redirect()->back();
        }

        $data = [
            'user_nidn' => $nidn,
            'user_password' => $password,
            'user_name' => $name,
            'user_email' => $email,
            'user_active' => $active,
            'user_ban' => $suspend,
        ];

        //Update Data
        User::where('user_id', $id)
            ->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Reviewer Diperbaharui' //Sub Alert Message
        );

        return redirect()->route('admin_reviewer');
    }

    public function destroy($id)
    {
        $destination = "assets/img/profile/";

        $imageOld =  User::where('user_id', $id)->first();
        $image_path = public_path($destination . $imageOld->user_image);

        User::destroy('user_id', $id);

        if ($imageOld->user_image != "default.jpg") {
            File::delete($image_path);
        }

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Reviewer Terhapus' //Sub Alert Message
        );

        return redirect()->route('admin_reviewer');
    }
}
