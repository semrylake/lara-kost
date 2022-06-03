<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            HOME
        </a>
        <a href="/all-kosts" class="text-decoration-none text-secondary mt-1 nav-link">HUNIAN</a>
        {{-- <a href="/all-rooms" class="text-decoration-none text-secondary mt-1 nav-link">KAMAR</a> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('REGISTER') }}</a>
                </li>
                @endif

                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('LOGIN') }}</a>
                </li>
                @endif


                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                        <i class="rounded-circle fas fa-user fa-sm fa-fw ms-1 text-gray-400"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right no-arrow" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/home"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Dashboard</a>
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">

                            <i class=" fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            {{ __('Logout') }}
                        </a> --}}

                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"
                                onclick="return confirm('Anda yakin ingin keluar dari halaman ini??');">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
