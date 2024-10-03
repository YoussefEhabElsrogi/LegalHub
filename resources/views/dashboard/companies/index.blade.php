@extends('dashboard.master')

@section('title', 'عرض الشركات')

@section('page', 'الشركات/')

@section('page-title', 'عرض الشركات')

@section('content')
    <div class="card">
        <x-card-header title="جميع الشركات" action-url="{{ route('companies.create') }}" action-text="إضافة شركة جديدة" />

        <div class="table-responsive">
            <table class="table table-bordered">
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
                    @forelse ($companies as $company)
                        <tr>
                            <td>{{ $company->client->name }}</td>
                            <td>{{ $company->establishment_fees }} جنيها</td>
                            <td>{{ $company->remaining_amount + $company->advance_amount }} جنيها</td>
                            <td>{{ $company->advance_amount }} جنيها</td>
                            <td>{{ $company->remaining_amount }} جنيها</td>
                            <td>
                                @if ($company->notes)
                                    {{ $company->notes }}
                                @else
                                    <span class="text-danger">غير متوفر ملاحظات</span>
                                @endif
                            </td>
                            <td>
                                <x-action-buttons :model-id="$company->id" route-prefix="companies" />
                            </td>
                        </tr>
                    @empty
                        <x-no-data-message :colspan="7" message="لا يوجد شركات مسجلة الان" />
                    @endforelse
                </tbody>
            </table>
        </div>
        <x-pagination :collection="$companies" />
    </div>
@endsection
