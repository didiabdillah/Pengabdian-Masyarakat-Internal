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
                        <h3 class="card-title">Ubah Luaran Dan Target Capaian</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body p-0">
                        <div class="bs-stepper">
                            <!-- NAVIGASI -->
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

                            <h4 class="text-center mt-2"><span class="badge badge-warning">UBAH DATA LUARAN WAJIB</span></h4>

                            <!-- CONTENT -->
                            <form action="{{route('pengusul_pengabdian_update_luaran', [$id, $luaran->usulan_luaran_id])}}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="1" readonly>
                                        @error('tahun')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kategori">Kategori Luaran</label>
                                        <select class="form-control select2 @error('kategori') is-invalid @enderror" style="width: 100%;" name="kategori">
                                            <option value="Publikasi di prosiding seminar nasional ber ISBN" selected>Publikasi di prosiding seminar nasional ber ISBN</option>
                                        </select>
                                        @error('kategori')
                                        <div class="invalid-feedback">
                                            Pilih Kategori Luaran
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis">Jenis Luaran</label>
                                        <select class="form-control select2 @error('jenis') is-invalid @enderror" style="width: 100%;" name="jenis">
                                            <option value="Artikel di prosiding seminar nasional ber ISBN" selected>Artikel di prosiding seminar nasional ber ISBN</option>
                                        </select>
                                        @error('jenis')
                                        <div class="invalid-feedback">
                                            Pilih Jenis Luaran
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="rencana">Rencana Capaian Peningkatan</label>
                                        <input type="text" class="form-control @error('rencana') is-invalid @enderror" id="rencana" name="rencana" placeholder="Rencana Capaian Peningkatan" value="{{$luaran->usulan_luaran_pengabdian_rencana}}">
                                        @error('rencana')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control select2 @error('status') is-invalid @enderror" style="width: 100%;" name="status">
                                            <option value="Published" selected>Published</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            Pilih Status
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="card-footer">
                                        <a href="{{route('pengusul_pengabdian_usulan', [4, $id])}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save "></i> Simpan</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
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
<!-- Select2 -->
<script src="{{URL::asset('assets/js/select2/js/select2.full.min.js')}}"></script>

<script>
    // Ajax setup from csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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