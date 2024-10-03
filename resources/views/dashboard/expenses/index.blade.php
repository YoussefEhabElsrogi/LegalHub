@extends('dashboard.master')

@section('title', 'عرض المصروفات الإدارية')

@section('page', 'المصروفات الإدارية/')

@section('page-title', 'عرض المصروفات الإدارية')

@section('content')
    <div class="card shadow-sm mb-4">
        <x-card-header title="جميع المصروفات الادارية" action-url="{{ route('expenses.create') }}"
            action-text="إضافة مصروف اداري" class="bg-primary text-white" />

        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>اسم الموكل</th>
                        <th>اسم المصروف</th>
                        <th>قيمة المصروف</th>
                        <th>ملاحظات</th>
                        <th class="text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->client->name }}</td>
                            <td>{{ $expense->expense_name }}</td>
                            <td>{{ number_format($expense->amount, 2) }} جنيهاً</td>
                            <td>
                                @if ($expense->notes)
                                    {{ $expense->notes }}
                                @else
                                    <span class="text-danger">غير متوفر ملاحظات</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <x-action-buttons :model-id="$expense->id" route-prefix="expenses" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <x-no-data-message :colspan="4" message="لا يوجد مصروفات الان" />
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <x-pagination :collection="$expenses" />
    </div>
@endsection
