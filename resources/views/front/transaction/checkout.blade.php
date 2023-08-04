@extends('layouts.front')

@section('title', 'anjay')

@push('css')
    
@endpush
    
@section('content')
<div class="row justify-content-between mt-3 mt-lg-4">
    @foreach ($channels as $channel)
        <div class="col-lg-3 col-md-4">
            <form action="{{ url('/donation/{id}/transaction') }}" method="POST">
                @csrf
                
                <input type="hidden" name="nominal" value="{{ $donation->nominal }}">
                <input type="hidden" name="method" value="{{ $channel->code }}">
                <button type="submit" class="text-center rounded">
                    <img src="{{ asset('storage/bank/' . $channel->code . '.png') }}" alt="" class="w-100 rounded">
                    <p class="mt-3 text-muted">Bayar dengan {{ $channel->name }}</p>
                </button>
            </form>
        </div>
    @endforeach
</div>
@endsection