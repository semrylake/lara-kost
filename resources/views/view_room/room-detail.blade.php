@extends('dashboard.opDash')

@section('container')

@if (session('psn'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('psn') }}
</div>
@endif
@if (session('del'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('del') }}
</div>
@endif

<a href="/room" class="btn btn-info shadow"><i class="fas fa-arrow-left"></i> Kembali</a>
<div class="card mb-3 shadow mt-2">
    <div class="card-header py-3">
        <h4 class="m-0 ">Detail Kamar {{ $room->kode_kamar}}</h4>
    </div>
    <div class="card-body">
        <b>No. Kamar : {{ $room->kode_kamar }}</b><br>
        <b>Harga Sewa: Rp.{{ number_format($room->harga , 0, ',', '.') }}</b><br>
        <b>Luas Kamar : {{ number_format($room->ukuran , 0, ',', '.') }} m<sup>2</sup></b>

        <hr>
        <img class="img-preview mb-2 img-fluid col-sm-2">
        <div class="col-lg-6">
            <form class="d-inline form-horizontal" action="/addFotoKamar" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-8">
                        <input type="file" class=" form-control form-control-sm @error('foto') is-invalid @enderror"
                            id="foto" name="foto" value="{{ old('foto') }}" onchange="previewImage()" required>
                        <div class="invalid-feedback text-danger">
                            @error('foto')
                            {{ $message }}
                            @enderror
                        </div>
                        <input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}" required>
                        <input type="hidden" name="slug" id="slug" value="{{ $room->slug }}" required>
                    </div>

                    <button type="submit" style="height: 90%" id="savereg" class="col-md-2 mt-1 btn-sm btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>

        </div>
        <hr>
        <div class="row el-element-overlay">


            @forelse ($fotoKamar as $a)
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1">
                            <img class="img-fluid rounded " style="height: 150px"
                                src="{{ asset('storage/'.$a->foto) }}" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item">
                                        <form action="/delete-imageroom/{{ $a->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="slug" id="slug" value="{{ $room->slug }}">
                                            <button type="submit" title="Hapus" class="btn-sm btn btn-danger "
                                                onclick="return confirm('Anda yakin ingin menghapus gambar ini??');"><i
                                                    class=" fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @empty
            <div class="col-lg-12">
                <h4 class="mt-4 text-center">Tidak ada gambar terkait</h4>

            </div>

            @endforelse


        </div>
    </div>
</div>

@livewireScripts

<script>
    function previewImage(params) {
    const image = document.querySelector('#foto');
    const imgPreview = document.querySelector('.img-preview');
    imgPreview.style.display = 'block';
    imgPreview.style.height = '100px';
    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
    }
</script>

<script src="{{ asset('assets/') }}/bts4/libs/magnific-popup/meg.init.js"></script>
<script src="{{ asset('assets/') }}/bts4/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>

@endsection
