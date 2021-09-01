@extends('layout.layout_admin')

@section('title', __('id.detail') . ' Pengabdian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>{{__('id.detail')}} Pengabdian</h1>
                </div>
            </div>

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{$back_url}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
                        <!-- <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Nama Ketua Pengusul</th>
                                        <td>: {{$ketua->user_name}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">NIDN</th>
                                        <td>: {{$ketua->user_nidn}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Skema</th>
                                        <td>: {{$usulan->skema_label}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Bidang</th>
                                        <td>: {{$usulan->bidang_label}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Jurusan</th>
                                        <td>: {{$ketua->biodata_jurusan}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Program Studi</th>
                                        <td>: {{$ketua->biodata_program_studi}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Nama Anggota</th>
                                        <td>: @foreach($anggota as $row){{$row->user_name . ", "}}@endforeach</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Lama Kegiatan</th>
                                        <td>: {{$usulan->usulan_pengabdian_lama_kegiatan}} Tahun</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Jumlah Mahasiswa Terlibat</th>
                                        <td>: {{$usulan->usulan_pengabdian_mahasiswa_terlibat}} Orang</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Tahun Usulan</th>
                                        <td>: {{$usulan->usulan_pengabdian_tahun}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- IDENTITAS KETUA -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-success m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-user"></i>
                                            Identitas Pengusul - Ketua
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row m-3">
                                            <div class="col-md-10">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Ketua
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>{{$ketua->user_name}} ({{$ketua->user_nidn}})</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small mb-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-university"></i></span> Institusi :
                                                                        @if($ketua->biodata_institusi)
                                                                        {{$ketua->biodata_institusi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-graduation-cap"></i></span> Program Studi :
                                                                        @if($ketua->biodata_program_studi)
                                                                        {{$ketua->biodata_program_studi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email :
                                                                        @if($ketua->user_email)
                                                                        {{$ketua->user_email}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-user-graduate"></i></span> Jenjang Pendidikan :
                                                                        @if($ketua->biodata_pendidikan)
                                                                        {{$ketua->biodata_pendidikan}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                <h6 class="text-muted ">
                                                                    <b>Tugas: </b>
                                                                    @if($ketua->anggota_pengabdian_tugas)
                                                                    {{$ketua->anggota_pengabdian_tugas}}
                                                                    @else
                                                                    {{"Leader"}}
                                                                    @endif
                                                                </h6>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="{{URL::asset('assets/img/profile/' . $ketua->user_image)}}" alt="user-avatar" class="img-circle img-fluid" style="width: 100px; height: 100px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- DOKUMEN USULAN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-warning m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-pdf"></i>
                                            Dokumen usulan
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="m-3">
                                            <label for="dokumen_usulan"><i class="fas fa-file-pdf fa-2x"></i> Dokumen Usulan</label>
                                            <h6>File Usulan : @if($dokumen_usulan){{$dokumen_usulan->dokumen_usulan_original_name}}@else{{"-"}}@endif</h6>
                                            <h6>Tanggal Unggah : @if($dokumen_usulan){{Carbon\Carbon::parse($dokumen_usulan->updated_at)->isoFormat('D MMMM Y')}}@else{{"-"}}@endif</h6>
                                            <h6>Ukuran File : @if($dokumen_usulan){{$dokumen_usulan->dokumen_usulan_file_size . " KB"}}@else{{"-"}}@endif</h6>

                                            @if($dokumen_usulan)
                                            <a href="{{route('file_preview', [$id, $dokumen_usulan->dokumen_usulan_hash_name, 'usulan'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                            <a href="{{route('file_download', [$id, $dokumen_usulan->dokumen_usulan_hash_name, 'usulan'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- IDENTITAS ANGGOTA -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-danger m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-users"></i>
                                            Identitas Pengusul - Anggota
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach($anggota as $row)
                                        <div class="row m-3">
                                            <div class="col-md-10">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        @if($row->anggota_pengabdian_role == 'anggota1')
                                                        {{"Anggota Pengusul 1"}}
                                                        @elseif($row->anggota_pengabdian_role == 'anggota2')
                                                        {{"Anggota Pengusul 2"}}
                                                        @endif
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>{{$row->user_name}} ({{$row->user_nidn}})</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small mb-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-university"></i></span> Institusi :
                                                                        @if($row->biodata_institusi)
                                                                        {{$row->biodata_institusi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-graduation-cap"></i></span> Program Studi :
                                                                        @if($row->biodata_program_studi)
                                                                        {{$row->biodata_program_studi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                <h6 class="text-muted ">
                                                                    <b>Tugas: </b>
                                                                    @if($row->anggota_pengabdian_tugas)
                                                                    {{$row->anggota_pengabdian_tugas}}
                                                                    @else
                                                                    {{"-"}}
                                                                    @endif
                                                                </h6>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="{{URL::asset('assets/img/profile/' . $row->user_image)}}" alt="user-avatar" class="img-circle img-fluid" style="width: 100px; height: 100px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- LUARAN DAN TARGET CAPAIAN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-alt"></i>
                                            Luaran Dan Target Capaian
                                        </h3>
                                    </div>
                                    <div class="card-body">

                                        <!-- LUARAN WAJIB -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card card-primary m-2 card-outline">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <i class="fas fa-file-alt"></i>
                                                            Luaran Wajib
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2">

                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($luaran_wajib as $data)
                                                                <tr>
                                                                    <td>
                                                                        Tahun : {{$data->usulan_luaran_pengabdian_tahun}}
                                                                    </td>
                                                                    <td>
                                                                        {{$loop->iteration}}. <b>- {{$data->usulan_luaran_pengabdian_kategori}}</b>
                                                                        <br>

                                                                        <b>{{$data->usulan_luaran_pengabdian_jenis}} (<span class="badge badge-warning">{{$data->usulan_luaran_pengabdian_status}}</span>)</b>

                                                                        <h5>{{$data->usulan_luaran_pengabdian_rencana}}</h5>

                                                                    </td>

                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- LUARAN TAMBAHAN -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card card-secondary m-2 card-outline">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <i class="fas fa-file-alt"></i>
                                                            Luaran Tambahan
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <th colspan="2">

                                                                </th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($luaran_tambahan as $data)
                                                                <tr>
                                                                    <td>
                                                                        Tahun : {{$data->usulan_luaran_pengabdian_tahun}}
                                                                    </td>
                                                                    <td>
                                                                        {{$loop->iteration}}. <b>- {{$data->usulan_luaran_pengabdian_kategori}}</b>
                                                                        <br>

                                                                        <b>{{$data->usulan_luaran_pengabdian_jenis}} (<span class="badge badge-warning">{{$data->usulan_luaran_pengabdian_status}}</span>)</b>

                                                                        <h5>{{$data->usulan_luaran_pengabdian_rencana}}</h5>

                                                                    </td>

                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- DOKUMEN RAB -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-dark m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-pdf"></i>
                                            Dokumen RAB
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="m-3">
                                            <label for="dokumen_rab"><i class="fas fa-file-pdf fa-2x"></i> Dokumen Rencana Anggaran Biaya</label>
                                            <h6>File RAB : @if($dokumen_rab){{$dokumen_rab->dokumen_rab_original_name}}@else{{"-"}}@endif</h6>
                                            <h6>Tanggal Unggah : @if($dokumen_rab){{Carbon\Carbon::parse($dokumen_rab->updated_at)->isoFormat('D MMMM Y')}}@else{{"-"}}@endif</h6>
                                            <h6>Ukuran File : @if($dokumen_rab){{$dokumen_rab->dokumen_rab_file_size . " KB"}}@else{{"-"}}@endif</h6>

                                            @if($dokumen_rab)
                                            <a href="{{route('file_preview', [$id, $dokumen_rab->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                            <a href="{{route('file_download', [$id, $dokumen_rab->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- DOKUMEN PENDUKUNG -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-pdf"></i>
                                            Dokumen Pendukung
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">No</th>
                                                    <th>Tipe Mitra</th>
                                                    <th>Nama Pimpinan Mitra</th>
                                                    <th>Kontribusi Pendanaan</th>
                                                    <th>Dokumen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($mitra_sasaran->count() != 0)
                                                @foreach($mitra_sasaran as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>
                                                        <b>
                                                            @if($data->mitra_sasaran_tipe_mitra == "kelompok_masyarakat")
                                                            {{"Kelompok Masyarakat"}}
                                                            @elseif($data->mitra_sasaran_tipe_mitra == "umkm")
                                                            {{"UMKM"}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </b>
                                                    </td>
                                                    <td>
                                                        {{$data->mitra_sasaran_nama_pimpinan_mitra}}
                                                    </td>
                                                    <td>
                                                        Rp. {{$data->mitra_sasaran_kontribusi_pendanaan_mitra}}
                                                    </td>
                                                    <td>
                                                        @php
                                                        $doc = $data->mitra_file()->where('mitra_file_mitra_sasaran_id', $data->mitra_sasaran_id)->get();
                                                        @endphp

                                                        @if($doc->count() > 0)
                                                        @foreach($doc as $row)
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file-pdf fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : {{$row->mitra_sasaran_file_original_name}}
                                                                <br>
                                                                Tanggal Unggah : {{Carbon\Carbon::parse($row->mitra_sasaran_file_date)->isoFormat('D MMMM Y')}}
                                                                <br>
                                                                <a href="{{route('file_preview', [$id, $row->mitra_sasaran_file_hash_name, 'mitra'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                                                <a href="{{route('file_download', [$id, $row->mitra_sasaran_file_hash_name, 'mitra'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file-pdf fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : -
                                                                <br>
                                                                Tanggal Unggah : -
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td class="text-center" colspan="5">Mitra Sasaran Kosong</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>

        <!--Content -->
        @if($penilaian_monev)
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <b>Ulasan Hasil Monev Pengabdian</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- NILAI MONEV -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">KRITERIA</th>
                                    <th scope="col">SKOR</th>
                                    <th scope="col">BOBOT</th>
                                    <th scope="col">NILAI</th>
                                    <th scope="col">JUSTIFIKASI PENILAIAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- NO 1 -->
                                <tr>
                                    <th class="text-center" scope="row">1</th>
                                    <td>
                                        <b>Kontribusi Pihak Ketiga</b>
                                        <br>
                                        (Dukungan dana dan/atau sarana dan prasarana)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["1"]}}
                                    </td>
                                    <td class="text-center">10</td>
                                    <td class="text-center">
                                        {{$nilai["1"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["1"]}}
                                    </td>
                                </tr>

                                <!-- NO 2A -->
                                <tr>
                                    <th class="text-center" scope="row" rowspan="6">2</th>
                                    <td>
                                        <b>Kegiatan PM</b>
                                        (Pilih butir-butir yang sesuai dengan kegiatan)
                                        <br>
                                        a. Program Capacity Building
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2a"]}}
                                    </td>
                                    <td rowspan="6" class="text-center">15</td>
                                    <td class="text-center">
                                        {{$nilai["2a"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2a"]}}
                                    </td>
                                </tr>

                                <!-- NO 2B -->
                                <tr>
                                    <td>
                                        b. Penerapan teknologi tepat guna
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2b"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2b"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2b"]}}
                                </tr>

                                <!-- NO 2C -->
                                <tr>
                                    <td>
                                        c. Problem Solving
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2c"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2c"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2c"]}}
                                    </td>
                                </tr>

                                <!-- NO 2D -->
                                <tr>
                                    <td>
                                        d. Difusi hasil-hasil penelitian
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2d"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2d"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2d"]}}
                                    </td>
                                </tr>

                                <!-- NO 2E -->
                                <tr>
                                    <td>
                                        e. Peningkatan daya saing UKM
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2e"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2e"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2e"]}}
                                    </td>
                                </tr>

                                <!-- NO 2F -->
                                <tr>
                                    <td>
                                        f. Komersialisasi hasil-hasil penelitian
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2f"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2f"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2f"]}}
                                    </td>
                                </tr>

                                <!-- NO 3 -->
                                <tr>
                                    <th class="text-center" scope="row">3</th>
                                    <td>
                                        <b>Peningkatan Potensi Daerah/Mitra</b>
                                        <br>
                                        (Keberhasilan program dalam memanfaatkan potensi daerah,
                                        <br>
                                        keserasian potensi daerah dan aktivitas program,
                                        <br>
                                        ketepatan program terhadap persoalan yang dihadapi mitra)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["3"]}}
                                    </td>
                                    <td class="text-center">25</td>
                                    <td class="text-center">
                                        {{$nilai["3"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["3"]}}
                                    </td>
                                </tr>

                                <!-- NO 4 -->
                                <tr>
                                    <th class="text-center" scope="row">4</th>
                                    <td>
                                        <b>Partisipasi Masyarakat</b>
                                        <br>
                                        (Tingkat partisipasi masyarakat/mitra dalam pelaksanaan program,
                                        <br>
                                        posisi strategis masyarakat sebagai mitra, keterpaduan dan kebersamaan
                                        <br>
                                        dengan PT dengan Lembaga Pemerintah atau institusi setempat)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["4"]}}
                                    </td>
                                    <td class="text-center">25</td>
                                    <td class="text-center">
                                        {{$nilai["4"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["4"]}}
                                    </td>
                                </tr>

                                <!-- NO 5 -->
                                <tr>
                                    <th class="text-center" scope="row">5</th>
                                    <td>
                                        <b>Mutu Pelaksanaan Program</b>
                                        <br>
                                        (Integritas, dedikasi dan kekompakan tim,
                                        <br>
                                        level penerimaan masyarakat, keberlanjutan)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["5"]}}
                                    </td>
                                    <td class="text-center">15</td>
                                    <td class="text-center">
                                        {{$nilai["5"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["5"]}}
                                    </td>
                                </tr>

                                <!-- NO 6 -->
                                <tr>
                                    <th class="text-center" scope="row">6</th>
                                    <td>
                                        <b>Lokasi Kegiatan</b>
                                        <br>
                                        (kemudahan pencapaian, intensitas kebersamaan di kawasan)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["6"]}}
                                    </td>
                                    <td class="text-center">10</td>
                                    <td class="text-center">
                                        {{$nilai["6"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["6"]}}
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th colspan="2">Total</th>
                                    <th>{{$skor["1"] + $skor["2a"] + $skor["2b"] + $skor["2c"] + $skor["2d"] + $skor["2e"] + $skor["2f"] + $skor["3"] + $skor["4"] + $skor["5"] + $skor["6"]}}</th>
                                    <th>100</th>
                                    <th>{{$nilai["1"] + $nilai["2a"] + $nilai["2b"] + $nilai["2c"] + $nilai["2d"] + $nilai["2e"] + $nilai["2f"] + $nilai["3"] + $nilai["4"] + $nilai["5"] + $nilai["6"]}}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="row mt-5 mx-2">
                            <h6>
                                <b>Catatan Selama Peninjauan :</b>
                                <br>
                                @if($penilaian_monev->penilaian_monev_catatan)
                                {{$penilaian_monev->penilaian_monev_catatan}}
                                @else
                                {{"-"}}
                                @endif
                            </h6>
                        </div>

                        <div class="row mx-2 mt-3">
                            <div class="col align-self-start"></div>
                            <div class="col align-self-center"></div>
                            <div class="col align-self-end">
                                <h6>
                                    Indramayu, {{Carbon\Carbon::parse($penilaian_monev->updated_at)->isoFormat('D MMMM Y')}}
                                    <br>
                                    Pemantau,
                                    <br>
                                    <img src="{{URL::asset('assets/file/tanda_tangan/' . $penilaian_monev->penilaian_monev_tanda_tangan)}}" alt="" style="width: 300px;">
                                    <br>
                                    <b>{{$usulan->user_name}}</b>
                                    <br>
                                    NIDN {{$usulan->user_nidn}}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        @endif
    </section>
</div>
<!-- /.content -->


@endsection

@push('plugin')
<script>
    // --------------
    // Delete Button
    // --------------
    $('.btn-remove').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

<!-- DataTables  & Plugins -->
<script src="{{URL::asset('assets/js/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(function() {

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pagingType": "simple_numbers",
            "language": {
                "url": "{{URL::asset('assets/js/datatables/Indonesian.json')}}"
            },
        });
    });
</script>
@endpush