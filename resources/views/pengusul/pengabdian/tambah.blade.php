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
                        <h3 class="card-title">Tambah Usulan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body p-0">
                        <div class="bs-stepper">
                            <!-- NAVIGASI -->
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <div class="step active" data-target="#identitas">
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

                            <!-- CONTENT -->
                            <form action="{{route('pengusul_pengabdian_store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Judul" value="{{old('judul')}}">
                                        @error('judul')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    {{--<div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <div class="form-check">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input class="form-check-input" type="radio" name="kategori" id="kategori1" value="0">
                                                    <label class="form-check-label" for="kategori1">
                                                        Kompetitif Nasional
                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input class="form-check-input" type="radio" name="kategori" id="kategori2" value="1" >
                                                    <label class="form-check-label" for="kategori2">
                                                        Desentralisasi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}

                                    <div class="form-group">
                                        <label for="skema">Skema</label>
                                        <select class="form-control select2 @error('skema') is-invalid @enderror" data-placeholder="Pilih Skema" style="width: 100%;" name="skema">
                                            <option value="">--Pilih Skema--</option>
                                            @foreach($skema as $row)
                                            <option value="{{$row->skema_id}}" @if(old('skema')==$row->skema_id){{'selected'}}@endif>{{$row->skema_label}}</option>
                                            @endforeach
                                        </select>
                                        @error('skema')
                                        <div class="invalid-feedback">
                                            Pilih Skema
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="bidang">Bidang Pengabdian</label>
                                        <select class="form-control select2 @error('bidang') is-invalid @enderror" data-placeholder="Pilih Bidang Pengabdian" style="width: 100%;" name="bidang">
                                            <option value="">--Bidang Pengabdian--</option>
                                            @foreach($bidang as $row)
                                            <option value="{{$row->bidang_id}}" @if(old('bidang')==$row->bidang_id){{'selected'}}@endif>{{$row->bidang_label}}</option>
                                            @endforeach
                                        </select>
                                        @error('bidang')
                                        <div class="invalid-feedback">
                                            Pilih Bidang Pengabdian
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="lama_kegiatan">Lama Kegiatan</label>
                                        <select class="form-control select2 @error('lama_kegiatan') is-invalid @enderror" data-placeholder="Pilih Lama Kegiatan" style="width: 100%;" name="lama_kegiatan">
                                            <option value="">--Pilih Lama Kegiatan--</option>
                                            @foreach($lama_kegiatan as $data)
                                            <option value="{{$data->lama_kegiatan_tahun}}" @if(old('lama_kegiatan')==$data->lama_kegiatan_tahun){{'selected'}}@endif>{{$data->lama_kegiatan_tahun}} Tahun</option>
                                            @endforeach
                                        </select>
                                        @error('lama_kegiatan')
                                        <div class="invalid-feedback">
                                            Pilih Lama Kegiatan
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah_mahasiswa">Jumlah Mahasiswa Yang Terlibat</label>
                                        <input type="text" class="form-control @error('jumlah_mahasiswa') is-invalid @enderror" id="jumlah_mahasiswa" name="jumlah_mahasiswa" placeholder="Minimal 0 Orang" value="{{old('jumlah_mahasiswa')}}">
                                        @error('jumlah_mahasiswa')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="card-footer">
                                        <a href="{{route('pengusul_pengabdian')}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                        <button type="submit" class="btn btn-primary ml-auto float-right"><i class="fas fa-arrow-right "></i> Lanjut</button>
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
<!-- BS-Stepper -->
<script src="{{URL::asset('assets/js/bs-stepper/js/bs-stepper.min.js')}}"></script>

<script>
    // BS-Stepper Init
    // document.addEventListener('DOMContentLoaded', function() {
    //     window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    // })
</script>
@endpush