@extends('layout.layout_admin')

@section('title', 'Laporan Akhir')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Laporan Akhir</h1>
                </div>
            </div>

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
                                    <th>Pengusul</th>
                                    <th>Program Studi</th>
                                    <th>Laporan Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporan_akhir as $data)
                                <tr>
                                    <td>
                                        <h6>{{$loop->iteration}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$data->usulan_pengabdian_judul}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$data->usulan_pengabdian_tahun}}</h6>
                                    </td>
                                    <td>
                                        <h6>
                                            @php
                                            $ketua= $data->anggota_pengabdian()
                                            ->join('users', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
                                            ->join('biodata', 'biodata.biodata_user_id', '=', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id')
                                            ->where('anggota_pengabdian_role', 'ketua')
                                            ->first();
                                            @endphp
                                            {{$ketua->user_name}}
                                        </h6>
                                    </td>
                                    <td>
                                        <h6>
                                            {{$ketua->biodata_program_studi}}
                                        </h6>
                                    </td>
                                    <td>
                                        @php
                                        $doc = $data->laporan_akhir()->where('laporan_akhir_pengabdian_id', $data->usulan_pengabdian_id)->first();
                                        @endphp

                                        @if($doc)
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-file-pdf"></i>
                                            </div>
                                            <div class="col-11">
                                                Nama {{__('id.file')}} : {{$doc->laporan_akhir_original_name}}
                                                <br>
                                                Tanggal {{__('id.upload')}} : {{Carbon\Carbon::parse($doc->laporan_akhir_file_date)->isoFormat('D MMMM Y')}}
                                                <br>
                                                <a href="{{route('file_preview', [$doc->laporan_akhir_id, $doc->laporan_akhir_hash_name,'laporan_akhir'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                                <a href="{{route('file_download', [$doc->laporan_akhir_id, $doc->laporan_akhir_hash_name,'laporan_akhir'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-file-pdf fa-2x"></i>
                                            </div>
                                            <div class="col-11">
                                                Nama {{__('id.file')}} : -
                                                <br>
                                                Tanggal {{__('id.upload')}} : -
                                            </div>
                                        </div>
                                        @endif
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