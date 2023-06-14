@extends('layouts.front')

@section('title', 'DARURAT! Peduli Korban Gempa Banten')

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
        <h2 class="fa-2x text-white">DARURAT! Peduli Korban Gempa Banten</h2>
    </div>
</div>

{{-- Detail --}}
<div class="tentang-kami bg-white">
    <div class="container py-5">
        <div class="row justify-content-between">
             <div class="col-lg-7">
                <div class="d-flex align-items-center">
                    <div class="img rounded-circle" style="width: 60px; overflow:hidden;">
                        <img src="{{ asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt="" class="w-100">
                    </div>
                    <div class="ml-3">
                        <strong class="d-block">Username</strong>
                        <small class="text-muted">{{ tanggal_indonesia(now()) }}</small>
                    </div>
                </div>

                <div class="thumbnail rounded mt-4" style="overflow: hidden;">
                    <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17affada31b%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)
                    %3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17affada31b%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2295
                    .5265625%22%3E%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="" class="w-100"> 
                </div>

                <div class="body mt-4">
                    <h4>Creating Something New</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum voluptate qui, perferendis nulla
                        consequatur enim officiis voluptatum laboriosam, ipsa reiciendis exercitationem, voluptatibus
                        facilis suscipit! Dolor, consectetur praesentium mollitia blanditiis quas velit! Delectus facere
                        nulla id, cumque ea ullam nam porro excepturi dicta cupiditate illum quo eos ad! Officia
                        temporibus velit, beatae, repellat ipsum culpa molestias recusandae officiis eos laboriosam a!
                        Perferendis sit dolores voluptate consectetur itaque.</p>
                    <p> Incidunt molestias aliquid facilis commodi
                        quisquam temporibus vero quis iure nostrum totam blanditiis ullam ea libero molestiae ratione
                        nesciunt voluptate quos architecto laudantium voluptas, provident consectetur! Dolores
                        dignissimos itaque consequuntur at debitis consequatur. Minus harum dolores soluta culpa quam
                        eligendi dolorem itaque quaerat autem accusamus deleniti molestiae ducimus repellat quidem
                        fugiat ex dicta magni sint dolore, rem eveniet, porro molestias eius?</p>
                    <p>Provident delectus
                        nesciunt, similique temporibus necessitatibus pariatur a earum laudantium laboriosam incidunt
                        eos enim ab assumenda. Voluptatem nihil consequuntur aperiam numquam facere est nobis quo
                        deleniti expedita corrupti veniam, quos doloremque explicabo quam, nulla ab at dignissimos!
                        Tempora vero consequatur tenetur. Placeat, expedita nobis fugit consequatur sint tempore
                        molestias minus, quia natus dolorum, sunt perspiciatis. Nulla nisi, aspernatur beatae vitae
                        repellendus magnam odit fugit! Ad voluptatibus quis impedit nobis. Possimus quo optio quod!</p>

                    <h4>It's time to build your new project</h4>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam numquam ratione vero aperiam
                        magni, cumque voluptas magnam cum possimus quia soluta. Non illum recusandae dolorem quisquam
                        mollitia?</p>
                    <p>Dolores veniam ea deleniti cum, nulla facilis maiores labore totam inventore
                        repudiandae harum consequatur modi ipsa ab, repellendus numquam, deserunt iure ratione rem! Quam
                        excepturi maxime, saepe molestias deleniti perferendis alias minima, tempora veritatis natus
                        inventore? Corrupti, iste iure delectus nam qui laborum.</p>

                    <div class="kategori border-top pt-3">
                        <a href="#" class="badge badge-primary p-2 rounded-pill font-weight-bold">Korban Banjir</a>
                    </div>

                    <hr class="d-lg-none d-block">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-0">
                    <h1 class="font-weight-bold">Rp. {{ format_uang(500000) }}</h1>
                    <p class="font-weight-bold">Terkumpul dari Rp. {{ format_uang(10000000) }}</p>
                    <div class="progress" style="height: .3rem;">
                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <p>10% tercapai</p>
                    <p>3 bulan lagi</p>
                </div>
                <div class="donasi mt-2 mb-4">
                    <button class="btn btn-primary btn-lg btn-block">Donasi Sekarang</button>
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

@endsection