@php $is_suspended = App\Models\User::select('user_ban')->where('user_id', Session::get('user_id'))->first()->user_ban; @endphp
@if($is_suspended)
<div class="alert alert-danger m-4">
    <h5><i class="icon fas fa-ban"></i> Perhatian, Akun Anda Ditangguhkan!</h5>
    Beberapa Akses Fitur Tidak Dapat Digunakan... Silahkan Menghubungi Admin Untuk Melakukan Pemulihan Akun
</div>
@endif