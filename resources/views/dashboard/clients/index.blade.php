@extends('dashboard.master')

@section('title', 'العملاء')

@section('page', 'العملاء/')

@section('page-title', 'جميع العملاء')

@section('content')
    <div class="card shadow-sm mb-4">
        <x-card-header title="جميع العملاء" action-url="{{ route('clients.create') }}" action-text="إضافة عميل" />
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
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td class="d-flex align-items-center justify-content-center">
                                <i class="ti ti-user ti-lg text-info me-2"></i>
                                <span class="fw-bold">{{ $client->name }}</span>
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
