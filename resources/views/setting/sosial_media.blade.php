<form action="{{ route('setting.update', $setting->id) }}?pills=sosial-media" method="POST">
    @csrf
    @method('PUT')

    <x-card>       
       <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="instagram_link">Instagram</label>
                    <input type="text" class="form-control @error('instagram_link') is-invalid @enderror" name="instagram_link" id="instagram_link" 
                        value="{{ old('instagram_link') ?? $setting->instagram_link }}">
                    @error('instagram_link')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="twitter_link">Twitter</label>
                    <input type="text" class="form-control @error('twitter_link') is-invalid @enderror" name="twitter_link" id="twitter_link" 
                        value="{{ old('twitter_link') ?? $setting->twitter_link }}">
                    @error('twitter_link')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
       </div>

       <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="facebook_link">Facebook</label>
                    <input type="text" class="form-control @error('facebook_link') is-invalid @enderror" name="facebook_link" id="facebook_link" 
                        value="{{ old('facebook_link') ?? $setting->facebook_link }}">
                    @error('facebook_link')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="google_plus_link">Google Plus</label>
                    <input type="text" class="form-control @error('google_plus_link') is-invalid @enderror" name="google_plus_link" id="google_plus_link" 
                        value="{{ old('google_plus_link') ?? $setting->google_plus_link }}">
                    @error('google_plus_link')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
         
         {{-- <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div> --}}
        
        <x-slot name="footer">
            <button type="reset" class="btn btn-dark">Reset</button>
            <button class="btn btn-primary">Simpan</button>
        </x-slot>
    </x-card>
</form>
