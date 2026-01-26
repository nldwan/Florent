@extends('layouts.admin')

@section('content')
<style>
/* ======================
   Card Dashboard
====================== */
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

/* ======================
   Charts Responsive
====================== */
.charts-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}
.chart-container {
    flex: 1 1 calc(50% - 20px); /* 2 chart per baris desktop */
    max-width: 520px;
    min-width: 250px;
    height: 300px;
    box-sizing: border-box;
    margin-top: 20px;
}

/* Card wrapper responsive */
.row.g-3 {
    margin-bottom: 20px;
}

/* Small screens: cards & charts */
@media (max-width: 992px) {
    .chart-container {
        flex: 1 1 100%; /* 1 chart per baris */
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
<div class="row g-3">
    <div class="col-6 col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Users</div>
            <div class="dashboard-number">{{ $userCount ?? 0 }}</div>
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
            <div class="dashboard-title">Active Admins</div>
            <div class="dashboard-number">{{ $adminCount ?? 0 }}</div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <div class="card dashboard-card p-3">
            <div class="dashboard-title">Total Courses</div>
            <div class="dashboard-number">{{ $coursesCount ?? 0 }}</div>
        </div>
    </div>
</div>

<!-- ======================
     Charts
====================== -->
<div class="charts-wrapper">
    <div class="chart-container">
        <h3>Laporan Keuangan (Paid)</h3>
        <canvas id="paymentChart"></canvas>
    </div>

    <div class="chart-container">
        <h3>Jumlah Pendaftar Siswa</h3>
        <canvas id="studentChart"></canvas>
    </div>

    <div class="chart-container">
        <h3>Status Pembayaran</h3>
        <canvas id="paymentStatusChart"></canvas>
    </div>

    <div class="chart-container">
        <h3>Jumlah Siswa per Course</h3>
        <canvas id="studentsPerCourseChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = {!! json_encode($labels) !!};
const paymentData = {!! json_encode($paymentData) !!};
const studentData = {!! json_encode($studentData) !!};
const paidCount = {!! json_encode($paidCount) !!};
const pendingCount = {!! json_encode($pendingCount) !!};
const courseLabels = {!! json_encode($courseLabels) !!};
const courseData = {!! json_encode($courseData) !!};

// Payment Paid Chart
new Chart(document.getElementById('paymentChart'), {
    type: 'bar',
    data: { labels, datasets:[{ label:'Total Payment', data:paymentData, backgroundColor:'rgba(54,162,235,0.5)', borderColor:'rgba(54,162,235,1)', borderWidth:1 }] },
    options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true } } }
});

// Siswa Baru Chart
new Chart(document.getElementById('studentChart'), {
    type: 'line',
    data: { labels, datasets:[{ label:'Jumlah Siswa', data:studentData, fill:false, borderColor:'rgba(255,99,132,1)', tension:0.1 }] },
    options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true } } }
});

// Payment Status Pie Chart
new Chart(document.getElementById('paymentStatusChart'), {
    type:'pie',
    data:{
        labels:['Paid','Pending'],
        datasets:[{
            data:[paidCount,pendingCount],
            backgroundColor:['rgba(54,162,235,0.5)','rgba(255,206,86,0.5)'],
            borderColor:['rgba(54,162,235,1)','rgba(255,206,86,1)'],
            borderWidth:1
        }]
    },
    options:{ responsive:true, maintainAspectRatio:false }
});

// Materi per Course Bar Chart
new Chart(document.getElementById('studentsPerCourseChart'), {
    type: 'bar',
    data: {
        labels: courseLabels,
        datasets: [{
            label: 'Jumlah Siswa',
            data: courseData,
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: { responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true } } }
});
</script>
@endsection
