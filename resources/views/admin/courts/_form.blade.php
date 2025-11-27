<div class="row g-1">
    <div class="col-md-6">
        <label class="form-label" for="courtName">Название</label>
        <input type="text" id="courtName" name="name" class="form-control" value="{{ old('name', $court->name ?? '') }}" required>
        @error('name')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
