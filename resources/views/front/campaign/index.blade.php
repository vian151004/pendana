@extends('layouts.front')

@section('title', 'Galang Dana')

@push('css_vendor')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
@endpush

@section('content') 
<div class="container py-5" style="min-height: calc(60px + 55vh)">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="bs-stepper">
                <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#judul-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="judul-part"
                            id="judul-part-trigger">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label d-lg-inline-block d-none ">Judul</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#detail-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="detail-part"
                            id="detail-part-trigger">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">Detail</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#foto-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="foto-part"
                            id="foto-part-trigger">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label">Foto</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#deskripsi-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="infordeskripsiation-part"
                            id="deskripsi-part-trigger">
                            <span class="bs-stepper-circle">4</span>
                            <span class="bs-stepper-label">Deskripsi</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#konfirmasi-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="konfirmasi-part"
                            id="konfirmasi-part-trigger">
                            <span class="bs-stepper-circle">5</span>
                            <span class="bs-stepper-label">Konfirmasi</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <!-- your steps content here -->
                    <div id="judul-part" class="content" role="tabpanel" aria-labelledby="judul-part-trigger">
                        @includeIf('front.campaign.step.judul')
                    </div>
                    <div id="detail-part" class="content" role="tabpanel" aria-labelledby="detail-part-trigger">
                        @includeIf('front.campaign.step.detail')
                    </div>
                    <div id="foto-part" class="content" role="tabpanel" aria-labelledby="foto-part-trigger">
                        @includeIf('front.campaign.step.foto')
                    </div>
                    <div id="deskripsi-part" class="content" role="tabpanel" aria-labelledby="deskripsi-part-trigger">
                        @includeIf('front.campaign.step.deskripsi')
                    </div>
                    <div id="konfirmasi-part" class="content" role="tabpanel" aria-labelledby="konfirmasi-part-trigger">
                        @includeIf('front.campaign.step.konfirmasi')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts_vendor')
    <script src="{{ asset('/AdminLTE/plugins/moment/moment.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
@endpush

@includeIf('includes.select2', ['placeholder' => 'Pilih Kategori'])
@includeIf('includes.datepicker')

@push('scripts')
    <script>
        $(document).ready(function () {
            window.stepper = new Stepper($('.bs-stepper')[0])
        })
    </script>
@endpush