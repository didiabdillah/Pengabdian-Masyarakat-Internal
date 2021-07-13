@extends('layout.layout_reviewer')

@section('title', 'Konfirmasi Usulan Pengabdian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Konfirmasi Usulan Pengabdian</h1>
                </div>
            </div>

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <form action="{{route('reviewer_pengabdian_nilai_update', $id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">

                                <div class="form-group clearfix">
                                    <label for="nilai_1">1. Administrasi (Kesesuaian Dengan Template)</label>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1a" name="nilai_1" value="5">
                                        <label for="nilai_1a">
                                            Sangat Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1b" name="nilai_1" value="4">
                                        <label for="nilai_1b">
                                            Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1c" name="nilai_1" value="3">
                                        <label for="nilai_1c">
                                            Cukup Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1d" name="nilai_1" value="2">
                                        <label for="nilai_1d">
                                            Kurang Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1e" name="nilai_1" value="1">
                                        <label for="nilai_1e">
                                            Tidak Sesuai
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group clearfix">
                                    <label for="nilai_2">2. Substansi (Sesuai Dengan Kepakaran, Judul, Tujuan, Dan Acuan)</label>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2a" name="nilai_2" value="5">
                                        <label for="nilai_2a">
                                            Sangat Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2b" name="nilai_2" value="4">
                                        <label for="nilai_2b">
                                            Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2c" name="nilai_2" value="3">
                                        <label for="nilai_2c">
                                            Cukup Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2d" name="nilai_2" value="2">
                                        <label for="nilai_2d">
                                            Kurang Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2e" name="nilai_2" value="1">
                                        <label for="nilai_2e">
                                            Tidak Sesuai
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group clearfix">
                                    <label for="nilai_3">3. Anggaran (Kelayakan, Kepatutan, Terisi Semua)</label>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3a" name="nilai_3" value="5">
                                        <label for="nilai_3a">
                                            Sangat Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3b" name="nilai_3" value="4">
                                        <label for="nilai_3b">
                                            Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3c" name="nilai_3" value="3">
                                        <label for="nilai_3c">
                                            Cukup Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3d" name="nilai_3" value="2">
                                        <label for="nilai_3d">
                                            Kurang Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3e" name="nilai_3" value="1">
                                        <label for="nilai_3e">
                                            Tidak Sesuai
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group clearfix">
                                    <label for="nilai_4">4. Luaran yang Dijanjikan</label>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4a" name="nilai_4" value="5">
                                        <label for="nilai_4a">
                                            Sangat Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4b" name="nilai_4" value="4">
                                        <label for="nilai_4b">
                                            Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4c" name="nilai_4" value="3">
                                        <label for="nilai_4c">
                                            Cukup Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4d" name="nilai_4" value="2">
                                        <label for="nilai_4d">
                                            Kurang Sesuai
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4e" name="nilai_4" value="1">
                                        <label for="nilai_4e">
                                            Tidak Sesuai
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group clearfix">
                                    <label for="nilai_5">5. Mahasiswa Yang Terlibat</label>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5a" name="nilai_5" value="5">
                                        <label for="nilai_5a">
                                            5 Orang Atau Lebih
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5b" name="nilai_5" value="4">
                                        <label for="nilai_5b">
                                            4 Orang
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5c" name="nilai_5" value="3">
                                        <label for="nilai_5c">
                                            3 Orang
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5d" name="nilai_5" value="2">
                                        <label for="nilai_5d">
                                            2 Orang
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5e" name="nilai_5" value="1">
                                        <label for="nilai_5e">
                                            1 Orang
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" placeholder="Komentar"></textarea>
                                    @error('komentar')
                                    <div class=" invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{route('reviewer_pengabdian_detail', $id)}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

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