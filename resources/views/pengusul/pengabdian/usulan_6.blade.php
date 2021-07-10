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
                        <h3 class="card-title">Mitra Sasaran</h3>
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
                                <div class="step active" data-target="#dokumen-pendukung">
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

                            <div class="card m-4">
                                <div class="card-header">
                                    <h3 class="card-title">Mitra Sasaran <span class="badge badge-warning">Wajib Ada</span></h3>
                                </div>
                                <div class="card-header">
                                    <p class="mt-2">Kelompok Masyarakat / Lembaga-Instansi Pemerintahan / Lembaga - Instansi Swasta / UMKM <a href="{{route('pengusul_pengabdian_tambah_mitra', $id)}}" class="btn btn-primary btn-sm ml-auto float-right"><i class="fas fa-plus"></i> Tambah</a></p>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Mitra</th>
                                                <th>Kontribusi Pendanaan</th>
                                                <th>Dokumen</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($mitra_sasaran->count() != 0)
                                            @foreach($mitra_sasaran as $data)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    <b>{{$data->mitra_sasaran_nama_pimpinan_mitra}}</b>
                                                    <br>
                                                    {{$data->mitra_sasaran_nama_mitra}}
                                                </td>
                                                <td>
                                                    Rp. {{$data->mitra_sasaran_kontribusi_pendanaan_mitra}}
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <button type="button" data-toggle="modal" data-id="{{$data->mitra_sasaran_id}}" data-target="#modal-default" class="btn btn-primary upload-mitra-dokumen"><b><i class="fas fa-upload"></i></b></button>
                                                        </div>
                                                        <div class="col-10">
                                                            @if($data->mitra_sasaran_file_date)
                                                            Nama File : {{$data->mitra_sasaran_file_original_name}}
                                                            <br>
                                                            Tanggal Unggah : {{Carbon\Carbon::parse($data->mitra_sasaran_file_date)->isoFormat('D MMMM Y')}}
                                                            @else
                                                            Nama File : -
                                                            <br>
                                                            Tanggal Unggah : -
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{route('pengusul_pengabdian_hapus_mitra', [$id, $data->mitra_sasaran_id])}}" method="POST" class="form-inline form-horizontal">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="btn btn-primary btn-sm" href="{{route('pengusul_pengabdian_edit_mitra', [$id, $data->mitra_sasaran_id])}}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                            Edit
                                                        </a>

                                                        <button class="btn btn-danger btn-sm btn-remove ml-2" type="submit">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Hapus
                                                        </button>

                                                    </form>
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
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

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

<!-- Upload Dokumen Modal -->
<div class="modal fade " id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Dokumen Mitra</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('pengusul_pengabdian_upload_dokumen_mitra', $id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <input type="hidden" class="" id="mitra_id" name="mitra_id" value="">
                        <div class="form-group">
                            <label for="dokumen_mitra">Dokumen Mitra Upload (PDF)</label>
                            <div class="input-group  @error('dokumen_mitra') is-invalid @enderror">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('dokumen_mitra') is-invalid @enderror" id="dokumen_mitra" name="dokumen_mitra">
                                    <label class="custom-file-label" id="dokumen_mitra_label" for="dokumen_mitra">Upload File Disini</label>
                                </div>
                            </div>
                            @error('dokumen_mitra')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });
</script>

@error('dokumen_mitra')
<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-default').modal('show');
    });
</script>
@enderror

<script type="text/javascript">
    $(document).on('click', '.upload-mitra-dokumen', function() {
        var mitra_id = $(this).data("id");

        $('#mitra_id').val(mitra_id);
        $('#dokumen_mitra').val("");
        $('#dokumen_mitra_label').text("Upload File Disini");
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