<div class="row g-1">
    <div class="col-md-6">
        <label class="form-label" for="topicName">Название</label>
        <input type="text" id="topicName" name="name" class="form-control" value="{{ old('name', $topic->name ?? '') }}" required>
        @error('name')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
