@extends('dashboard.master')

@section('title', 'تعديل المصروفات')

@section('page', 'تعديل المصروفات')

@section('page-title', 'تعديل مصروف')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <style>
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="card shadow-lg">
        <h5 class="card-header">تعديل مصروف</h5>
        <div class="card-body">
            <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3 mt-3">
                    <label for="client_id" class="form-label">اسم الموكل</label>
                    <select name="client_id" id="select2Basic" class="select2 form-select form-select-lg">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ $expense->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="expense_name" class="form-label">اسم المصروف</label>
                    <input type="text" class="form-control" id="expense_name" name="expense_name"
                        value="{{ old('expense_name', $expense->expense_name) }}">
                    @error('expense_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">قيمة المصروف</label>
                    <input type="number" class="form-control" id="amount" name="amount"
                        value="{{ old('amount', $expense->amount) }}">
                    @error('amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">ملاحظات</label>
                    <textarea class="form-control" id="notes" name="notes">{{ old('notes', $expense->notes) }}</textarea>
                    @error('notes')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">تحديث</button>
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
