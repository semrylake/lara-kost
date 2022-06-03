@extends('dashboard.opDash')

@section('container')

@if($status == "off")
<div class="alert alert-danger alert-dismissible">
    <h5><i class="fas fa-exclamation-triangle"></i> Peringatan !!</h5>
    Anda belum melengkapi informasi data kost anda.
    <a href="/profile">Lengkapi Sekarang!</a>
</div>
@endif
<div class="row">
    <div class="col-md-6  col-lg-2 col-xlg-3">
        <div class="card shadow card-hover">
            <div class="box bg-cyan text-center">
                <h1 class="font-light text-white"><i class="fa fa-users"></i></h1>
                <h5 class="text-white">{{ count($jumlahPenghuni) }}</h5>
                <h6 class="text-white">Jumlah Penghuni</h6>
            </div>
        </div>
    </div>
    <div class="col-md-6  col-lg-2 col-xlg-3">
        <div class="card shadow card-hover">
            <div class="box bg-success text-center">
                <h1 class="font-light text-white"><i class="mdi mdi-glassdoor"></i></h1>
                <h5 class="text-white">{{ $jumlahKamar }}</h5>
                <h6 class="text-white">Jumlah Kamar</h6>
            </div>
        </div>
    </div>

    <div class="col-md-6  col-lg-2 col-xlg-3">
        <div class="card shadow card-hover">
            <div class="box bg-warning text-center">
                <h1 class="font-light text-white"><i class="mdi mdi-bell"></i></h1>
                <h5 class="text-white">{{ $jumlahPesanan }}</h5>
                <h6 class="text-white">Pesanan Kamar</h6>
            </div>
        </div>
    </div>
</div>



{{-- <script src="assets/js/myjs.js"></script> --}}
@endsection
