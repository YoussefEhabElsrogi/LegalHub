@extends('dashboard.master')

@section('title', 'العملاء')

@section('page', 'العملاء/')

@section('page-title', 'جميع العملاء')

@section('content')
    <div class="card shadow-sm mb-4">
        <x-card-header title="جميع العملاء" action-url="{{ route('clients.create') }}" action-text="إضافة عميل" />

        <x-search-input id="search-client" placeholder="ابحث عن العملاء حسب الاسم أو رقم الهاتف أو الرقم القومي..." />

        <div id="status-message" class="alert alert-warning d-none"></div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">الاسم</th>
                        <th scope="col">رقم الهاتف</th>
                        <th scope="col">الرقم القومي</th>
                        <th scope="col">الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="ajax-search_result">
                    @forelse($clients as $client)
                        <tr>
                            <td>
                                <div class="grid-container">
                                    <div class="icon-container">
                                        <i class="ti ti-user ti-lg text-info"></i>
                                    </div>
                                    <span class="fw-bold">{{ $client->name }}</span>
                                </div>
                            </td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->national_id }}</td>
                            <td>
                                <x-action-buttons :model-id="$client->id" route-prefix="clients" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <x-no-data-message :colspan="4" message="لا يوجد عملاء الان" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white d-flex justify-content-center">
            <x-pagination :collection="$clients" />
        </div>
    </div>
@endsection

@push('css')
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: auto 1fr;
            align-items: center;
            gap: 10px;
        }

        .icon-container {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-container i {
            font-size: 24px;
        }

        td {
            text-align: center;
        }

        .fw-bold {
            white-space: nowrap;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('assets/js/responseHandler.js') }}"></script>
    <script>
        $(document).ready(function() {
            let timer = null;

            $(document).on('input', "#search-client", function() {
                clearTimeout(timer);
                var search = $(this).val();

                timer = setTimeout(function() {
                    jQuery.ajax({
                        url: "{{ route('search.client') }}",
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
