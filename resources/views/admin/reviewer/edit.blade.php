@extends('layout.layout_admin')

@section('title', 'Edit Reviewer')

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
                        <h3 class="card-title">Edit Reviewer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_reviewer_update', $user->user_id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" placeholder="NIDN" value="{{$user->user_nidn}}">
                                @error('nidn')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{$user->user_name}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{$user->user_email}}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password (Optional)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password (Optional)">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group clearfix">
                                <div class="icheck-success">
                                    <input type="checkbox" id="checkboxPrimary1" name="active" @if($user->user_active == true){{"checked"}}@endif>
                                    <label for="checkboxPrimary1">
                                        Active
                                    </label>
                                </div>
                                <div class="icheck-danger">
                                    <input type="checkbox" id="checkboxPrimary2" name="suspend" @if($user->user_ban == true){{"checked"}}@endif>
                                    <label for="checkboxPrimary2">
                                        Suspend
                                    </label>
                                </div>
                            </div>

                            <div class=" card-footer">
                                <a href="{{route('admin_reviewer')}}" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Update</button>
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