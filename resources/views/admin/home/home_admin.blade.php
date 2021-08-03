@extends('layout.layout_admin')

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
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{$jumlah_pengusul}}</h3>

                                <p>Pengusul</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{$jumlah_reviewer}}</h3>
                                <p>Reviewer</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$jumlah_usulan_tahun_ini}}</h3>

                                <p>Usulan Tahun Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$jumlah_usulan_total}}</h3>

                                <p>Total Usulan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </section>
</div>
<!-- /.content -->


@endsection

@push('plugin')


@endpush