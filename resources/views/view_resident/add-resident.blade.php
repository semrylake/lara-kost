@extends('dashboard.opDash')

@section('container')

@if (session('psn'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('psn') }}
</div>
@endif

<a href="/resident" class="btn btn-info shadow"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card mt-3 border shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Form Tambah Penghuni</h6>
    </div>
    <form class="form-horizontal" action="/addResident" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label for="name" class="control-label col-form-label">Nama Lengkap<sup
                        class="text-danger">*</sup></label>
                <input autofocus type="text" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" required>
                <input type="hidden" readonly class="form-control shadow @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug') }}" required>
                <div class="invalid-feedback text-danger">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="room_id">Kode Kamar<sup class="text-danger">*</sup></label></label>
                        <div class="form-label-group">
                            <select required class=form-control @error('room_id') is-invalid @enderror" required
                                name="room_id" id="room_id">
                                <option></option>
                                @forelse ($room as $a)
                                <option id="room_id" value="{{ $a->id }}" {{ old('room_id')==$a->id ? 'selected' :
                                    null}}
                                    class="form-control">{{ $a->kode_kamar }}</option>
                                @empty
                                <option>Belum ada data kamar</option>
                                @endforelse
                            </select>
                            <div class="invalid-feedback text-danger">
                                @error('room_id')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin<sup class="text-danger">*</sup></label></label>
                        <div class="form-label-group">
                            <select class=" form-control @error('jk') is-invalid @enderror" required name="jk" id="jk">
                                <option></option>
                                <option id="jk" value="Laki-laki" {{ old('jk')=="Laki-laki" ? 'selected' : null}}
                                    class="form-control">Laki-laki</option>
                                <option id="jk" value="Perempuan" {{ old('jk')=="Perempuan" ? 'selected' : null}}
                                    class="form-control">Perempuan</option>

                            </select>
                            <div class="invalid-feedback text-danger">
                                @error('jk')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tempat_lahir" class="control-label col-form-label">Tempat Lahir</label>
                        <input placeholder="Contoh: Kupang" type="text" name="tempat_lahir"
                            value="{{ old('tempat_lahir') }}"
                            class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                            autocomplete="off">
                        <div class="invalid-feedback text-danger">
                            @error('tempat_lahir')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tgl_lahir" class="control-label col-form-label">Tanggal Lahir</label>
                        <input type="text" placeholder="Contoh: 01/01/2000" name="tgl_lahir"
                            value="{{ old('tgl_lahir') }}" class="form-control @error('tgl_lahir') is-invalid @enderror"
                            id="tgl_lahir" autocomplete="off">
                        <div class="invalid-feedback text-danger">
                            @error('tgl_lahir')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="tlpn" class="control-label col-form-label">No. Telepon<sup
                        class="text-danger">*</sup></label></label>
                <input autofocus type="text" name="tlpn" value="{{ old('tlpn') }}"
                    class="form-control @error('tlpn') is-invalid @enderror" id="tlpn" autocomplete="off" required>
                <div class="invalid-feedback text-danger">
                    @error('tlpn')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="control-label col-form-label">Status<sup
                        class="text-danger">*</sup></label></label>
                <input autofocus type="text" name="status" value="{{ old('status') }}"
                    class="form-control @error('status') is-invalid @enderror" id="status" autocomplete="off" required>
                <div class="invalid-feedback text-danger">
                    @error('status')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="foto" class="control-label col-form-label">Foto</label>
                <img class="img-preview mb-2 img-fluid col-sm-2">
                <input type="file" class=" form-control form-control-sm @error('foto') is-invalid @enderror" id="foto"
                    name="foto" value="{{ old('foto') }}" onchange="previewImage()">
                <div class="invalid-feedback text-danger">
                    <div class="invalid-feedback text-danger">
                        @error('foto')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <p class="text-danger">Tanda * wajib diinput</p>
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

{{-- Script slug --}}
<script>
    const nama = document.querySelector('#name');
    const slug = document.querySelector('#slug');
    nama.addEventListener('change', function(){
        fetch('/createSlugResident?nama='+nama.value)
        .then(response=>response.json())
        .then(data=>slug.value = data.slug)
    });
</script>
{{-- Script image preview --}}
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


@endsection
