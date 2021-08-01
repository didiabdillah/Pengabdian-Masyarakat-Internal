@extends('layout.auth_main')

@section('title', __('id.change') . ' ' . __('id.password')')

@section('auth_page')

@include('layout.flash_alert')

<div class=" login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{url('/')}}" class="h1"><img src="{{URL::asset('assets/img/logo/polindra.png')}}" alt="" style="width: 100px;"></a>
            <h3 class="mt-2">{{__('id.simtabmas')}}</h3>
        </div>
        <div class="card-body">
            <p class="login-box-msg">{{__('id.create')}} {{__('id.password')}} baru</p>
            <form action="{{route('change_password_process', [$email, $token])}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" placeholder="{{__('id.password')}} Baru" name="new_password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('new_password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('retype_password') is-invalid @enderror" placeholder="Konfirmasi {{__('id.password')}} Baru" name="retype_password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('retype_password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">{{__('id.create')}} {{__('id.password')}} Baru</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1 text-center">
                <a href="{{route('login')}}">{{__('id.back')}} Ke Login</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection