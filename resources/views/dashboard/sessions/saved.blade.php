@extends('dashboard.master')

@section('title', 'عرض الدعاوي المحفوظة')

@section('page', 'الدعاوي المحفوظة/')

@section('page-title', 'عرض الدعاوي المحفوظة')

@push('css')
    <style>
        .session-date {
            font-weight: bold;
            font-size: 1.1rem;
            color: #333;
        }

        .session-date.expired {
            color: #dc3545;
        }

        .status-badge {
            font-size: 0.9rem;
            padding: 0.2rem 0.5rem;
            border-radius: 0.25rem;
        }
    </style>
@endpush

@section('content')
    <div class="card shadow-sm">
        <h5 class="card-header">الدعاوي المحفوظة</h5>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>الموكل</th>
                        <th>رقم الدعوي</th>
                        <th>نوع الدعوي</th>
                        <th>تاريخ الدعوي</th>
                        <th>اسم الخصم</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($savedSessions as $session)
                        <tr>
                            <td>{{ $session->client->name ?? 'غير متوفر' }}</td>
                            <td>{{ $session->session_number }}</td>
                            <td>{{ $session->session_type }}</td>
                            <td>
                                @php
                                    $sessionDate = \Carbon\Carbon::parse($session->session_date);
                                @endphp
                                <span class="session-date {{ $sessionDate->isPast() ? 'expired' : '' }}">
                                    {{ $sessionDate->translatedFormat('d F Y') }}
                                </span>
                                @if ($sessionDate->isPast())
                                    <span class="badge bg-danger status-badge">انتهت</span>
                                @endif
                            </td>
                            <td>{{ $session->opponent_name }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $session->session_status }}</span>
                            </td>
                            <td>
                                <form action="{{ route('sessions.destroy', $session->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذه الدعوي؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <x-no-data-message colspan="7" message="لا يوجد جلسات محفوظة الآن" />
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <x-pagination :collection="$savedSessions" />
        </div>
    </div>
@endsection

@push('js')
@endpush
