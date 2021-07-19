@extends('layout.layout_admin')

@section('title', 'Pengusul')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Pengusul</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-3 col-md-3">
                    <a href="{{route('admin_pengusul_insert')}}" class="btn btn-primary btn-md mb-3 btn-block"><i class="fas fa-plus"></i> Tambah Pengusul</a>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped projects">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Avatar</th>
                                    <th>NIDN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $data)
                                @if($data->user_id != Session::get('user_id'))
                                <tr>
                                    <td>
                                        <h5> {{$loop->iteration}}</h5>
                                    </td>
                                    <td>
                                        <img alt="Avatar" class="table-avatar" src="{{URL::asset('assets/img/profile/' . $data->user_image)}}" style="height: 40px;">
                                    </td>
                                    <td>
                                        <h5>@if($data->user_nidn != NULL){{$data->user_nidn}}@else{{'-'}}@endif</h5>
                                    </td>
                                    <td>
                                        <h5>{{$data->user_name}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$data->user_email}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$data->user_role}}</h5>
                                    </td>
                                    <td>
                                        <h5>
                                            @if($data->user_active == true)
                                            <span class="badge badge-success">Aktif</span>
                                            @else
                                            <span class="badge badge-warning">Tidak Aktif</span>
                                            @endif
                                        </h5>
                                        <h5>
                                            @if($data->user_ban == true)
                                            <span class="badge badge-danger">Suspended</span>
                                            @else
                                            <span class="badge badge-primary">Not Suspend</span>
                                            @endif
                                        </h5>
                                    </td>

                                    <td>
                                        <form action="{{route('admin_pengusul_destroy', $data->user_id)}}" method="POST" class="form-inline form-horizontal">
                                            @csrf
                                            @method('delete')
                                            <div class="card-body">
                                                <a class="btn btn-primary btn-sm" href="{{route('admin_pengusul_edit', $data->user_id)}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                    Edit
                                                </a>

                                                <button class="btn btn-danger btn-sm btn-remove" type="submit">
                                                    <i class="fas fa-trash">
                                                    </i>

                                                    Remove
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>
</div>
<!-- /.content -->


@endsection

@push('plugin')
<script>
    // --------------
    // Delete Button
    // --------------
    $('.btn-remove').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

<!-- DataTables  & Plugins -->
<script src="{{URL::asset('assets/js/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(function() {

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pagingType": "simple_numbers",
        });
    });
</script>
@endpush