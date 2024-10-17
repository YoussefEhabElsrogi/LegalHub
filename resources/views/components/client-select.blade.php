<div class="col-md-12 mb-3">
    <label for="client_id" class="form-label">العميل <span class="text-danger" style="font-size: 1.2rem;">*</span></label>
    <select name="client_id" id="select2Basic" class="select2 form-select form-select-lg" data-allow-clear="true" required>
        <option value="" disabled selected>اختر عميل</option>
        @foreach ($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }}</option>
        @endforeach
    </select>
    @error('client_id')
        <div class="error-message text-danger">{{ $message }}</div>
    @enderror
</div>
