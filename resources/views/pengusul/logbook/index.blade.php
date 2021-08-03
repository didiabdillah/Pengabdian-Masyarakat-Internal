@extends('layout.layout_pengusul')

@section('title', 'Logbook')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Logbook</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            @if($is_tambah_unlock == true)
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info">
                        <h5><i class="icon fas fa-info"></i> Waktu Pelaksanaan Logbook</h5>
                        <ul class="mb-0">
                            <li>
                                <b>Periode</b> : {{$tambah_unlock["start_year"] . " / " . $tambah_unlock["end_year"]}}
                            </li>
                            <li>
                                <b>Batas Awal</b> : {{Carbon\Carbon::parse($tambah_unlock["start_time"])->isoFormat('D MMMM Y , hh:mm:ss')}} WIB
                            <li>
                                <b>Batas Akhir</b> : {{Carbon\Carbon::parse($tambah_unlock["end_time"])->isoFormat('D MMMM Y , hh:mm:ss')}} WIB
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
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
                                    <th>Judul</th>
                                    <th>Tahun</th>
                                    <th>{{__('id.option')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengabdian as $data)
                                <tr>
                                    <td>
                                        <h5>{{$loop->iteration}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$data->usulan_pengabdian_judul}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$data->usulan_pengabdian_tahun}}</h5>
                                    </td>
                                    <td>
                                        <div class="card-body">
                                            @if($data->usulan_pengabdian_unlock_pass >= strtotime(date('Y-m-d H:i:s')))
                                            <a class="btn btn-primary btn-sm" href="{{route('pengusul_logbook_detail', $data->usulan_pengabdian_id)}}">
                                                <i class="fas fa-folder">
                                                </i>

                                                Kelola Logbook
                                            </a>
                                            <br>
                                            <h6>
                                                <span class="badge badge-warning">
                                                    <b>Batas Akhir</b> : {{Carbon\Carbon::parse(date('Y-m-d H:i:s', $data->usulan_pengabdian_unlock_pass))->isoFormat('D MMMM Y , hh:mm:ss')}} WIB
                                                </span>
                                            </h6>
                                            @elseif($is_tambah_unlock == false)
                                            <a class="btn btn-info btn-sm" style="pointer-events: none; cursor: default;">
                                                <i class="fas fa-folder">
                                                </i>

                                                Kelola Logbook
                                            </a>
                                            @else
                                            <a class="btn btn-primary btn-sm" href="{{route('pengusul_logbook_detail', $data->usulan_pengabdian_id)}}">
                                                <i class="fas fa-folder">
                                                </i>

                                                Kelola Logbook
                                            </a>
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
    });
</script>
@endpush