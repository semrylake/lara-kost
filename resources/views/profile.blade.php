@extends('dashboard.opDash')

@section('container')

@if (session('psn'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('psn') }}
</div>
@endif

@if (session('update_msg'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    {{ session('update_msg') }}
</div>
@endif

@if(count($kost) != 1)
<div class="alert alert-success shadow alert-dismissible">
    <h5><i class="mdi-alert mdi"></i> Buat akun untuk promosi kost-kostan anda !!!</h5>
    {{ session('psn') }}
</div>
@endif

<div class="card mb-3 shadow">

    <div class="row g-0 p-5">
        <div class="col-md-4">
            @if(count($kost) == 1)
            @foreach ($kost as $a)
            <img src="{{ asset('storage/'.$a->foto) }}" class=" p-3 img-fluid rounded-start" alt="...">
            @endforeach
            @else
            <img src="assets\logo\cs2.png" class="img-fluid rounded-start" alt="...">
            @endif
        </div>
        <div class="col-md-8">

            <div class="card-body">
                <h3 class="card-title">Informasi Kost</h3>
                <hr>
                @if(count($kost) == 1)
                @include('components.html.v_editProfile');
                @else
                @include('components.html.v_addProfile');
                @endif
            </div>

        </div>
        </form>
    </div>
</div>

<script>
    if (navigator.geolocation) {
            navigator.geolocation.watchPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const long = position.coords.longitude;
            // console.log("Latitude: " + lat);
            // console.log("Longitude: " + long);
            document.getElementById("latitude").value = lat;
            document.getElementById("longtitude").value = long;
        }
    // if ('geolocation' in navigator) {
    //     console.log('Supports HTML geolocation API')va;

    //     (function () {
    //         var onSuccess = function (location) {
    //                 console.log('User location', location);

    //                 var userLat = location.coords.latitude,
    //                     userLon = location .coords.longitude;
    //             },
    //             onError = function (code, message) {
    //                 console.log('Gelocation error', code, message);
    //             };

    //         navigator.geolocation.getCurrentPosition(onSuccess, onError);
    //     })();
    // }
</script>

<script>
    const nama = document.querySelector('#nama');
    const slug = document.querySelector('#slug');
    nama.addEventListener('change', function(){
        fetch('/createSlug?nama='+nama.value)
        .then(response=>response.json())
        .then(data=>slug.value = data.slug)
    });
</script>

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
