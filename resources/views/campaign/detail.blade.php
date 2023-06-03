@extends('layouts.app')

@section('title', 'Projek')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('campaign.index') }}">Projek</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection 

@push('css')
    <style>
        .daftar-donasi.nav-pills .nav-link.active, 
        .daftar-donasi.nav-pills .show>.nav-link {
        background: transparent;
        color: var(--blue);
        border-bottom: 3.5px solid var(--blue);
        border-radius: 0;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-8">
        <x-card>
            <x-slot name="header">
                <h3>{{ $campaign->title }}</h3>
                <p class="font-weight-bold mb-0"> Diposting oleh <span class="text-primary">{{ $campaign->user->name }}</span>
                    <small class="d-block">{{ tanggal_indonesia($campaign->publish_date) }} {{ date('H:i', strtotime($campaign->publish_date)) }}</small>
                </p>
            </x-slot>

            {!! $campaign->body !!}
        </x-card>
    </div>
    <div class="col-lg-4">
        <x-card>
            <x-slot name="header">
                <h5 class="card-title">Kategori</h5>
            </x-slot>

            <ul>
                @foreach ($campaign->category_campaign as $v)
                <li>{{ $v->name }}</li>
                @endforeach
            </ul>
        </x-card>
    
        <x-card>
            <x-slot name="header">
                <h5 class="card-title">Gambar Unggulan</h5>
            </x-slot>
            {{-- {{ dd($campaign) }} --}}
            {{-- <iframe src="/storage{{ $campaign->path_image }}" width="100%" height="270px" frameborder="0"></iframe> --}}
            <img src="/storage{{ $campaign->path_image }}" class="img-thumbnail">
        </x-card>
    
        <x-card>
            <h3 class="font-weight-bold">Rp. {{ format_uang(500000) }}</h3>
            <p class="font-weight-bold">Terkumpul dari Rp. {{ format_uang(10000000) }}</p>
            <div class="progress" style="height: .3rem;">
                <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between">
                <p>10% tercapai</p>
                <p>3 bulan lagi</p>
            </div>
            <h4 class="font-weight-bold">Donatur (3)</h4>
            <ul class="nav nav-pills mb-3 daftar-donasi" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-waktu-tab" data-toggle="pill" data-target="#pills-waktu"
                        type="" role="tab" aria-controls="pills-waktu" aria-selected="true">Waktu</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-jumlah-tab" data-toggle="pill" data-target="#pills-jumlah"
                        type="" role="tab" aria-controls="pills-jumlah" aria-selected="false">Jumlah</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-waktu" role="tabpanel" aria-labelledby="pills-waktu-tab">
                    @for ($i = 0; $i < 5; $i++)
                    <div>
                        <p class="font-weight-bold mb-0">User</p>
                        <p class="font-weight-bold mb-0">Rp. {{ format_uang(100000) }}</p>
                        <p class="text-muted mb-1">{{ tanggal_indonesia(date('Y-m-d H:i:s')) }}</p>
                    </div>
                    @endfor
                </div>
                <div class="tab-pane fade" id="pills-jumlah" role="tabpanel" aria-labelledby="pills-jumlah-tab">

                </div>
            </div>
        </x-card>
    </div>
</div>
  
@endsection
