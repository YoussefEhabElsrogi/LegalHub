<style>
    .stat-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card .icon-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70px;
        width: 70px;
        background-color: #f0f4f7;
        border-radius: 50%;
        margin: 0 auto;
    }

    .stat-card .card-body {
        padding: 2rem;
    }

    @media (max-width: 767px) {
        .stat-card {
            margin-bottom: 1.5rem;
        }

        .stat-card .icon-container {
            height: 60px;
            width: 60px;
        }

        .stat-card .card-title {
            font-size: 1.2rem;
        }

        .stat-card .card-text {
            font-size: 2rem;
        }
    }
</style>
<div class="col-md-4 mb-4">
    <div class="card shadow-sm border-0 rounded-3 overflow-hidden stat-card h-100">
        <div class="card-body text-center">
            <div class="icon-container mb-3">
                <i class="{{ $icon }} ti-3x text-primary"></i>
            </div>
            <h5 class="card-title fw-bold">{{ $title }}</h5>
            <h1 class="card-text text-primary fw-bold">{{ $count }}</h1>
            <a href="{{ $route }}" class="btn btn-primary mt-3">عرض كل {{ $title }}</a>
        </div>
    </div>
</div>
