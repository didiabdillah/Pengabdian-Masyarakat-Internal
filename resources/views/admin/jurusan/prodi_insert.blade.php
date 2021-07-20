@extends('layout.layout_admin')

@section('title', 'Tambah Program Studi')

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
                        <h3 class="card-title">Tambah Program Studi</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_prodi_store', $jurusan_id)}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Program Studi</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Program Studi" value="{{old('name')}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('admin_prodi', $jurusan_id)}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Tambah</button>
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