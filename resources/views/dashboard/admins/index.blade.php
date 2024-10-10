@extends('dashboard.master')

@section('title', 'المشرفين')

@section('page', 'المشرفين/')

@section('page-title', 'جميع المشرفين')

@section('content')
    <div class="card">
        <x-card-header title="جميع المشرفين" action-url="{{ route('admins.create') }}" action-text="إضافة مشرف" />

        <x-search-input id="search-admin" placeholder="ابحث عن المشرفين حسب الاسم أو البريد الإلكتروني..." />

        <div id="status-message" class="alert alert-warning d-none"></div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">الاسم</th>
                        <th scope="col">البريد الإلكتروني</th>
                        <th scope="col">رقم الهاتف</th>
                        <th scope="col">الدور</th>
                        <th scope="col">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="ajax-search_result">
                    @forelse($regularAdmins as $admin)
                        <tr>
                            <td>
                                <i class="ti ti-user ti-lg text-info me-3"></i>
                                <span class="fw-medium">{{ $admin->name }}</span>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td><span class="badge bg-label-success me-1">{{ ucfirst($admin->role ?? 'غير محدد') }}</span>
                            </td>
                            <td>
                                <x-action-buttons :model-id="$admin->id" route-prefix="admins" />
                            </td>
                        </tr>
                    @empty
                        <x-no-data-message :colspan="5" message="لا يوجد مشرفون الان" />
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-pagination :collection="$regularAdmins" />
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/responseHandler.js') }}"></script>
    <script>
        $(document).ready(function() {
            let timer = null;

            $(document).on('input', "#search-admin", function() {
                clearTimeout(timer);
                var search = $(this).val();

                timer = setTimeout(function() {
                    jQuery.ajax({
                        url: "{{ route('search.admin') }}",
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
