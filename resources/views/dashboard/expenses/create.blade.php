@extends('dashboard.master')

@section('title', 'إضافة مصروفات')

@section('page', 'المصروفات/')

@section('page-title', 'إضافة مصروفات')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor') }}/libs/select2/select2.css" />
@endpush

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4">
            <h5 class="card-header">إضافة مصروفات</h5>
            <form action="{{ route('expenses.store') }}" method="POST">
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
                    <label for="expense_name" class="form-label">اسم المصروف</label>
                    <input type="text" name="expense_name" class="form-control" id="expense_name"
                        placeholder="ادخل اسم المصروف" value="{{ old('expense_name') }}">
                    @error('expense_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="amount" class="form-label">قيمة المصروف</label>
                    <input type="number" name="amount" class="form-control" id="amount" placeholder="ادخل قيمة المصروف"
                        value="{{ old('amount') }}" step="0.01">
                    @error('amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="notes" class="form-label">الملاحظات</label>
                    <textarea name="notes" class="form-control" id="notes" placeholder="ادخل ملاحظات حول المصروف">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary m-3">إضافة المصروف</button>
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
