@extends('dashboard.master')

@section('title', 'عرض التوكيلات')

@section('page', 'التوكيلات/')

@section('page-title','عرض التوكيلات')

@section('content')
    <div class="card">
        <h5 class="card-header">التوكيلات</h5>
        <div class="card-body">
            <a href="{{ route('procuration.create') }}" class="btn btn-primary mb-3">إضافة توكيل جديد</a>

            @if ($procurations->isEmpty())
                <p>لا توجد توكيلات مسجلة.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>رقم التوكيل</th>
                            <th>رقم التوكيل في الدفتر</th>
                            <th>عدد الملفات</th>
                            <th>العميل</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($procurations as $procuration)
                            <tr>
                                <td>{{ $procuration->authorization_number }}</td>
                                <td>{{ $procuration->notebook_number }}</td>
                                <td>{{ $procuration->files->count() }}</td>
                                <td>{{ $procuration->client->name ?? 'غير متوفر' }}</td>
                                <td>
                                    <a href="{{ route('procuration.show', $procuration->id) }}"
                                        class="btn btn-info btn-sm">عرض</a>
                                    <a href="{{ route('procuration.edit', $procuration->id) }}"
                                        class="btn btn-warning btn-sm">تعديل</a>
                                    <form action="{{ route('procuration.destroy', $procuration->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا التوكيل؟')">حذف</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $procurations->links() }} <!-- Pagination links -->
                </div>
            @endif
        </div>
    </div>
@endsection
