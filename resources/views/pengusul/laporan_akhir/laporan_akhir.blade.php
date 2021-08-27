@extends('layout.layout_pengusul')

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

        <div class="container-fluid">

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('pengusul_laporan_akhir')}}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- LAPORAN AKHIR DAN KEUANGAN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-warning m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-alt"></i>
                                            Laporan Akhir Dan Keuangan
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- LAPORAN AKHIR -->
                                                <tr>
                                                    <td>
                                                        <h5><b>Laporan Akhir</b></h5>
                                                    </td>
                                                    <td>

                                                        @if($laporan_akhir)
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : {{$laporan_akhir->laporan_akhir_original_name}}
                                                                <br>
                                                                Tanggal Unggah : {{Carbon\Carbon::parse($laporan_akhir->laporan_akhir_date)->isoFormat('D MMMM Y')}}
                                                                <br>
                                                                <a href="{{route('file_preview', [$laporan_akhir->laporan_akhir_id, $laporan_akhir->laporan_akhir_hash_name,'laporan_akhir'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                                                <a href="{{route('file_download', [$laporan_akhir->laporan_akhir_id, $laporan_akhir->laporan_akhir_hash_name,'laporan_akhir'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : -
                                                                <br>
                                                                Tanggal Unggah : -
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" href="{{route('pengusul_laporan_akhir_insert', [$pengabdian_id, ($laporan_akhir) ? $laporan_akhir->laporan_akhir_id : 0, 'akhir'])}}">
                                                            <i class="fas fa-upload">
                                                            </i>
                                                            {{__('id.upload')}} Laporan
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- LALPORAN KEUANGAN -->
                                                <tr>
                                                    <td>
                                                        <h5><b>Laporan Keuangan</b></h5>
                                                    </td>
                                                    <td>

                                                        @if($laporan_keuangan)
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : {{$laporan_keuangan->laporan_akhir_original_name}}
                                                                <br>
                                                                Tanggal Unggah : {{Carbon\Carbon::parse($laporan_keuangan->laporan_akhir_date)->isoFormat('D MMMM Y')}}
                                                                <br>
                                                                <a href="{{route('file_preview', [$laporan_keuangan->laporan_akhir_id, $laporan_keuangan->laporan_akhir_hash_name,'laporan_akhir'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                                                <a href="{{route('file_download', [$laporan_keuangan->laporan_akhir_id, $laporan_keuangan->laporan_akhir_hash_name,'laporan_akhir'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : -
                                                                <br>
                                                                Tanggal Unggah : -
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" href="{{route('pengusul_laporan_akhir_insert', [$pengabdian_id, ($laporan_keuangan) ? $laporan_keuangan->laporan_akhir_id : 0, 'keuangan'])}}">
                                                            <i class="fas fa-upload">
                                                            </i>
                                                            {{__('id.upload')}} Laporan
                                                        </a>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- LUARAN WAJIB -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-alt"></i>
                                            Luaran Wajib
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($luaran_wajib->count() != 0)
                                                @foreach($luaran_wajib as $data)
                                                <tr>
                                                    <td>
                                                        Tahun : {{$data->usulan_luaran_pengabdian_tahun}}
                                                    </td>
                                                    <td>
                                                        {{$loop->iteration}}. <b>- {{$data->usulan_luaran_pengabdian_kategori}}</b>
                                                        <br>

                                                        <b>{{$data->usulan_luaran_pengabdian_jenis}} (<span class="badge badge-warning">{{$data->usulan_luaran_pengabdian_status}}</span>)</b>

                                                        <h5>{{$data->usulan_luaran_pengabdian_rencana}}</h5>

                                                    </td>
                                                    @php
                                                    $doc = $data->laporan_akhir_luaran()->where('laporan_akhir_luaran_luaran_id', $data->usulan_luaran_id)->first();
                                                    @endphp
                                                    <td>
                                                        @if($doc)
                                                        Nama Publikasi : {{($doc->laporan_akhir_luaran_nama_publikasi) ? $doc->laporan_akhir_luaran_nama_publikasi : "-"}}
                                                        <br>
                                                        Judul Luaran : {{($doc->laporan_akhir_luaran_judul) ? $doc->laporan_akhir_luaran_judul : "-"}}
                                                        <br>
                                                        Link Luaran : {{($doc->laporan_akhir_luaran_link) ? $doc->laporan_akhir_luaran_link : "-"}}
                                                        @else
                                                        Nama Publikasi : -
                                                        <br>
                                                        Judul Luaran : -
                                                        <br>
                                                        Link Luaran : -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($doc)
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : {{$doc->laporan_akhir_luaran_original_name}}
                                                                <br>
                                                                Tanggal Unggah : {{Carbon\Carbon::parse($doc->laporan_akhir_luaran_date)->isoFormat('D MMMM Y')}}
                                                                <br>
                                                                <a href="{{route('file_preview', [$doc->laporan_akhir_luaran_id, $doc->laporan_akhir_luaran_hash_name,'laporan_akhir_luaran'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                                                <a href="{{route('file_download', [$doc->laporan_akhir_luaran_id, $doc->laporan_akhir_luaran_hash_name,'laporan_akhir_luaran'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : -
                                                                <br>
                                                                Tanggal Unggah : -
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" href="{{route('pengusul_laporan_akhir_insert', [$pengabdian_id, $data->usulan_luaran_id, 'luaran'])}}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                            Tambah Laporan
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td class="text-center" colspan="3">Luaran Wajib Kosong</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- LUARAN TAMBAHAN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-alt"></i>
                                            Luaran Tambahan
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <th colspan="3">

                                                </th>
                                            </thead>
                                            <tbody>
                                                @if($luaran_tambahan->count() != 0)
                                                @foreach($luaran_tambahan as $data)
                                                <tr>
                                                    <td>
                                                        Tahun : {{$data->usulan_luaran_pengabdian_tahun}}
                                                    </td>
                                                    <td>
                                                        {{$loop->iteration}}. <b>- {{$data->usulan_luaran_pengabdian_kategori}}</b>
                                                        <br>

                                                        <b>{{$data->usulan_luaran_pengabdian_jenis}} (<span class="badge badge-warning">{{$data->usulan_luaran_pengabdian_status}}</span>)</b>

                                                        <h5>{{$data->usulan_luaran_pengabdian_rencana}}</h5>
                                                    </td>
                                                    @php
                                                    $doc = $data->laporan_akhir_luaran()->where('laporan_akhir_luaran_luaran_id', $data->usulan_luaran_id)->first();
                                                    @endphp
                                                    <td>
                                                        @if($doc)
                                                        <b>Nama Publikasi</b> : <p>{{($doc->laporan_akhir_luaran_nama_publikasi) ? $doc->laporan_akhir_luaran_nama_publikasi : "-"}}</p>
                                                        <b>Judul Luaran</b> : <p>{{($doc->laporan_akhir_luaran_judul) ? $doc->laporan_akhir_luaran_judul : "-"}}</p>
                                                        <b>Link Luaran</b> : @php echo ($doc->laporan_akhir_luaran_link) ? '<a href="' . $doc->laporan_akhir_luaran_link . '">' . $doc->laporan_akhir_luaran_link . '</a>' : "-"; @endphp
                                                        @else
                                                        <b>Nama Publikasi</b> : -
                                                        <br>
                                                        <b>Judul Luaran</b> : -
                                                        <br>
                                                        <b>Link Luaran</b> : -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($doc)
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : {{$doc->laporan_akhir_luaran_original_name}}
                                                                <br>
                                                                Tanggal Unggah : {{Carbon\Carbon::parse($doc->laporan_akhir_luaran_date)->isoFormat('D MMMM Y')}}
                                                                <br>
                                                                <a href="{{route('file_preview', [$doc->laporan_akhir_luaran_id, $doc->laporan_akhir_luaran_hash_name,'laporan_akhir_luaran'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                                                <a href="{{route('file_download', [$doc->laporan_akhir_luaran_id, $doc->laporan_akhir_luaran_hash_name,'laporan_akhir_luaran'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : -
                                                                <br>
                                                                Tanggal Unggah : -
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" href="{{route('pengusul_laporan_akhir_insert', [$pengabdian_id, $data->usulan_luaran_id, 'luaran'])}}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                            {{__('id.insert')}} Laporan
                                                        </a>

                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td class="text-center" colspan="3">Luaran Tambahan Kosong</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
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

<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endpush