@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ format_uang($jumlahKategori) }}</h3>

                <p>Kategori</p>
            </div>
            <div class="icon">
                <i class="fas fa-cube"></i>
            </div>
            <a href="{{ route('category.index') }}" class="small-box-footer">Lihat<i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ format_uang($jumlahProjek) }}</h3>

                <p>Projek</p>
            </div>
            <div class="icon">
                <i class="fas fa-folder"></i>
            </div>
            <a href="{{ route('campaign.index') }}" class="small-box-footer">Lihat<i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ format_uang($jumlahProjekPending) }}</h3>

                <p>Projek Pending</p>
            </div>
            <div class="icon">
                <i class="fas fa-folder"></i>
            </div>
            <a href="{{ route('campaign.index', ['status' => 'publish']) }}" class="small-box-footer">Lihat<i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ format_uang($jumlahKontakMasuk) }}</h3>

                <p>Kontak Masuk Baru</p>
            </div>
            <div class="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <a href="{{ route('contact.index', ['date' => Date('Y-m-d')]) }}" class="small-box-footer">Lihat<i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Rp. {{ format_uang($totalDonasi) }}</h3>

                <p>Total Donasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-donate"></i>
            </div>
            <a href="{{ route('donation.index', ['status' => 'confirmed']) }}" class="small-box-footer">Lihat <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ format_uang($jumlahDonasiBelumDikonfirmasi) }}</h3>

                <p>Donasi Belum Dikonfirmasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-donate"></i>
            </div>
            <a href="{{ route('donation.index', ['status' => 'not confirmed']) }}" class="small-box-footer">Lihat <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ format_uang($jumlahDonasiDikonfirmasi) }}</h3>

                <p>Donasi Dikonfirmasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-donate"></i>
            </div>
            <a href="{{ route('donation.index', ['status' => 'confirmed']) }}" class="small-box-footer">Lihat <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Rp. {{ format_uang($totalProjekDicairkan) }}</h3>

                <p>Total Dicairkan</p>
            </div>
            <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <a href="{{ route('cashout.index', ['status' => 'success']) }}" class="small-box-footer">Lihat <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<!-- /.row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-1"></i>
                    Laporan donasi dan pencairan {{ date('Y') }}
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body text-center pb-0">
                {{ tanggal_indonesia(date('Y-01-01')) }} s/d {{ tanggal_indonesia(date('Y-12-31')) }}
            </div>
            <div class="card-body pt-0">
                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header body-transparent">
                <h3 class="card-title">
                    <i class="fas fa-donate mr-1"></i>
                    Transaksi Masuk
                </h3>
            </div>
    
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Nama</th>
                                <th width="35%">Judul</th>
                                <th>Jumlah Donasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $k => $v)
                            <tr>
                                <td><a href="{{ route('transaction.show', $v->reference) }}">{{ $k+1 }}</a></td>
                                <td>{{ $v->user->name }} <br> <a href="mailTo:{{ $v->email }}"
                                    target="-blank">{{ $v->user->email }}</a></td>
                                <td>{{ $v->donation->campaign->title }}</td> 
                                <td>Rp. {{ format_uang($v->donation->nominal) }}</td>
                                <td>
                                    @if ($v->status == 'paid')
                                    <span class="rounded-circle bg-success py-2 px-2 text-xs font-weight-bold text-uppercase">
                                        {{ $v->status }}
                                    </span>
                                    @else
                                    <span class="rounded-circle bg-danger py-2 px-2 text-xs font-weight-bold text-uppercase">
                                        {{ $v->status }}
                                    </span>    
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Tidak Tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>

    <!-- /.Left col -->
    <div class="col-lg-7">
        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">10 projek populer bulan ini</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Jumlah Donasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projekPopuler as $k => $v)
                            <tr>
                                <td><a href="{{ route('campaign.show', $v->id) }}">{{ $k+1 }}</a></td>
                                <td>{{ $v->title }}</td>
                                <td><span class="badge badge-{{ $v->statusColor() }}">{{ $v->status }}</span></td>
                                <td>{{ $v->donations_count }}x</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Tidak Tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Top 10 donatur bulan ini</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Nama</th>
                                <th>Jumlah Donasi</th>
                                <th>Jumlah Projek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topDonatur as $k => $v)
                            <tr>
                                <td><a href="{{ route('donatur.index', ['email' => $v->email]) }}">{{ $k+1 }}</a></td>
                                <td>{{ $v->name }} <br> <a href="mailTo:{{ $v->email }}"
                                        target="-blank">{{ $v->email }}</a></td>
                                <td>{{ $v->donations_count }}x</td>
                                <td>{{ $v->campaigns_count }}x</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Tidak Tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">

        <!-- Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Pengguna Bulan Ini
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="sales-chart-canvas" height="150" style="height: 150px;"></canvas>
                    </div>
                    <div class="col-md-6">
                        <ul class="chart-legend clearfix">
                            <li><i class="far fa-circle text-danger"></i> Donatur</li>
                            <li><i class="far fa-circle text-success"></i> Subscriber</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Notifikasi terbaru <span class="badge badge-danger">{{ $countNotifikasi }}</span>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach ($listNotifikasi as $k => $notifikasi)
                        @foreach ($notifikasi as $v)
                        <li class="item">
                            <div class="product-info ml-1">
                                <a href="{{ route("$k.index") }}" class="product-title">
                                    {{ $v->name ?? $v->email ?? $v->user->name ?? "" }}
                                    <span class="badge 
                                    @switch($k)
                                        @case('donatur') badge-warning @break
                                        @case('subscriber') badge-secondary @break
                                        @case('contact') badge-info @break
                                        @case('donation') badge-primary @break
                                        @case('cashout') badge-success @break
                                    @endswitch
                                    float-right">{{ $k }} baru</span>
                                </a>
                                <span class="product-description">
                                    {{ now()->parse($v->created_at)->diffForHumans() }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->
@endsection

@push('scripts_vendor')
<script src="{{ asset('/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
@endpush

@push('scripts')
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script>
    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
    var salesChartData = {
        labels: @json($listBulan),
        datasets: [{
                label: 'Donasi',
                backgroundColor: 'rgba(10, 123,255, .9)',
                borderColor: 'rgba(10, 123, 255, .8)',
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(10, 123, 255, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(10, 123, 255, 1)',
                data: @json($listDonasi)
            },
            {
                label: 'Pencairan',
                backgroundColor: 'rgba(210, 214, 222, .9)',
                borderColor: 'rgba(210, 214, 222, .8)',
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: @json($listPencairan)
            }
        ]
    }
    var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    // This will get the first returned node in the jQuery collection.
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
        type: 'line',
        data: salesChartData,
        options: salesChartOptions
    })
    // Donut Chart
    var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
    var pieData = {
        labels: @json($listNamaUser),
        datasets: [{
            data: @json($listJumlahUser),
            backgroundColor: ['#f56954', '#00a65a']
        }]
    }
    var pieOptions = {
        legend: {
            display: false
        },
        maintainAspectRatio: false,
        responsive: true
    }
    // Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    // eslint-disable-next-line no-unused-vars
    var pieChart = new Chart(pieChartCanvas, { // lgtm[js/unused-local-variable]
        type: 'doughnut',
        data: pieData,
        options: pieOptions
    })
</script>
@endpush
