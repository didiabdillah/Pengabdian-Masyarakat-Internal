@extends('layout.layout_reviewer')

@section('title', __('id.home'))

@section('page')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>{{__('id.home')}}</h1>
                </div>
            </div>

        </div>

        <!--In Progress content -->
        <section class="content">

            <div class="container-fluid">

                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-12 mt-4">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#">Biodata</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="profile">
                                        <!-- About Me Box -->
                                        <div class="card card-primary">
                                            <div class="row m-1 p-3">
                                                <div class="col-md-3">
                                                    <div class="text-center">
                                                        <img class="profile-user-img img-fluid" src="{{URL::asset('assets/img/profile/' . $user->user_image)}}" alt="User profile picture" style="height: 200px; width: 200px;">
                                                    </div>

                                                    <h5 class="profile-username text-center">{{$user->user_name}}</h5>


                                                    <ul class="list-group list-group-unbordered mb-3">
                                                        <li class="list-group-item">
                                                            <b>Role</b> <a class="float-right">{{$user->user_role}}</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>NIDN</b>
                                                            <a class="float-right">

                                                                @if($user->user_nidn)
                                                                {{$user->user_nidn}}
                                                                @else
                                                                {{"-"}}
                                                                @endif

                                                            </a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Email</b>
                                                            <a class="float-right">

                                                                @if($user->user_email)
                                                                {{$user->user_email}}
                                                                @else
                                                                {{"-"}}
                                                                @endif

                                                            </a>
                                                        </li>
                                                    </ul>
                                                    @if($user_id == Session::get('user_id'))
                                                    <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-primary btn-block"><b><i class="fas fa-camera"></i> {{__('id.upload')}} Foto</b></button>
                                                    <a href="{{route('reviewer_biodata_edit')}}" class="btn btn-danger btn-block"><b><i class="fas fa-pencil-alt"></i> {{__('id.edit')}} Biodata</b></a>
                                                    @endif

                                                </div>
                                                <div class="col-md-4 offset-md-1">
                                                    <div class="card-body">
                                                        <strong><i class="fas fa-user mr-1"></i>Nama</strong>

                                                        <p class="text-muted">
                                                            {{$user->user_name}}
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-venus-mars mr-1"></i>Jenis Kelamin</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_sex == 0)
                                                            {{"Laki-Laki"}}
                                                            @elseif($user->biodata->biodata_sex == 1)
                                                            {{"Perempuan"}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-university mr-1"></i>Institusi</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_institusi)
                                                            {{$user->biodata->biodata_institusi}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-graduation-cap mr-1"></i>Jurusan</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_jurusan)
                                                            {{$user->biodata->biodata_jurusan}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-graduation-cap mr-1"></i>Program Studi</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_program_studi)
                                                            {{$user->biodata->biodata_program_studi}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-user-graduate mr-1"></i>Jenjang Pendidikan</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_pendidikan)
                                                            {{$user->biodata->biodata_pendidikan}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-briefcase mr-1"></i>Jabatan</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_jabatan)
                                                            {{$user->biodata->biodata_jabatan}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-map-marker-alt mr-1"></i>Alamat</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_alamat)
                                                            {{$user->biodata->biodata_alamat}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card-body">
                                                        <strong><i class="fas fa-birthday-cake mr-1"></i>Tempat/Tanggal Lahir</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_tempat_lahir != NULL && $user->biodata->biodata_tanggal_lahir == NULL)
                                                            {{$user->biodata->biodata_tempat_lahir . ", -"}}
                                                            @elseif($user->biodata->biodata_tempat_lahir == NULL && $user->biodata->biodata_tanggal_lahir != NULL)
                                                            {{"-, " . Carbon\Carbon::parse($user->biodata->biodata_tanggal_lahir)->isoFormat('D MMMM Y')}}
                                                            @elseif($user->biodata->biodata_tempat_lahir != NULL && $user->biodata->biodata_tanggal_lahir != NULL)
                                                            {{$user->biodata->biodata_tempat_lahir . ", " . Carbon\Carbon::parse($user->biodata->biodata_tanggal_lahir)->isoFormat('D MMMM Y')}}
                                                            @elseif($user->biodata->biodata_tempat_lahir == NULL && $user->biodata->biodata_tanggal_lahir == NULL)
                                                            {{"-, -"}}
                                                            @endif
                                                            @else
                                                            {{"-, -"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-id-card mr-1"></i>No KTP</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_no_ktp)
                                                            {{$user->biodata->biodata_no_ktp}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-phone-alt mr-1"></i>No Telp</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_no_telp)
                                                            {{$user->biodata->biodata_no_telp}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-mobile-alt mr-1"></i>No HP</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_no_hp)
                                                            {{$user->biodata->biodata_no_hp}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-globe mr-1"></i>Web Personal</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_web_personal)
                                                            {{$user->biodata->biodata_web_personal}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fas fa-journal-whills mr-1"></i>SINTA ID</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_sinta_id)
                                                            {{$user->biodata->biodata_sinta_id}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fab fa-google mr-1"></i>Google Schoolar ID</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_google_schoolar_id)
                                                            {{$user->biodata->biodata_google_schoolar_id}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>

                                                        <strong><i class="fab fa-stripe-s mr-1"></i>Scopus ID</strong>

                                                        <p class="text-muted">
                                                            @if($user->biodata)
                                                            @if($user->biodata->biodata_scopus_id)
                                                            {{$user->biodata->biodata_scopus_id}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </p>

                                                        <hr>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.tab-pane -->

                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
        </section>
</div>
<!-- /.content -->

@if($user_id == Session::get('user_id'))
<!-- Upload Profile Picture Modal Form -->
<!-- <div class="modal fade show" id="modal-default" style="display: block;" aria-modal="true" role="dialog"> -->
<div class="modal fade " id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('id.upload')}} Foto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('reviewer_biodata_update_picture')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image">Unggah Gambar (JPEG/JPG/PNG, Max 2 MB)</label>
                            <div class="input-group  @error('image') is-invalid @enderror">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input  @error('image') is-invalid @enderror" id="image" name="image">
                                    <label class="custom-file-label" for="image">{{__('id.choose')}} {{__('id.file')}}</label>
                                </div>
                            </div>
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('id.close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('id.save')}}</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endif
@endsection

@push('plugin')

@error('image')
<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-default').modal('show');
    });
</script>
@enderror

<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });
</script>

@endpush