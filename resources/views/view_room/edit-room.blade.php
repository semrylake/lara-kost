@extends('dashboard.opDash')

@section('container')

@if (session('upt'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('upt') }}
</div>
@endif

<a href="/room" class="btn btn-info shadow"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card mt-3 border shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Form Edit Kamar Kost</h6>
    </div>
    <form class="form-horizontal" action="/update-room/{{ $room->slug }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="control-label col-form-label">Kode Kamar</label>
                <input autofocus type="text" name="name" value="{{ old('name',$room->kode_kamar) }}" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" required>
                <input type="hidden" readonly class="form-control shadow @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug',$room->slug) }}" required>
                <div class="invalid-feedback text-danger">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="harga" class="control-label col-form-label">Harga Kamar (Rp.)</label>
                <input autofocus type="number" name="harga" value="{{ old('harga', $room->harga) }}"
                    class="form-control @error('harga') is-invalid @enderror" id="harga" autocomplete="off" required>
                <div class="invalid-feedback text-danger">
                    @error('harga')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="ukuran" class="control-label col-form-label">Ukuran Kamar (m<sup>2</sup>)</label>
                <input autofocus type="number" name="ukuran" value="{{ old('ukuran', $room->ukuran) }}"
                    class="form-control @error('ukuran') is-invalid @enderror" id="ukuran" autocomplete="off" required>
                <div class="invalid-feedback text-danger">
                    @error('ukuran')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="keterangan" class="control-label col-form-label">Keterangan Kamar</label>
                <input autofocus type="text" name="keterangan" value="{{ old('keterangan', $room->keterangan) }}"
                    class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" autocomplete="off">
                <div class="invalid-feedback text-danger">
                    @error('keterangan')
                    {{ $message }}
                    @enderror
                </div>
            </div>


        </div>
        <div class="border-top">
            <div class="card-body">
                <button type="submit" id="savereg" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    const nama = document.querySelector('#name');
    const slug = document.querySelector('#slug');
    nama.addEventListener('change', function(){
        fetch('/createSlugRoom?nama='+nama.value)
        .then(response=>response.json())
        .then(data=>slug.value = data.slug)
    });
</script>
@endsection
