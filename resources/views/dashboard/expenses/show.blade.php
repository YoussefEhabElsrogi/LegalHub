@extends('dashboard.master')

@section('title', 'عرض المصروفات')

@section('page', 'المصروفات/')

@section('page-title', 'عرض المصروفات')

@push('css')
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

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .card-text {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* تحسين تصميم الحقول */
        .info-block {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .info-label {
            font-weight: bold;
            color: #333;
        }

        .info-value {
            color: #555;
        }

        /* تحسينات للعرض على الشاشات الصغيرة */
        @media (max-width: 768px) {
            .info-block {
                display: block;
            }

            .info-label {
                font-size: 1rem;
            }

            .info-value {
                font-size: 1rem;
                margin-top: 0.5rem;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg mt-4">
                    <h5 class="card-header">تفاصيل المصروفات</h5>
                    <div class="card-body">
                        <div class="info-block mt-3">
                            <span class="info-label">اسم المصروف:</span>
                            <span class="info-value">{{ $expense->expense_name }}</span>
                        </div>

                        <div class="info-block">
                            <span class="info-label">اسم العميل:</span>
                            <span class="info-value">{{ $expense->client->name ?? 'غير متوفر' }}</span>
                        </div>

                        <div class="info-block">
                            <span class="info-label">رقم هاتف العميل:</span>
                            <span class="info-value">{{ $expense->client->phone ?? 'غير متوفر' }}</span>
                        </div>

                        <div class="info-block">
                            <span class="info-label">قيمة المصروف:</span>
                            <span class="info-value">{{ number_format($expense->amount, 2) }} جنيهاً</span>
                        </div>

                        <div class="info-block">
                            <span class="info-label">الملاحظات:</span>
                            <span class="info-value">{{ $expense->notes ?? 'غير متوفر ملاحظات' }}</span>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-primary mx-2">تعديل</a>
                            <a href="{{ route('expenses.index') }}" class="btn btn-secondary mx-2">العودة إلى القائمة</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
