@extends('dashboard.master')

@section('title', 'إضافة مصروفات')

@section('page', 'المصروفات/')

@section('page-title', 'إضافة مصروفات')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor') }}/libs/select2/select2.css" />
    <style>
        .form-label {
            font-weight: bold;
        }

        .select2-container .select2-selection--single {
            height: 40px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004080;
        }

        .required:after {
            content: " ★";
            /* Add the red star */
            color: red;
            /* Set the color of the star */
        }
    </style>
@endpush

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4 shadow-sm">
            <h5 class="card-header">إضافة مصروفات</h5>
            <form action="{{ route('expenses.store') }}" method="POST" class="p-3">
                @csrf

                <x-client-select :clients="$clients" />

                <div class="mb-3">
                    <label for="expense_name" class="form-label required">اسم المصروف</label>
                    <input type="text" name="expense_name" class="form-control" id="expense_name"
                        placeholder="ادخل اسم المصروف" value="{{ old('expense_name') }}">
                    @error('expense_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label required">قيمة المصروف</label>
                    <input type="number" name="amount" class="form-control" id="amount" placeholder="ادخل قيمة المصروف"
                        value="{{ old('amount') }}" step="0.01">
                    @error('amount')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">الملاحظات</label>
                    <textarea name="notes" class="form-control" id="notes" placeholder="ادخل ملاحظات حول المصروف">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">إضافة المصروف</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/vendor') }}/libs/select2/select2.js"></script>
    <script>
        $(document).ready(function() {
            $('#select2Basic').select2({
                placeholder: 'اختر عميل',
                allowClear: true
            });
        });
    </script>
@endpush
