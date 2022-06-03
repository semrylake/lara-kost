@extends('dashboard.opDash')

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
@if (session('pindahok'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('pindahok') }}
</div>
@endif

<div class="card shadow mb-4">


    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-dark">Daftar Pesanan</h4>
    </div>
    <div class="card-body">
        <a class="btn text-dark" href="" style="border-color: black; margin-bottom: 1px;">
            <i class="fas fa-fw fa-retweet"></i> Refresh
        </a>
        <hr>
        <div class="table-responsive mt-2">
            <table class="table table-bordered" id="zero_config" width="100%">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th colspan="2">Opsi</th>
                        <th>Nama Pemesan</th>
                        <th>Kode Kamar</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th>Pekerjaan</th>
                        <th>Status</th>
                        <th>Tlpn/WhatsApp</th>
                        <th>Jumlah Pemesan</th>
                    </tr>
                </thead>
                <tbody align="center">

                    @forelse ($pesanan as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <form action="/delete-pesanan/{{ $a->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" title="Tolak Pemesan" class="btn-sm btn btn-danger "
                                    onclick="return confirm('Anda yakin ingin menghapus data ini??');"><i
                                        class=" fas fa-trash"></i>
                                </button>
                            </form>

                        </td>
                        <td>
                            <form action="/tambahkan-ke-penghuni/{{ $a->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" title="Jadikan Penghuni" class="btn-sm btn btn-success "
                                    onclick="return confirm('Anda akan menjadikan pemesan sebagai penghuni. Data akan otomatis tersimpan dan terhapus dari halaman ini. Silahkan pastikan apakah data yang ingin diubah sesuai!!');"><i
                                        class=" fas fa-plus"></i>
                                </button>
                            </form>

                        </td>
                        <td>{{ $a->namapemesan }}</td>
                        <td>{{ $a->room_id }}</td>
                        <td>{{ $a->jk }}</td>
                        <td>{{ $a->emailpemesan }}</td>
                        <td>{{ $a->pekerjaan }}</td>
                        <td>{{ $a->status }}</td>
                        <td>{{ $a->tlpn }}</td>
                        <td>{{ number_format($a->jumlah , 0, ',', '.')}} Orang</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Tidak ada data</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
