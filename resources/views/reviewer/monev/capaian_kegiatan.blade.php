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
                                    <!-- CAPAIAN -->
                                    <div>
                                        <!-- Mitra kegiatan -->
                                        <tr>
                                            <td> <label>Mitra Kegiatan</label></td>
                                            <td>
                                                <input type="text" class="form-control @error('mitra_kegiatan') is-invalid @enderror" id="mitra_kegiatan" name="mitra_kegiatan" value="@if($capaian){{$capaian->mitra_kegiatan}}@else{{old('mitra_kegiatan')}}@endif">
                                                @error('mitra_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- Jumlah Mitra -->
                                        <tr>
                                            <td> <label>Jumlah Mitra</label></td>
                                            @php
                                            $decode_jumlah_mitra = NULL;
                                            if($capaian){
                                            $decode_jumlah_mitra = json_decode($capaian->jumlah_mitra, true);
                                            }
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jumlah_mitra_orang') is-invalid @enderror" id="jumlah_mitra_orang" name="jumlah_mitra_orang" value="@if($capaian){{$decode_jumlah_mitra['orang']}}@else{{old('jumlah_mitra_orang')}}@endif">
                                                        @error('jumlah_mitra_orang')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jumlah_mitra_usaha') is-invalid @enderror" id="jumlah_mitra_usaha" name="jumlah_mitra_usaha" value="@if($capaian){{$decode_jumlah_mitra['usaha']}}@else{{old('jumlah_mitra_usaha')}}@endif">
                                                        @error('jumlah_mitra_usaha')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Usaha</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Pendidikan Mitra -->
                                        <tr>
                                            <td> <label>Pendidikan Mitra</label></td>
                                            @php
                                            $decode_pendidikan_mitra = NULL;
                                            if($capaian){
                                            $decode_pendidikan_mitra = json_decode($capaian->pendidikan_mitra, true);
                                            }
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_s3') is-invalid @enderror" id="pendidikan_mitra_s3" name="pendidikan_mitra_s3" value="@if($capaian){{$decode_pendidikan_mitra['s3']}}@else{{old('pendidikan_mitra_s3')}}@endif">
                                                        @error('pendidikan_mitra_s3')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-3 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_s2') is-invalid @enderror" id="pendidikan_mitra_s2" name="pendidikan_mitra_s2" value="@if($capaian){{$decode_pendidikan_mitra['s2']}}@else{{old('pendidikan_mitra_s2')}}@endif">
                                                        @error('pendidikan_mitra_s2')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-2 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_s1') is-invalid @enderror" id="pendidikan_mitra_s1" name="pendidikan_mitra_s1" value="@if($capaian){{$decode_pendidikan_mitra['s1']}}@else{{old('pendidikan_mitra_s1')}}@endif">
                                                        @error('pendidikan_mitra_s1')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-1 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_diploma') is-invalid @enderror" id="pendidikan_mitra_diploma" name="pendidikan_mitra_diploma" value="@if($capaian){{$decode_pendidikan_mitra['diploma']}}@else{{old('pendidikan_mitra_diploma')}}@endif">
                                                        @error('pendidikan_mitra_diploma')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Diploma (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_sma') is-invalid @enderror" id="pendidikan_mitra_sma" name="pendidikan_mitra_sma" value="@if($capaian){{$decode_pendidikan_mitra['sma']}}@else{{old('pendidikan_mitra_sma')}}@endif">
                                                        @error('pendidikan_mitra_sma')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>SMA (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_smp') is-invalid @enderror" id="pendidikan_mitra_smp" name="pendidikan_mitra_smp" value="@if($capaian){{$decode_pendidikan_mitra['smp']}}@else{{old('pendidikan_mitra_smp')}}@endif">
                                                        @error('pendidikan_mitra_smp')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>SMP (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_sd') is-invalid @enderror" id="pendidikan_mitra_sd" name="pendidikan_mitra_sd" value="@if($capaian){{$decode_pendidikan_mitra['sd']}}@else{{old('pendidikan_mitra_sd')}}@endif">
                                                        @error('pendidikan_mitra_sd')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>SD (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_ts') is-invalid @enderror" id="pendidikan_mitra_ts" name="pendidikan_mitra_ts" value="@if($capaian){{$decode_pendidikan_mitra['tidak_berpendidikan']}}@else{{old('pendidikan_mitra_ts')}}@endif">
                                                        @error('pendidikan_mitra_ts')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Tidak Berpendidikan (Orang)</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Persoalan Mitra -->
                                        <tr>
                                            <td><label>Persoalan Mitra</label></td>
                                            <td>
                                                <input type="text" class="form-control @error('persoalan_mitra') is-invalid @enderror" id="persoalan_mitra" name="persoalan_mitra" value="@if($capaian){{$capaian->persoalan_mitra}}@else{{old('persoalan_mitra')}}@endif">
                                                @error('persoalan_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- Status Sosial Mitra -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Status Sosial Mitra:
                                                </label>
                                                <br>
                                                <p>Pengusaha Mikro, Anggota Koperasi, Kelompok Tani/Nelayan, PKK/Karang Taruna, Lainnya (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('status_sosial_mitra') is-invalid @enderror" id="status_sosial_mitra" name="status_sosial_mitra" value="@if($capaian){{$capaian->status_sosial_mitra}}@else{{old('status_sosial_mitra')}}@endif">
                                                @error('status_sosial_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                        <!-- Jarak PT Ke Lokasi Mitra -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Jarak PT Ke Lokasi Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jarak_lokasi_mitra') is-invalid @enderror" id="jarak_lokasi_mitra" name="jarak_lokasi_mitra" value="@if($capaian){{$capaian->jarak_lokasi_mitra}}@else{{old('jarak_lokasi_mitra')}}@endif">
                                                        @error('jarak_lokasi_mitra')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>KM</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Sarana transportasi: -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Sarana transportasi:
                                                </label>
                                                <br>
                                                <p>Angkutan umum, motor, jalan kaki (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('sarana_transportasi') is-invalid @enderror" id="sarana_transportasi" name="sarana_transportasi" value="@if($capaian){{$capaian->sarana_transportasi}}@else{{old('sarana_transportasi')}}@endif">
                                                @error('sarana_transportasi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- Sarana komunikasi: -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Sarana komunikasi:
                                                </label>
                                                <br>
                                                <p>Telepon, Internet, Surat, Fax, Tidak ada sarana komunikasi (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('sarana_komunikasi') is-invalid @enderror" id="sarana_komunikasi" name="sarana_komunikasi" value="@if($capaian){{$capaian->sarana_komunikasi}}@else{{old('sarana_komunikasi')}}@endif">
                                                @error('sarana_komunikasi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                        <!-- Jumlah dosen -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Jumlah dosen
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jumlah_dosen') is-invalid @enderror" id="jumlah_dosen" name="jumlah_dosen" value="@if($capaian){{$capaian->jumlah_dosen}}@else{{old('jumlah_dosen')}}@endif">
                                                        @error('jumlah_dosen')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Jumlah mahasiswa -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Jumlah mahasiswa
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jumlah_mahasiswa') is-invalid @enderror" id="jumlah_mahasiswa" name="jumlah_mahasiswa" value="@if($capaian){{$capaian->jumlah_mahasiswa}}@else{{old('jumlah_mahasiswa')}}@endif">
                                                        @error('jumlah_mahasiswa')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Gelar Akademik Tim -->
                                        <tr>
                                            @php
                                            $decode_gelar_akademik_tim = NULL;
                                            if($capaian){
                                            $decode_gelar_akademik_tim = json_decode($capaian->gelar_akademik_tim, true);
                                            }
                                            @endphp
                                            <td>
                                                <label>
                                                    Gelar Akademik Tim
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gelar_akademik_tim_s3') is-invalid @enderror" id="gelar_akademik_tim_s3" name="gelar_akademik_tim_s3" value="@if($capaian){{$decode_gelar_akademik_tim['s3']}}@else{{old('gelar_akademik_tim_s3')}}@endif">
                                                        @error('gelar_akademik_tim_s3')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-3 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gelar_akademik_tim_s2') is-invalid @enderror" id="gelar_akademik_tim_s2" name="gelar_akademik_tim_s2" value="@if($capaian){{$decode_gelar_akademik_tim['s2']}}@else{{old('gelar_akademik_tim_s2')}}@endif">
                                                        @error('gelar_akademik_tim_s2')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-2 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gelar_akademik_tim_s1') is-invalid @enderror" id="gelar_akademik_tim_s1" name="gelar_akademik_tim_s1" value="@if($capaian){{$decode_gelar_akademik_tim['s1']}}@else{{old('gelar_akademik_tim_s1')}}@endif">
                                                        @error('gelar_akademik_tim_s1')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-1 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gelar_akademik_tim_gb') is-invalid @enderror" id="gelar_akademik_tim_gb" name="gelar_akademik_tim_gb" value="@if($capaian){{$decode_gelar_akademik_tim['gb']}}@else{{old('gelar_akademik_tim_gb')}}@endif">
                                                        @error('gelar_akademik_tim_gb')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>GB (Orang)</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Gender -->
                                        <tr>
                                            @php
                                            $decode_gender = NULL;
                                            if($capaian){
                                            $decode_gender = json_decode($capaian->gender, true);
                                            }
                                            @endphp
                                            <td>
                                                <label>
                                                    Gender
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gender_pria') is-invalid @enderror" id="gender_pria" name="gender_pria" value="@if($capaian){{$decode_gender['pria']}}@else{{old('gender_pria')}}@endif">
                                                        @error('gender_pria')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Laki-Laki (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gender_wanita') is-invalid @enderror" id="gender_wanita" name="gender_wanita" value="@if($capaian){{$decode_gender['wanita']}}@else{{old('gender_wanita')}}@endif">
                                                        @error('gender_wanita')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
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
                                        <!-- Metode Pelaksanaan Kegiatan: -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Metode Pelaksanaan Kegiatan:
                                                </label>
                                                <br>
                                                <p>Penyuluhan/Penyadaran , Pendampingan Pendidikan, Demplot, Rancang Bangun, Pelatihan Manajemen Usaha, Pelatihan Produksi, Pelatihan Administrasi, Pengobatan, Lainnya (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('metode_pelaksanaan_kegiatan') is-invalid @enderror" id="metode_pelaksanaan_kegiatan" name="metode_pelaksanaan_kegiatan" value="@if($capaian){{$capaian->metode_pelaksanaan_kegiatan}}@else{{old('metode_pelaksanaan_kegiatan')}}@endif">
                                                @error('metode_pelaksanaan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- Waktu Efektif Pelaksanaan Kegiatan -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Waktu Efektif Pelaksanaan Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('waktu_efektif_pelaksanaan') is-invalid @enderror" id="waktu_efektif_pelaksanaan" name="waktu_efektif_pelaksanaan" value="@if($capaian){{$capaian->waktu_efektif_pelaksanaan_kegiatan}}@else{{old('waktu_efektif_pelaksanaan')}}@endif">
                                                        @error('waktu_efektif_pelaksanaan')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
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
                                        <!-- Keberhasilan -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Keberhasilan
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="keberhasilan_berhasil" name="keberhasilan" value="Berhasil" @if($capaian)@if($capaian->keberhasilan == "Berhasil"){{'checked'}}@endif @elseif(old('keberhasilan') == "Berhasil"){{'checked'}}@endif>
                                                    <label for="keberhasilan_berhasil">
                                                        Berhasil
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="keberhasilan_gagal" name="keberhasilan" value="Gagal" @if($capaian)@if($capaian->keberhasilan == "Gagal"){{'checked'}}@endif @elseif(old('keberhasilan') == "Gagal"){{'checked'}}@endif>
                                                    <label for="keberhasilan_gagal">
                                                        Gagal
                                                    </label>
                                                </div>
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
                                        <!-- Keberlanjutan Kegiatan Di Mitra -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Keberlanjutan Kegiatan Di Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="keberlanjutan_kegiatan_berlanjut" name="keberlanjutan_kegiatan" value="Berlanjut" @if($capaian)@if($capaian->keberlanjutan_kegiatan_mitra == "Berlanjut"){{'checked'}}@endif @elseif(old('keberlanjutan_kegiatan') == "Berlanjut"){{'checked'}}@endif>
                                                    <label for="keberlanjutan_kegiatan_berlanjut">
                                                        Berlanjut
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="keberlanjutan_kegiatan_berhenti" name="keberlanjutan_kegiatan" value="Berhenti" @if($capaian)@if($capaian->keberlanjutan_kegiatan_mitra == "Berhenti"){{'checked'}}@endif @elseif(old('keberlanjutan_kegiatan') == "Berhenti"){{'checked'}}@endif>
                                                    <label for="keberlanjutan_kegiatan_berhenti">
                                                        Berhenti
                                                    </label>
                                                </div>
                                                @error('keberlanjutan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- Kapasitas Produksi -->
                                        <tr>
                                            @php
                                            $decode_kapasitas_produksi = NULL;
                                            if($capaian){
                                            $decode_kapasitas_produksi = json_decode($capaian->kapasitas_produksi, true);
                                            }
                                            @endphp
                                            <td>
                                                <label>
                                                    Kapasitas Produksi
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Sebelum PM</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('kapasitas_produksi_sebelum') is-invalid @enderror" id="kapasitas_produksi_sebelum" name="kapasitas_produksi_sebelum" value="@if($capaian){{$decode_kapasitas_produksi['sebelum']}}@else{{old('kapasitas_produksi_sebelum')}}@endif">
                                                        @error('kapasitas_produksi_sebelum')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Setelah PM</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('kapasitas_produksi_setelah') is-invalid @enderror" id="kapasitas_produksi_setelah" name="kapasitas_produksi_setelah" value="@if($capaian){{$decode_kapasitas_produksi['setelah']}}@else{{old('kapasitas_produksi_setelah')}}@endif">
                                                        @error('kapasitas_produksi_setelah')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Omzet per bulan -->
                                        <tr>
                                            @php
                                            $decode_omzet_perbulan = NULL;
                                            if($capaian){
                                            $decode_omzet_perbulan = json_decode($capaian->omzet_perbulan, true);
                                            }
                                            @endphp
                                            <td>
                                                <label>
                                                    Omzet per bulan
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Sebelum PM Rp.</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('omzet_per_bulan_sebelum') is-invalid @enderror" id="omzet_per_bulan_sebelum" name="omzet_per_bulan_sebelum" value="@if($capaian){{$decode_omzet_perbulan['sebelum']}}@else{{old('omzet_per_bulan_sebelum')}}@endif">
                                                        @error('omzet_per_bulan_sebelum')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Setelah PM Rp.</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('omzet_per_bulan_setelah') is-invalid @enderror" id="omzet_per_bulan_setelah" name="omzet_per_bulan_setelah" value="@if($capaian){{$decode_omzet_perbulan['setelah']}}@else{{old('omzet_per_bulan_setelah')}}@endif">
                                                        @error('omzet_per_bulan_setelah')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Persoalan Masyarakat Mitra -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Persoalan Masyarakat Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="persoalan_masyarakat_mitra_terselesaikan" name="persoalan_masyarakat_mitra" value="Terselesaikan" @if($capaian)@if($capaian->persoalan_masyarakat_mitra == "Terselesaikan"){{'checked'}}@endif @elseif(old('persoalan_masyarakat_mitra') == "Terselesaikan"){{'checked'}}@endif>
                                                    <label for="persoalan_masyarakat_mitra_terselesaikan">
                                                        Terselesaikan
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="persoalan_masyarakat_mitra_tidak_terselesaikan" name="persoalan_masyarakat_mitra" value="Tidak Terselesaikan" @if($capaian)@if($capaian->persoalan_masyarakat_mitra == "Tidak Terselesaikan"){{'checked'}}@endif @elseif(old('persoalan_masyarakat_mitra') == "Tidak Terselesaikan"){{'checked'}}@endif>
                                                    <label for="persoalan_masyarakat_mitra_tidak_terselesaikan">
                                                        Tidak Terselesaikan
                                                    </label>
                                                </div>
                                                @error('persoalan_masyarakat_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                        <!-- PNBP -->
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
                                                        <input type="text" class="form-control @error('biaya_pnbp') is-invalid @enderror" id="biaya_pnbp" name="biaya_pnbp" value="@if($capaian){{$capaian->biaya_pnbp}}@else{{old('biaya_pnbp')}}@endif">
                                                        @error('biaya_pnbp')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Sumber Lain -->
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
                                                        <input type="text" class="form-control @error('biaya_sumber_lain') is-invalid @enderror" id="biaya_sumber_lain" name="biaya_sumber_lain" value="@if($capaian){{$capaian->biaya_sumber_lain}}@else{{old('biaya_sumber_lain')}}@endif">
                                                        @error('biaya_sumber_lain')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
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
                                        <!-- a) Tahapan pencairan dana -->
                                        <tr>
                                            <td>
                                                <label>
                                                    a) Tahapan pencairan dana
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="tahap_pencairan_dana_mendukung" name="tahap_pencairan_dana" value="Mendukung Kegiatan" @if($capaian)@if($capaian->tahapan_pencairan_dana == "Mendukung Kegiatan"){{'checked'}}@endif @elseif(old('tahap_pencairan_dana') == "Mendukung Kegiatan"){{'checked'}}@endif>
                                                    <label for="tahap_pencairan_dana_mendukung">
                                                        Mendukung kegiatan
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="tahap_pencairan_dana_mengganggu" name="tahap_pencairan_dana" value="Mengganggu Kelancaran Kegiatan Di Lapangan" @if($capaian)@if($capaian->tahapan_pencairan_dana == "Mengganggu Kelancaran Kegiatan Di Lapangan"){{'checked'}}@endif @elseif(old('tahap_pencairan_dana') == "Mengganggu Kelancaran Kegiatan Di Lapangan"){{'checked'}}@endif>
                                                    <label for="tahap_pencairan_dana_mengganggu">
                                                        Mengganggu Kelancaran kegiatan di lapangan
                                                    </label>
                                                </div>
                                                @error('tahap_pencairan_dana')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- b) Jumlah dana -->
                                        <tr>
                                            <td>
                                                <label>
                                                    b) Jumlah dana
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="jumlah_dana_diterima" name="jumlah_dana" value="Diterima 100%" @if($capaian)@if($capaian->jumlah_dana == "Diterima 100%"){{'checked'}}@endif @elseif(old('jumlah_dana') == "Diterima 100%"){{'checked'}}@endif>
                                                    <label for="jumlah_dana_diterima">
                                                        Diterima 100%
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="jumlah_dana_tidak_diterima" name="jumlah_dana" value="Tidak Diterima 100%" @if($capaian)@if($capaian->jumlah_dana == "Tidak Diterima 100%"){{'checked'}}@endif @elseif(old('jumlah_dana') == "Tidak Diterima 100%"){{'checked'}}@endif>
                                                    <label for="jumlah_dana_tidak_diterima">
                                                        Tidak Diterima 100%
                                                    </label>
                                                </div>
                                                @error('jumlah_dana')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                        <!-- Peran Serta Mitra dalam Kegiatan -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Peran Serta Mitra dalam Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_serta_mitra_aktif" name="peran_serta_mitra" value="Aktif" @if($capaian)@if($capaian->peran_serta_mitra == "Aktif"){{'checked'}}@endif @elseif(old('peran_serta_mitra') == "Aktif"){{'checked'}}@endif>
                                                    <label for="peran_serta_mitra_aktif">
                                                        Aktif
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_serta_mitra_pasif" name="peran_serta_mitra" value="Pasif" @if($capaian)@if($capaian->peran_serta_mitra == "Pasif"){{'checked'}}@endif @elseif(old('peran_serta_mitra') == "Pasif"){{'checked'}}@endif>
                                                    <label for="peran_serta_mitra_pasif">
                                                        Pasif
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_serta_mitra_acuh" name="peran_serta_mitra" value="Acuh Tak Acuh" @if($capaian)@if($capaian->peran_serta_mitra == "Acuh Tak Acuh"){{'checked'}}@endif @elseif(old('peran_serta_mitra') == "Acuh Tak Acuh"){{'checked'}}@endif>
                                                    <label for="peran_serta_mitra_acuh">
                                                        Acuh Tak Acuh
                                                    </label>
                                                </div>
                                                @error('peran_serta_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- Kontribusi Pendanaan -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Kontribusi Pendanaan
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="kontribusi_pendanaan_menyediakan" name="kontribusi_pendanaan" value="Menyediakan" @if($capaian)@if($capaian->kontribusi_pendanaan == "Menyediakan"){{'checked'}}@endif @elseif(old('kontribusi_pendanaan') == "Menyediakan"){{'checked'}}@endif>
                                                    <label for="kontribusi_pendanaan_menyediakan">
                                                        Menyediakan
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="kontribusi_pendanaan_tidak_menyediakan" name="kontribusi_pendanaan" value="Tidak Menyediakan" @if($capaian)@if($capaian->kontribusi_pendanaan == "Tidak Menyediakan"){{'checked'}}@endif @elseif(old('kontribusi_pendanaan') == "Tidak Menyediakan"){{'checked'}}@endif>
                                                    <label for="kontribusi_pendanaan_tidak_menyediakan">
                                                        Tidak Menyediakan
                                                    </label>
                                                </div>
                                                @error('kontribusi_pendanaan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- Peranan Mitra -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Peranan Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_mitra_objek" name="peran_mitra" value="Objek Kegiatan" @if($capaian)@if($capaian->peranan_mitra == "Objek Kegiatan"){{'checked'}}@endif @elseif(old('peran_mitra') == "Objek Kegiatan"){{'checked'}}@endif>
                                                    <label for="peran_mitra_objek">
                                                        Objek Kegiatan
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_mitra_subjek" name="peran_mitra" value="Subjek Kegiatan" @if($capaian)@if($capaian->peranan_mitra == "Subjek Kegiatan"){{'checked'}}@endif @elseif(old('peran_mitra') == "Subjek Kegiatan"){{'checked'}}@endif>
                                                    <label for="peran_mitra_subjek">
                                                        Subjek Kegiatan
                                                    </label>
                                                </div>
                                                @error('peran_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                        <!-- Alasan Kelanjutan Kegiatan Mitra -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Alasan Kelanjutan Kegiatan Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="alasan_kelanjutan_kegiatan_permintaan" name="alasan_kelanjutan_kegiatan" value="Permintaan Masyarakat" @if($capaian)@if($capaian->alasan_kelanjutan_kegiatan == "Permintaan Masyarakat"){{'checked'}}@endif @elseif(old('alasan_kelanjutan_kegiatan') == "Permintaan Masyarakat"){{'checked'}}@endif>
                                                    <label for="alasan_kelanjutan_kegiatan_permintaan">
                                                        Permintaan Masyarakat
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="alasan_kelanjutan_kegiatan_keputusan" name="alasan_kelanjutan_kegiatan" value="Keputusan Bersama" @if($capaian)@if($capaian->alasan_kelanjutan_kegiatan == "Keputusan Bersama"){{'checked'}}@endif @elseif(old('alasan_kelanjutan_kegiatan') == "Keputusan Bersama"){{'checked'}}@endif>
                                                    <label for="alasan_kelanjutan_kegiatan_keputusan">
                                                        Keputusan Bersama
                                                    </label>
                                                </div>
                                                @error('alasan_kelanjutan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                        <!-- Model Usulan Kegiatan -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Model Usulan Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('model_usulan_kegiatan') is-invalid @enderror" id="model_usulan_kegiatan" name="model_usulan_kegiatan" value="@if($capaian){{$capaian->model_usulan_kegiatan}}@else{{old('model_usulan_kegiatan')}}@endif">
                                                @error('model_usulan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- Anggaran Biaya -->
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
                                                        <input type="text" class="form-control @error('anggaran_biaya') is-invalid @enderror" id="anggaran_biaya" name="anggaran_biaya" value="@if($capaian){{$capaian->anggaran_biaya}}@else{{old('anggaran_biaya')}}@endif">
                                                        @error('anggaran_biaya')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Lain-Lain -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Lain-Lain
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('usul_lain_lain') is-invalid @enderror" id="usul_lain_lain" name="usul_lain_lain" value="@if($capaian){{$capaian->lain_lain}}@else{{old('usul_lain_lain')}}@endif">
                                                @error('usul_lain_lain')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                        <!-- Produk/kegiatan yang dinilai bermanfaat
                                        dari berbagai perspektif (Tuliskan) -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Produk/kegiatan yang dinilai bermanfaat
                                                    dari berbagai perspektif (Tuliskan)
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('kegiatan_dinilai_bermanfaat') is-invalid @enderror" id="kegiatan_dinilai_bermanfaat" name="kegiatan_dinilai_bermanfaat" value="@if($capaian){{$capaian->kegiatan_yang_dinilai}}@else{{old('kegiatan_dinilai_bermanfaat')}}@endif">
                                                @error('kegiatan_dinilai_bermanfaat')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- Potret permasalahan lain yang terekam -->
                                        <tr>
                                            <td>
                                                <label>
                                                    Potret permasalahan lain yang terekam
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('permasalahan_lain_terekam') is-invalid @enderror" id="permasalahan_lain_terekam" name="permasalahan_lain_terekam" value="@if($capaian){{$capaian->potret_permasalahan}}@else{{old('permasalahan_lain_terekam')}}@endif">
                                                @error('permasalahan_lain_terekam')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                        <!-- - Jasa -->
                                        <tr>
                                            <td>
                                                <label>
                                                    - Jasa
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('jasa') is-invalid @enderror" id="jasa" name="jasa" value="@if($capaian){{$capaian->jasa}}@else{{old('jasa')}}@endif">
                                                @error('jasa')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- - Metode atau sistem -->
                                        <tr>
                                            <td>
                                                <label>
                                                    - Metode atau sistem
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('metode') is-invalid @enderror" id="metode" name="metode" value="@if($capaian){{$capaian->metode}}@else{{old('metode')}}@endif">
                                                @error('metode')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- - Produk/barang -->
                                        <tr>
                                            <td>
                                                <label>
                                                    - Produk/barang
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('produk') is-invalid @enderror" id="produk" name="produk" value="@if($capaian){{$capaian->produk}}@else{{old('produk')}}@endif">
                                                @error('produk')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- - Paten -->
                                        <tr>
                                            <td>
                                                <label>
                                                    - Paten
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('paten') is-invalid @enderror" id="paten" name="paten" value="@if($capaian){{$capaian->paten}}@else{{old('paten')}}@endif">
                                                @error('paten')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- - Publikasi (artikel / proceeding) -->
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi (artikel / proceeding)
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('publikasi_artikel') is-invalid @enderror" id="publikasi_artikel" name="publikasi_artikel" value="@if($capaian){{$capaian->publikasi_artikel}}@else{{old('publikasi_artikel')}}@endif">
                                                @error('publikasi_artikel')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <!-- - Publikasi Media masa -->
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi Media masa
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('publikasi_media_masa') is-invalid @enderror" id="publikasi_media_masa" name="publikasi_media_masa" value="@if($capaian){{$capaian->publikasi_media_massa}}@else{{old('publikasi_media_masa')}}@endif">
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
                                <a href="{{route('reviewer_monev_nilai', $id)}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
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