@extends('layout.layout_reviewer')

@section('title', 'Ulasan Nilai Usulan Pengabdian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Ulasan Nilai Usulan Pengabdian</h1>
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
                        <div class="alert alert-light">
                            <form action="{{route('reviewer_monev_nilai_ulasan_update', [$usulan->usulan_pengabdian_id])}}" method="POST" class="form-inline form-horizontal float-right">
                                @csrf
                                @method('patch')
                                <a class="btn btn-danger" href="{{route('reviewer_monev_nilai', [$usulan->usulan_pengabdian_id])}}">
                                    <i class="fas fa-arrow-left">
                                    </i>

                                    {{__('id.back')}}
                                </a>
                                <button class="btn btn-success btn-confirm ml-1" type="submit">
                                    <i class="fas fa-check">
                                    </i>

                                    Kirim Nilai
                                </button>

                            </form>

                            <h5><b>Ulasan Hasil Monev Pengabdian</b></h5>

                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Nama Ketua Pengusul</th>
                                        <td>: {{$ketua->user_name}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">NIDN</th>
                                        <td>: {{$ketua->user_nidn}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Skema</th>
                                        <td>: {{$usulan->skema_label}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Bidang</th>
                                        <td>: {{$usulan->bidang_label}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Jurusan</th>
                                        <td>: {{$ketua->biodata_jurusan}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Program Studi</th>
                                        <td>: {{$ketua->biodata_program_studi}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Nama Anggota</th>
                                        <td>: @foreach($anggota as $row){{$row->user_name . ", "}}@endforeach</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">KRITERIA</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">BOBOT</th>
                                    <th scope="col">SKOR</th>
                                    <th scope="col">NILAI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row" rowspan="2">1</th>
                                    <td>
                                        Publikasi Ilmiah di jurnal/prosiding
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_status_1}}
                                    </td>
                                    <td rowspan="2" class="text-center">20</td>
                                    <td>
                                        {{$nilai->penilaian_monev_skor_1}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_nilai_1}}
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        Publikasi pada media massa (cetak/elektronik)
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_status_2}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_skor_2}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_nilai_2}}
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-center" scope="row" rowspan="4">2</th>
                                    <td>
                                        Peningkatan omzet pada mitra yang bergerak dalam bidang ekonomi
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_status_3}}
                                    </td>
                                    <td rowspan="4" class="text-center">60</td>
                                    <td>
                                        {{$nilai->penilaian_monev_skor_3}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_nilai_3}}
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        Peningkatan kualitas dan kuantitas produk
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_status_4}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_skor_4}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_nilai_4}}
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        Peningkatan pemahaman dan ketrampilan masyarakat
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_status_5}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_skor_5}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_nilai_5}}
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        Peningkatan ketentraman/kesehatan masyarakat (mitra masyarakat umum)
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_status_6}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_skor_6}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_nilai_6}}
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-center" scope="row" rowspan="2">3</th>
                                    <td>
                                        Jasa, model, rekayasa social, sistem, produk/barang
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_status_7}}
                                    </td>
                                    <td rowspan="2" class="text-center">10</td>
                                    <td>
                                        {{$nilai->penilaian_monev_skor_7}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_nilai_7}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Hak kekayaan intelektual
                                        <br>
                                        (paten, paten sederhana, hak cipta, merek dagang, rahasia dagang,
                                        <br>
                                        desain produk industri, perlindungan varietas tanaman, perlindungan topografi)
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_status_8}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_skor_8}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_nilai_8}}
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-center" scope="row">4</th>
                                    <td>
                                        Buku Ajar
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_status_9}}
                                    </td>
                                    <td class="text-center">10</td>
                                    <td>
                                        {{$nilai->penilaian_monev_skor_9}}
                                    </td>
                                    <td>
                                        {{$nilai->penilaian_monev_nilai_9}}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th colspan="3">Jumlah</th>
                                    <th>100</th>
                                    <th>
                                        {{
                                            $nilai->penilaian_monev_skor_1 +
                                            $nilai->penilaian_monev_skor_2 +
                                            $nilai->penilaian_monev_skor_3 +
                                            $nilai->penilaian_monev_skor_4 +
                                            $nilai->penilaian_monev_skor_5 +
                                            $nilai->penilaian_monev_skor_6 +
                                            $nilai->penilaian_monev_skor_7 +
                                            $nilai->penilaian_monev_skor_8 +
                                            $nilai->penilaian_monev_skor_9
                                        }}
                                    </th>
                                    <th>
                                        {{
                                            $nilai->penilaian_monev_nilai_1 +
                                            $nilai->penilaian_monev_nilai_2 +
                                            $nilai->penilaian_monev_nilai_3 +
                                            $nilai->penilaian_monev_nilai_4 +
                                            $nilai->penilaian_monev_nilai_5 +
                                            $nilai->penilaian_monev_nilai_6 +
                                            $nilai->penilaian_monev_nilai_7 +
                                            $nilai->penilaian_monev_nilai_8 +
                                            $nilai->penilaian_monev_nilai_9
                                        }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="row mt-5 mx-2">
                            <h6>
                                <b>Komentar :</b>
                                <br>
                                @if($nilai->penilaian_monev_komentar)
                                {{$nilai->penilaian_monev_komentar}}
                                @else
                                {{"-"}}
                                @endif
                            </h6>
                        </div>
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
    $('.btn-confirm').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal.fire({
            title: 'Anda Yakin?',
            text: "Anda Tidak Dapat Mengubah Nilai Setelah Dikirimkan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim Nilai',
            cancelButtonText: 'Batal'
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