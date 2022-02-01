@extends('dashboard.opDash')

@section('container')

@if (session('psn'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('psn') }}
</div>
@endif

<a href="/regulation" class="btn btn-info shadow"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card mt-3 border shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Form Tambah Peraturan Kost</h6>
    </div>
    <form class="form-horizontal" action="/addRegulations" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="control-label col-form-label">Peraturan</label>
                <input autofocus type="text" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" required>
                <input type="hidden" name="iduser" id="iduser" value="{{ $kost->id }}" readonly>
                <div class="invalid-feedback text-danger">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="jns">Jenis Peraturan</label>
                <select id="jns" name="jns" class="form-control @error('jns') is-invalid @enderror">
                    <option value="">----</option>
                    <option id="jns" value="wajib">Wajib</option>
                    <option id="jns" value="tidak wajib">Tidak Wajib</option>
                </select>
                <div class="invalid-feedback text-danger">
                    @error('jns')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <input type="hidden" readonly class="form-control shadow @error('slug') is-invalid @enderror" id="slug"
                name="slug" value="{{ old('slug') }}" required>
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
        fetch('/createSlugRule?nama='+nama.value)
        .then(response=>response.json())
        .then(data=>slug.value = data.slug)
    });
</script>
@endsection
