@extends('layout.layout_reviewer')

@section('title', 'Monev Capaian Kegiatan Pengabdian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Monev Capaian Kegiatan Pengabdian</h1>
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

                        <form action="{{route('reviewer_monev_capaian_update', $id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

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
                                    <div>
                                        <tr>
                                            <td> <label>Mitra Kegiatan</label></td>
                                            <td>
                                                <input type="text" class="form-control @error('mitra_kegiatan') is-invalid @enderror" id="mitra_kegiatan" name="mitra_kegiatan" value="{{old('mitra_kegiatan')}}">
                                                @error('mitra_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label>Jumlah Mitra</label></td>
                                            <td>
                                                <input type="text" class="form-control @error('jumlah_mitra') is-invalid @enderror" id="jumlah_mitra" name="jumlah_mitra" value="{{old('jumlah_mitra')}}">
                                                @error('jumlah_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label>Pendidikan Mitra</label></td>
                                            <td>
                                                <input type="text" class="form-control @error('pendidikan_mitra') is-invalid @enderror" id="pendidikan_mitra" name="pendidikan_mitra" value="{{old('pendidikan_mitra')}}">
                                                @error('pendidikan_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Persoalan Mitra</label></td>
                                            <td>
                                                <input type="text" class="form-control @error('persoalan_mitra') is-invalid @enderror" id="persoalan_mitra" name="persoalan_mitra" value="{{old('persoalan_mitra')}}">
                                                @error('persoalan_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('status_sosial_mitra') is-invalid @enderror" id="status_sosial_mitra" name="status_sosial_mitra" value="{{old('status_sosial_mitra')}}">
                                                @error('status_sosial_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>

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
                                                <input type="text" class="form-control @error('jarak_lokasi_mitra') is-invalid @enderror" id="jarak_lokasi_mitra" name="jarak_lokasi_mitra" value="{{old('jarak_lokasi_mitra')}}">
                                                @error('jarak_lokasi_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('sarana_transportasi') is-invalid @enderror" id="sarana_transportasi" name="sarana_transportasi" value="{{old('sarana_transportasi')}}">
                                                @error('sarana_transportasi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('sarana_komunikasi') is-invalid @enderror" id="sarana_komunikasi" name="sarana_komunikasi" value="{{old('sarana_komunikasi')}}">
                                                @error('sarana_komunikasi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>

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
                                                <input type="text" class="form-control @error('jumlah_dosen') is-invalid @enderror" id="jumlah_dosen" name="jumlah_dosen" value="{{old('jumlah_dosen')}}">
                                                @error('jumlah_dosen')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Jumlah mahasiswa
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('jumlah_mahasiswa') is-invalid @enderror" id="jumlah_mahasiswa" name="jumlah_mahasiswa" value="{{old('jumlah_mahasiswa')}}">
                                                @error('jumlah_mahasiswa')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Gelar Akademik Tim
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('gelar_akademik_tim') is-invalid @enderror" id="gelar_akademik_tim" name="gelar_akademik_tim" value="{{old('gelar_akademik_tim')}}">
                                                @error('gelar_akademik_tim')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Gender
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" value="{{old('gender')}}">
                                                @error('gender')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('metode_pelaksanaan_kegiatan') is-invalid @enderror" id="metode_pelaksanaan_kegiatan" name="metode_pelaksanaan_kegiatan" value="{{old('metode_pelaksanaan_kegiatan')}}">
                                                @error('metode_pelaksanaan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Waktu Efektif Pelaksanaan Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('waktu_efektif_pelaksanaan') is-invalid @enderror" id="waktu_efektif_pelaksanaan" name="waktu_efektif_pelaksanaan" value="{{old('waktu_efektif_pelaksanaan')}}">
                                                @error('waktu_efektif_pelaksanaan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('keberhasilan') is-invalid @enderror" id="keberhasilan" name="keberhasilan" value="{{old('keberhasilan')}}">
                                                @error('keberhasilan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('keberlanjutan_kegiatan') is-invalid @enderror" id="keberlanjutan_kegiatan" name="keberlanjutan_kegiatan" value="{{old('keberlanjutan_kegiatan')}}">
                                                @error('keberlanjutan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Kapasitas Produksi
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('kapasitas_produksi') is-invalid @enderror" id="kapasitas_produksi" name="kapasitas_produksi" value="{{old('kapasitas_produksi')}}">
                                                @error('kapasitas_produksi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Omzet per bulan
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('omzet_per_bulan') is-invalid @enderror" id="omzet_per_bulan" name="omzet_per_bulan" value="{{old('omzet_per_bulan')}}">
                                                @error('omzet_per_bulan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Persoalan Masyarakat Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('persoalan_masyarakat_mitra') is-invalid @enderror" id="persoalan_masyarakat_mitra" name="persoalan_masyarakat_mitra" value="{{old('persoalan_masyarakat_mitra')}}">
                                                @error('persoalan_masyarakat_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>

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
                                                <input type="text" class="form-control @error('biaya_pnbp') is-invalid @enderror" id="biaya_pnbp" name="biaya_pnbp" value="{{old('biaya_pnbp')}}">
                                                @error('biaya_pnbp')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Sumber Lain
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('biaya_sumber_lain') is-invalid @enderror" id="biaya_sumber_lain" name="biaya_sumber_lain" value="{{old('biaya_sumber_lain')}}">
                                                @error('biaya_sumber_lain')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>

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
                                                <input type="text" class="form-control @error('tahap_pencairan_dana') is-invalid @enderror" id="tahap_pencairan_dana" name="tahap_pencairan_dana" value="{{old('tahap_pencairan_dana')}}">
                                                @error('tahap_pencairan_dana')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    b) Jumlah dana
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('jumlah_dana') is-invalid @enderror" id="jumlah_dana" name="jumlah_dana" value="{{old('jumlah_dana')}}">
                                                @error('jumlah_dana')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>

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
                                                <input type="text" class="form-control @error('peran_serta_mitra') is-invalid @enderror" id="peran_serta_mitra" name="peran_serta_mitra" value="{{old('peran_serta_mitra')}}">
                                                @error('peran_serta_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Kontribusi Pendanaan
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('kontribusi_pendanaan') is-invalid @enderror" id="kontribusi_pendanaan" name="kontribusi_pendanaan" value="{{old('kontribusi_pendanaan')}}">
                                                @error('kontribusi_pendanaan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Peran Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('peran_mitra') is-invalid @enderror" id="peran_mitra" name="peran_mitra" value="{{old('peran_mitra')}}">
                                                @error('peran_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>

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
                                                <input type="text" class="form-control @error('alasan_kelanjutan_kegiatan') is-invalid @enderror" id="alasan_kelanjutan_kegiatan" name="alasan_kelanjutan_kegiatan" value="{{old('alasan_kelanjutan_kegiatan')}}">
                                                @error('alasan_kelanjutan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>

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
                                                <input type="text" class="form-control @error('model_usulan_kegiatan') is-invalid @enderror" id="model_usulan_kegiatan" name="model_usulan_kegiatan" value="{{old('model_usulan_kegiatan')}}">
                                                @error('model_usulan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Anggaran Biaya
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('anggaran_biaya') is-invalid @enderror" id="anggaran_biaya" name="anggaran_biaya" value="{{old('anggaran_biaya')}}">
                                                @error('anggaran_biaya')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Lain-Lain
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('usul_lain_lain') is-invalid @enderror" id="usul_lain_lain" name="usul_lain_lain" value="{{old('usul_lain_lain')}}">
                                                @error('usul_lain_lain')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>

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
                                                <input type="text" class="form-control @error('kegiatan_dinilai_bermanfaat') is-invalid @enderror" id="kegiatan_dinilai_bermanfaat" name="kegiatan_dinilai_bermanfaat" value="{{old('kegiatan_dinilai_bermanfaat')}}">
                                                @error('kegiatan_dinilai_bermanfaat')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Potret permasalahan lain yang terekam
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('permasalahan_lain_terekam') is-invalid @enderror" id="permasalahan_lain_terekam" name="permasalahan_lain_terekam" value="{{old('permasalahan_lain_terekam')}}">
                                                @error('permasalahan_lain_terekam')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>

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
                                                <input type="text" class="form-control @error('jasa') is-invalid @enderror" id="jasa" name="jasa" value="{{old('jasa')}}">
                                                @error('jasa')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Metode atau sistem
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('metode') is-invalid @enderror" id="metode" name="metode" value="{{old('metode')}}">
                                                @error('metode')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Produk/barang
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('produk') is-invalid @enderror" id="produk" name="produk" value="{{old('produk')}}">
                                                @error('produk')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Paten
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('paten') is-invalid @enderror" id="paten" name="paten" value="{{old('paten')}}">
                                                @error('paten')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi (artikel / proceeding)
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('publikasi_artikel') is-invalid @enderror" id="publikasi_artikel" name="publikasi_artikel" value="{{old('publikasi_artikel')}}">
                                                @error('publikasi_artikel')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi Media masa
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('publikasi_media_masa') is-invalid @enderror" id="publikasi_media_masa" name="publikasi_media_masa" value="{{old('publikasi_media_masa')}}">
                                                @error('publikasi_media_masa')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>

                            <div class="card-footer">
                                <a href="{{route('reviewer_monev_detail', $id)}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
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