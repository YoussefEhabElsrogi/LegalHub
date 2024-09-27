@extends('dashboard.master')

@section('title', 'العملاء')

@section('page', 'العملاء/')

@section('page-title', 'جميع العملاء')

@section('content')
    <div class="card">
        <h5 class="card-header">
            جميع العملاء
            <a href="{{ route('clients.create') }}" class="btn btn-primary float-end">إضافة عميل</a>
        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">الاسم</th>
                        <th scope="col">رقم الهاتف</th>
                        <th scope="col">الرقم القومي</th>
                        <th scope="col">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($clients as $client)
                        <tr>
                            <td>
                                <i class="ti ti-user ti-lg text-info me-3"></i>
                                <span class="fw-medium">{{ $client->name }}</span>
                            </td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->national_id }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('clients.show', $client->id) }}">
                                            <i class="ti ti-eye me-1"></i> عرض
                                        </a>
                                        <a class="dropdown-item" href="{{ route('clients.edit', $client->id) }}">
                                            <i class="ti ti-pencil me-1"></i> تعديل
                                        </a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا العميل؟');">
                                                <i class="ti ti-trash me-1"></i> حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">لا يوجد عملاء مسجلون حتي الأن.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $clients->links() }}
        </div>
    </div>
@endsection
