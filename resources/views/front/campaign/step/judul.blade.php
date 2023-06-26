<div class="form-group">
    <label for="categories">Kategori apa yang tepat untuk penggalangan dana ini ?</label>
    <select name="categories[]" id="categories" class="select2" multiple required>
        @foreach ($category as $k => $v)
            <option value="{{ $k }}">{{ $v }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="title">Apa judul untuk penggalangan dana ini ?</label>
    <input type="text" name="title" id="title" class="form-control" placeholder="Contoh: bantu kafi melawan kanker">
</div>
<div class="form-group">
    <button type="button" class="btn btn-primary" onclick="stepper.next()">Selanjutnya</button>
</div>