@extends('layout.layout_pengusul')

@section('title', __('id.history') . ' Usulan Pengabdian')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>{{__('id.history')}} Usulan Pengabdian</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <!-- USULAN PENGABDIAN -->
                <div class="card">
                    <div class="card-header">
                        <b>{{__('id.history')}} Usulan Pengabdian Kepada Masyarakat</b>
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
                                    <th>{{__('id.option')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($riwayat_pengabdian as $riwayat)
                                <tr>
                                    <td>
                                        <h6>{{$loop->iteration}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$riwayat->usulan_pengabdian_judul}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$riwayat->usulan_pengabdian_tahun}}</h6>
                                    </td>
                                    <td>
                                        @if($riwayat->usulan_pengabdian_status == "dikirim")
                                        <h5><span class="badge badge-primary">Dikirim</span></h5>
                                        @elseif($riwayat->usulan_pengabdian_status == "diterima")
                                        <h5><span class="badge badge-success">Diterima</span></h5>
                                        @elseif($riwayat->usulan_pengabdian_status == "ditolak")
                                        <h5><span class="badge badge-danger">Ditolak</span></h5>
                                        @elseif($riwayat->usulan_pengabdian_status == "dinilai")
                                        <h5><span class="badge badge-info">Dinilai</span></h5>
                                        @elseif($riwayat->usulan_pengabdian_status == "pending")
                                        <h5><span class="badge badge-warning">Pending</span></h5>
                                        @elseif($riwayat->usulan_pengabdian_status == "selesai")
                                        <h5><span class="badge badge-success">Selesai</span></h5>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="card-body">
                                            <a class="btn btn-success btn-sm" href="{{route('pengusul_pengabdian_detail', [$riwayat->usulan_pengabdian_id, 'riwayat'])}}">
                                                <i class="fas fa-folder">
                                                </i>

                                                {{__('id.detail')}}
                                            </a>
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
            </div>
        </section>
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
            "language": {
                "url": "{{URL::asset('assets/js/datatables/Indonesian.json')}}"
            },
        });
        $('#example3').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pagingType": "simple_numbers",
            "language": {
                "url": "{{URL::asset('assets/js/datatables/Indonesian.json')}}"
            },
        });
    });
</script>
@endpush