@extends('dashboard.adminDash')

@section('container')

@if (session('psn_update'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('psn_update') }}
</div>
@endif
@if (session('del_msg'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('del_msg') }}
</div>
@endif

<div class="row el-element-overlay">


    @forelse ($galeri as $a)
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img class="img-fluid rounded " style="height: 150px" src="{{ asset('storage/'.$a->foto) }}" />
                    <div class="el-overlay">
                        <ul class="list-style-none el-info">
                            <li class="el-item">
                                <a target="_blank" class="btn btn-success btn-outline image-popup-vertical-fit el-link"
                                    href="{{ asset('storage/'.$a->foto) }}">
                                    <i class="fas fa-search-plus"></i>
                                </a>
                            </li>
                            <li class="el-item">
                                <form action="/delete-imageGaleri-kamar-admin/{{ $a->id }}" method="post"
                                    class="d-inline">
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
                    <div class="el-card-content mt-2">
                        <h4 class="m-b-0">{{ $a->namaKost }}</h4>
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

@endsection
