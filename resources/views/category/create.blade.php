@extends('layouts.app')

@section('title', 'Kategori')
@section('breadcrumb')
@parent
<li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kategori</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row">
	<div class="col-12">
		<form action="{{ route('category.store') }}" method="POST">
			@csrf
			<x-card>
				<div class="form-group row">
					<label for="name">Nama</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
					@error('name')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
				<x-slot name="footer">
					<button class="btn btn-warning" type="reset">Reset</button>
					<button class="btn btn-primary">Simpan</button>
				</x-slot>
			</x-card>
		</form>
	</div>
</div>
@endsection

@push('scripts')

@endpush