@extends('dashboard.master')

@section('title', 'عرض العميل')

@section('page', 'العملاء/')

@section('page-title', 'عرض العميل')

@section('content')
    <div class="card shadow-sm mb-4">
        <h5 class="card-header bg-primary text-white">تفاصيل العميل</h5>
        <div class="card-body">
            <!-- Client details -->
            <h5 class="card-title mt-3"><strong>الاسم:</strong> {{ $client->name }}</h5>
            <p class="card-text"><strong>رقم الهاتف:</strong> {{ $client->phone }}</p>
            <p class="card-text"><strong>الرقم القومي:</strong> {{ $client->national_id }}</p>

            <!-- توكيلات -->
            <h6 class="mt-4"><strong>التوكيلات:</strong></h6>
            @if ($procurations->isEmpty())
                <div class="alert alert-warning">لا توجد توكيلات مسجلة لهذا العميل.</div>
            @else
                <ul class="list-group">
                    @foreach ($procurations as $index => $item)
                        <li class="list-group-item">
                            <strong>توكيل رقم {{ $procurations->firstItem() + $index }}:</strong><br>
                            <strong>رقم التوكيل:</strong> {{ $item->authorization_number }}<br>
                            <strong>رقم التوكيل في الدفتر:</strong> {{ $item->notebook_number }}<br>
                            <strong>ملاحظات:</strong> {{ $item->notes ?? 'لا توجد ملاحظات' }}<br>
                            <strong>عدد الملفات:</strong> {{ $item->files->count() }}
                            @if ($item->files->isEmpty())
                                <div class="alert alert-info mt-2">لا توجد ملفات لهذا التوكيل.</div>
                            @else
                                <div class="row mt-3">
                                    @foreach ($item->files as $file)
                                        <div class="col-md-3 mb-3">
                                            <div class="card h-100 text-center shadow-sm">
                                                <div class="card-body">
                                                    <a href="{{ asset($file->path) }}" target="_blank">
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                    </a>
                                                    @php
                                                        $fileName = pathinfo($file->path, PATHINFO_FILENAME);
                                                        $shortName = Str::limit($fileName, 10);
                                                    @endphp
                                                    <p class="mt-2">{{ $shortName }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $procurations->appends(['sessions_page' => $sessions->currentPage()])->links() }}
                </div>

                <p class="mt-3"><strong>إجمالي عدد التوكيلات:</strong> {{ $procurations->total() }} توكيلات</p>
            @endif

            <!-- الدعاوي -->
            <h6 class="mt-4"><strong>الدعاوي:</strong></h6>
            @if ($sessions->isEmpty())
                <div class="alert alert-warning">لا توجد جلسات مسجلة لهذا العميل.</div>
            @else
                <ul class="list-group">
                    @foreach ($sessions as $index => $session)
                        <li class="list-group-item">
                            <strong>دعوي رقم {{ $sessions->firstItem() + $index }}:</strong><br>
                            <strong>نوع القضية:</strong> {{ $session->session_type }}<br>
                            <strong>رقم القضية:</strong> {{ $session->session_number }}<br>
                            <strong>اسم الخصم:</strong> {{ $session->opponent_name }}<br>
                            <strong>تاريخ الدعوي:</strong>
                            {{ \Carbon\Carbon::parse($session->session_date)->format('Y-m-d') }}<br>
                            <strong>الحالة:</strong> {{ $session->session_status }}<br>
                            <strong>ملاحظات:</strong> {{ $session->notes ?? 'لا توجد ملاحظات' }}<br>
                            <strong>عدد الملفات:</strong> {{ $session->files->count() }}
                            @if ($session->files->isEmpty())
                                <div class="alert alert-info mt-2">لا توجد ملفات لهذه الدعوي.</div>
                            @else
                                <div class="row mt-3">
                                    @foreach ($session->files as $file)
                                        <div class="col-md-3 mb-3">
                                            <div class="card h-100 text-center shadow-sm">
                                                <div class="card-body">
                                                    <a href="{{ asset($file->path) }}" target="_blank">
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                    </a>
                                                    @php
                                                        $fileName = pathinfo($file->path, PATHINFO_FILENAME);
                                                        $shortName = Str::limit($fileName, 10);
                                                    @endphp
                                                    <p class="mt-2">{{ $shortName }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $sessions->appends(['procuration_page' => $procurations->currentPage()])->links() }}
                </div>

                <p class="mt-3"><strong>إجمالي عدد الدعاوي:</strong> {{ $sessions->total() }} جلسات</p>
            @endif

            <!-- المصروفات -->
            <h6 class="mt-4"><strong>المصروفات:</strong></h6>
            @if ($expenses->isEmpty())
                <div class="alert alert-warning">لا توجد مصروفات مسجلة لهذا العميل.</div>
            @else
                <ul class="list-group">
                    @foreach ($expenses as $expense)
                        <li class="list-group-item">
                            <strong>اسم المصروف:</strong> {{ $expense->expense_name }}<br>
                            <strong>قيمة المصروف:</strong> {{ $expense->amount }}<br>
                            <strong>ملاحظات:</strong> {{ $expense->notes ?? 'لا توجد ملاحظات' }}<br>
                        </li>
                    @endforeach
                </ul>
            @endif

            <!-- الشركات -->
            <h6 class="mt-4"><strong>الشركات:</strong></h6>
            @if ($companies->isEmpty())
                <div class="alert alert-warning">لا توجد شركات مسجلة لهذا العميل.</div>
            @else
                <ul class="list-group">
                    @foreach ($companies as $company)
                        <li class="list-group-item">
                            <strong>رسوم التأسيس:</strong> {{ $company->establishment_fees }}<br>
                            <strong>الأتعاب:</strong> {{ $company->fees }}<br>
                            <strong>المبلغ المتبقي:</strong> {{ $company->remaining_amount }}<br>
                            <strong>المبلغ المدفوع مسبقاً:</strong> {{ $company->advance_amount }}<br>
                            <strong>ملاحظات:</strong> {{ $company->notes ?? 'لا توجد ملاحظات' }}<br>
                            <!-- Displaying associated files if they exist -->
                            @if ($company->files->isNotEmpty())
                                <strong>الملفات:</strong>
                                <div class="row mt-2">
                                    @foreach ($company->files as $file)
                                        <div class="col-md-3 mb-3">
                                            <div class="card h-100 text-center shadow-sm">
                                                <div class="card-body">
                                                    <a href="{{ asset($file->path) }}" target="_blank">
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                    </a>
                                                    @php
                                                        $fileName = pathinfo($file->path, PATHINFO_FILENAME);
                                                        $shortName = Str::limit($fileName, 10);
                                                    @endphp
                                                    <p class="mt-2">{{ $shortName }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info mt-2">لا توجد ملفات لهذه الشركة.</div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $companies->links() }}
                </div>

                <p class="mt-3"><strong>إجمالي عدد الشركات:</strong> {{ $companies->total() }} شركة</p>
            @endif
        </div>
    </div>
@endsection
