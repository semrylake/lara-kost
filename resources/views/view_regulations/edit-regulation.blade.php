@extends('dashboard.opDash')

@section('container')


<a href="/regulation" class="btn btn-info shadow"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card mt-3 border shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Form Edit Peraturan Kost</h6>
    </div>
    <form class="form-horizontal" action="/update-regulation/{{ $reg->slug }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="control-label col-form-label">Peraturan</label>
                <input autofocus type="text" name="name" value="{{ $reg->regulation }} {{ old(" name") }}"
                    class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" required>
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
                    @if ($reg->jenis == "wajib")
                    <option value="{{ $reg->jenis }}">Wajib</option>
                    <option id="jns" value="tidak wajib">Tidak Wajib</option>
                    @else
                    <option value="{{ $reg->jenis }}">Tidak Wajib</option>
                    <option id="jns" value="wajib">Wajib</option>

                    @endif
                </select>
                <div class="invalid-feedback text-danger">
                    @error('jns')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <input type="hidden" readonly class="form-control shadow @error('slug') is-invalid @enderror" id="slug"
                name="slug" value="{{ $reg->slug }} {{ old('slug') }}" required>
        </div>
        <div class="border-top">
            <div class="card-body">
                <button type="submit" id="saveprodukgudang" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update
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
