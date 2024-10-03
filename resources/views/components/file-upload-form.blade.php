<h6 class="mt-4">تحميل ملف جديد:</h6>
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="files" class="form-label">اختر ملف (PDF فقط)</label>
        <input type="file" name="files[]" class="form-control" id="files" accept="application/pdf" multiple>
        @error('files')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">تحميل</button>
</form>
