<div class="row g-1">
    <div class="col-md-6">
        <label class="form-label" for="topicName">Название</label>
        <input type="text" id="topicName" name="name" class="form-control" value="{{ old('name', $topic->name ?? '') }}" required>
        @error('name')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-12">
        <label class="form-label" for="topicDescription">Описание</label>
        <textarea id="topicDescription" name="description" class="form-control" rows="4">{{ old('description', $topic->description ?? '') }}</textarea>
        @error('description')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <div class="form-check mt-2">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" id="topicActiveCheckbox" name="is_active" value="1" class="form-check-input"
                   @checked(old('is_active', $topic->is_active ?? true))>
            <label class="form-check-label" for="topicActiveCheckbox">Активна</label>
        </div>
        @error('is_active')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
