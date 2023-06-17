@extends('layouts.front')

@section('title', 'Kontak')

@push('css')
    <style>
        @media (max-width: 575.98px) {
            .text-lg {
                font-size: 18px;
            }
        }
    </style>
@endpush
    
@section('content')
{{-- Banner --}}
<div class="banner bg-pendana">
    <div class="container">
        <h2 class="fa-2x text-white">Kontak</h2>
    </div>
</div>

{{-- Punya Pertanyaan --}}
<div class="punya-pertanyaan bg-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-5 mb-4">Punya Pertanyaan?</h1>
                <p class="mb-5 text-lg">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt, tempora? <br>
                    amet consectetur adipisicing elit. Molestias, doloremque?
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <p class="icon">
                    <i class="fas fa-phone fa-2x"></i>
                </p>
                <p class="font-weight-bold mb-1">Hubungi Kami</p>
                <p class="font-weight-bold mb-1">0878-3082-6172</p>
            </div>
            <div class="col-lg-4 text-center">
                <p class="icon">
                    <i class="fas fa-map-marker fa-2x"></i>
                </p>
                <p class="font-weight-bold mb-1">Alamat</p>
                <p class="font-weight-bold mb-1">Jl. Ungaran Raya <br>Kab. Semarang, Jawa Tengah</p>
            </div>
            <div class="col-lg-4 text-center">
                <p class="icon">
                    <i class="fas fa-envelope fa-2x"></i>
                </p>
                <p class="font-weight-bold mb-1">Email</p>
                <p class="font-weight-bold mb-1">support@gmail.com</p>
            </div>
        </div>
    </div>
</div>

{{-- Form Kontak --}}
<div class="form-kontak">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-5 mb-4">Kontak Kami</h1>
                <p class="mb-5 text-lg">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt, tempora? <br>
                    amet consectetur adipisicing elit. Molestias, doloremque?
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Masukkan nama">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Masukkan no telepon">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan subjek">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea rows="5" class="form-control" placeholder="Masukkan pesan"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection