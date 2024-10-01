@extends('dashboard.master')

@section('title', 'المشرفين')

@section('page', 'المشرفين/')

@section('page-title', 'جميع المشرفين')

@section('content')
    <div class="card">
        <x-card-header title="جميع المشرفين" action-url="{{ route('admins.create') }}" action-text="إضافة مشرف" />

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
                <tbody class="table-border-bottom-0">
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
