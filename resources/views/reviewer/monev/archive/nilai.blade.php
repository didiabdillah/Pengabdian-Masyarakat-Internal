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

                        <form action="{{route('reviewer_monev_nilai_update', $id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">NO</th>
                                        <th scope="col">KRITERIA</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">BOBOT</th>
                                        <th scope="col">SKOR</th>
                                        <!-- <th scope="col">NILAI</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-center" scope="row" rowspan="2">1</th>
                                        <td>
                                            Publikasi Ilmiah di jurnal/prosiding
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-1 @error('status_1') is-invalid @enderror" style="width: 100%;" name="status_1" id="status_1">
                                                <option value="">-Status-</option>
                                                <option value="Draft" @if($nilai) @if($nilai->penilaian_monev_status_1 == "Draft"){{"selected"}}@endif @endif>Draft</option>
                                                <option value="Submitted" @if($nilai) @if($nilai->penilaian_monev_status_1 == "Submitted"){{"selected"}}@endif @endif>Submitted</option>
                                                <option value="Reviewed" @if($nilai) @if($nilai->penilaian_monev_status_1 == "Reviewed"){{"selected"}}@endif @endif>Reviewed</option>
                                                <option value="Accepted" @if($nilai) @if($nilai->penilaian_monev_status_1 == "Accepted"){{"selected"}}@endif @endif>Accepted</option>
                                                <option value="Published" @if($nilai) @if($nilai->penilaian_monev_status_1 == "Published"){{"selected"}}@endif @endif>Published</option>
                                            </select>
                                        </td>
                                        <td rowspan="2" class="text-center">20</td>
                                        <td>
                                            <select class="form-control select2-skor-1 @error('skor_1') is-invalid @enderror" style="width: 100%;" name="skor_1" id="skor_1">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            Publikasi pada media massa (cetak/elektronik)
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-2 @error('status_2') is-invalid @enderror" style="width: 100%;" name="status_2" id="status_2">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada" @if($nilai) @if($nilai->penilaian_monev_status_2 == "Tidak Ada"){{"selected"}}@endif @endif>Tidak Ada</option>
                                                <option value="Draft" @if($nilai) @if($nilai->penilaian_monev_status_2 == "Draft"){{"selected"}}@endif @endif>Draft</option>
                                                <option value="Editting" @if($nilai) @if($nilai->penilaian_monev_status_2 == "Editting"){{"selected"}}@endif @endif>Editting</option>
                                                <option value="Sudah Terbit" @if($nilai) @if($nilai->penilaian_monev_status_2 == "Sudah Terbit"){{"selected"}}@endif @endif>Sudah Terbit</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-2 @error('skor_2') is-invalid @enderror" style="width: 100%;" name="skor_2" id="skor_2">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_2 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_2 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_2 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_2 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_2 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_2 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center" scope="row" rowspan="4">2</th>
                                        <td>
                                            Peningkatan omzet pada mitra yang bergerak dalam bidang ekonomi
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-3 @error('status_3') is-invalid @enderror" style="width: 100%;" name="status_3" id="status_3">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada" @if($nilai) @if($nilai->penilaian_monev_status_3 == "Tidak Ada"){{"selected"}}@endif @endif>Tidak Ada</option>
                                                <option value="Ada" @if($nilai) @if($nilai->penilaian_monev_status_3 == "Ada"){{"selected"}}@endif @endif>Ada</option>
                                            </select>
                                        </td>
                                        <td rowspan="4" class="text-center">60</td>
                                        <td>
                                            <select class="form-control select2-skor-3 @error('skor_3') is-invalid @enderror" style="width: 100%;" name="skor_3" id="skor_3">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_3 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_3 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_3 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_3 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_3 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_3 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            Peningkatan kualitas dan kuantitas produk
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-4 @error('status_4') is-invalid @enderror" style="width: 100%;" name="status_4" id="status_4">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada" @if($nilai) @if($nilai->penilaian_monev_status_4 == "Tidak Ada"){{"selected"}}@endif @endif>Tidak Ada</option>
                                                <option value="Ada" @if($nilai) @if($nilai->penilaian_monev_status_4 == "Ada"){{"selected"}}@endif @endif>Ada</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-4 @error('skor_4') is-invalid @enderror" style="width: 100%;" name="skor_4" id="skor_4">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            Peningkatan pemahaman dan ketrampilan masyarakat
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-5 @error('status_5') is-invalid @enderror" style="width: 100%;" name="status_5" id="status_5">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada" @if($nilai) @if($nilai->penilaian_monev_status_5 == "Tidak Ada"){{"selected"}}@endif @endif>Tidak Ada</option>
                                                <option value="Ada" @if($nilai) @if($nilai->penilaian_monev_status_5 == "Ada"){{"selected"}}@endif @endif>Ada</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-5 @error('skor_5') is-invalid @enderror" style="width: 100%;" name="skor_5" id="skor_5">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            Peningkatan ketentraman/kesehatan masyarakat (mitra masyarakat umum)
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-6 @error('status_6') is-invalid @enderror" style="width: 100%;" name="status_6" id="status_6">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada" @if($nilai) @if($nilai->penilaian_monev_status_6 == "Tidak Ada"){{"selected"}}@endif @endif>Tidak Ada</option>
                                                <option value="Ada" @if($nilai) @if($nilai->penilaian_monev_status_6 == "Ada"){{"selected"}}@endif @endif>Ada</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-6 @error('skor_6') is-invalid @enderror" style="width: 100%;" name="skor_6" id="skor_6">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_6 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_6 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_6 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_6 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_6 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_6 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center" scope="row" rowspan="2">3</th>
                                        <td>
                                            Jasa, model, rekayasa social, sistem, produk/barang
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-7 @error('status_7') is-invalid @enderror" style="width: 100%;" name="status_7" id="status_7">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada" @if($nilai) @if($nilai->penilaian_monev_status_7 == "Tidak Ada"){{"selected"}}@endif @endif>Tidak Ada</option>
                                                <option value="Draft" @if($nilai) @if($nilai->penilaian_monev_status_7 == "Draft"){{"selected"}}@endif @endif>Draft</option>
                                                <option value="Produk" @if($nilai) @if($nilai->penilaian_monev_status_7 == "Produk"){{"selected"}}@endif @endif>Produk</option>
                                                <option value="Penerapan" @if($nilai) @if($nilai->penilaian_monev_status_7 == "Penerapan"){{"selected"}}@endif @endif>Penerapan</option>
                                            </select>
                                        </td>
                                        <td rowspan="2" class="text-center">10</td>
                                        <td>
                                            <select class="form-control select2-skor-7 @error('skor_7') is-invalid @enderror" style="width: 100%;" name="skor_7" id="skor_7">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_7 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_7 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_7 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_7 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_7 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_7 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
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
                                            <select class="form-control select2-status-8 @error('status_8') is-invalid @enderror" style="width: 100%;" name="status_8" id="status_8">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada" @if($nilai) @if($nilai->penilaian_monev_status_8 == "Tidak Ada"){{"selected"}}@endif @endif>Tidak Ada</option>
                                                <option value="Draft" @if($nilai) @if($nilai->penilaian_monev_status_8 == "Draft"){{"selected"}}@endif @endif>Draft</option>
                                                <option value="Terdaftar" @if($nilai) @if($nilai->penilaian_monev_status_8 == "Terdaftar"){{"selected"}}@endif @endif>Terdaftar</option>
                                                <option value="Granted" @if($nilai) @if($nilai->penilaian_monev_status_8 == "Granted"){{"selected"}}@endif @endif>Granted</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control select2-skor-8 @error('skor_8') is-invalid @enderror" style="width: 100%;" name="skor_8" id="skor_8">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_8 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_8 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_8 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_8 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_8 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_8 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="text-center" scope="row">4</th>
                                        <td>
                                            Buku Ajar
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-9 @error('status_9') is-invalid @enderror" style="width: 100%;" name="status_9" id="status_9">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada" @if($nilai) @if($nilai->penilaian_monev_status_9 == "Tidak Ada"){{"selected"}}@endif @endif>Tidak Ada</option>
                                                <option value="Draft" @if($nilai) @if($nilai->penilaian_monev_status_9 == "Draft"){{"selected"}}@endif @endif>Draft</option>
                                                <option value="Editting" @if($nilai) @if($nilai->penilaian_monev_status_9 == "Editting"){{"selected"}}@endif @endif>Editting</option>
                                                <option value="Sudah Terbit" @if($nilai) @if($nilai->penilaian_monev_status_9 == "Sudah Terbit"){{"selected"}}@endif @endif>Sudah Terbit</option>
                                            </select>
                                        </td>
                                        <td class="text-center">10</td>
                                        <td>
                                            <select class="form-control select2-skor-9 @error('skor_9') is-invalid @enderror" style="width: 100%;" name="skor_9" id="skor_9">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_9 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_9 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_9 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_9 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_9 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_9 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th colspan="3">Jumlah</th>
                                        <th>100</th>
                                        <th colspan="2"></th>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="form-group">
                                <label for="komentar">Komentar</label>
                                <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" placeholder="Komentar">{{old('komentar')}}</textarea>
                                @error('komentar')
                                <div class=" invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('reviewer_monev_detail', $id)}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> {{__('id.submit')}}</button>
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
@endpush