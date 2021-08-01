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
                        <h3 class="card-title">{{__('id.upload')}} Laporan {{ucwords($tipe)}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('pengusul_laporan_kemajuan_store', [$pengabdian_id, $id, $tipe])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="file">{{__('id.upload')}} {{__('id.file')}} Laporan {{ucwords($tipe)}}</label>
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
                                <a href="{{route('pengusul_laporan_kemajuan_list', $pengabdian_id)}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
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