@extends('layout.layout_pengusul')

@section('title', 'Tambah Usulan Pengabdian')

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
                        <h3 class="card-title">Substansi usulan pengabdian Kepada Masyarakat</h3>
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
                                <div class="step active" data-target="#substansi">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="substansi" id="substansi-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Substansi Usulan</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#rab">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="rab" id="rab-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">RAB</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#dokumen-pendukung">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="dokumen-pendukung" id="dokumen-pendukung-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Dokumen Pendukung</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#kirim">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="kirim" id="kirim-trigger">
                                        <span class="bs-stepper-circle">5</span>
                                        <span class="bs-stepper-label">Kirim Usulan</span>
                                    </button>
                                </div>
                            </div>

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
                                                        <th colspan="3">
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

                                                        <td>
                                                            @if($wajib1)
                                                            <form action="{{route('pengusul_pengabdian_destroy_luaran', [$id, $wajib1->usulan_luaran_id])}}" method="POST" class="form-inline form-horizontal">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="btn btn-primary btn-sm" href="{{route('pengusul_pengabdian_edit_luaran', [$id, $wajib1->usulan_luaran_id])}}">
                                                                    <i class="fas fa-pencil-alt">
                                                                    </i>
                                                                    Ubah
                                                                </a>

                                                                <button class="btn btn-danger btn-sm btn-remove m-1" type="submit">
                                                                    <i class="fas fa-trash">
                                                                    </i>
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                            @else
                                                            <a class="btn btn-success btn-sm" href="{{route('pengusul_pengabdian_tambah_luaran', [$id, 'wajib', 1])}}">
                                                                <i class="fas fa-plus">
                                                                </i>
                                                                Tambah
                                                            </a>
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

                                                        <td>
                                                            @if($wajib2)
                                                            <form action="{{route('pengusul_pengabdian_destroy_luaran', [$id, $wajib2->usulan_luaran_id])}}" method="POST" class="form-inline form-horizontal">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="btn btn-primary btn-sm" href="{{route('pengusul_pengabdian_edit_luaran', [$id, $wajib2->usulan_luaran_id])}}">
                                                                    <i class="fas fa-pencil-alt">
                                                                    </i>
                                                                    Ubah
                                                                </a>

                                                                <button class="btn btn-danger btn-sm btn-remove m-1" type="submit">
                                                                    <i class="fas fa-trash">
                                                                    </i>
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                            @else
                                                            <a class="btn btn-success btn-sm" href="{{route('pengusul_pengabdian_tambah_luaran', [$id, 'wajib', 2])}}">
                                                                <i class="fas fa-plus">
                                                                </i>
                                                                Tambah
                                                            </a>
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

                                                        <td>
                                                            @if($wajib3)
                                                            <form action="{{route('pengusul_pengabdian_destroy_luaran', [$id, $wajib3->usulan_luaran_id])}}" method="POST" class="form-inline form-horizontal">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="btn btn-primary btn-sm" href="{{route('pengusul_pengabdian_edit_luaran', [$id, $wajib3->usulan_luaran_id])}}">
                                                                    <i class="fas fa-pencil-alt">
                                                                    </i>
                                                                    Ubah
                                                                </a>

                                                                <button class="btn btn-danger btn-sm btn-remove m-1" type="submit">
                                                                    <i class="fas fa-trash">
                                                                    </i>
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                            @else
                                                            <a class="btn btn-success btn-sm" href="{{route('pengusul_pengabdian_tambah_luaran', [$id, 'wajib', 3])}}">
                                                                <i class="fas fa-plus">
                                                                </i>
                                                                Tambah
                                                            </a>
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

                                                        <td>
                                                            @if($wajib4)
                                                            <form action="{{route('pengusul_pengabdian_destroy_luaran', [$id, $wajib4->usulan_luaran_id])}}" method="POST" class="form-inline form-horizontal">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="btn btn-primary btn-sm" href="{{route('pengusul_pengabdian_edit_luaran', [$id, $wajib4->usulan_luaran_id])}}">
                                                                    <i class="fas fa-pencil-alt">
                                                                    </i>
                                                                    Ubah
                                                                </a>

                                                                <button class="btn btn-danger btn-sm btn-remove m-1" type="submit">
                                                                    <i class="fas fa-trash">
                                                                    </i>
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                            @else
                                                            <a class="btn btn-success btn-sm" href="{{route('pengusul_pengabdian_tambah_luaran', [$id, 'wajib', 4])}}">
                                                                <i class="fas fa-plus">
                                                                </i>
                                                                Tambah
                                                            </a>
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
                                                    <th colspan="3">

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

                                                        <td>
                                                            @if($tambahan)
                                                            <form action="{{route('pengusul_pengabdian_destroy_luaran', [$id, $tambahan->usulan_luaran_id])}}" method="POST" class="form-inline form-horizontal">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="btn btn-primary btn-sm" href="{{route('pengusul_pengabdian_edit_luaran', [$id, $tambahan->usulan_luaran_id])}}">
                                                                    <i class="fas fa-pencil-alt">
                                                                    </i>
                                                                    Ubah
                                                                </a>

                                                                <button class="btn btn-danger btn-sm btn-remove m-1" type="submit">
                                                                    <i class="fas fa-trash">
                                                                    </i>
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                            @else
                                                            <a class="btn btn-success btn-sm" href="{{route('pengusul_pengabdian_tambah_luaran', [$id, 'tambahan', 0])}}">
                                                                <i class="fas fa-plus">
                                                                </i>
                                                                Tambah
                                                            </a>
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
                        <div class="card-footer">
                            <a href="{{route('pengusul_pengabdian_usulan', [$page-1, $id])}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <a href="{{route('pengusul_pengabdian_usulan', [$page+1, $id])}}" class="btn btn-primary ml-auto float-right"><i class="fas fa-arrow-right"></i> Lanjut</a>
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

<!-- BS-Stepper -->
<script src="{{URL::asset('assets/js/bs-stepper/js/bs-stepper.min.js')}}"></script>

<script>
    // BS-Stepper Init
    // document.addEventListener('DOMContentLoaded', function() {
    //     window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    // })
</script>
@endpush