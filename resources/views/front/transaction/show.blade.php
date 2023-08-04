@extends('layouts.front')

@section('title', 'Transaksi')

@push('css')
<style>
    .sideways {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .sideways h3.text-3x1 {
        font-size: 3rem;
        font-weight: 500;
        color: #007bff;
    }

    .text-muted {
        color: #999;
        opacity: 0.9;
    }

    .dropdown-toggle {
        cursor: pointer;
        padding: 4px 8px;
        background-color: #f1f1f1;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 16px;
    }

    .dropdown-content {
        display: none;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 0.5rem;
    }

    .dropdown-content ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .dropdown-toggle .arrow-icon {
        transition: transform 0.3s ease;
        height: 12px;
        width: 12px;
        margin-left: 3px;
    }

    .dropdown-toggle.open .arrow-icon {
        transform: rotate(180deg);
    }

    .dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.255em;
        vertical-align: 0.255em;
        content: "";
        border-top: 0em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
    }

    @media (max-width: 767px) {
        .sideways {
            flex-direction: column;
            align-items: center;
        }
        .sideways h3.text-3x1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .sideways .dropdown-toggle .arrow-icon {
            display: block;
        }
        .sideways .dropdown-toggle.open .arrow-icon {
            display: block;
        }
        .sideways .bg-danger {
            margin-top: 1rem;
        }
        .dropdown-content {
            margin-top: 0;
        }
    }
</style>
@endpush
    
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <x-card class="mt-2">
            <x-slot name="header">
                <h5 class="card-title text-bold">TRANSAKSI PEMBAYARAN</h5>
                <h5 class="text-primary text-right">#{{ $detail->reference }}</h5>
            </x-slot>

            <div class="sideways">
                <p class="text-muted ml-1 text-lg">Detail Transaksi</p>
                <p class="text-muted text-lg mr-2 text-center">Instruction</p>
                <div class="bg-danger rounded mr-2 justify-between">
                    <span class="mx-2">{{ $detail->status }}</span>    
                </div>
            </div>

            <div class="sideways mt-0">
                <h3 class="text-3x1 font-medium text-primary">Rp. {{ format_uang($detail->amount) }}</h3>
                @foreach ($detail->instructions as $instruction)
                <button class="bg-secondary rounded flex items-center justify-between dropdown-toggle" onclick="toggleDropdown()">      
                    <span class="mx-1 text-md">
                        {{ $instruction->title }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 arrow-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>       
                </button> 
                @endforeach  
            </div>
            
            <div class="sideways">      
                @foreach ($detail->instructions as $instruction)
                <div class="dropdown-content" id="dropdown-content">
                    <ul>
                        @foreach ($instruction->steps as $step)
                            <li>{{ $loop->iteration }}. {!! $step !!}</li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>  
        </x-card>
    </div>
</div>
@endsection
