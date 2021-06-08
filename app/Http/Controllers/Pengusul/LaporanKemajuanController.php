<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanKemajuanController extends Controller
{
    public function index()
    {
        return view('pengusul.laporan_kemajuan.index');
    }

    public function insert()
    {
        return view('pengusul.laporan_kemajuan.insert');
    }

    // public function store(Request $request)
    // {
    //     // Input Validation
    //     $request->validate(
    //         [
    //             'file' => 'required',
    //             'file.*'  => 'required|mimes:doc,docx|max:10000',
    //         ],
    //         [
    //             'file.*.mimes' => 'File harus bertipe:doc, docx'
    //         ]
    //     );

    //     $user_id = $request->session()->get('user_id');
    //     $destination = "assets/file/laporan_kemajuan/";

    //     //Insert Data
    //     $data_content = [
    //         'content_title' => $title,
    //         'content_note' => $note,
    //         'content_type' => $type,
    //         'content_date' => $date,
    //         'content_is_present' => $is_present,
    //         'content_category' => $category,
    //         'content_user_id' => $user_id,
    //         'content_status' => __('content_status.content_status_process'),
    //     ];
    //     $query = Content::create($data_content);

    //     // insert file
    //     foreach ($request->file() as $files) {
    //         foreach ($files as $file) {
    //             $hashName = $file->hashName();
    //             $originalName = $file->getClientOriginalName();
    //             $extension = $file->getClientOriginalExtension();

    //             $data = [
    //                 'content_file_content_id' => $query->content_id,
    //                 'content_file_original_name' => $file->getClientOriginalName(),
    //                 'content_file_hash_name' => $file->hashName(),
    //                 'content_file_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
    //                 'content_file_extension' => $file->getClientOriginalExtension(),
    //             ];

    //             if ($file->getClientOriginalExtension() == "docx" || $file->getClientOriginalExtension() == "doc") {

    //                 $file->move($destination_word, $file->hashName());
    //             } else {

    //                 $file->move($destination_img, $file->hashName());
    //             }

    //             Content_file::create($data);
    //         }
    //     }

    //     //change value From Missed Upload Data
    //     if ($is_present == false) {
    //         $missed_upload_total = Missed_upload::where('missed_upload_user_id', $user_id)
    //             ->where('missed_upload_date', $request->date)->first()->missed_upload_total;

    //         Missed_upload::where('missed_upload_user_id', $user_id)
    //             ->where('missed_upload_date', $request->date)
    //             ->update([
    //                 'missed_upload_total' => $missed_upload_total - 1
    //             ]);
    //     }

    //     //Flash Message
    //     flash_alert(
    //         __('alert.icon_success'), //Icon
    //         'Add Success', //Alert Message 
    //         'New Content Added' //Sub Alert Message
    //     );

    //     return redirect()->route('content');
    // }
}
