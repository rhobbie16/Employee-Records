@extends('layouts.user_template')

@section('content')

<h4 class="mb-4">Dashboard</h4>
<p class="text-muted mb-4">Overview of company statistics and employee metrics.</p>

{{-- STATS CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md">
        <a href="{{ route('employees') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                        <i class="bi bi-people text-primary fs-5"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Employees</div>
                        <div class="fw-bold fs-4">{{ $totalEmployees }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md">
        <a href="{{ route('employees') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-success bg-opacity-10 p-2">
                        <i class="bi bi-person-check text-success fs-5"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Active Employees</div>
                        <div class="fw-bold fs-4">{{ $activeEmployees }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md">
        <a href="{{ route('employees') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-2">
                        <i class="bi bi-person-x text-danger fs-5"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Inactive Employees</div>
                        <div class="fw-bold fs-4">{{ $inactiveEmployees }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md">
        <a href="{{ route('departments') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                        <i class="bi bi-building text-warning fs-5"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Departments</div>
                        <div class="fw-bold fs-4">{{ $totalDepartments }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md">
        <a href="{{ route('user') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-secondary bg-opacity-10 p-2">
                        <i class="bi bi-gear text-secondary fs-5"></i>
                    </div>
                    <div>
                        <div class="text-muted small">System Users</div>
                        <div class="fw-bold fs-4">{{ $systemUsers }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- CHARTS ROW 1 --}}
<div class="row g-3 mb-4">
    <div class="col-12 col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">Employees per Department</h6>
                <canvas id="barChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column align-items-center">
                <h6 class="fw-semibold mb-3 align-self-start">Employee Status</h6>
                <canvas id="donutChart" style="max-width:200px;max-height:200px;"></canvas>
                <div class="d-flex gap-3 mt-3">
                    <span class="d-flex align-items-center gap-1 small">
                        <span style="width:10px;height:10px;border-radius:50%;background:#3b82f6;display:inline-block;"></span> Active
                    </span>
                    <span class="d-flex align-items-center gap-1 small">
                        <span style="width:10px;height:10px;border-radius:50%;background:#ef4444;display:inline-block;"></span> Inactive
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CHART ROW 2 --}}
<div class="row g-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">Monthly Hires (Last 12 Months)</h6>
                <canvas id="lineChart" height="80"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($deptLabels) !!},
            datasets: [{
                data: {!! json_encode($deptCounts) !!},
                backgroundColor: '#3b82f6',
                borderRadius: 4,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Inactive'],
            datasets: [{
                data: [{{ $activeEmployees }}, {{ $inactiveEmployees }}],
                backgroundColor: ['#3b82f6', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 6
            }]
        },
        options: {
            cutout: '68%',
            plugins: { legend: { display: false } }
        }
    });

    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($monthLabels) !!},
            datasets: [{
                data: {!! json_encode($monthlyHires) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.08)',
                pointBackgroundColor: '#3b82f6',
                pointRadius: 4,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 3 }, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>

@endsection