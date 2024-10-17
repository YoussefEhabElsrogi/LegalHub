@extends('dashboard.master')

@section('title', 'عرض الشركات')

@section('page', 'الشركات/')

@section('page-title', 'عرض الشركات')

@section('content')
    <div class="card">
        <x-card-header title="جميع الشركات" action-url="{{ route('companies.create') }}" action-text="إضافة شركة جديدة" />

        <x-search-input id="search-company" placeholder="ابحث عن الشركات حسب اسم الشركة أو اسم الموكل المالك للشركة..." />

        <div id="status-message" class="alert alert-warning d-none"></div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>اسم الموكل</th>
                        <th>اسم الشركة</th>
                        <th>رسوم التأسيس</th>
                        <th>الأتعاب</th>
                        <th>المقدم</th>
                        <th>المؤخر</th>
                        <th>الملاحظات</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="ajax-search_result">
                    @forelse ($companies as $company)
                        <tr>
                            <td class="nowrap">{{ $company->client->name }}</td>
                            <td class="nowrap">{{ $company->company_name }}</td>
                            <td class="nowrap">{{ $company->establishment_fees }} جنيها</td>
                            <td class="nowrap">{{ $company->remaining_amount + $company->advance_amount }} جنيها</td>
                            <td class="nowrap">{{ $company->advance_amount }} جنيها</td>
                            <td class="nowrap">{{ $company->remaining_amount }} جنيها</td>
                            <td class="nowrap">
                                @if ($company->notes)
                                    {{ $company->notes }}
                                @else
                                    <span class="text-danger">غير متوفر ملاحظات</span>
                                @endif
                            </td>
                            <td class="nowrap">
                                <x-action-buttons :model-id="$company->id" route-prefix="companies" />
                            </td>
                        </tr>
                    @empty
                        <x-no-data-message :colspan="8" message="لا يوجد شركات مسجلة الان" />
                    @endforelse
                </tbody>
            </table>
        </div>
        <x-pagination :collection="$companies" />
    </div>
@endsection

@push('css')
    <style>
        .nowrap {
            white-space: nowrap;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('assets/js/responseHandler.js') }}"></script>
    <script>
        $(document).ready(function() {
            let timer = null;

            $(document).on('input', "#search-company", function() {
                clearTimeout(timer);
                var search = $(this).val();

                timer = setTimeout(function() {
                    jQuery.ajax({
                        url: "{{ route('search.company') }}",
                        type: "POST",
                        datatype: "json",
                        cache: false,
                        data: {
                            search: search,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: handleResponse,
                        error: function(xhr, status, error) {
                            console.log('Error: ' + error);
                        }
                    });
                }, 500);
            });
        });
    </script>
@endpush
