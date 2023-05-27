@extends('layouts.app') 

@section('title', 'Kategori') 
@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active">Kategori</li>
@endsection @section('content')
<div class="row">
    <div class="col-12">
        <x-card>
            <x-slot name="header">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Tambah
				</a hr>
            </x-slot>
            <form action="" class="d-flex justify-content-between">
                <x-dropdown-table/>
                <x-filter-table/>
            </form>

            <x-table>
                <x-slot name="thead">
                    <th width="5%">No</th>
                    <th width="">Nama</th>
                    <th width="25%">Jumlah Projek</th>
                    <th width="15%">
                        <i class="fas fa-cog"></i>
                    </th>
                </x-slot>

                @foreach ($category as $k => $v)
                <tr>
                    <td><x-number-table :key="$k" :model="$category"/></td>
                    <td>{{ $v->name }}</td>
                    <td>0</td>
                    <td>
                        <form action="{{ route('category.destroy', $v->id) }}" method="POST">
                            @csrf 
                            @method('DELETE')
                            
                            <a href="{{ route('category.edit', $v->id) }} " class="btn btn-link text-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button
                                class="btn btn-link text-danger"
                                onclick="return confirm('Yakin ingin menghapus data?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </x-table>
			<x-pagination-table :model="$category"/>
        </x-card>
    </div>
</div>
@endsection 

<x-toast/>