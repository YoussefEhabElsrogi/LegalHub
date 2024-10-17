@extends('dashboard.master')

@section('title', 'الصفحة الرئيسية')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @if (Auth::user()->hasRole('superadmin'))
                <x-stat-card title="عدد المشرفين" count="{{ $numberOfAdmins }}" icon="ti ti-users"
                    cardBorderClass="card-border-shadow-primary" avatarBgClass="bg-label-primary"
                    route="{{ route('admins.index') }}" />
            @endif

            <x-stat-card title="عدد الموكلين" count="{{ $numberOfClients }}" icon="ti ti-user"
                cardBorderClass="card-border-shadow-primary" avatarBgClass="bg-label-primary"
                route="{{ route('clients.index') }}" />

            <x-stat-card title="عدد التوكيلات" count="{{ $numberOfProcurations }}" icon="ti ti-files"
                cardBorderClass="card-border-shadow-warning" avatarBgClass="bg-label-warning"
                route="{{ route('procurations.index') }}" />

            <x-stat-card title="عدد الدعاوي" count="{{ $numberOfSessions }}" icon="ti ti-calendar"
                cardBorderClass="card-border-shadow-danger" avatarBgClass="bg-label-danger"
                route="{{ route('sessions.index') }}" />

            <x-stat-card title="المصروفات الإدارية" count="{{ $totalExpenses }}" icon="ti ti-coins"
                cardBorderClass="card-border-shadow-info" avatarBgClass="bg-label-info"
                route="{{ route('expenses.index') }}" />

            <x-stat-card title="عدد الشركات" count="{{ $numberOfCompanies }}" icon="ti ti-building"
                cardBorderClass="card-border-shadow-success" avatarBgClass="bg-label-success"
                route="{{ route('companies.index') }}" />
        </div>

        <div class="col-12 mt-4">
            <h5>إحصائيات الجلسات الشهرية</h5>
            <div class="w-100" style="height: 350px;">
                <canvas id="sessionsChart" style="width: 100%; height: 100%;"></canvas>
            </div>
            <button id="download" class="btn btn-primary mt-2">تحميل الرسم البياني</button>
        </div>

    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const changesPerMonth = @json($changesPerMonth);
        const currentMonth = @json($currentMonth);
        const monthNames = [
            "يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو",
            "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
        ];

        const ctx = document.getElementById('sessionsChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthNames.slice(0, currentMonth),
                datasets: [{
                    label: 'التغير في عدد الجلسات',
                    data: changesPerMonth,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 255, 0.1)',
                    fill: true,
                    tension: 0.1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y;
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x'
                }
            }
        });

        // Function to download chart as an image
        document.getElementById('download').addEventListener('click', function() {
            const link = document.createElement('a');
            link.href = document.getElementById('sessionsChart').toDataURL(
                'image/png'); // Convert the canvas to image data
            link.download = 'sessions-chart.png'; // File name for the downloaded image
            link.click(); // Trigger the download
        });
    </script>
@endpush
