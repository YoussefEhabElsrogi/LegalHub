@extends('dashboard.master')

@section('title', 'تعديل الشركة')

@section('page', 'الشركات/')

@section('page-title', 'تعديل الشركة')

@push('css')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card">
            <h5 class="card-header text-center">تعديل بيانات الشركة</h5>
            <div class="card-body">
                <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="client_id" class="form-label">اسم الموكل</label>
                        <select class="form-control" id="client_id" name="client_id">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $company->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="establishment_fees" class="form-label">رسوم التأسيس</label>
                        <input type="number" step="0.01" class="form-control" id="establishment_fees"
                            name="establishment_fees" value="{{ old('establishment_fees', $company->establishment_fees) }}">
                        @error('establishment_fees')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fees" class="form-label">الأتعاب</label>
                        <input type="number" step="0.01" class="form-control" id="fees" name="fees"
                            value="{{ old('fees', $company->fees) }}">
                        @error('fees')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="advance_amount" class="form-label">المقدم</label>
                        <input type="number" step="0.01" class="form-control" id="advance_amount" name="advance_amount"
                            value="{{ old('advance_amount', $company->advance_amount) }}">
                        @error('advance_amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="remaining_amount" class="form-label">المؤخر</label>
                        <input type="number" step="0.01" class="form-control" id="remaining_amount"
                            name="remaining_amount" value="{{ old('remaining_amount', $company->remaining_amount) }}">
                        @error('remaining_amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea class="form-control" id="notes" name="notes">{{ old('notes', $company->notes) }}</textarea>
                        @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-upload-file />

                    <button type="submit" class="btn btn-primary btn-block">تحديث</button>
                </form>
            </div>
        </div>
    </div>
@endsection
