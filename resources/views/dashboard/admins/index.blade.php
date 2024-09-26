@extends('dashboard.master')

@section('title', 'المشرفين')

@section('page', 'المشرفين')

@section('page-title', 'جميع المشرفين')

@section('content')
    <div class="card">
        <h5 class="card-header">جميع المشرفين</h5>
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
                    @forelse($admins as $admin)
                        <tr>
                            <td>
                                <i class="ti ti-user ti-lg text-info me-3"></i>
                                <span class="fw-medium">{{ $admin->name }}</span>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td><span class="badge bg-label-success me-1">{{ ucfirst($admin->role) }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.show', $admin->id) }}">
                                            <i class="ti ti-eye me-1"></i> عرض
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.edit', $admin->id) }}">
                                            <i class="ti ti-pencil me-1"></i> تعديل
                                        </a>
                                        <form action="{{ route('admin.destroy', $admin->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا المشرف؟');">
                                                <i class="ti ti-trash me-1"></i> حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-danger">لا يوجد مشرفون مسجلون حتي الأن.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $admins->links() }}
        </div>
    </div>
@endsection
