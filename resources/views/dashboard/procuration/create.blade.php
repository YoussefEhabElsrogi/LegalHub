@extends('dashboard.master')

@section('title', 'إضافة توكيل')

@section('page', 'التوكيلات/')

@section('page-title', 'إضافة توكيل')

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4">
            <h5 class="card-header">إضافة توكيل جديد</h5>
            <form action="{{ route('procuration.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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

                <div class="mb-3 p-2">
                    <label for="authorization_number" class="form-label">رقم التوكيل</label>
                    <input type="text" name="authorization_number" class="form-control" id="authorization_number"
                        placeholder="ادخل رقم التوكيل">
                    @error('authorization_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="notebook_number" class="form-label">رقم التوكيل في الدفتر</label>
                    <input type="text" name="notebook_number" class="form-control" id="notebook_number"
                        placeholder="ادخل رقم التوكيل في الدفتر">
                    @error('notebook_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="notes" class="form-label">ملاحظات</label>
                    <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="ادخل الملاحظات"></textarea>
                </div>

                <div class="mb-3">
                    <label for="files" class="form-label">الملفات (PDF فقط)</label>
                    <input type="file" name="files[]" class="form-control" id="files" accept="application/pdf"
                        multiple >
                    @error('files.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary m-3">إضافة التوكيل</button>
            </form>
        </div>
    </div>
@endsection
