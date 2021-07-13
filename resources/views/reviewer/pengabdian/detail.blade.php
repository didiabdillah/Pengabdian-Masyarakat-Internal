@extends('layout.layout_reviewer')

@section('title', 'Detail Usulan Pengabdian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Detail Usulan Pengabdian</h1>
                </div>
            </div>

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('reviewer_pengabdian')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <a href="{{route('reviewer_pengabdian_nilai', $id)}}" class="btn btn-success ml-auto float-right"><i class="fas fa-pencil-alt"></i> Nilai Usulan</a>
                        <!-- <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> -->
                    </div>
                    <div class="card-body">

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
                                                                        <span class="fa-li"><i class="fas fa-lg fa-university"></i></span>
                                                                        @if($ketua->biodata_institusi)
                                                                        {{$ketua->biodata_institusi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-graduation-cap"></i></span>
                                                                        @if($ketua->biodata_program_studi)
                                                                        {{$ketua->biodata_program_studi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span>
                                                                        @if($ketua->user_email)
                                                                        {{$ketua->user_email}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-user-graduate"></i></span>
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
                                                                    {{"-"}}
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
                                            <a href="{{route('reviewer_pengabdian_file_preview', [$id, $dokumen_usulan->dokumen_usulan_hash_name, 'usulan'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                            <a href="{{route('reviewer_pengabdian_file_download', [$id, $dokumen_usulan->dokumen_usulan_hash_name, 'usulan'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
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
                                                                        <span class="fa-li"><i class="fas fa-lg fa-university"></i></span>
                                                                        @if($row->biodata_institusi)
                                                                        {{$row->biodata_institusi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-graduation-cap"></i></span>
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
                                                <div class="card m-2">
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
                                                                        @if($jumlah_luaran_wajib = 4)
                                                                        <h5><span class="badge badge-primary">Isi Luaran Wajib Sudah Lengkap</span></h5>
                                                                        @else
                                                                        <h5><span class="badge badge-danger">Isi Luaran Wajib Belum Lengkap</span></h5>
                                                                        @endif
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <h5>Tahun 1 :</h5>
                                                                    </td>

                                                                    <td>
                                                                        1. <b>- Publikasi di prosiding seminar nasional ber ISBN</b>
                                                                        <br>
                                                                        @if($wajib1)
                                                                        @if($wajib1->usulan_luaran_pengabdian_jenis && $wajib1->usulan_luaran_pengabdian_status)
                                                                        <b>{{$wajib1->usulan_luaran_pengabdian_jenis}} (<span class="badge badge-warning">{{$wajib1->usulan_luaran_pengabdian_status}}</span>)</b>
                                                                        @endif
                                                                        @if($wajib1->usulan_luaran_pengabdian_rencana)
                                                                        <h5>{{$wajib1->usulan_luaran_pengabdian_rencana}}</h5>
                                                                        @else
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                        @else
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>

                                                                    </td>

                                                                    <td>
                                                                        @if($wajib2)
                                                                        2. <b>- {{$wajib2->usulan_luaran_pengabdian_kategori}}, ...</b>
                                                                        <br>
                                                                        @if($wajib2->usulan_luaran_pengabdian_jenis && $wajib2->usulan_luaran_pengabdian_status)
                                                                        <b>{{$wajib2->usulan_luaran_pengabdian_jenis}} (<span class="badge badge-warning">{{$wajib2->usulan_luaran_pengabdian_status}}</span>)</b>
                                                                        @endif
                                                                        @if($wajib2->usulan_luaran_pengabdian_rencana)
                                                                        <h5>{{$wajib2->usulan_luaran_pengabdian_rencana}}</h5>
                                                                        @else
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                        @else
                                                                        2. <b>- Publikasi di media massa, ...</b>
                                                                        <br>
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>

                                                                    </td>

                                                                    <td>
                                                                        3. <b>- Video pelaksanaan kegiatan</b>
                                                                        <br>
                                                                        @if($wajib3)
                                                                        @if($wajib3->usulan_luaran_pengabdian_jenis && $wajib3->usulan_luaran_pengabdian_status)
                                                                        <b>{{$wajib3->usulan_luaran_pengabdian_jenis}} (<span class="badge badge-warning">{{$wajib3->usulan_luaran_pengabdian_status}}</span>)</b>
                                                                        @endif
                                                                        @if($wajib3->usulan_luaran_pengabdian_rencana)
                                                                        <h5>{{$wajib3->usulan_luaran_pengabdian_rencana}}</h5>
                                                                        @else
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                        @else
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>

                                                                    </td>

                                                                    <td>
                                                                        4. <b>- Peningkatan pemberdayaan mitra,...</b>
                                                                        <br>
                                                                        @if($wajib4)
                                                                        @if($wajib4->usulan_luaran_pengabdian_jenis && $wajib4->usulan_luaran_pengabdian_status)
                                                                        <b>{{$wajib4->usulan_luaran_pengabdian_jenis}} (<span class="badge badge-warning">{{$wajib4->usulan_luaran_pengabdian_status}}</span>)</b>
                                                                        @endif
                                                                        @if($wajib4->usulan_luaran_pengabdian_rencana)
                                                                        <h5>{{$wajib4->usulan_luaran_pengabdian_rencana}}</h5>
                                                                        @else
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                        @else
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                    </td>
                                                                </tr>
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
                                                <div class="card m-2">
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
                                                                <tr>
                                                                    <td>
                                                                        <h5>Tahun 1 :</h5>
                                                                    </td>

                                                                    <td>
                                                                        @if($tambahan)
                                                                        @if($tambahan->usulan_luaran_pengabdian_jenis && $tambahan->usulan_luaran_pengabdian_status)
                                                                        <b>{{$tambahan->usulan_luaran_pengabdian_jenis}} (<span class="badge badge-warning">{{$tambahan->usulan_luaran_pengabdian_status}}</span>)</b>
                                                                        @endif
                                                                        @if($tambahan->usulan_luaran_pengabdian_rencana)
                                                                        <h5>{{$tambahan->usulan_luaran_pengabdian_rencana}}</h5>
                                                                        @else
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                        @else
                                                                        <h5><span class="badge badge-warning">-</span></h5>
                                                                        @endif
                                                                    </td>
                                                                </tr>
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
                                            <a href="{{route('reviewer_pengabdian_file_preview', [$id, $dokumen_rab->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                            <a href="{{route('reviewer_pengabdian_file_download', [$id, $dokumen_rab->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
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
                                                        <i class="fas fa-file-pdf fa-2x"></i>
                                                        <br>
                                                        @if($data->mitra_sasaran_file_date)
                                                        Nama File : {{$data->mitra_sasaran_file_original_name}}
                                                        <br>
                                                        Tanggal Unggah : {{Carbon\Carbon::parse($data->mitra_sasaran_file_date)->isoFormat('D MMMM Y')}}
                                                        @else
                                                        Nama File : -
                                                        <br>
                                                        Tanggal Unggah : -
                                                        @endif

                                                        @if($data->mitra_sasaran_file_date)
                                                        <br>
                                                        <a href="{{route('reviewer_pengabdian_file_preview', [$id, $data->mitra_sasaran_file_hash_name, 'mitra'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                                        <a href="{{route('reviewer_pengabdian_file_download', [$id, $data->mitra_sasaran_file_hash_name, 'mitra'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
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
        });
    });
</script>
@endpush