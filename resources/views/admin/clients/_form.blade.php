<div class="row g-1">
    <div class="col-md-6">
        <label class="form-label" for="clientName">Имя клиента</label>
        <input type="text" id="clientName" name="name" class="form-control" value="{{ old('name', $client->name ?? '') }}" required>
        @error('name')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="clientPhone">Телефон</label>
        <input type="text" id="clientPhone" name="phone" class="form-control" value="{{ old('phone', $client->phone ?? '') }}">
        @error('phone')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="clientEmail">Email</label>
        <input type="email" id="clientEmail" name="email" class="form-control" value="{{ old('email', $client->email ?? '') }}">
        @error('email')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
