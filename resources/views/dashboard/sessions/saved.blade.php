@extends('dashboard.master')

@section('title', 'عرض الجلسات المحفوظة')

@section('page', 'الجلسات المحفوظة/')

@section('page-title', 'عرض الجلسات المحفوظة')

@section('content')
    <div class="card">
        <h5 class="card-header">الجلسات المحفوظة</h5>
        <div class="card-body">
            @if ($savedSessions->isEmpty())
                <p>لا توجد جلسات محفوظة.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>رقم الجلسة</th>
                            <th>نوع الجلسة</th>
                            <th>تاريخ الجلسة</th>
                            <th>اسم الخصم</th>
                            <th>عدد الملفات</th>
                            <th>العميل</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th> <!-- إضافة عنوان عمود الإجراءات -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($savedSessions as $session)
                            <tr>
                                <td>{{ $session->session_number }}</td>
                                <td>{{ $session->session_type }}</td>
                                <td>{{ $session->session_date }}</td>
                                <td>{{ $session->opponent_name }}</td>
                                <td>{{ $session->files->count() }}</td>
                                <td>{{ $session->client->name ?? 'غير متوفر' }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $session->session_status }}</span>
                                </td>
                                <td>
                                    <form action="{{ route('sessions.destroy', $session->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذه الجلسة؟')">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $savedSessions->links() }} <!-- Pagination links -->
                </div>
            @endif
        </div>
    </div>
@endsection
