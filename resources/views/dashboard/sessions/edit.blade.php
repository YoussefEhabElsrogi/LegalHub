@extends('dashboard.master')

@section('title', 'تعديل دعوي')

@section('page', 'الدعاوي/')

@section('page-title', 'تعديل دعوي')

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@section('content')
    <div class="col-xxl-8 col-md-10 mx-auto my-4">
        <div class="card mb-4 shadow-sm">
            <h5 class="card-header text-center bg-primary text-white">تعديل الدعوي</h5>
            <form action="{{ route('sessions.update', $session->id) }}" method="POST" enctype="multipart/form-data"
                class="p-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="client_id" class="form-label">العميل</label>
                    <select name="client_id" class="form-select" id="client_id">
                        <option value="">اختر عميل</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                {{ old('client_id', $session->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="session_type" class="form-label">نوع الدعوي</label>
                    <input type="text" name="session_type" class="form-control" id="session_type"
                        placeholder="ادخل نوع الدعوي" value="{{ old('session_type', $session->session_type) }}">
                    @error('session_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="session_number" class="form-label">رقم الدعوي</label>
                    <input type="text" name="session_number" class="form-control" id="session_number"
                        placeholder="ادخل رقم الدعوي" value="{{ old('session_number', $session->session_number) }}">
                    @error('session_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="opponent_name" class="form-label">اسم الخصم</label>
                    <input type="text" name="opponent_name" class="form-control" id="opponent_name"
                        placeholder="ادخل اسم الخصم" value="{{ old('opponent_name', $session->opponent_name) }}">
                    @error('opponent_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="session_date" class="form-label">تاريخ الدعوي</label>
                    <input type="text" name="session_date" class="form-control datepicker" id="session_date"
                        placeholder="اختر تاريخ الدعوي"
                        value="{{ old('session_date', $session->session_date ? $session->session_date->format('Y-m-d') : '') }}">
                    @error('session_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="reminder_dates" class="form-label">ذكرني في</label>
                    <input type="text" name="reminder_dates[]" class="form-control datepicker" id="reminder_dates"
                        placeholder="اختر تواريخ التذكير" data-toggle="tooltip" data-placement="right"
                        title="اختر تواريخ من التقويم" multiple
                        value="{{ old('reminder_dates') ? implode(',', old('reminder_dates')) : $session->reminders->pluck('reminder_time')->map(fn($date) => \Carbon\Carbon::parse($date)->format('Y-m-d'))->implode(', ') }}">
                    @error('reminder_dates.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="session_status" class="form-label">الحالة</label>
                    <select name="session_status" class="form-select" id="session_status">
                        <option value="سارية"
                            {{ old('session_status', $session->session_status) == 'سارية' ? 'selected' : '' }}>سارية
                        </option>
                        <option value="محفوظة"
                            {{ old('session_status', $session->session_status) == 'محفوظة' ? 'selected' : '' }}>محفوظة
                        </option>
                    </select>
                    @error('session_status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">ملاحظات</label>
                    <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="ادخل الملاحظات">{{ old('notes', $session->notes) }}</textarea>
                </div>

                <x-upload-file></x-upload-file>

                <button type="submit" class="btn btn-primary">تحديث الدعوي</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#session_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                language: 'ar'
            });

            $('#reminder_dates').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                language: 'ar',
                multidate: true
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
