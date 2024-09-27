@extends('dashboard.master')

@section('title', 'عرض العميل')

@section('page', 'العملاء/')

@section('page-title', 'عرض العميل')

@section('content')
    <div class="card">
        <h5 class="card-header">تفاصيل العميل</h5>
        <div class="card-body">
            <h5 class="card-title">الاسم: {{ $client->name }}</h5>
            <p class="card-text"><strong>رقم الهاتف:</strong> {{ $client->phone }}</p>
            <p class="card-text"><strong>الرقم القومي:</strong> {{ $client->national_id }}</p>

            <!-- التوكيلات -->
            <h6 class="mt-4">التوكيلات:</h6>
            @if ($procuration->isEmpty())
                <p>لا توجد توكيلات مسجلة لهذا العميل.</p>
            @else
                <ul class="list-group">
                    @foreach ($procuration as $index => $item)
                        <li class="list-group-item">
                            <strong>توكيل رقم {{ $procuration->firstItem() + $index }}:</strong><br>
                            <strong>رقم التوكيل:</strong> {{ $item->authorization_number }}<br>
                            <strong>رقم التوكيل في الدفتر:</strong> {{ $item->notebook_number }}<br>
                            <strong>ملاحظات:</strong> {{ $item->notes ?? 'لا توجد ملاحظات' }}<br>

                            <strong>عدد الملفات:</strong> {{ $item->files->count() }}<br>
                            @if ($item->files->isEmpty())
                                <p>لا توجد ملفات لهذا التوكيل.</p>
                            @else
                                <div class="row" style="margin-top: 20px">
                                    @foreach ($item->files as $fileIndex => $file)
                                        <div class="col-md-3 mb-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <a href="{{ asset($file->path) }}" target="_blank">
                                                        <i class="fas fa-file-pdf fa-3x" style="color: red;"></i>
                                                    </a>
                                                    <p class="mt-2">ملف&nbsp;{{ $fileIndex + 1 }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <!-- pagination for procuration -->
                <div class="mt-3">
                    {{ $procuration->appends(['sessions_page' => $sessions->currentPage()])->links() }}
                </div>

                <p class="mt-3"><strong>إجمالي عدد التوكيلات:</strong> {{ $procuration->total() }} توكيلات</p>
            @endif

            <!-- الجلسات -->
            <h6 class="mt-4">الجلسات:</h6>
            @if ($sessions->isEmpty())
                <p>لا توجد جلسات مسجلة لهذا العميل.</p>
            @else
                <ul class="list-group">
                    @foreach ($sessions as $index => $session)
                        <li class="list-group-item">
                            <strong>جلسة رقم {{ $sessions->firstItem() + $index }}:</strong><br>
                            <strong>نوع القضية:</strong> {{ $session->case_type }}<br>
                            <strong>رقم القضية:</strong> {{ $session->case_number }}<br>
                            <strong>اسم الخصم:</strong> {{ $session->opponent_name }}<br>
                            <strong>تاريخ الجلسة:</strong> {{ $session->session_date }}<br>
                            <strong>الحالة:</strong> {{ $session->case_status }}<br>
                            <strong>ملاحظات:</strong> {{ $session->notes ?? 'لا توجد ملاحظات' }}<br>

                            <strong>عدد الملفات:</strong> {{ $session->files->count() }}<br>
                            @if ($session->files->isEmpty())
                                <p>لا توجد ملفات لهذه الجلسة.</p>
                            @else
                                <div class="row" style="margin-top: 20px">
                                    @foreach ($session->files as $fileIndex => $file)
                                        <div class="col-md-3 mb-3">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <a href="{{ asset($file->path) }}" target="_blank">
                                                        <i class="fas fa-file-pdf fa-3x" style="color: red;"></i>
                                                    </a>
                                                    <p class="mt-2">ملف&nbsp;{{ $fileIndex + 1 }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <!-- pagination for sessions -->
                <div class="mt-3">
                    {{ $sessions->appends(['procuration_page' => $procuration->currentPage()])->links() }}
                </div>

                <p class="mt-3"><strong>إجمالي عدد الجلسات:</strong> {{ $sessions->total() }} جلسات</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">تعديل</a>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
            </div>
        </div>
    </div>
@endsection
