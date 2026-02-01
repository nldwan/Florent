@extends('layouts.admin')

@section('content')
<style>

/* Dashboard */
.page-title {
    font-weight: 600;
    letter-spacing: .3px;
}

.dashboard-card {
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    background-color: #fff;
    transition: 0.2s ease;
}
.dashboard-card:hover {
    box-shadow: 0 6px 14px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

.dashboard-title {
    font-size: 14px;
    color: #6b7280;
}
.dashboard-number {
    font-size: 26px;
    font-weight: 600;
    color: #111827;
}

/* Charts Wrapper */
.charts-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

/* Card chart */
.chart-card {
    flex: 1 1 calc(50% - 20px);
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    padding: 16px;
    height: 360px;
    box-sizing: border-box;
    transition: 0.2s ease;
}

.chart-card:hover {
    box-shadow: 0 6px 14px rgba(0,0,0,0.08);
}

.chart-card h3 {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #111827;
}

.chart-card.full {
    flex: 1 1 100%;
    height: 420px;
}

.chart-card.full canvas {
    height: 340px !important;
}

.chart-card canvas {
    width: 100% !important;
    height: 280px !important;
}

/* 
   Responsive
 */
@media (max-width: 992px) {
    .chart-card {
        flex: 1 1 100%; /* 1 per baris */
    }
}

@media (max-width: 768px) {
    .dashboard-card {
        text-align: center;
    }
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="page-title">Dashboard</h4>
</div>

<!-- 
     Info Cards
 -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Students</div>
            <div class="dashboard-number">{{ $userCount ?? 0 }}</div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Admins</div>
            <div class="dashboard-number">{{ $adminCount ?? 0 }}</div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Materials</div>
            <div class="dashboard-number">{{ $materialCount ?? 0 }}</div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Conversations</div>
            <div class="dashboard-number">{{ $conversationCount ?? 0 }}</div>
        </div>
    </div>
</div>

    <!-- Charts (IN CARD) -->
<div class="charts-wrapper">
    <div class="chart-card full">
        <h3>Laporan Keuangan (Paid)</h3>
        <canvas id="paymentChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Jumlah Pendaftar Siswa</h3>
        <canvas id="studentChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Jumlah Siswa per Course</h3>
        <canvas id="studentsPerCourseChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = {!! json_encode($labels) !!};
const paymentData = {!! json_encode($paymentData) !!};
const studentData = {!! json_encode($studentData) !!};
const courseLabels = {!! json_encode($courseLabels) !!};
const courseData = {!! json_encode($courseData) !!};

new Chart(document.getElementById('studentChart'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Jumlah Siswa',
            data: studentData,
            borderColor: 'rgba(75,192,192,1)',
            backgroundColor: 'rgba(75,192,192,0.25)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: 'rgba(75,192,192,1)',
            pointBorderColor: '#fff',
            pointRadius: 4,
            pointHoverRadius: 6,
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

new Chart(document.getElementById('studentsPerCourseChart'), {
    type: 'bar',
    data: {
        labels: courseLabels,
        datasets: [{
            label: 'Jumlah Siswa',
            data: courseData,
            backgroundColor: 'rgba(75,192,192,0.5)',
            borderColor: 'rgba(75,192,192,1)',
            borderWidth: 1,
            maxBarThickness: 100
        }]
    },
    options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true } } }
});

new Chart(document.getElementById('paymentChart'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label:'Total Payment',
            data:paymentData,
            backgroundColor:'rgba(54,162,235,0.5)',
            borderColor:'rgba(54,162,235,1)',
            borderWidth:1
        }]
    },
    options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true } } }
});

</script>
@endsection
