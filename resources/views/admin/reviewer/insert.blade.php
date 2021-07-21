@extends('layout.layout_admin')

@section('title', 'Tambah Reviewer')

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
                        <h3 class="card-title">Tambah Reviewer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_reviewer_store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" placeholder="NIDN" value="{{old('nidn')}}">
                                @error('nidn')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama" value="{{old('name')}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sex">Jenis Kelamin</label>
                                <select class="form-control select2 @error('sex') is-invalid @enderror" data-placeholder="Pilih jenis Kelamin" style="width: 100%;" name="sex">
                                    <option value="0" @if(old('sex')==0){{"selected"}}@endif>Laki-Laki</option>
                                    <option value="1" @if(old('sex')==1){{"selected"}}@endif>Perempuan</option>
                                </select>
                                @error('sex')
                                <div class="invalid-feedback">
                                    Pilih Jenis Kelamin
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="institusi">Institusi (Optional)</label>
                                <input name="institusi" type="text" class="form-control @error('institusi') is-invalid @enderror" id="institusi" placeholder="Masukan Institusi" value="{{old('institusi')}}">
                                @error('institusi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jurusan">Jurusan (Optional)</label>
                                <input name="jurusan" type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" placeholder="Masukan Jurusan" value="{{old('jurusan')}}">
                                @error('jurusan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="program_studi">Program Studi (Optional)</label>
                                <input name="program_studi" type="text" class="form-control @error('program_studi') is-invalid @enderror" id="program_studi" placeholder="Masukan Program Studi" value="{{old('program_studi')}}">
                                @error('program_studi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pendidikan">Jenjang Pendidikan (Optional)</label>
                                <input name="pendidikan" type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" placeholder="Masukan Jenjang Pendidikan" value="{{old('pendidikan')}}">
                                @error('pendidikan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jabatan">Jabatan (Optional)</label>
                                <input name="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" placeholder="Masukan Jabatan" value="{{old('jabatan')}}">
                                @error('jabatan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('admin_reviewer')}}" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Insert</button>
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