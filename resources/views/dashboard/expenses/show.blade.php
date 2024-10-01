@extends('dashboard.master')

@section('title', 'عرض المصروفات')

@section('page', 'المصروفات/')

@section('page-title', 'عرض المصروفات')

@section('content')
    <div class="card">
        <h5 class="card-header">تفاصيل المصروفات</h5>
        <div class="card-body">
            <h5 class="card-title">اسم المصروف: {{ $expense->expense_name }}</h5>
            <p class="card-text"><strong>اسم العميل:</strong> {{ $expense->client->name ?? 'غير متوفر' }}</p>
            <p class="card-text"><strong>رقم هاتف العميل:</strong> {{ $expense->client->phone ?? 'غير متوفر' }}</p>
            <p class="card-text"><strong>قيمة المصروف:</strong> {{ number_format($expense->amount, 2) }} جنيهاً</p>
            <!-- تاريخ الإنشاء -->
            <p class="card-text"><strong>الملاحظات:</strong> {{ $expense->notes ?? 'غير متوفر ملاحظات' }}</p>
            <!-- تاريخ آخر تحديث -->
            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-primary">تعديل</a>
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
        </div>
    </div>
@endsection
