<div class="form-group">
    <label for="categories">Kategori apa yang tepat untuk penggalangan dana ini ?</label>
    <select name="categories[]" id="categories" class="select2" multiple>
        @foreach ($category as $k => $v)
            <option value="{{ $k }}"
                {{ isset($campaign) && in_array($k, $campaign->category_campaign->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $v }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="title">Apa judul untuk penggalangan dana ini ?</label>
    <input type="text" name="title" id="title" class="form-control" placeholder="Contoh: bantu kafi melawan kanker" 
        value="{{ isset($campaign) ? $campaign->title : '' }}">
</div>
<div class="form-group">
    <button type="button" class="btn btn-primary" onclick="stepper.next()">Selanjutnya</button>
</div>