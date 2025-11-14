<div class="row g-1">
    <div class="col-md-6">
        <label class="form-label" for="courtName">Название</label>
        <input type="text" id="courtName" name="name" class="form-control" value="{{ old('name', $court->name ?? '') }}" required>
        @error('name')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="courtRegion">Регион</label>
        <input type="text" id="courtRegion" name="region" class="form-control" value="{{ old('region', $court->region ?? '') }}">
        @error('region')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="courtAddress">Адрес</label>
        <input type="text" id="courtAddress" name="address" class="form-control" value="{{ old('address', $court->address ?? '') }}">
        @error('address')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
