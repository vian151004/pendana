@extends('layouts.front')

@section('title', 'Mari Kita Saling Berbagi')

@push('css')
    <style>
        /* Jumbotron */
        .jumbotron {
            height: 87.5vh;
            background-image: url('{{ asset("/storage/bgcharity1.jpg") }}');
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 0;
        }
        .jumbotron .bg-white-50:hover {
            background: rgb(255, 255, 255, .15);
        }
        @media (max-width: 575.98px) {
            .jumbotron .btn.rounded {
                width: 100% !important;
            }
            .jumbotron .display-4 {
                font-size: 42px;
            }
        }

        /* Info Campaign */
        @media (max-width: 575.98px) {
            .info-campaign .fa-2x.text {
                font-size: 24px;
            }
        }

        /* Dana Tersalurkan */
        .dana-tersalurkan .card {
            border: 0;
            box-shadow: 0 1rem 3rem rgb(0, 0, 0, .1) !important;
            transition: 1s;
        }
        .dana-tersalurkan .card:hover,
        .dana-tersalurkan .card:focus {
            transform: translateY(-5px);
        }
        .dana-tersalurkan .card-body2 {
            min-height: 10rem;
        }

        /* Galang Dana2 */
        @media (max-width: 575.98px) {
            .galang-dana2 .fa-3x {
                font-size: 32px;
            }
            .galang-dana2 h3 {
                font-size: 18px;
            }
            .dana-tersalurkan .card-body2 {
                min-height: 10rem;
            }
        }

        .page-item .page-link {
            background: transparent;
            border-radius: .35rem;
            border: none;
            padding: .75rem 1rem;
            font-weight: 700;
            font-size: .9rem;
            color: #454545;
        }
        .page-item.disabled .page-link {
            background: transparent;
        }
        .page-item.active .page-link {
            z-index: 3;
            color: #ffffff;
            background: var(--primary);
            border-color: var(--primary);
        }
    </style>
@endpush
    
@section('content')
{{-- Jumbotron --}}
<div class="jumbotron d-flex justify-content-center align-items-center mb-0">
    <div class="shadow-sm p-3 bg-white-50 rounded">
        <div class="card p-4 border text-center mb-0">
            <h1 class="display-4 font-weight-bold">GALANG DANA</h1>
        <p class="lead text-capitalize mt-3">Untuk hal yang anda perjuangkan demi kemanusiaan</p>
        <a href="{{ url('/campaign') }}" class="btn btn-primary btn-lg rounded w-50 m-auto">Galang Dana Sekarang</a>
        </div>
    </div>
</div>

{{-- Info Campaign --}}
<div class="info-campaign bg-dark">
    <div class="container text-white py-5">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6">
                <p class="icon">
                    <i class="fas fa-smile fa-4x"></i>
                </p>
                <p class="fa-2x font-weight-bold">{{ format_uang($donatur) }}</p>
                <p class="fa-2x text mb-0 text-uppercase">DONATUR</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <p class="icon">
                    <i class="fas fa-rocket fa-4x"></i>
                </p>
                <p class="fa-2x font-weight-bold">{{ format_uang($misiSukses) }}</p>
                <p class="fa-2x text mb-0 text-uppercase">MISI SUKSES</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <p class="icon">
                    <i class="fas fa-user-plus fa-4x"></i>
                </p>
                <p class="fa-2x font-weight-bold">{{ format_uang($relawan) }}</p>
                <p class="fa-2x text mb-0 text-uppercase">RELAWAN</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <p class="icon">
                    <i class="fas fa-globe fa-4x"></i>
                </p>
                <p class="fa-2x font-weight-bold">{{ format_uang($projek) }}</p>
                <p class="fa-2x text mb-0 text-uppercase">PROJEK</p>
            </div>
        </div>
    </div>
</div>

{{-- Dana Tersalurkan --}}
<div class="dana-tersalurkan">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="fa-3x mb-4">DANA TERSALURKAN</h2>
                <h3 class="font-weight-normal mb-3">
                    Jika Anda dapat bergaung dengan kami sekarang, <br>
                    maka akan banyak yang terbantu
                </h3>
            </div>

            @foreach ($campaign as $v)  
            <div class="col-lg-4 col-md-6">
                <div class="card mt-4">
                    <div class="rounded-top" style="height: 250px; overflow: hidden;"> {{-- jika foto terlalu leabr ditambah overflow: hidden; --}}
                        @if (asset('storage'.( $v->path_image))) 
                        <img src="{{ asset('storage'.( $v->path_image)) }}" class="card-img-top" 
                            alt="...">
                        @else
                        <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.
                        org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_
                        17affada31b%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-
                        size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17affada31b%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.
                        1953125%22%20y%3D%2295.5265625%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                            class="card-img-top" alt="...">
                        @endif
                    </div>
                    <div class="card-body p-2 rounded">
                        <div class="d-flex justify-content-between text-dark">
                            <p class="mb-0">Terkumpul: <strong>{{ format_uang($v->nominal) }}</strong></p>
                            <p class="mb-0">Goal: <strong>{{ format_uang($v->goal) }}</strong></p>
                        </div>
                    </div>
                    <div class="card-body card-body2 p-2 border-top">
                        <a href="{{ url('/donation/'. $v->id) }}" class="card-title text-bold text-dark mb-3">{{ $v->title }}</a>
                        @if (Str::length($v->short_description) > 0)
                            <p class="card-text">{{ Str::limit($v->short_description, 100, ' ...') }}</p>
                        @else
                            <p class="card-text">Deskripsi tidak tersedia.</p>
                        @endif
                    </div>
                    <div class="card-footer p-2">
                        <a href="{{ url('/donation/'. $v->id) }}" class="btn btn-primary d-block rounded">
                            <i class="fas fa-donate mr-2"></i>
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="paginasi pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <x-pagination-card :model="$campaign" />
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Galang Dana2 --}}
<div class="galang-dana2 bg-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="fa-3x mb-4">GALANG DANA DI PENDANA</h2>
                <h3 class="font-weight-normal mb-4">
                    Dari menolong anggota keluarga, hingga membangun jembatan di desa, <br>
                    ribuan orang telah menggunakan pendana untuk menggalang dana.
                </h3>
                <a href="{{ route('campaign.create') }}" class="btn btn-primary btn-lg rounded m-auto">Galang Dana Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection
