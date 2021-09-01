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
                    <h1>Monev Pengabdian</h1>
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
                            <h5><b>Form Monev Pengabdian</b></h5>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Judul</th>
                                        <td>: {{$usulan->usulan_pengabdian_judul}}</td>
                                    </tr>
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

                        <form action="{{route('reviewer_monev_nilai_update', $id)}}" method="POST" enctype="multipart/form-data" id="form_monev">
                            @csrf
                            @method('patch')

                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">NO</th>
                                        <th scope="col">KRITERIA</th>
                                        <th scope="col">BOBOT</th>
                                        <th scope="col">SKOR</th>
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
                                        <td class="text-center">10</td>
                                        <td>
                                            <select class="form-control select2-skor-1 @error('skor_1') is-invalid @enderror" style="width: 100%;" name="skor_1" id="skor_1">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["1"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["1"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["1"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["1"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["1"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["1"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_1" type="text" class="form-control @error('justifikasi_1') is-invalid @enderror" id="justifikasi_1" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['1']}}@endif">
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
                                        <td rowspan="6" class="text-center">15</td>
                                        <td>
                                            <select class="form-control select2-skor-2a @error('skor_2a') is-invalid @enderror" style="width: 100%;" name="skor_2a" id="skor_2a">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["2a"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["2a"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["2a"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["2a"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["2a"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["2a"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_2a" type="text" class="form-control @error('justifikasi_2a') is-invalid @enderror" id="justifikasi_2a" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['2a']}}@endif">
                                        </td>
                                    </tr>

                                    <!-- NO 2B -->
                                    <tr>
                                        <td>
                                            b. Penerapan teknologi tepat guna
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-2b @error('skor_2b') is-invalid @enderror" style="width: 100%;" name="skor_2b" id="skor_2b">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["2b"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["2b"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["2b"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["2b"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["2b"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["2b"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_2b" type="text" class="form-control @error('justifikasi_2b') is-invalid @enderror" id="justifikasi_2b" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['2b']}}@endif">
                                        </td>
                                    </tr>

                                    <!-- NO 2C -->
                                    <tr>
                                        <td>
                                            c. Problem Solving
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-2c @error('skor_2c') is-invalid @enderror" style="width: 100%;" name="skor_2c" id="skor_2c">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["2c"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["2c"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["2c"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["2c"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["2c"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["2c"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_2c" type="text" class="form-control @error('justifikasi_2c') is-invalid @enderror" id="justifikasi_2c" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['2c']}}@endif">
                                        </td>
                                    </tr>

                                    <!-- NO 2D -->
                                    <tr>
                                        <td>
                                            d. Difusi hasil-hasil penelitian
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-2d @error('skor_2d') is-invalid @enderror" style="width: 100%;" name="skor_2d" id="skor_2d">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["2d"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["2d"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["2d"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["2d"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["2d"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["2d"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_2d" type="text" class="form-control @error('justifikasi_2d') is-invalid @enderror" id="justifikasi_2d" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['2d']}}@endif">
                                        </td>
                                    </tr>

                                    <!-- NO 2E -->
                                    <tr>
                                        <td>
                                            e. Peningkatan daya saing UKM
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-2e @error('skor_2e') is-invalid @enderror" style="width: 100%;" name="skor_2e" id="skor_2e">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["2e"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["2e"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["2e"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["2e"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["2e"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["2e"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_2e" type="text" class="form-control @error('justifikasi_2e') is-invalid @enderror" id="justifikasi_2e" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['2e']}}@endif">
                                        </td>
                                    </tr>

                                    <!-- NO 2F -->
                                    <tr>
                                        <td>
                                            f. Komersialisasi hasil-hasil penelitian
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-2f @error('skor_2f') is-invalid @enderror" style="width: 100%;" name="skor_2f" id="skor_2f">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["2f"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["2f"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["2f"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["2f"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["2f"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["2f"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_2f" type="text" class="form-control @error('justifikasi_2f') is-invalid @enderror" id="justifikasi_2f" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['2f']}}@endif">
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
                                        <td class="text-center">25</td>
                                        <td>
                                            <select class="form-control select2-skor-3 @error('skor_3') is-invalid @enderror" style="width: 100%;" name="skor_3" id="skor_3">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["3"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["3"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["3"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["3"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["3"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["3"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_3" type="text" class="form-control @error('justifikasi_3') is-invalid @enderror" id="justifikasi_3" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['3']}}@endif">
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
                                        <td class="text-center">25</td>
                                        <td>
                                            <select class="form-control select2-skor-4 @error('skor_4') is-invalid @enderror" style="width: 100%;" name="skor_4" id="skor_4">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["4"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["4"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["4"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["4"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["4"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["4"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_4" type="text" class="form-control @error('justifikasi_4') is-invalid @enderror" id="justifikasi_4" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['4']}}@endif">
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
                                        <td class="text-center">15</td>
                                        <td>
                                            <select class="form-control select2-skor-5 @error('skor_5') is-invalid @enderror" style="width: 100%;" name="skor_5" id="skor_5">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["5"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["5"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["5"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["5"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["5"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["5"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_5" type="text" class="form-control @error('justifikasi_5') is-invalid @enderror" id="justifikasi_5" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['5']}}@endif">
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
                                        <td class="text-center">10</td>
                                        <td>
                                            <select class="form-control select2-skor-6 @error('skor_6') is-invalid @enderror" style="width: 100%;" name="skor_6" id="skor_6">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($skor) @if($skor["6"]=="1" ){{"selected"}}@endif @endif>(1) Sangat Buruk Sekali</option>
                                                <option value="2" @if($skor) @if($skor["6"]=="2" ){{"selected"}}@endif @endif>(2) Buruk Sekali</option>
                                                <option value="3" @if($skor) @if($skor["6"]=="3" ){{"selected"}}@endif @endif>(3) Buruk</option>
                                                <option value="4" @if($skor) @if($skor["6"]=="4" ){{"selected"}}@endif @endif>(4) Baik</option>
                                                <option value="5" @if($skor) @if($skor["6"]=="5" ){{"selected"}}@endif @endif>(5) Baik Sekali</option>
                                                <option value="6" @if($skor) @if($skor["6"]=="6" ){{"selected"}}@endif @endif>(6) Istimewa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="justifikasi_6" type="text" class="form-control @error('justifikasi_6') is-invalid @enderror" id="justifikasi_6" placeholder="Justifikasi Penilaian" value="@if($justifikasi){{$justifikasi['6']}}@endif">
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th colspan="2">Total</th>
                                        <th>100</th>
                                        <th colspan="2"></th>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="form-group">
                                <label>Tanda Tangan (Wajib)</label>
                                <div id="canvasDiv" style="border-style: dashed;"></div>
                                <input type="hidden" id="signature" name="signature" class="@error('signature') is-invalid @enderror">
                                @error('signature')
                                <div class=" invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <button type="button" class="btn btn-danger mt-2" id="reset-btn">Ulangi Tanda Tangan</button>
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan Selama Peninjauan (Opsional)</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" placeholder="Catatan..." rows="5">{{old('catatan')}}</textarea>
                                @error('catatan')
                                <div class=" invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('reviewer_monev_detail', $id)}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
                                <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-check"></i> {{__('id.submit')}}</button>
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
            "language": {
                "url": "{{URL::asset('assets/js/datatables/Indonesian.json')}}"
            },
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script>
    $(document).ready(() => {
        var canvasDiv = document.getElementById('canvasDiv');
        var canvas = document.createElement('canvas');
        canvas.setAttribute('id', 'canvas');
        canvasDiv.appendChild(canvas);
        $("#canvas").attr('height', $("#canvasDiv").outerHeight() + 500);
        $("#canvas").attr('width', $("#canvasDiv").width());
        if (typeof G_vmlCanvasManager != 'undefined') {
            canvas = G_vmlCanvasManager.initElement(canvas);
        }

        context = canvas.getContext("2d");
        $('#canvas').mousedown(function(e) {
            var offset = $(this).offset()
            var mouseX = e.pageX - this.offsetLeft;
            var mouseY = e.pageY - this.offsetTop;

            paint = true;
            addClick(e.pageX - offset.left, e.pageY - offset.top);
            redraw();
        });

        $('#canvas').mousemove(function(e) {
            if (paint) {
                var offset = $(this).offset()
                //addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
                addClick(e.pageX - offset.left, e.pageY - offset.top, true);
                console.log(e.pageX, offset.left, e.pageY, offset.top);
                redraw();
            }
        });

        $('#canvas').mouseup(function(e) {
            paint = false;
        });

        $('#canvas').mouseleave(function(e) {
            paint = false;
        });

        var clickX = new Array();
        var clickY = new Array();
        var clickDrag = new Array();
        var paint;

        function addClick(x, y, dragging) {
            clickX.push(x);
            clickY.push(y);
            clickDrag.push(dragging);
        }

        $("#reset-btn").click(function() {
            context.clearRect(0, 0, window.innerWidth, window.innerWidth);
            clickX = [];
            clickY = [];
            clickDrag = [];
        });

        $(document).on('click', '.btn-submit', function(e) {
            e.preventDefault();
            var mycanvas = document.getElementById('canvas');
            var img = mycanvas.toDataURL("image/png");
            anchor = $("#signature");
            anchor.val(img);
            $("#form_monev").submit();
        });

        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;

        canvas.addEventListener("touchstart", function(e) {
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);


        canvas.addEventListener("touchend", function(e) {
            var mouseEvent = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(mouseEvent);
        }, false);


        canvas.addEventListener("touchmove", function(e) {

            var touch = e.touches[0];
            var offset = $('#canvas').offset();
            var mouseEvent = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);



        // Get the position of a touch relative to the canvas
        function getTouchPos(canvasDiv, touchEvent) {
            var rect = canvasDiv.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            };
        }


        var elem = document.getElementById("canvas");

        var defaultPrevent = function(e) {
            e.preventDefault();
        }
        elem.addEventListener("touchstart", defaultPrevent);
        elem.addEventListener("touchmove", defaultPrevent);


        function redraw() {
            //
            lastPos = mousePos;
            for (var i = 0; i < clickX.length; i++) {
                context.beginPath();
                if (clickDrag[i] && i) {
                    context.moveTo(clickX[i - 1], clickY[i - 1]);
                } else {
                    context.moveTo(clickX[i] - 1, clickY[i]);
                }
                context.lineTo(clickX[i], clickY[i]);
                context.closePath();
                context.stroke();
            }
        }
    })
</script>
@endpush