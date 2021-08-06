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
                                <a class="btn btn-danger" href="{{route('reviewer_monev_capaian', [$usulan->usulan_pengabdian_id])}}">
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

                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center pb-4 mt-4">
                                <b>
                                    Monev Capaian Kegiatan Pengabdian
                                </b>
                            </h4>

                            <table class="table table-bordered" style="table-layout: fixed;">
                                <thead>
                                    <tr class="text-center">
                                        <!-- <th scope="col">NO</th>
                                        <th scope="col">KRITERIA</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">BOBOT</th>
                                        <th scope="col">SKOR</th>
                                        <th scope="col">NILAI</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- CAPAIAN -->
                                    <div>
                                        <tr>
                                            <td> <label>Mitra Kegiatan</label></td>
                                            <td>
                                                {{$capaian->mitra_kegiatan}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label>Jumlah Mitra</label></td>
                                            @php
                                            $decode_jumlah_mitra = json_decode($capaian->jumlah_mitra, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    {{$decode_jumlah_mitra['orang']}}
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_jumlah_mitra['usaha']}}
                                                    <div class="col">
                                                        <label>Usaha</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label>Pendidikan Mitra</label></td>
                                            @php
                                            $decode_pendidikan_mitra = json_decode($capaian->pendidikan_mitra, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    {{$decode_pendidikan_mitra['s3']}}
                                                    <div class="col">
                                                        <label>S-3 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_pendidikan_mitra['s2']}}
                                                    <div class="col">
                                                        <label>S-2 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_pendidikan_mitra['s1']}}
                                                    <div class="col">
                                                        <label>S-1 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_pendidikan_mitra['diploma']}}
                                                    <div class="col">
                                                        <label>Diploma (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_pendidikan_mitra['sma']}}
                                                    <div class="col">
                                                        <label>SMA (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_pendidikan_mitra['smp']}}
                                                    <div class="col">
                                                        <label>SMP (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_pendidikan_mitra['sd']}}
                                                    <div class="col">
                                                        <label>SD (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_pendidikan_mitra['tidak_berpendidikan']}}
                                                    <div class="col">
                                                        <label>Tidak Berpendidikan (Orang)</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Persoalan Mitra</label></td>
                                            <td>
                                                {{$capaian->persoalan_mitra}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Status Sosial Mitra:
                                                </label>
                                                <br>
                                                <p>Pengusaha Mikro, Anggota Koperasi, Kelompok Tani/Nelayan, PKK/Karang Taruna, Lainnya (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                {{$capaian->status_sosial_mitra}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- LOKASI -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Lokasi
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Jarak PT Ke Lokasi Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    {{$capaian->jarak_lokasi_mitra}}
                                                    <div class="col">
                                                        <label>KM</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Sarana transportasi:
                                                </label>
                                                <br>
                                                <p>Angkutan umum, motor, jalan kaki (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                {{$capaian->sarana_transportasi}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Sarana komunikasi:
                                                </label>
                                                <br>
                                                <p>Telepon, Internet, Surat, Fax, Tidak ada sarana komunikasi (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                {{$capaian->sarana_komunikasi}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- IDENTITAS -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Identitas
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <!-- <h5 class="text-center"> -->
                                                <b>
                                                    Tim Pengabdian Masyarakat
                                                </b>
                                                <!-- </h5> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Jumlah dosen
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    {{$capaian->jumlah_dosen}}
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Jumlah mahasiswa
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    {{$capaian->jumlah_mahasiswa}}
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Gelar Akademik Tim
                                                </label>
                                            </td>
                                            @php
                                            $decode_gelar_akademik_tim = json_decode($capaian->gelar_akademik_tim, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    {{$decode_gelar_akademik_tim['s3']}}
                                                    <div class="col">
                                                        <label>S-3 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_gelar_akademik_tim['s2']}}
                                                    <div class="col">
                                                        <label>S-2 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_gelar_akademik_tim['s1']}}
                                                    <div class="col">
                                                        <label>S-1 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_gelar_akademik_tim['gb']}}
                                                    <div class="col">
                                                        <label>GB (Orang)</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Gender
                                                </label>
                                            </td>
                                            @php
                                            $decode_gender = json_decode($capaian->gender, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    {{$decode_gender['pria']}}
                                                    <div class="col">
                                                        <label>Laki-Laki (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{$decode_gender['wanita']}}
                                                    <div class="col">
                                                        <label>Perempuan (Orang)</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <!-- <h5 class="text-center"> -->
                                                <b>
                                                    Aktivitas Pengabdian Masyarakat
                                                </b>
                                                <!-- </h5> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Metode Pelaksanaan Kegiatan:
                                                </label>
                                                <br>
                                                <p>Penyuluhan/Penyadaran , Pendampingan Pendidikan, Demplot, Rancang Bangun, Pelatihan Manajemen Usaha, Pelatihan Produksi, Pelatihan Administrasi, Pengobatan, Lainnya (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                {{$capaian->metode_pelaksanaan_kegiatan}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Waktu Efektif Pelaksanaan Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    {{$capaian->waktu_efektif_pelaksanaan_kegiatan}}
                                                    <div class="col">
                                                        <label>Bulan</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <!-- <h5 class="text-center"> -->
                                                <b>
                                                    Evaluasi Kegiatan
                                                </b>
                                                <!-- </h5> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Keberhasilan
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->keberhasilan}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <!-- <h5 class="text-center"> -->
                                                <b>
                                                    Indikator Keberhasilan
                                                </b>
                                                <!-- </h5> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Keberlanjutan Kegiatan Di Mitra
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->keberlanjutan_kegiatan_mitra}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Kapasitas Produksi
                                                </label>
                                            </td>
                                            @php
                                            $decode_kapasitas_produksi = json_decode($capaian->kapasitas_produksi, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Sebelum PM</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{$decode_kapasitas_produksi['sebelum']}}
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Setelah PM</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{$decode_kapasitas_produksi['setelah']}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Omzet per bulan
                                                </label>
                                            </td>
                                            @php
                                            $decode_omzet_perbulan = json_decode($capaian->omzet_perbulan, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Sebelum PM Rp.</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{$decode_omzet_perbulan['sebelum']}}
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Setelah PM Rp.</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{$decode_omzet_perbulan['setelah']}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Persoalan Masyarakat Mitra
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->persoalan_masyarakat_mitra}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- BIAYA PROGRAM -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Biaya Program
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    PNBP
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Rp. </b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{$capaian->biaya_pnbp}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Sumber Lain
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Rp. </b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{$capaian->biaya_sumber_lain}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- LIKUIDITAS DANA PROGRAM -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Likuiditas Dana Program
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    a) Tahapan pencairan dana
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->tahapan_pencairan_dana}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    b) Jumlah dana
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->jumlah_dana}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- KONTRIBUSI MITRA -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Kontribusi Mitra
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Peran Serta Mitra dalam Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->peran_serta_mitra}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Kontribusi Pendanaan
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->kontribusi_pendanaan}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Peranan Mitra
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->peranan_mitra}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- KEBERLANJUTAN -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Keberlanjutan
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Alasan Kelanjutan Kegiatan Mitra
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->alasan_kelanjutan_kegiatan}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- Usul penyempurnaan program Pengabdian Masyarakat -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Usul penyempurnaan program Pengabdian Masyarakat
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Model Usulan Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->model_usulan_kegiatan}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Anggaran Biaya
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Rp. </b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{$capaian->anggaran_biaya}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Lain-Lain
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->lain_lain}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- DOKUMENTASI -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Dokumentasi (Foto kegiatan dan Produk)
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Produk/kegiatan yang dinilai bermanfaat
                                                    dari berbagai perspektif (Tuliskan)
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->kegiatan_yang_dinilai}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Potret permasalahan lain yang terekam
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->potret_permasalahan}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- Luaran program Pengabdian Masyarakat berupa -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Luaran program Pengabdian Masyarakat berupa
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Jasa
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->jasa}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Metode atau sistem
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->metode}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Produk/barang
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->produk}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Paten
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->paten}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi (artikel / proceeding)
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->publikasi_artikel}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi Media masa
                                                </label>
                                            </td>
                                            <td>
                                                {{$capaian->publikasi_media_massa}}
                                            </td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
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