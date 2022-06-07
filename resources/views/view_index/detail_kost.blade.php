@extends('layouts.app')

@section('content')
<div id="map" class="border rounded shadow" style="width: 100%; height: 350px;"></div>
<div class="row mt-3">
    <div id="carouselExampleDark" class="carousel carousel-dark slide col-md-8 mb-2" data-bs="carousel">
        <div class="carousel-indicators">
            @php
            $no = 1;
            @endphp
            @foreach ($galeri as $a)
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
            @foreach ($galeri as $a)
            @if ($no == 1)
            <div class="carousel-item active">
                <img src="/foto-galeri-kost/{{ $a->foto }}" style="width: 100%; height: 400px;" alt="..."
                    class="img-fluid rounded">
            </div>
            @else()
            <div class="carousel-item">
                <img src="/foto-galeri-kost/{{ $a->foto }}" style="width: 100%; height: 400px;" alt="..."
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
        <h1 class="text-secondary">{{ $kost->namaKost }}</h1>
        <p class="text-secondary"><i class="me-2 fas fa-map-marker-alt"></i> {{ $kost->alamat }}</p>
        <p class="text-secondary"><i class="me-2 fas fa-phone"></i> {{ $kost->tlpn }}</p>
        <hr>
        <div class="alert alert-secondary" role="alert">
            <h5 class="alert-heading">Harga mulai</h5>
            <p>
                <span class="fs-5 fw-bold text-danger">Rp.{{ number_format($hargaTermurah , 0, ',', '.')}}</span> /
                Bulan
            </p>
        </div>
        <div class="alert alert-secondary" role="alert">
            <p>
                <span class="fs-5 fw-bold">{{ number_format($jumlahKamar , 0, ',', '.')}}</span> Jumlah Kamar
            </p>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-8">
        <div class="card shadow ">
            <div class="card-header">
                <h3 class="card-title">
                    Peraturan
                </h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($peraturan as $a)
                    <li>{{ $a->regulation }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow ">
            <div class="card-header">
                <h3 class="card-title">
                    Fasilitas
                </h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($fasilitas as $a)
                    <li>{{ $a->fasilitas }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="mt-3" id="kamar">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="font-weight-bold text-dark">Daftar Kamar</h4>
        </div>
        <div class="card-body">
            <a class="btn text-dark" href="" style="border-color: black; margin-bottom: 1px;">
                <i class="fas fa-fw fa-retweet"></i> Refresh
            </a>
            <hr>
            <div class="table-responsive mt-2">
                <table class="table table-hover" id="zero_config" width="100%">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            {{-- <th>Status</th> --}}
                            <th>No. Kamar</th>
                            <th>Harga</th>
                            <th>Ukuran</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody align="center">

                        @forelse ($kamar as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- @php
                            $idroom = '';
                            @endphp
                            @foreach ($penghuni as $item )

                            @if ($item->room_id == $a->id)
                            @php
                            $idroom = $item->room_id;
                            @endphp
                            @if ($idroom == $item->room_id)
                            <td class="text-danger fw-bold">Sudah disewa</td>
                            @php
                            $idroom ='';
                            @endphp

                            @endif
                            @else
                            <td class="text-success fw-bold">Masih kosong</td>
                            @endif
                            {{-- @empty
                            <td class="text-success fw-bold">Masih kosong</td>
                            @endforeach --}}


                            <td>{{ $a->kode_kamar }}</td>
                            <td>Rp.{{ number_format($a->harga , 0, ',', '.')}}</td>
                            <td>{{ number_format($a->ukuran , 0, ',', '.')}} m<sup>2</sup></td>
                            <td>{{ $a->keterangan }}</td>
                            <td>
                                <a href="/detail-kamar/{{ $a->slug }}" target="_blank"
                                    class="btn btn-sm btn-success mt-1 mb-1">
                                    <i class="fas fa-eye"></i> Detail</a>
                                @if ($a->keterangan == 'Masih Kosong')
                                <a href="/pesan-kamar/{{ $a->slug }}" target="_blank"
                                    class="btn text-white btn-sm btn-info"><i class="fas fa-shopping-cart"></i>
                                    Pesan</a>
                                {{-- @else
                                <button class="btn text-white btn-sm btn-info">Sudah Disewa</button> --}}
                                @endif

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada data</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCueVJrO7FkMxGPutUScb99BL8gQaHvwh4&callback=initMap&libraries=&v=weekly"
    async>
</script>
<script>
    function initMap() {
  // The location of Uluru
  const uluru = { lat: {{$kost->latitude}}, lng: {{ $kost->longitude }} };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 20,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}
</script>

@endsection
