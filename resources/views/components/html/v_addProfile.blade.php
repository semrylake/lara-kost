<form method="post" action="/addKost" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <label for="nama" class="col-sm-3 col-form-label">Nama Kost</label>
        <div class="col-sm-8">
            {{-- <input type="hidden" class="form-control" value="{{ Auth::user()->id }} " name="id_user" id="id_user">
            --}}
            <input type="text" autofocus class="form-control shadow @error('nama') is-invalid @enderror" id="nama"
                name="nama" value="{{ old('nama') }}" required>
            <input type="hidden" readonly class="form-control shadow @error('slug') is-invalid @enderror" id="slug"
                name="slug" value="{{ old('slug') }}" required>
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
                name="pemilik" value="{{ old('pemilik') }}" required>
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
                name="alamat" value="{{ old('alamat') }}" required>
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
                name="telepon" value="{{ old('telepon') }}" required>
            <div class="invalid-feedback text-danger">
                @error('telepon')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        {{-- <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label> --}}
        <div class="col-sm-3 mt-3">
            <input type="hidden" readonly class="form-control shadow @error('latitude') is-invalid @enderror"
                id="latitude" name="latitude" value="{{ old('latitude') }}" required>
            <div class="invalid-feedback text-danger">
                @error('latitude')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-sm-3 mt-3">
            <input type="hidden" readonly class="form-control shadow @error('longtitude') is-invalid @enderror"
                id="longtitude" name="longtitude" value="{{ old('longtitude') }}" required>
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
            <img class="img-preview img-fluid col-sm-8 mb-2">
            <input type="file" class=" form-control form-control-sm @error('foto') is-invalid @enderror" id="foto"
                name="foto" value="{{ old('foto') }}" onchange="previewImage()" required>
            <div class="invalid-feedback text-danger">
                @error('foto')
                {{ $message }}
                @enderror
            </div>
        </div>
    </div>


    <div class="row">
        <label for="btn" class="col-sm-3 col-form-label"></label>
        <div class="col-sm-9">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
</form>
