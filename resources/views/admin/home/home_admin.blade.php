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


            </div>
        </section>
</div>
<!-- /.content -->


@endsection

@push('plugin')


@endpush