<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ujikom</title>
    <link href="{{ asset('bootstrap-5/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script src="{{ asset('bootstrap-5/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>

<body>
    <main class="container-fluid">
        <div class="row">
            <aside class="col-auto min-vh-100 bg-dark bg-aside p-0">
                <div
                    class="col-auto d-flex align-items-center justify-content-between p-3 bg-header text-white border-bottom border-secondary">
                    <span class="m-0 lead d-none d-md-inline">My Kasir</span>
                    <div class="icon">
                        <i class="fa-solid fa-business-time"></i>
                    </div>
                </div>

                <ul class="nav nav-pills flex-column gap-3 lead mt-5 px-3">
                    <li class="nav-item">
                        <a href="{{ url('home') }}"
                            class="nav-link d-inline d-md-block text-link rounded-2 bg-link gap-2">
                            <i class="fa-solid fa-house "></i>
                            <span class="d-none d-md-inline">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('product') }}"
                            class="nav-link text-link d-inline d-md-block rounded-2 bg-link gap-2">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="d-none d-md-inline">Product</span>
                        </a>
                    </li>
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ url('kategori') }}"
                                class="nav-link text-link d-inline d-md-block rounded-2 bg-link">
                                <i class="fa-solid fa-list"></i>
                                <span>kategori</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'kasir')
                        <li class="nav-item">
                            <a href="{{ url('transaksi') }}"
                                class="nav-link text-link d-inline d-md-block rounded-2 bg-link  align-items-center gap-2 ">
                                <i class="fa-solid fa-money-check-dollar"></i>
                                <span class="d-none d-md-inline">transaksi</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'kasir')
                        <li class="nav-item">
                            <a href="{{ url('member') }}"
                                class="nav-link text-link d-inline d-md-block rounded-2 bg-link  gap-2">
                                <i class="fa-solid fa-user"></i>
                                <span class="d-none d-md-inline">Member</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ url('kasir') }}"
                                class="nav-link text-link d-inline d-md-block rounded-2 bg-link align-items-center gap-2">
                                <i class="fa-solid fa-user"></i>
                                <span class="d-none d-md-inline"> Kasir </span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <div class="dropdown lead">
                            <a class="btn d-inline d-md-block text-start  bg-link text-link" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-chart-simple"></i>
                                <span class="d-none d-md-inline lead">Laporan</span>
                            </a>

                            <ul class="dropdown-menu">
                                @if (Auth::user()->role == 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ url('laporanProduct') }}">Laporan Product</a>
                                    </li>
                                @endif
                                @if (Auth::user()->role == 'admin')
                                    <li><a class="dropdown-item" href="laporanKasir">Laporan kasir</a>
                                    </li>
                                @endif
                                @if (Auth::user()->role == 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ url('laporanTransaksi') }}">laporan
                                            transaksi</a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ url('laporanMember') }}">Laporan Member</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </aside>
            <div class="right px-0 col">
                <div class="header d-flex justify-content-between header border-bottom border-secondary mb-3">
                    <a class="btn btn-danger mx-4 mt-2 mb-3" href="{{ url('logout') }}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="h6">Logout</span>
                    </a>
                    <button class="btn text-white rounded-0 d-flex align-items-center"
                        style="background-color: #369FFF">
                        <div class="icon">
                            <i class="fa-solid fa-user-tie"></i>
                            <span class="h6">{{ Auth::user()->role }}</span>
                        </div>
                    </button>
                </div>
                <div class="content">
                    <div class="container">
                        @include('component.pesan')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>


</body>

</html>
