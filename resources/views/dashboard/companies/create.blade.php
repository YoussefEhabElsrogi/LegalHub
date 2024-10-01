@extends('dashboard.master')

@section('title', 'إضافة شركة')

@section('page', 'الشركات/')

@section('page-title', 'إضافة شركة')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor') }}/libs/select2/select2.css" />
@endpush

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4">
            <h5 class="card-header">إضافة شركة</h5>
            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 p-2">
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

                <div class="mb-3 p-2">
                    <label for="establishment_fees" class="form-label">رسوم التأسيس</label>
                    <input type="number" name="establishment_fees" class="form-control" id="establishment_fees"
                        placeholder="ادخل رسوم التأسيس" value="{{ old('establishment_fees') }}">
                    @error('establishment_fees')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="fees" class="form-label">الأتعاب</label>
                    <input type="number" name="fees" class="form-control" id="fees" placeholder="ادخل الأتعاب"
                        value="{{ old('fees') }}">
                    @error('fees')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="advance_amount" class="form-label">المقدم</label>
                    <input type="number" name="advance_amount" class="form-control" id="advance_amount"
                        placeholder="ادخل المقدم" value="{{ old('advance_amount') }}">
                    @error('advance_amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="remaining_amount" class="form-label">المؤخر</label>
                    <input type="number" name="remaining_amount" class="form-control" id="remaining_amount"
                        placeholder="ادخل المؤخر" value="{{ old('remaining_amount') }}">
                    @error('remaining_amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="notes" class="form-label">ملاحظات</label>
                    <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="ادخل الملاحظات">{{ old('notes') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="files" class="form-label">الملفات (PDF فقط)</label>
                    <input type="file" name="files[]" class="form-control" id="files" accept="application/pdf"
                        multiple>
                    @error('files.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary m-3">إضافة الشركة</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <!-- Page JS -->
    <script src="{{ asset('assets/vendor') }}/libs/select2/select2.js"></script>
    <script src="{{ asset('assets/js') }}/forms-selects.js"></script>
    <script src="{{ asset('assets/js') }}/forms-tagify.js"></script>
    <script src="{{ asset('assets/js') }}/forms-typeahead.js"></script>
@endpush
