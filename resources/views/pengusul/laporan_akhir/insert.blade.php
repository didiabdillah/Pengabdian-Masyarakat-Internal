@extends('layout.layout_pengusul')

@section('title', __('id.upload') . ' Laporan ' . ucwords($tipe))

@section('page')

@include('layout.flash_alert')

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
                        <h3 class="card-title">Tambah Laporan {{ucwords($tipe)}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('pengusul_laporan_akhir_store', [$pengabdian_id, $id, $tipe])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @if($tipe == "luaran")
                            <div class="form-group">
                                <label for="nama_publikasi">Nama Publikasi</label>
                                <input type="text" class="form-control @error('nama_publikasi') is-invalid @enderror" id="nama_publikasi" name="nama_publikasi" placeholder="Masukan Nama Publikasi" value="{{old('nama_publikasi')}}">
                                @error('nama_publikasi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="judul">Judul Luaran</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Masukan Judul Luaran" value="{{old('judul')}}">
                                @error('judul')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="link">Link Luaran (Optional)</label>
                                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="Masukan Link Luaran" value="{{old('link')}}">
                                @error('link')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="file">{{__('id.upload')}} {{__('id.file')}} Laporan {{ucwords($tipe)}} (PDF, Max 15 MB)</label>
                                <div class="input-group  @error('file') is-invalid @enderror">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file">
                                        <label class="custom-file-label" for="file">{{__('id.choose')}} {{__('id.file')}}</label>
                                    </div>
                                </div>
                                @error('file')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('pengusul_laporan_akhir_list', $pengabdian_id)}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> {{__('id.upload')}}</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
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
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script>

<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endpush