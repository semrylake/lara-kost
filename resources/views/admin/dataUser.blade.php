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

<div class="card shadow mb-4">


    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-dark">Daftar Users</h4>
    </div>
    <div class="card-body">
        {{-- <a class="btn btn-info" href="/add-regulation">
            <i class="fas fa-fw fa-plus"></i> Tambah
        </a> --}}
        <a class="btn text-dark" href="" style="border-color: black; margin-bottom: 1px;">
            <i class="fas fa-fw fa-retweet"></i> Refresh
        </a>
        <hr>
        <div class="table-responsive mt-2">
            <table class="table table-bordered" id="zero_config" width="100%">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>level</th>
                        <th>Email verified at</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                </thead>
                <tbody align="center">

                    @forelse ($users as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->level }}</td>
                        <td>{{ $a->email_verified_at }}</td>
                        <td>{{ $a->created_at }}</td>
                        <td>{{ $a->updated_at }}</td>
                        {{-- <td>
                            <a href="/edit-regulation/{{ $a->slug }}" class="btn btn-sm btn-warning mt-1 mb-1"><i
                                    class="fas fa-edit"></i> Edit</a>
                            <form action="/delete-regulation/{{ $a->slug }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" title="Hapus" class="btn-sm btn btn-danger "
                                    onclick="return confirm('Anda yakin ingin menghapus data ini??');"><i
                                        class=" fas fa-trash"></i> Hapus
                                </button>
                            </form>

                        </td> --}}
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">Tidak ada data</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
