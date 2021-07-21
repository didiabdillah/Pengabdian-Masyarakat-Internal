<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use App\Models\Laporan_akhir;
use App\Models\Usulan_pengabdian;
use App\Models\Dokumen_usulan;
use App\Models\Dokumen_rab;
use App\Models\Mitra_sasaran;

class FileController extends Controller
{
    // FILE PREVIEW AND DOWNLOAD
    public function file_download($id, $file_name, $file_category)
    {
        $file_fetch = NULL;
        $file = NULL;
        $file_extension = NULL;
        $file_original_name = NULL;

        if ($file_category == "usulan") {
            $file_fetch = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)
                ->where('dokumen_usulan_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_usulan/" . $file_fetch->dokumen_usulan_hash_name);

            $file_extension = $file_fetch->dokumen_usulan_extension;

            $file_original_name = $file_fetch->dokumen_usulan_original_name;
        } elseif ($file_category == "rab") {
            $file_fetch = Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)
                ->where('dokumen_rab_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_rab/" . $file_fetch->dokumen_rab_hash_name);

            $file_extension = $file_fetch->dokumen_rab_extension;

            $file_original_name = $file_fetch->dokumen_rab_original_name;
        } elseif ($file_category == "mitra") {
            $file_fetch = Mitra_sasaran::join('mitra_file', 'mitra_sasaran.mitra_sasaran_id', '=', 'mitra_file.mitra_file_mitra_sasaran_id')
                ->where('mitra_sasaran.mitra_sasaran_pengabdian_id', $id)
                ->where('mitra_file.mitra_sasaran_file_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_mitra/" . $file_fetch->mitra_sasaran_file_hash_name);

            $file_extension = $file_fetch->mitra_sasaran_file_extension;

            $file_original_name = $file_fetch->mitra_sasaran_file_original_name;
        } elseif ($file_category == "laporan_akhir") {
            $file_fetch = Laporan_akhir::where('laporan_akhir_id', $id)
                ->where('laporan_akhir_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/laporan_akhir/" . $file_fetch->laporan_akhir_hash_name);

            $file_extension = $file_fetch->laporan_akhir_extension;

            $file_original_name = $file_fetch->laporan_akhir_original_name;
        } elseif ($file_category == "template_dokumen") {
            $file_fetch = get_where_local_db_json("template_dokumen.json", "id", $id);

            $file = public_path("assets/file/template_dokumen/" . $file_fetch["hash_name"]);

            $file_extension = $file_fetch["extension"];

            $file_original_name = $file_fetch["original_name"];
        }

        if ($file_fetch) {
            // if ($file_extension == "pdf") {

            $headers = array(
                'Content-Type' => mime_content_type($file),
            );

            return response()->download($file, $file_original_name, $headers);
            // }
        }

        return redirect()->back();
    }

    public function file_preview($id, $file_name, $file_category)
    {
        $file_fetch = NULL;
        $file = NULL;
        $file_extension = NULL;

        if ($file_category == "usulan") {
            $file_fetch = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)
                ->where('dokumen_usulan_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_usulan/" . $file_fetch->dokumen_usulan_hash_name);

            $file_extension = $file_fetch->dokumen_usulan_extension;
        } elseif ($file_category == "rab") {
            $file_fetch = Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)
                ->where('dokumen_rab_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_rab/" . $file_fetch->dokumen_rab_hash_name);

            $file_extension = $file_fetch->dokumen_rab_extension;
        } elseif ($file_category == "mitra") {
            $file_fetch = Mitra_sasaran::join('mitra_file', 'mitra_sasaran.mitra_sasaran_id', '=', 'mitra_file.mitra_file_mitra_sasaran_id')
                ->where('mitra_sasaran.mitra_sasaran_pengabdian_id', $id)
                ->where('mitra_file.mitra_sasaran_file_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/dokumen_mitra/" . $file_fetch->mitra_sasaran_file_hash_name);

            $file_extension = $file_fetch->mitra_sasaran_file_extension;
        } elseif ($file_category == "laporan_akhir") {
            $file_fetch = Laporan_akhir::where('laporan_akhir_id', $id)
                ->where('laporan_akhir_hash_name', $file_name)
                ->first();

            $file = public_path("assets/file/laporan_akhir/" . $file_fetch->laporan_akhir_hash_name);

            $file_extension = $file_fetch->laporan_akhir_extension;
        } elseif ($file_category == "template_dokumen") {
            $file_fetch = get_where_local_db_json("template_dokumen.json", "id", $id);

            $file = public_path("assets/file/template_dokumen/" . $file_fetch["hash_name"]);

            $file_extension = $file_fetch["extension"];

            $file_original_name = $file_fetch["original_name"];
        }

        if ($file_fetch) {
            if ($file_extension == "pdf") {

                $headers = array(
                    'Content-Type' => mime_content_type($file),
                );

                return response()->file($file, $headers);
            } else {
                return redirect()->route('coming_soon');
            }
        }
    }
}
