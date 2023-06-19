@extends('layouts.front')

@section('title', 'DARURAT! Peduli Korban Gempa Banten')

@push('css')
    <style>
        .informasi {
            height: 120px;
        }
        @media (max-width: 575.98px) {
            .info {
                border-radius: .25rem;
            }
            .informasi {
                height: 150px;
            }
        }
    </style>
@endpush
    
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
           <h5 class="text-center">Terimakasih Vian</h5>
            <div class="detail d-flex justify-content-between align-items-center text-center mt-3 mt-lg-4">
                <p>ID Transkasi #008812</p>
                <p>Total Tagihan <strong>Rp. {{ format_uang(100000) }}</strong></p>
            </div>

            <div class="row justify-content-between mt-3 mt-lg-4">
                <div class="col-lg-3 col-md-4 text-center">
                    <img src="{{ asset('/storage/bank/bri.png') }}" alt="" class="w-100">
                    <p class="mt-3 text-muted">0009092983289323</p>
                </div>
                <div class="col-lg-3 col-md-4 text-center">
                    <img src="{{ asset('/storage/bank/bni.png') }}" alt="" class="w-100">
                    <p class="mt-3 text-muted">0009092983289323</p>
                </div>
                <div class="col-lg-3 col-md-4 text-center">
                    <img src="{{ asset('/storage/bank/bca.png') }}" alt="" class="w-100">
                    <p class="mt-3 text-muted">0009092983289323</p>
                </div>
            </div>

            <p class="text-center mt-3 mt-lg-4">
                Harap transfer sesuai dengan nominal "<strong>TOTAL TAGIHAN</strong>" ke bank yang tertera di atas!
                Setelah transfer lakukan konfirmasi! Perbedan nilai transfer akan menghambat proses verifikasi.
            </p>
           
            <div class="text-center mt-3 mt-lg-4">
                <a href="" class="btn btn-primary btn-lg">Konfirmasi Pembayaran</a>
            </div>

            <div class="informasi d-flex justify-content-center align-items-center mt-3 mt-lg-4">
                <div class="bg-info rounded-left d-none d-lg-block w-25 pt-4 text-center text-white h-100">
                    <i class="fas fa-info fa-4x m-auto"></i>
                </div> 
                <div class="bg-white rounded-right info text-center w-100 p-4 h-100">
                   <p>Kami sudah membuatkan akun Pendana untuk anda, silahkan cek email anda.</p>
                   <strong>(example@gmail.com)</strong>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection