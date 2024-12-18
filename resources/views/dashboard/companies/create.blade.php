@extends('dashboard.master')

@section('title', 'إضافة شركة')

@section('page', 'الشركات/')

@section('page-title', 'إضافة شركة')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <style>
        .form-label {
            font-weight: bold;
        }

        .error-message {
            font-size: 0.875rem;
            color: #dc3545;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .required-star {
            font-size: 1.25rem;
            color: #dc3545;
        }
    </style>
@endpush

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4">
            <h5 class="card-header">إضافة شركة</h5>
            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <x-client-select :clients="$clients" />

                        <div class="col-md-12 mb-3">
                            <label for="company_name" class="form-label">اسم الشركة <span
                                    class="required-star">*</span></label>
                            <input type="text" name="company_name" class="form-control" id="company_name"
                                placeholder="ادخل اسم الشركة" value="{{ old('company_name') }}">
                            @error('company_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="establishment_fees" class="form-label">رسوم التأسيس <span
                                    class="required-star">*</span></label>
                            <input type="text" name="establishment_fees" class="form-control" id="establishment_fees"
                                placeholder="ادخل رسوم التأسيس" value="{{ old('establishment_fees') }}">
                            @error('establishment_fees')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="fees" class="form-label">الأتعاب <span class="required-star">*</span></label>
                            <input type="text" name="fees" class="form-control" id="fees"
                                placeholder="ادخل الأتعاب" value="{{ old('fees') }}" step="0.01">
                            @error('fees')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="advance_amount" class="form-label">المقدم <span
                                    class="required-star">*</span></label>
                            <input type="text" name="advance_amount" class="form-control" id="advance_amount"
                                placeholder="ادخل المقدم" value="{{ old('advance_amount') }}" step="0.01">
                            @error('advance_amount')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="remaining_amount" class="form-label">المؤخر <span
                                    class="required-star">*</span></label>
                            <input type="text" name="remaining_amount" class="form-control" id="remaining_amount"
                                placeholder="ادخل المؤخر" value="{{ old('remaining_amount') }}" step="0.01">
                            @error('remaining_amount')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="notes" class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="ادخل الملاحظات">{{ old('notes') }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="files" class="form-label">الملفات (PDF فقط)</label>
                            <input type="file" name="files[]" class="form-control" id="files"
                                accept="application/pdf" multiple>
                            @error('files.*')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary m-3">إضافة الشركة</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
@endpush
