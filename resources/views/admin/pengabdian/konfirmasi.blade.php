@extends('layout.layout_admin')

@section('title', 'Konfirmasi Usulan Pengabdian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content mt-3">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Konfirmasi Usulan Pengabdian</h1>
                </div>
            </div>

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <a href="{{route('admin_pengabdian_usulan')}}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{route('admin_pengabdian_usulan_konfirmasi_update', $id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control select2 @error('status') is-invalid @enderror" data-placeholder="Select Status" style="width: 100%;" name="status">
                                        <option value="">Konfirmasi Status...</option>
                                        <option value="1" @if($konfirmasi->status == 'diterima'){{"selected"}}@endif>Terima</option>
                                        <option value="0" @if($konfirmasi->status == 'ditolak'){{"selected"}}@endif>Tolak</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        Please select status
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{route('admin_pengabdian_usulan')}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Konfirmasi</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </section>

    </section>

</div>
@endsection

@push('plugin')

@endpush