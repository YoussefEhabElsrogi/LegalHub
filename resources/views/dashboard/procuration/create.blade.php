@extends('dashboard.master')

@section('title', 'إضافة توكيل')

@section('page', 'التوكيلات/')

@section('page-title', 'إضافة توكيل')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endpush

@section('content')
    <div class="container-fluid mt-3">
        <div class="card mb-4">
            <h5 class="card-header">إضافة توكيل جديد</h5>
            <div class="card-body">
                <form action="{{ route('procurations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="client_id" class="form-label">العميل</label>
                        <select name="client_id" id="select2Basic" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option value="">اختر عميل</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="authorization_number" class="form-label">رقم التوكيل</label>
                        <input type="text" name="authorization_number" class="form-control" id="authorization_number"
                            placeholder="ادخل رقم التوكيل">
                        @error('authorization_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notebook_number" class="form-label">رقم التوكيل في الدفتر</label>
                        <input type="text" name="notebook_number" class="form-control" id="notebook_number"
                            placeholder="ادخل رقم التوكيل في الدفتر">
                        @error('notebook_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="ادخل الملاحظات"></textarea>
                    </div>

                    <x-upload-file></x-upload-file>

                    <button type="submit" class="btn btn-primary mt-3">إضافة التوكيل</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Page JS -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
@endpush
