
<div class="col-md-3 col-sm-6 mb-3">
    <div class="card text-center shadow-sm h-100">
        <div class="card-body">
            <a href="{{ asset($file->path) }}" target="_blank">
                <i class="fas fa-file-pdf fa-3x text-danger"></i>
            </a>
            @php
                $fileName = pathinfo($file->path, PATHINFO_FILENAME);
                $shortName = Str::limit($fileName, 10);
            @endphp
            <p class="mt-2">اسم الملف: {{ $shortName }}</p>

            <div class="d-flex justify-content-center">
                <form action="{{ route('attachments.download', $file->id) }}" method="GET" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm me-2">تحميل</button>
                </form>

                <form action="{{ route('attachments.destroy', $file->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا الملف؟')">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
