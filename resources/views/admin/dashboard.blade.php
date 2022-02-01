@extends('dashboard.adminDash')

@section('container')

<div class="row">
    <div class="col-md-6  col-lg-2 col-xlg-3">
        <div class="card shadow card-hover">
            <div class="box bg-cyan text-center">
                <h1 class="font-light text-white"><i class="fa fa-user"></i></h1>
                <h5 class="text-white">{{ $users }}</h5>
                <h6 class="text-white">Total users</h6>
            </div>
        </div>
    </div>
    <div class="col-md-6  col-lg-2 col-xlg-3">
        <div class="card shadow card-hover">
            <div class="box bg-success text-center">
                <h1 class="font-light text-white"><i class="fas fa-building"></i></h1>
                <h5 class="text-white">{{ $kosts }}</h5>
                <h6 class="text-white">Total Kost</h6>
            </div>
        </div>
    </div>
    <div class="col-md-6  col-lg-2 col-xlg-3">
        <div class="card shadow card-hover">
            <div class="box text-center" style="background-color: rgb(175, 16, 214)">
                <h1 class="font-light text-white"><i class="mdi-glassdoor mdi"></i></h1>
                <h5 class="text-white">{{ $rooms }}</h5>
                <h6 class="text-white">Total Kamar</h6>
            </div>
        </div>
    </div>
</div>

@endsection
