@extends('layouts.app')

@section('content')

@if (session('psn'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('psn') }}
</div>
@endif
<div class="card mt-3 border shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Form Pemesanan Kamar Kost</h6>
    </div>
    <form class="form-horizontal" action="/pesanKamarKost" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name" class="control-label col-form-label">Nama Kost</label>
                        <input required type="hidden" name="kost_id" id="kost_id" value="{{ $kost->id }}">
                        <input required type="hidden" name="slug" id="slug" value="{{ $slug }}">
                        <input readonly type="text" name="name" value="{{  $kost->namaKost }}"
                            class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off"
                            required>
                        <div class="invalid-feedback text-danger">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="kode" class="control-label col-form-label">Kode Kamar</label>
                        <input required type="hidden" name="room_id" id="room_id" value="{{ $rooms->id }}">
                        <input readonly type="text" name="kode" value="{{$rooms->kode_kamar }}"
                            class="form-control @error('kode') is-invalid @enderror" id="kode" autocomplete="off"
                            required>
                        <div class="invalid-feedback text-danger">
                            @error('kode')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="namapemesan" class="control-label col-form-label">Nama Anda</label>
                <input autofocus type="text" name="namapemesan" value="{{ old('namapemesan') }}"
                    class="form-control @error('namapemesan') is-invalid @enderror" id="namapemesan" autocomplete="off"
                    required>
                <div class="invalid-feedback text-danger">
                    @error('namapemesan')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="emailpemesan" class="control-label col-form-label">Email</label>
                <input autofocus type="email" name="emailpemesan" value="{{ old('emailpemesan') }}"
                    class="form-control @error('emailpemesan') is-invalid @enderror" id="emailpemesan" required>
                <div class="invalid-feedback text-danger">
                    @error('emailpemesan')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <div class="form-label-group">
                    <select class=" select2 form-control custom-select @error('jk') is-invalid @enderror" required
                        name="jk" id="jk">
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

            <div class="form-group">
                <label for="status">Status Pernikahan</label>
                <div class="form-label-group">
                    <select class=" select2 form-control custom-select @error('status') is-invalid @enderror" required
                        name="status" id="status">
                        <option></option>
                        <option id="status" value="Belum Menikah" {{ old('status')=="Belum Menikah" ? 'selected' :
                            null}} class="form-control">Belum Menikah</option>
                        <option id="status" value="Sudah Menikah" {{ old('status')=="Sudah Menikah" ? 'selected' :
                            null}} class="form-control">Sudah Menikah</option>
                    </select>
                    <div class="invalid-feedback text-danger">
                        @error('status')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="tlpn" class="control-label col-form-label">No. Tlpn / WhatAapp</label>
                <input autofocus type="text" name="tlpn" value="{{ old('tlpn') }}"
                    class="form-control @error('tlpn') is-invalid @enderror" id="tlpn" autocomplete="off" required>
                <div class="invalid-feedback text-danger">
                    @error('tlpn')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="pekerjaan" class="control-label col-form-label">Pekerjaan</label>
                <input autofocus type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                    class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" autocomplete="off"
                    required>
                <div class="invalid-feedback text-danger">
                    @error('pekerjaan')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="jumlah" class="control-label col-form-label">Jumlah Orang yang Pesan / Kamar</label>
                <input autofocus type="number" min="1" name="jumlah" value="{{ old('jumlah') }}"
                    class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" autocomplete="off" required>
                <div class="invalid-feedback text-danger">
                    @error('jumlah')
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

@endsection
