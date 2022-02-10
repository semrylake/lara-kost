@extends('layouts.app')

@section('content')

<div id="carouselExampleDark" class="carousel mt-1 carousel-dark slide" style="height: 500px; " data-bs="carousel">
    <div class="carousel-indicators mt-2">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        {{-- <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3"
            aria-label="Slide 4"></button> --}}
    </div>
    <div class="carousel-inner">
        <div style="height: 500px; background: black; overflow: hidden;" class="carousel-item active">
            <img src="{!! asset('assets/logo/perumahan.jpeg') !!}"
                style="width: 100%; height: 100%; opacity: 0.9; object-fit: cover" alt="..." class="d-block img-fluid">
            <div class="carousel-caption d-none d-md-block">
                <h4 class=" fw-bolder text-white">CARI DAN TEMUKAN TEMPAT TINGGAL SESUAI KEINGINAN ANDA</h4>
                <a href="/all-kosts" class="btn btn-info text-white fw-bolder">MULAI CARI</a>
            </div>
        </div>
        <div style="height: 500px;  background: black; overflow: hidden;" class="carousel-item">
            <img src="{!! asset('assets/logo/kamar_kost.jpg') !!}"
                style="width: 100%; height: 100%; opacity: 0.9; object-fit: cover" alt="..." class="d-block img-fluid">
            <div class="carousel-caption d-none d-md-block">
                <h4 class="fw-bolder text-white mt-5">TEMUKAN KAMAR YANG NYAMAN UNTUK ANDA</h4>
                <a href="/all-rooms" class="btn btn-info text-white fw-bolder">CARI KAMAR</a>
            </div>
        </div>
        <div style="height: 500px;  background: black; overflow: hidden;" class="carousel-item">
            <img src="{!! asset('assets/logo/register-phone.jpg') !!}"
                style="width: 100%; height: 100%; opacity: 0.9; object-fit: cover" alt="..." class="d-block img-fluid">
            <div class="carousel-caption d-none d-md-block">
                <h4 class="fw-bolder text-white mt-5">DAFTAR DAN PROMOSIKAN KOST ANDA</h4>
                <a href="/register" class="btn btn-info text-white fw-bolder">AYO DAFTAR</a>
            </div>
        </div>
        {{-- <div style="height: 500px;  background: black; overflow: hidden;" class="carousel-item">
            <img src="{!! asset('assets/logo/maps.jpg') !!}"
                style="width: 100%; height: 100%; opacity: 0.9; object-fit: cover" alt="..." class="d-block img-fluid">
            <div class="carousel-caption d-none d-md-block">
                <h4 class="fw-bolder text-white mt-5">TEMUKAN TEMPAT TINGGAL SEMENTARA DI SEKITAR ANDA</h4>
                <a href="/register" class="btn btn-info text-white fw-bolder">YUK LIHAT</a>
            </div>
        </div> --}}
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="harga-murah p-3 mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h3 class="text-center text-uppercase">Daftar Hunian/kost</h3>
        </div>
        <hr>
        <div class="col">
            <a class="float-end text-decoration-none" href="/all-kosts">Lihat Semua</a>
        </div>
    </div>
    <div class="mt-1 row">
        @foreach ($daftarkost as $a)
        <div class="col-sm-2">
            <a href="/kost/{{ $a->slug }}" class="text-dark" style="text-decoration: none;">
                <div class="card shadow rounded p-2" style=" height: 100%;">
                    <img src="{!! asset('storage/'.$a->foto) !!}" class="card-img-top" height="100px">
                    <div class="card-body" style="height: 50%">
                        <strong style="font-size: 1em">{{$a->namaKost}}</strong>
                        {{-- <strong style="font-size: 1em">Rp.{{number_format($a->harga, 0, ',',
                            '.');}}</strong> --}}
                        {{-- <p class="card-text">Ukuran : {{ $a->alamat }}m<sup>2</sup></p> --}}
                        <p class="card-text" style="font-size: 1rem">Lokasi : {{ $a->alamat }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>






@endsection
