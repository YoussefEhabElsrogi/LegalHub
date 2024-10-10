@extends('dashboard.master')

@section('title', 'عرض التوكيلات')

@section('page', 'التوكيلات/')

@section('page-title', 'عرض التوكيلات')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <x-card-header title="جميع التوكيلات" action-url="{{ route('procurations.create') }}" action-text="إضافة توكيل" />
            <x-search-input id="search-procuration"
                placeholder="ابحث عن التوكيلات حسب العمبل أو رقم التوكيل أو رقم التوكيل في الدفتر..." />
            <div id="status-message" class="alert alert-warning d-none"></div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>العميل</th>
                            <th>رقم التوكيل</th>
                            <th>رقم التوكيل في الدفتر</th>
                            <th>ملاحظات</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="ajax-search_result">
                        @forelse ($procurations as $procuration)
                            <tr>
                                <td>{{ $procuration->client->name ?? 'غير متوفر' }}</td>
                                <td>{{ $procuration->authorization_number }}</td>
                                <td>{{ $procuration->notebook_number }}</td>
                                <td>{{ $procuration->notes ?? 'لا يوجد ملاحظات' }}</td>
                                <td>
                                    <x-action-buttons :model-id="$procuration->id" route-prefix="procurations" />
                                </td>
                            </tr>
                        @empty
                            <x-no-data-message :colspan="5" message="لا يوجد توكيلات الان" />
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <x-pagination :collection="$procurations" />
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/responseHandler.js') }}"></script>
    <script>
        $(document).ready(function() {
            let timer = null;

            $(document).on('input', "#search-procuration", function() {
                clearTimeout(timer);
                var search = $(this).val();

                timer = setTimeout(function() {
                    jQuery.ajax({
                        url: "{{ route('search.procuration') }}",
                        type: "POST",
                        datatype: "json",
                        cache: false,
                        data: {
                            search: search,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: handleResponse,
                        error: function(xhr, status, error) {
                            console.log('Error: ' +
                                error);
                        }
                    });
                }, 500);
            });
        });
    </script>
@endpush
