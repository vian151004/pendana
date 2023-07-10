<form action="{{ route('setting.update', $setting->id) }}?pills=bank" method="POST">
    @csrf
    @method('PUT')

    <x-card>       
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-group">
                    <label for="bank_id">Bank</label>
                    <select name="bank_id" id="bank_id" class="custom-select @error('bank_id') is-invalid @enderror">
                        <option selected disabled>Pilih Salah Satu</option>
                        @foreach ($bank as $k => $v)
                            <option value="{{ $k }}" {{ old('bank_id') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('bank_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="account">Nomor Rekening</label>
                    <input type="text" class="form-control @error('account') is-invalid @enderror" name="account" id="account" 
                        value="{{ old('account') }}">
                    @error('account')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" 
                        value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input @error('is_main') is-invalid @enderror" name="is_main" id="is_main" 
                        value="{{ old('is_main') ?? 1 }}" 
                        {{ old('is_main') == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_main">Akun Utama?</label>
                    @error('is_main')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        
        <x-slot name="footer">
            <button type="reset" class="btn btn-dark">Reset</button>
            <button class="btn btn-primary">Simpan</button>
        </x-slot>
    </x-card>

</form>

<x-card>
    <x-slot name="header">
        <h5 class="card-title">Daftar Bank</h5>
    </x-slot>

    <x-table>
        <x-slot name="thead">
            <th width="5%">No</th>
            <th>Nama</th>
            <th>Nomor Rekening</th>
            <th>Bank</th>
            <th width="15%">
                <i class="fas fa-cog"></i>
            </th>
        </x-slot>

        @foreach ($setting->bank_setting as $k => $v)
            <tr>
                <td>{{ $k+1 }}</td>
                <td>{{ $v->pivot->name }}</td>
                <td>{{ $v->pivot->account }} {!! $v->pivot->is_main ? '<small class="text-primary"><i class="fas fa-check-circle"></i></small>' : '' !!}</td>
                <td>{{ $v->name }}</td>
                <td>
                    <form action="{{ route('setting.bank.destroy', ['setting' => $setting->id, 'id' => $v->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')

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
</x-card>