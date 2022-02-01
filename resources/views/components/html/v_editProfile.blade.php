@foreach ($kost as $a)
<form method="post" action="/updateProfile/{{ $a->slug }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <label for="nama" class="col-sm-3 col-form-label">Nama Kost</label>
        <div class="col-sm-8">
            <input type="text" autofocus class="form-control shadow @error('nama') is-invalid @enderror" id="nama"
                name="nama" value="{{  old('nama',$a->namaKost) }}" required>
            <input type="hidden" readonly class="form-control shadow @error('slug') is-invalid @enderror" id="slug"
                name="slug" value="{{ old('slug',$a->slug) }}" required>
            <div class="invalid-feedback text-danger">
                @error('nama')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="pemilik" class="col-sm-3 col-form-label">Nama Pemilik Kost</label>
        <div class="col-sm-8">
            <input type="text" class="form-control shadow @error('pemilik') is-invalid @enderror" id="pemilik"
                name="pemilik" value="{{  old('pemilik',$a->namaPemilik) }}" required>
            <div class="invalid-feedback text-danger">
                @error('pemilik')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="alamat" class="col-sm-3 col-form-label">Alamat Kost</label>
        <div class="col-sm-8">
            <input type="text" class="form-control shadow @error('alamat') is-invalid @enderror" id="alamat"
                name="alamat" value="{{  old('alamat',$a->alamat) }}" required>
            <div class="invalid-feedback text-danger">
                @error('alamat')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="telepon" class="col-sm-3 col-form-label">No. Telepon</label>
        <div class="col-sm-8">
            <input type="text" class="form-control shadow @error('telepon') is-invalid @enderror" id="telepon"
                name="telepon" value="{{  old('telepon',$a->tlpn) }}" required>
            <div class="invalid-feedback text-danger">
                @error('telepon')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        {{-- lokasi --}}
        <div class="col-sm-3">
            <input type="hidden" value="{{ old('latitude',$a->latitude) }}" readonly
                class="form-control shadow @error('latitude') is-invalid @enderror" id="latitude" name="latitude">
            <div class="invalid-feedback text-danger">
                @error('latitude')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-sm-3">
            <input type="hidden" value="{{ old('latitude',$a->longitude) }}" readonly
                class="form-control shadow @error('longtitude') is-invalid @enderror" id="longtitude" name="longtitude">
            <div class="invalid-feedback text-danger">
                @error('longtitude')
                {{ $message }}
                @enderror
            </div>
        </div>

    </div>
    <div class="row mb-3">
        <label for="telepon" class="col-sm-3 col-form-label">Foto</label>
        <div class="col-sm-8">
            <img class="img-preview mb-2 img-fluid">
            <input type="hidden" value="{{ $a->foto }}" name="fotolama">
            <input type="file" class=" form-control form-control-sm @error('foto') is-invalid @enderror" id="foto"
                name="foto" value="{{ old('foto') }}" onchange="previewImage()">
            <div class="invalid-feedback text-danger">
                @error('foto')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <label for="btn" class="col-sm-3 col-form-label"></label>
        <div class="col-sm-9">
            <button type="submit" class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
@endforeach
