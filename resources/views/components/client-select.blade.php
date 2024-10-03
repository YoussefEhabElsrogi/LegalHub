<div class="col-md-6 mb-3">
    <label for="client_id" class="form-label">العميل</label>
    <select name="client_id" id="select2Basic" class="select2 form-select form-select-lg" data-allow-clear="true">
        <option value="">اختر عميل</option>
        @foreach ($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }}</option>
        @endforeach
    </select>
    @error('client_id')
        <div class="error-message">{{ $message }}</div>
    @enderror
</div>
