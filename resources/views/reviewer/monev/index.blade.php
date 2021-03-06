@extends('layout.layout_reviewer')

@section('title', 'Monev Pengabdian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Data Pengabdian Yang Harus Di Monev</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            @if($is_nilai_unlock == true)
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info">
                        <h5><i class="icon fas fa-info"></i> Waktu Pelaksanaan Monev Pengabdian</h5>
                        <ul class="mb-0">
                            <li>
                                <b>Periode</b> : {{$nilai_unlock["start_year"] . " / " . $nilai_unlock["end_year"]}}
                            </li>
                            <li>
                                <b>Batas Awal</b> : {{Carbon\Carbon::parse($nilai_unlock["start_time"])->isoFormat('D MMMM Y , hh:mm:ss')}} WIB
                            <li>
                                <b>Batas Akhir</b> : {{Carbon\Carbon::parse($nilai_unlock["end_time"])->isoFormat('D MMMM Y , hh:mm:ss')}} WIB
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
                                    <th>Pengusul</th>
                                    <th>Program Studi</th>
                                    <th>Skema</th>
                                    <th>Bidang</th>
                                    <th>Status</th>
                                    <th>{{__('id.option')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($usulan_pengabdian as $usulan)
                                <tr>
                                    <td>
                                        <h6>{{$loop->iteration}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$usulan->usulan_pengabdian_judul}}</h6>
                                    </td>
                                    @php
                                    $ketua = $usulan->anggota_pengabdian()
                                    ->join('users', 'users.user_id', '=', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id')
                                    ->join('biodata', 'biodata.biodata_user_id', '=', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id')
                                    ->where('anggota_pengabdian_pengabdian_id', $usulan->usulan_pengabdian_id)
                                    ->where('anggota_pengabdian_role', 'ketua')
                                    ->first();
                                    @endphp
                                    <td>
                                        <h6>
                                            {{$ketua->user_name}}
                                        </h6>
                                    </td>
                                    <td>
                                        <h6>{{$ketua->biodata_program_studi}}</h6>
                                    </td>
                                    <td>
                                        <h6>
                                            {{
                                                $usulan->join('pkm_skema_pengabdian', 'pkm_skema_pengabdian.skema_id', '=', 'pkm_usulan_pengabdian.usulan_pengabdian_skema_id')->first()->skema_label
                                            }}
                                        </h6>
                                    </td>
                                    <td>
                                        <h6>
                                            {{
                                                $usulan->join('pkm_bidang_pengabdian', 'pkm_bidang_pengabdian.bidang_id', '=', 'pkm_usulan_pengabdian.usulan_pengabdian_bidang_id')->first()->bidang_label
                                            }}
                                        </h6>
                                    </td>
                                    <td>
                                        @if($usulan->usulan_pengabdian_status == "dikirim")
                                        <h5><span class="badge badge-primary">Dikirim</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "dinilai")
                                        <h5><span class="badge badge-info">Dinilai</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "diterima")
                                        <h5><span class="badge badge-success">Diterima</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "ditolak")
                                        <h5><span class="badge badge-danger">Ditolak</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "error")
                                        <h5><span class="badge badge-danger">Error</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "undefined")
                                        <h5><span class="badge badge-danger">Undefined</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "dimonev")
                                        <h5><span class="badge badge-info">Dimonev</span></h5>
                                        @elseif($usulan->usulan_pengabdian_status == "selesai")
                                        <h5><span class="badge badge-success">Selesai</span></h5>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="card-body">
                                            <a class="btn btn-success btn-sm" href="{{route('reviewer_monev_detail', $usulan->usulan_pengabdian_id)}}">
                                                <i class="fas fa-search-plus">
                                                </i>

                                                {{__('id.review')}}
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
    });
</script>
@endpush