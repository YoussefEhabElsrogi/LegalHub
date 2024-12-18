@extends('dashboard.master')

@section('title', 'عرض الدعاوي')

@section('page', 'الدعاوي/')

@section('page-title', 'عرض الدعاوي')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">جميع الدعاوي</h5>
            <div class="btn-group" style="gap: 10px">
                <a href="{{ route('session.saved') }}" class="btn btn-secondary">الدعاوي المحفوظة</a>
                <a href="{{ route('sessions.create') }}" class="btn btn-primary">إضافة دعوي</a>
            </div>
        </div>

        <x-search-input id="search-session" placeholder="ابحث عن الجلسات حسب اسم الموكل أو رقم الدعوي..." />

        <div id="status-message" class="alert alert-warning d-none"></div>

        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>اسم الموكل</th>
                        <th>رقم الدعوي</th>
                        <th>نوع الدعوي</th>
                        <th>تاريخ الدعوي</th>
                        <th>اسم الخصم</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="ajax-search_result">
                    @forelse ($sessions as $session)
                        <tr>
                            <td>{{ $session->client->name ?? 'غير متوفر' }}</td>
                            <td>{{ $session->session_number }}</td>
                            <td>{{ $session->session_type }}</td>
                            <td>{{ $session->session_date->format('Y-m-d') }}</td>
                            <td>{{ $session->opponent_name }}</td>
                            <td>
                                @if ($session->session_status === 'سارية')
                                    <span class="badge bg-success">{{ $session->session_status }}</span>
                                @elseif ($session->session_status === 'محفوظة')
                                    <span class="badge bg-secondary">{{ $session->session_status }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $session->session_status }}</span>
                                @endif
                            </td>
                            <td>
                                <x-action-buttons :model-id="$session->id" route-prefix="sessions" />
                            </td>
                        </tr>
                    @empty
                        <x-no-data-message :colspan="7" message="لا يوجد جلسات الان" />
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <x-pagination :collection="$sessions" />
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/js/responseHandler.js') }}"></script>
    <script>
        $(document).ready(function() {
            let timer = null;

            $(document).on('input', "#search-session", function() {
                clearTimeout(timer);
                var search = $(this).val();

                timer = setTimeout(function() {
                    jQuery.ajax({
                        url: "{{ route('search.session') }}",
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
