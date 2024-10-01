@extends('dashboard.master')

@section('title', 'عرض المصروفات الإدارية')

@section('page', 'المصروفات الإدارية/')

@section('page-title', 'عرض المصروفات الإدارية')

@section('content')
    <div class="card">
        <h5 class="card-header">المصروفات الإدارية</h5>
        <div class="card-body">
            <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3">إضافة مصروف جديد</a>

            @if ($expenses->isEmpty())
                <p>لا توجد مصروفات مسجلة.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>اسم المصروف</th>
                            <th>قيمة المصروف</th>
                            <th>ملاحظات</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->expense_name }}</td>
                                <td>{{ number_format($expense->amount, 2) }} جنيهاً</td> <!-- تنسيق القيمة -->
                                <td>
                                    @if ($expense->notes)
                                        {{ $expense->notes }}
                                    @else
                                        <span class="text-danger">غير متوفر ملاحظات</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('expenses.show', $expense->id) }}" class="btn btn-info btn-sm">عرض</a>
                                    <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا المصروف؟')">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $expenses->links() }} <!-- Pagination links -->
                </div>
            @endif
        </div>
    </div>
@endsection
