@extends('layout.layout_reviewer')

@section('title', 'Ulasan Nilai Monev Pengabdian')

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

                    <!-- NILAI MONEV -->
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
                                        <th scope="row" style="width: 250px;">Judul</th>
                                        <td>: {{$usulan->usulan_pengabdian_judul}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Nama Ketua Tim Pelaksana</th>
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
                                    <th scope="col">SKOR</th>
                                    <th scope="col">BOBOT</th>
                                    <th scope="col">NILAI</th>
                                    <th scope="col">JUSTIFIKASI PENILAIAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- NO 1 -->
                                <tr>
                                    <th class="text-center" scope="row">1</th>
                                    <td>
                                        <b>Kontribusi Pihak Ketiga</b>
                                        <br>
                                        (Dukungan dana dan/atau sarana dan prasarana)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["1"]}}
                                    </td>
                                    <td class="text-center">10</td>
                                    <td class="text-center">
                                        {{$nilai["1"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["1"]}}
                                    </td>
                                </tr>

                                <!-- NO 2A -->
                                <tr>
                                    <th class="text-center" scope="row" rowspan="6">2</th>
                                    <td>
                                        <b>Kegiatan PM</b>
                                        (Pilih butir-butir yang sesuai dengan kegiatan)
                                        <br>
                                        a. Program Capacity Building
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2a"]}}
                                    </td>
                                    <td rowspan="6" class="text-center">15</td>
                                    <td class="text-center">
                                        {{$nilai["2a"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2a"]}}
                                    </td>
                                </tr>

                                <!-- NO 2B -->
                                <tr>
                                    <td>
                                        b. Penerapan teknologi tepat guna
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2b"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2b"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2b"]}}
                                </tr>

                                <!-- NO 2C -->
                                <tr>
                                    <td>
                                        c. Problem Solving
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2c"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2c"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2c"]}}
                                    </td>
                                </tr>

                                <!-- NO 2D -->
                                <tr>
                                    <td>
                                        d. Difusi hasil-hasil penelitian
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2d"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2d"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2d"]}}
                                    </td>
                                </tr>

                                <!-- NO 2E -->
                                <tr>
                                    <td>
                                        e. Peningkatan daya saing UKM
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2e"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2e"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2e"]}}
                                    </td>
                                </tr>

                                <!-- NO 2F -->
                                <tr>
                                    <td>
                                        f. Komersialisasi hasil-hasil penelitian
                                    </td>
                                    <td class="text-center">
                                        {{$skor["2f"]}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai["2f"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["2f"]}}
                                    </td>
                                </tr>

                                <!-- NO 3 -->
                                <tr>
                                    <th class="text-center" scope="row">3</th>
                                    <td>
                                        <b>Peningkatan Potensi Daerah/Mitra</b>
                                        <br>
                                        (Keberhasilan program dalam memanfaatkan potensi daerah,
                                        <br>
                                        keserasian potensi daerah dan aktivitas program,
                                        <br>
                                        ketepatan program terhadap persoalan yang dihadapi mitra)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["3"]}}
                                    </td>
                                    <td class="text-center">25</td>
                                    <td class="text-center">
                                        {{$nilai["3"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["3"]}}
                                    </td>
                                </tr>

                                <!-- NO 4 -->
                                <tr>
                                    <th class="text-center" scope="row">4</th>
                                    <td>
                                        <b>Partisipasi Masyarakat</b>
                                        <br>
                                        (Tingkat partisipasi masyarakat/mitra dalam pelaksanaan program,
                                        <br>
                                        posisi strategis masyarakat sebagai mitra, keterpaduan dan kebersamaan
                                        <br>
                                        dengan PT dengan Lembaga Pemerintah atau institusi setempat)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["4"]}}
                                    </td>
                                    <td class="text-center">25</td>
                                    <td class="text-center">
                                        {{$nilai["4"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["4"]}}
                                    </td>
                                </tr>

                                <!-- NO 5 -->
                                <tr>
                                    <th class="text-center" scope="row">5</th>
                                    <td>
                                        <b>Mutu Pelaksanaan Program</b>
                                        <br>
                                        (Integritas, dedikasi dan kekompakan tim,
                                        <br>
                                        level penerimaan masyarakat, keberlanjutan)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["5"]}}
                                    </td>
                                    <td class="text-center">15</td>
                                    <td class="text-center">
                                        {{$nilai["5"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["5"]}}
                                    </td>
                                </tr>

                                <!-- NO 6 -->
                                <tr>
                                    <th class="text-center" scope="row">6</th>
                                    <td>
                                        <b>Lokasi Kegiatan</b>
                                        <br>
                                        (kemudahan pencapaian, intensitas kebersamaan di kawasan)
                                    </td>
                                    <td class="text-center">
                                        {{$skor["6"]}}
                                    </td>
                                    <td class="text-center">10</td>
                                    <td class="text-center">
                                        {{$nilai["6"]}}
                                    </td>
                                    <td>
                                        {{$justifikasi["6"]}}
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th colspan="2">Total</th>
                                    <th>{{$skor["1"] + $skor["2a"] + $skor["2b"] + $skor["2c"] + $skor["2d"] + $skor["2e"] + $skor["2f"] + $skor["3"] + $skor["4"] + $skor["5"] + $skor["6"]}}</th>
                                    <th>100</th>
                                    <th>{{$nilai["1"] + $nilai["2a"] + $nilai["2b"] + $nilai["2c"] + $nilai["2d"] + $nilai["2e"] + $nilai["2f"] + $nilai["3"] + $nilai["4"] + $nilai["5"] + $nilai["6"]}}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="row mt-5 mx-2">
                            <h6>
                                <b>Catatan Selama Peninjauan :</b>
                                <br>
                                @if($penilaian_monev->penilaian_monev_catatan)
                                {{$penilaian_monev->penilaian_monev_catatan}}
                                @else
                                {{"-"}}
                                @endif
                            </h6>
                        </div>

                        <div class="row mx-2 mt-3">
                            <div class="col align-self-start"></div>
                            <div class="col align-self-center"></div>
                            <div class="col align-self-end">
                                <h6>
                                    Indramayu, {{Carbon\Carbon::parse($penilaian_monev->updated_at)->isoFormat('D MMMM Y')}}
                                    <br>
                                    Pemantau,
                                    <br>
                                    <img src="{{URL::asset('assets/file/tanda_tangan/' . $penilaian_monev->penilaian_monev_tanda_tangan)}}" alt="" style="width: 300px;">
                                    <br>
                                    <b>{{$usulan->user_name}}</b>
                                    <br>
                                    NIDN {{$usulan->user_nidn}}
                                </h6>
                            </div>
                        </div>
                    </div>

                </div>
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