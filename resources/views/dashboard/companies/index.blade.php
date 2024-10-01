@extends('dashboard.master')

@section('title', 'عرض الشركات')

@section('page', 'الشركات/')

@section('page-title', 'عرض الشركات')

@section('content')
    <div class="card">
        <h5 class="card-header">عرض الشركات</h5>
        <div class="card-body">
            <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">إضافة شركة جديدة</a>

            @if ($companies->isEmpty())
                <p>لا توجد شركات مسجلة.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>اسم الموكل</th>
                            <th>رسوم التأسيس</th>
                            <th>الأتعاب</th>
                            <th>المقدم</th>
                            <th>المؤخر</th>
                            <th>الملاحظات</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->client->name }}</td>
                                <td>{{ number_format($company->establishment_fees, 2) }} جنيهاً</td>
                                <td>{{ number_format($company->remaining_amount + $company->advance_amount, 2) }} جنيهاً
                                <td>{{ number_format($company->advance_amount, 2) }} جنيهاً</td>
                                <td>{{ number_format($company->remaining_amount, 2) }} جنيهاً</td>
                                </td>
                                <td>
                                    @if ($company->notes)
                                        {{ $company->notes }}
                                    @else
                                        <span class="text-danger">غير متوفر ملاحظات</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('companies.show', $company->id) }}"
                                            class="btn btn-info btn-sm me-2">عرض</a>
                                        <a href="{{ route('companies.edit', $company->id) }}"
                                            class="btn btn-warning btn-sm me-2">تعديل</a>
                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذه الشركة؟')">حذف</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $companies->links() }} <!-- Pagination links -->
                </div>
            @endif
        </div>
    </div>
@endsection
