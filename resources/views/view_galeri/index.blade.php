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

<img class="img-preview mb-2 img-fluid col-sm-2">
<div class="col-lg-6">
    <form class="d-inline form-horizontal" action="/addGaleri" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <div class="col-md-8">
                <input type="file" class=" form-control form-control-sm @error('foto') is-invalid @enderror" id="foto"
                    name="foto" value="{{ old('foto') }}" onchange="previewImage()" required>
                <div class="invalid-feedback text-danger">
                    @error('foto')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <button type="submit" style="height: 90%" id="savereg" class="col-md-2 mt-1 btn-sm btn btn-success">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
<hr>
<div class="row el-element-overlay">
    @forelse ($galerifoto as $a)
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img class="img-fluid rounded " style="height: 150px" src="/foto-galeri-kost/{{ $a->foto }}" />
                    <div class="el-overlay">
                        <ul class="list-style-none el-info">
                            <li class="el-item">
                                <a target="_blank" class="btn btn-success btn-outline image-popup-vertical-fit el-link"
                                    href="/foto-galeri-kost/{{ $a->foto }}">
                                    <i class="fas fa-search-plus"></i>
                                </a>
                            </li>
                            <li class="el-item">
                                <form action="/delete-imageGaleri/{{ $a->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" title="Hapus"
                                        class="btn btn-danger btn-outline image-popup-vertical-fit el-link"
                                        onclick="return confirm('Anda yakin ingin menghapus gambar ini??');">
                                        <i class="fas fa-trash"></i>
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
