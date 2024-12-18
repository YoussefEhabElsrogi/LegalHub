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

                    {{-- Client Name --}}
                    <x-client-select :clients="$clients" />

                    <!-- Authorization Number -->
                    <div class="mb-3">
                        <label for="authorization_number" class="form-label">
                            رقم التوكيل <span class="text-danger" style="font-size: 1.2rem;">*</span>
                        </label>
                        <input type="text" name="authorization_number" class="form-control" id="authorization_number"
                            placeholder="ادخل رقم التوكيل" required>
                        @error('authorization_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Notebook Number -->
                    <div class="mb-3">
                        <label for="notebook_number" class="form-label">
                            رقم التوكيل في الدفتر <span class="text-danger" style="font-size: 1.2rem;">*</span>
                        </label>
                        <input type="text" name="notebook_number" class="form-control" id="notebook_number"
                            placeholder="ادخل رقم التوكيل في الدفتر" required>
                        @error('notebook_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="ادخل الملاحظات"></textarea>
                    </div>

                    <!-- File Upload -->
                    <x-upload-file />

                    <!-- Submit Button -->
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
