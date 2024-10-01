<div class="btn-group" style="gap: 5px" role="group">
    <a href="{{ route($routePrefix . '.show', $modelId) }}" class="btn btn-info btn-sm">عرض</a>
    <a href="{{ route($routePrefix . '.edit', $modelId) }}" class="btn btn-warning btn-sm">تعديل</a>
    <form action="{{ route($routePrefix . '.destroy', $modelId) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm"
            onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
    </form>
</div>
