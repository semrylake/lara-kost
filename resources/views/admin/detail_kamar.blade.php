@extends('dashboard.adminDash')

@section('container')

{{-- <a href="/kost/{{ $kost->slug }}" class="btn btn-primary mt-5 shadow"><i class="fas fa-arrow-left"></i> Kembali</a>
--}}
<div class="row mt-3">
    <div id="carouselExampleDark" class="carousel  carousel-dark slide col-md-8 mb-2" data-bs="carousel">
        <div class="carousel-indicators">
            @php
            $no = 1;
            @endphp

            @foreach ($images_room as $a)
            @if ($no == 1)
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $no-1 }}" class="active"
                aria-current="true" aria-label="Slide {{ $no }}"></button>
            @else()
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $no-1 }}"
                aria-label="Slide {{ $no }}"></button>
            @endif

            @php
            $no++;
            @endphp
            @endforeach

        </div>
        <div class="carousel-inner">
            @php
            $no = 1;
            @endphp

            @foreach ($images_room as $a)
            @if ($no == 1)
            <div class="carousel-item active">
                <img src="/foto-kamar-kost/{{ $a->foto }}" style="width: 100%; height: 450px;" alt="..."
                    class="img-fluid rounded">
            </div>
            @else()
            <div class="carousel-item">
                <img src="/foto-kamar-kost/{{ $a->foto }}" style="width: 100%; height: 450px;" alt="..."
                    class="img-fluid rounded">

            </div>
            @endif

            @php
            $no++;
            @endphp
            @endforeach

        </div>
    </div>
    <div class="detail col-md-4 border shadow rounded">
        <h1 class="text-secondary">No. Kamar : <small>{{ $kamar->kode_kamar }}</small>
        </h1>
        <a href="/admin-detailKost/{{ $kost->slug }}">
            <h4>{{ $kost->namaKost }}</h4>
        </a>

        <hr>
        <div class="alert alert-secondary" role="alert">
            <h5 class="alert-heading">Harga</h5>
            <p>
                <span class="fs-5 fw-bold text-danger">Rp.{{ number_format($kamar->harga , 0, ',', '.')}}</span> /
                Bulan
            </p>
        </div>
        <div class="alert alert-secondary" role="alert">
            <h5 class="alert-heading">Ukuran {{ $kamar->ukuran }}m<sup>2</sup></h5>

        </div>
        <div class="alert alert-secondary" role="alert">
            <h5 class="alert-heading">Keterangan</h5>
            <p>{{ $kamar->keterangan }}</p>

        </div>
    </div>

</div>


@endsection
