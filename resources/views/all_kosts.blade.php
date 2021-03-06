@extends('layouts.app')
@section('content')
<div class="row d-flex mt-2 justify-content-center">
    <form action="/all-kosts" class="col-md-6">
        <div class="input-group">
            <input autofocus type="text" class="form-control" value="{{request('search')}}" name="search"
                placeholder="Cari kost berdasarkan nama, alamat/lokasi, fasilitas, dan harga......">
            <button class="btn btn-success" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>

    </form>
</div>
<div class="harga-murah mt-5">
    <div class="row">
        <div class="col">
            <h5>Semua Kost</h5>
        </div>
    </div>
    @if ($kost->count())
    <div class="mt-1 row">
        @php
        $id = '';
        @endphp
        @foreach ($kost as $a)
        @if ($id != $a->id)
        <div class="col-sm-3" style="height: 100%">
            <a href="/kost/{{ $a->slug }}" class="text-dark" style="text-decoration: none;">
                <div class="card shadow rounded  p-2" style=" height: 100%;">
                    <img src="/foto-profil-kost/{{ $a->foto }}" class="card-img-top" height="60%">
                    <div class="card-body p-2" style="height: 50%">
                        <strong style="font-size: 1rem" class="text-uppercase">{{ $a->namaKost }}</strong>
                        <p class="card-text"><i class="me-2 fas fa-map-marker-alt"></i> {{ $a->alamat }}</p>
                        <p style="margin-top: -10px" class="card-text mb-3"><i class="me-2 fas fa-phone"></i> {{
                            $a->tlpn }}</p>
                    </div>
                </div>
            </a>
        </div>
        @php
        $id = $a->id;
        @endphp
        @endif
        @endforeach
        {{-- <div class="d-flex justify-content-end mb-5">
            {{ $produk->links() }}
        </div> --}}
    </div>
    @else
    <p class="text-center fs-4 mt-5">Data yang dicari tidak ditemukan.</p>
    @endif
</div>
@endsection
