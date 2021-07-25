@extends('layout.layout_admin')

@section('title', 'Ubah Jenis Luaran')

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
                        <h3 class="card-title">Ubah Jenis Luaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_data_luaran_jenis_update', $jenis->jenis_luaran_id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kategori">Pilih Kategori</label>
                                <select class="form-control select2 @error('kategori') is-invalid @enderror" data-placeholder="Select kategori" style="width: 100%;" name="kategori">
                                    @foreach($kategori as $data)
                                    <option value="{{$data->kategori_luaran_id}}" @if($jenis->jenis_luaran_kategori_id==$data->kategori_luaran_id ){{"selected"}}@endif>{{$data->kategori_luaran_label . " ($data->kategori_luaran_required)"}}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                <div class="invalid-feedback">
                                    Please Select Kategori
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="label">Nama Jenis</label>
                                <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" placeholder="Nama Jenis" value="{{$jenis->jenis_luaran_label}}">
                                @error('label')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('admin_data_luaran')}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Ubah</button>
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

@endpush