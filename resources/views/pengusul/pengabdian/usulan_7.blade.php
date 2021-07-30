@extends('layout.layout_pengusul')

@section('title', 'Tambah Usulan Pengabdian')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

@section('page')

@include('layout.flash_alert')

@push('style')
<!-- BS Stepper -->
<link rel="stylesheet" href="{{URL::asset('assets/css/bs-stepper/css/bs-stepper.min.css')}}">

@endpush

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content mt-3">

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cek Sebelum Kirim Usulan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body p-0">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <div class="step" data-target="#identitas">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="identitas" id="identitas-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Identitas Usulan</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#substansi">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="substansi" id="substansi-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Substansi Usulan</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step " data-target="#rab">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="rab" id="rab-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">RAB</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step " data-target="#dokumen-pendukung">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="dokumen-pendukung" id="dokumen-pendukung-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Dokumen Pendukung</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step active" data-target="#kirim">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="kirim" id="kirim-trigger">
                                        <span class="bs-stepper-circle">5</span>
                                        <span class="bs-stepper-label">Kirim Usulan</span>
                                    </button>
                                </div>
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
                                                <a href="{{route('file_preview', [$id, $dokumen_usulan->dokumen_usulan_hash_name, 'usulan'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                                <a href="{{route('file_download', [$id, $dokumen_usulan->dokumen_usulan_hash_name, 'usulan'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
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
                                                <a href="{{route('file_preview', [$id, $dokumen_rab->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                                <a href="{{route('file_download', [$id, $dokumen_rab->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
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
                                                                    <a href="{{route('file_preview', [$id, $row->mitra_sasaran_file_hash_name, 'mitra'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                                                    <a href="{{route('file_download', [$id, $row->mitra_sasaran_file_hash_name, 'mitra'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
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
                        <div class="card-footer">
                            <form action="{{route('pengusul_pengabdian_submit', $id)}}" method="POST" class="form-inline form-horizontal">
                                @csrf
                                <div class="card-body">
                                    <a href="{{route('pengusul_pengabdian_usulan', [$page-1, $id])}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>

                                    <button type="submit" class="btn btn-primary ml-auto float-right btn-submit"><i class="fas fa-paper-plane"></i> Kirim Usulan</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>

    </section>

</div>

@endsection

@push('plugin')
<script>
    // --------------
    // Delete Button
    // --------------
    $('.btn-submit').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal.fire({
            title: 'Sudah yakin Untuk Di Submit?',
            text: "Setelah Di Submit Tidak Dapat Di Ubah Lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kirim!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

<!-- BS-Stepper -->
<script src="{{URL::asset('assets/js/bs-stepper/js/bs-stepper.min.js')}}"></script>

<script>
    // BS-Stepper Init
    // document.addEventListener('DOMContentLoaded', function() {
    //     window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    // })
</script>
@endpush