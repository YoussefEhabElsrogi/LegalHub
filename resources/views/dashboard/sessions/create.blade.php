@extends('dashboard.master')

@section('title', 'إضافة جلسة')

@section('page', 'الجلسات/')

@section('page-title', 'إضافة جلسة')

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4">
            <h5 class="card-header">إضافة جلسة جديدة</h5>
            <form action="{{ route('sessions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- اختيار العميل -->
                <div class="mb-3 p-2">
                    <label for="client_id" class="form-label">العميل</label>
                    <select name="client_id" class="form-select" id="client_id">
                        <option value="">اختر عميل</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- نوع الجلسة -->
                <div class="mb-3 p-2">
                    <label for="session_type" class="form-label">نوع الجلسة</label>
                    <input type="text" name="session_type" class="form-control" id="session_type"
                        placeholder="ادخل نوع الجلسة">
                    @error('session_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- رقم الجلسة -->
                <div class="mb-3 p-2">
                    <label for="session_number" class="form-label">رقم الجلسة</label>
                    <input type="text" name="session_number" class="form-control" id="session_number"
                        placeholder="ادخل رقم الجلسة">
                    @error('session_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- اسم الخصم -->
                <div class="mb-3 p-2">
                    <label for="opponent_name" class="form-label">اسم الخصم</label>
                    <input type="text" name="opponent_name" class="form-control" id="opponent_name"
                        placeholder="ادخل اسم الخصم">
                    @error('opponent_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- تاريخ الجلسة -->
                <div class="mb-3 p-2">
                    <label for="session_date" class="form-label">تاريخ الجلسة</label>
                    <input type="date" name="session_date" class="form-control" id="session_date">
                    @error('session_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- الحالة -->
                <div class="mb-3 p-2">
                    <label for="session_status" class="form-label">الحالة</label>
                    <select name="session_status" class="form-select" id="session_status">
                        <option value="سارية">سارية</option>
                        <option value="محفوظة">محفوظة</option>
                    </select>
                    @error('session_status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ملاحظات -->
                <div class="mb-3 p-2">
                    <label for="notes" class="form-label">ملاحظات</label>
                    <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="ادخل الملاحظات"></textarea>
                </div>

                <!-- الملفات -->
                <div class="mb-3">
                    <label for="files" class="form-label">الملفات (PDF فقط)</label>
                    <input type="file" name="files[]" class="form-control" id="files" accept="application/pdf"
                        multiple>
                    @error('files.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary m-3">إضافة الجلسة</button>
            </form>
        </div>
    </div>
@endsection
