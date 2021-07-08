@extends('layout.layout_pengusul')

@section('title', 'Usulan Pengabdian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Usulan Pengabdian</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-3 col-md-3">
                    <a href="{{route('pengusul_pengabdian_tambah')}}" class="btn btn-primary btn-md mb-3 btn-block"><i class="fas fa-plus"></i> Tambah Usulan Pengabdian</a>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <!-- USULAN PENGABDIAN -->
                <div class="card">
                    <div class="card-header">
                        <b>Usulan Pengabdian Kepada Masyarakat</b>
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
                                    <th>Judul</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($usulan_pengabdian as $usulan)
                                <tr>
                                    <td>
                                        <h5>{{$loop->iteration}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$usulan->usulan_pengabdian_judul}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$usulan->usulan_pengabdian_tahun}}</h5>
                                    </td>
                                    <td>
                                        @if($usulan->usulan_pengabdian_status == "diproses")
                                        <h5><span class="badge badge-primary">Diproses</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "diterima")
                                        <h5><span class="badge badge-success">Diterima</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "ditolak")
                                        <h5><span class="badge badge-danger">Ditolak</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "pending")
                                        <h5><span class="badge badge-warning">Pending</span></h5>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="card-body">
                                            <a class="btn btn-success btn-sm" href="">
                                                <i class="fas fa-folder">
                                                </i>

                                                Detail
                                            </a>

                                            @php $role = $usulan->anggota_pengabdian()->where('anggota_pengabdian_user_id', Session::get('user_id'))->first()->anggota_pengabdian_role @endphp

                                            @if($role == "ketua")
                                            @if($usulan->usulan_pengabdian_status == "pending" || $usulan->usulan_pengabdian_status == "ditolak")
                                            <a class="btn btn-primary btn-sm" href="{{route('pengusul_pengabdian_usulan', [1, $usulan->usulan_pengabdian_id])}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>

                                                Edit
                                            </a>
                                            @endif

                                            @if($usulan->usulan_pengabdian_status == "pending")
                                            <a class="btn btn-danger btn-sm" href="">
                                                <i class="fas fa-trash">
                                                </i>

                                                Hapus
                                            </a>
                                            @endif
                                            @endif
                                        </div>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- RIWAYAT -->
                <div class="card">
                    <div class="card-header">
                        <b> Riwayat Pengabdian Kepada Masyarakat </b>
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
                                    <th>Judul</th>
                                    <th>Tahun</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>
                                        <h5>1</h5>
                                    </td>
                                    <td>
                                        <h5>Pengabdian Masjid Jatisawit Lor</h5>
                                    </td>
                                    <td>
                                        <h5>2021</h5>
                                    </td>

                                    <td>
                                        <div class="card-body">
                                            <a class="btn btn-primary btn-sm" href="">
                                                <i class="fas fa-pencil-alt">
                                                </i>

                                                Edit
                                            </a>

                                            <a class="btn btn-success btn-sm" href="">
                                                <i class="fas fa-trash">
                                                </i>

                                                Hapus
                                            </a>
                                        </div>

                                    </td>
                                </tr>

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