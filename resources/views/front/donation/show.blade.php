@extends('layouts.front')

@section('title', $campaign->title)

@push('css')
    <style>
        .daftar-donasi.nav-pills .nav-link.active, 
        .daftar-donasi.nav-pills .show>.nav-link {
        background: transparent;
        color: var(--dark);
        border-bottom: 3.5px solid var(--blue);
        border-radius: 0;
        }
    </style>
@endpush
    
@section('content')
{{-- Banner --}}
<div class="banner bg-pendana">
    <div class="container">
        <h2 class="fa-2x text-white">{{ $campaign->title }}</h2>
    </div>
</div>

{{-- Detail --}}
<div class="tentang-kami bg-white">
    <div class="container py-5">
        <div class="row justify-content-between">
             <div class="col-lg-7">
                <div class="d-flex align-items-center">
                    <div class="img rounded-circle" style="width: 60px; overflow:hidden;">
                        @if ( asset('storage'. ($campaign->user->path_image)) )
                        <img src="{{ asset('storage'.( $campaign->user->path_image)) }}" class="card-img-top" 
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
                    <div class="ml-3">
                        <strong class="d-block">{{ $campaign->user->name }}</strong>
                        <small class="text-muted">{{ tanggal_indonesia($campaign->publish_date) }}</small>
                    </div>
                </div>

                <div class="thumbnail rounded mt-4" style="overflow: hidden;">
                    @if ( asset('storage'. ($campaign->path_image)) )
                    <img src="{{ asset('storage'.( $campaign->path_image)) }}" class="w-100" alt="...">
                    @else
                    <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.
                        org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_
                        17affada31b%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-
                            size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17affada31b%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.
                        1953125%22%20y%3D%2295.5265625%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                        class="w-100" alt="...">
                    @endif
                </div>

                <div class="body mt-4">
                    {!! $campaign->body !!}

                    <div class="kategori border-top pt-3">
                        @if ($campaign->category_campaign)
                            @foreach ($campaign->category_campaign as $v)
                            <a href="#" class="badge badge-primary p-2 rounded-pill">{{ $v->name }}</a>
                            @endforeach
                        @endif
                    </div>

                    <hr class="d-lg-none d-block">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 p-3 shadow-0">
                        <h1 class="font-weight-bold">Rp. {{ format_uang($campaign->nominal) }}</h1>
                        <p class="font-weight-bold">Terkumpul dari Rp. {{ format_uang($campaign->goal) }}</p>
                        <div class="progress" style="height: .3rem;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $campaign->nominal / $campaign->goal * 100 }}%" aria-valuenow="{{ $campaign->nominal / $campaign->goal * 100 }}" aria-valuemin="0" aria-valuemax="{{ 100 }}"></div>
                        </div>
                    <div class="d-flex justify-content-between">
                        <p>{{ $campaign->nominal / $campaign->goal * 100 }}% tercapai</p>
                        <p>{{ now()->parse($campaign->end_date)->diffForHumans() }}</p>
                    </div>

                    <div class="donasi mt-2 mb-4">
                        <a href="/donation/{{  $campaign->id  }}/create" class="btn btn-primary btn-lg btn-block">Donasi Sekarang</a>
                    </div>

                    <h4 class="font-weight-bold">Donatur (3)</h4>
                    <ul class="nav nav-pills mb-3 daftar-donasi" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-waktu-tab" data-toggle="pill" data-target="#pills-waktu"
                                type="" role="tab" aria-controls="pills-waktu" aria-selected="true">Waktu</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-jumlah-tab" data-toggle="pill" data-target="#pills-jumlah" type=""
                                role="tab" aria-controls="pills-jumlah" aria-selected="false">Jumlah</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-waktu" role="tabpanel"
                            aria-labelledby="pills-waktu-tab">
                            @for ($i = 0; $i < 5; $i++) 
                            <div @if ($i > 0) class="mt-1" @endif>
                                <p class="font-weight-bold mb-0">User</p>
                                <p class="font-weight-bold mb-0">Rp. {{ format_uang(100000) }}</p>
                                <p class="text-muted mb-1">{{ tanggal_indonesia(date('Y-m-d H:i:s')) }}</p>
                            </div>
                            @endfor
                        </div>
                        <div class="tab-pane fade" id="pills-jumlah" role="tabpanel" 
                            aria-labelledby="pills-jumlah-tab">
                            ...
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>

@endsection