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
            {{--
                <div class="row">
                <div class="col-12 col-sm-3 col-md-3">
                    <a href="" class="btn btn-primary btn-md mb-3 btn-block"><i class="fas fa-plus"></i> Tambah Laporan Akhir</a>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            --}}
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
                                    <th>Laporan Akhir</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporan_akhir as $data)
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
                                        @php
                                        $doc = $data->laporan_akhir()->where('laporan_akhir_pengabdian_id', $data->usulan_pengabdian_id)->first();
                                        @endphp

                                        @if($doc)
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-file-pdf"></i>
                                            </div>
                                            <div class="col-11">
                                                Nama File : {{$doc->laporan_akhir_original_name}}
                                                <br>
                                                Tanggal Unggah : {{Carbon\Carbon::parse($doc->laporan_akhir_file_date)->isoFormat('D MMMM Y')}}
                                                <br>
                                                <a href="{{route('file_preview', [$doc->laporan_akhir_id, $doc->laporan_akhir_hash_name,'laporan_akhir'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                                <a href="{{route('file_download', [$doc->laporan_akhir_id, $doc->laporan_akhir_hash_name,'laporan_akhir'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-file-pdf fa-2x"></i>
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
                                        <button type="button" data-toggle="modal" data-id="{{$data->usulan_pengabdian_id}}" data-target="#modal-default" class="btn btn-primary upload-laporan-akhir"><b><i class="fas fa-upload"></i> Upload</b></button>
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

<!-- Upload Laporan Akhir Modal -->
<div class="modal fade " id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Laporan Akhir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('pengusul_laporan_akhir_upload_update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <input type="hidden" class="" id="pengabdian_id" name="pengabdian_id" value="">
                        <div class="form-group">
                            <label for="laporan_akhir">Laporan Akhir Upload (PDF)</label>
                            <div class="input-group  @error('laporan_akhir') is-invalid @enderror">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('laporan_akhir') is-invalid @enderror" id="laporan_akhir" name="laporan_akhir">
                                    <label class="custom-file-label" id="laporan_akhir_label" for="laporan_akhir">Upload File Disini</label>
                                </div>
                            </div>
                            @error('laporan_akhir')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
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

<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });
</script>

@error('laporan_akhir')
<script type="text/javascript">
    $(document).ready(function() {
        var pengabdian_id = "{{old('pengabdian_id')}}";
        $('#modal-default').modal('show');
        $('#pengabdian_id').val(pengabdian_id);
    });
</script>
@enderror

<script type="text/javascript">
    $(document).on('click', '.upload-laporan-akhir', function() {
        var pengabdian_id = $(this).data("id");

        $('#pengabdian_id').val(pengabdian_id);
        $('#laporan_akhir').val("");
        $('#laporan_akhir_label').text("Upload File Disini");
    });
</script>
@endpush