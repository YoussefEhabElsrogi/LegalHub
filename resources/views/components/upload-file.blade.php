<div class="mb-3">
    <label for="files" class="form-label">الملفات (PDF فقط)</label>
    <input type="file" name="files[]" class="form-control" id="files" accept="application/pdf" multiple>
    @error('files.*')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
