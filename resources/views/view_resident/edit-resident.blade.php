@extends('dashboard.opDash')

@section('container')

@if (session('upt'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('upt') }}
</div>
@endif

<a href="/resident" class="btn btn-info shadow"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card mt-3 border shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Form Edit Penghuni</h6>
    </div>
    <form class="form-horizontal" action="/update-resident/{{ $resident->slug }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">

            <div class="form-group">
                <label for="name" class="control-label col-form-label">Nama Lengkap<sup
                        class="text-danger">*</sup></label>
                <input autofocus type="text" name="name" value="{{ old('name',$resident->name) }}"
                    class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" required>
                <input type="hidden" readonly class="form-control shadow @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug',$resident->slug) }}" required>
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
                                @if (old('room_id', $a->id) == $resident->room_id)
                                <option id="room_id" value="{{$a->id}}" selected class="form-control">
                                    {{$a->kode_kamar}}
                                </option>
                                @else
                                <option id="room_id" value="{{$a->id}}" class="form-control">{{$a->kode_kamar}}
                                </option>
                                @endif
                                @empty
                                <option>Belum ada data</option>
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

                                @if (old('jk', $resident->jk) == 'Laki-laki')
                                <option id="jk" value="{{$resident->jk}}" selected class="form-control">
                                    Laki-laki
                                </option>
                                <option id="jk" value="Perempuan" class="form-control">
                                    Perempuan
                                </option>
                                @endif
                                @if (old('jk', $resident->jk) == 'Perempuan')
                                <option id="jk" value="{{$resident->jk}}" selected class="form-control">
                                    Perempuan
                                </option>
                                <option id="jk" value="Laki-laki" class="form-control">
                                    Laki-laki
                                </option>
                                @endif

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
                            value="{{ old('tempat_lahir',$resident->tempat_lahir) }}"
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
                            value="{{ old('tgl_lahir',$resident->tgl_lahir) }}"
                            class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                            autocomplete="off">
                        <div class="invalid-feedback text-danger">
                            @error('tgl_lahir')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="control-label col-form-label">Status<sup
                        class="text-danger">*</sup></label></label>
                <input autofocus type="text" name="status" value="{{ old('status',$resident->status) }}"
                    class="form-control @error('status') is-invalid @enderror" id="status" autocomplete="off" required>
                <div class="invalid-feedback text-danger">
                    @error('status')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="tlpn" class="control-label col-form-label">No. Telepon<sup
                        class="text-danger">*</sup></label></label>
                <input autofocus type="text" name="tlpn" value="{{ old('tlpn',$resident->tlpn) }}"
                    class="form-control @error('tlpn') is-invalid @enderror" id="tlpn" autocomplete="off" required>
                <div class="invalid-feedback text-danger">
                    @error('tlpn')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <input type="hidden" name="fotolama" id="fotolama" value="{{ $resident->foto }}">

            <div class="form-group">
                <label for="foto" class="control-label col-form-label">Foto</label>
                @if ($resident->foto)
                <img class="img-preview mb-2 img-fluid col-sm-2" src="/foto-penghuni-kost/{{ $resident->foto }}">
                @else
                <img class="img-preview mb-2 img-fluid col-sm-2">
                @endif
                <input type="file" class=" form-control form-control-sm @error('foto') is-invalid @enderror" id="foto"
                    name="foto" onchange="previewImage()">
                <div class="invalid-feedback text-danger">
                    <div class="invalid-feedback text-danger">
                        @error('foto')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group ml-1 row">
                <label class="control-label col-form-label">Yakin ingin merubah data ini?</label>
                <div class="col-md-9 mt-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" onclick="activeButtonUpdate()" id="radio1"
                            name="radio-stacked" required>
                        <label class="custom-control-label" for="radio1">Ya</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" onclick="nonactiveButtonUpdate()" id="radio2"
                            name="radio-stacked" required>
                        <label class="custom-control-label" for="radio2">Tidak</label>
                    </div>
                </div>
            </div>

            <p class="text-danger">Tanda * wajib diinput</p>

            <div class="border-top">
                <div class="card-body">
                    <button type="submit" id="savereg" disabled class="btn text-white btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>

                </div>
            </div>
    </form>
</div>

{{-- Script slug --}}
<script>
    const nama = document.querySelector('#name');
    const slug = document.querySelector('#slug');
    const btn = document.querySelector('#savereg');
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
<script>
    function activeButtonUpdate() {
        document.getElementById("savereg").removeAttribute('disabled');
    }
    function nonactiveButtonUpdate() {
        document.getElementById("savereg").setAttribute('disabled','');
    }
</script>


@endsection
