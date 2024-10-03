@extends('dashboard.master')

@section('title', 'تعديل توكيل')

@section('page', 'التوكيلات/')

@section('page-title', 'تعديل توكيل')

@section('content')
    <div class="container mt-4">
        <div class="card mb-4 shadow-sm">
            <h5 class="card-header text-center bg-primary text-white">تعديل التوكيل</h5>
            <form action="{{ route('procurations.update', $procuration->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="mb-3">
                        <label for="client_id" class="form-label">العميل</label>
                        <select name="client_id" class="form-select" id="client_id">
                            <option value="">اختر عميل</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $procuration->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="authorization_number" class="form-label">رقم التوكيل</label>
                        <input type="text" name="authorization_number" class="form-control" id="authorization_number"
                            value="{{ old('authorization_number', $procuration->authorization_number) }}"
                            placeholder="ادخل رقم التوكيل">
                        @error('authorization_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notebook_number" class="form-label">رقم التوكيل في الدفتر</label>
                        <input type="text" name="notebook_number" class="form-control" id="notebook_number"
                            value="{{ old('notebook_number', $procuration->notebook_number) }}"
                            placeholder="ادخل رقم التوكيل في الدفتر">
                        @error('notebook_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="ادخل الملاحظات">{{ old('notes', $procuration->notes) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <x-upload-file></x-upload-file>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('procurations.index') }}" class="btn btn-secondary">رجوع</a>
                        <button type="submit" class="btn btn-primary">تحديث التوكيل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
