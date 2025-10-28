@extends('layouts.siswa')

@section('content')
	<style>
	body {
		font-family: "Poppins", sans-serif;
		color: #1f2937;
		background-color: #f8fafc;
	}

	/* ========== HOME SECTION ========== */
	.home-section {
		background-image: url('/images/bg.png');
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
		min-height: 100vh;
		display: flex;
		align-items: center;
		justify-content: flex-start;
		text-align: left;
		padding-left: 80px;
		color: #fff;
	}

	.home-content {
		display: flex;
		flex-direction: column;
		gap: 10px;
		max-width: 600px;
	}

	.home-content h1 {
		font-weight: 700;
		font-size: 2.8rem;
		color: #0f172a;
	}

	.home-content p {
		color: #475569;
		font-size: 1.1rem;
		margin-top: 10px;
	}

	.btn-start {
		display: inline-block;
		margin-top: 25px;
		background-color: #2563eb;
		color: #fff;
		padding: 8px 20px;
		border-radius: 8px;
		border: none;
		font-weight: 600;
		font-size: 1rem;
		width: fit-content;
		min-width: 140px;
		text-align: center;
		text-decoration: none;
	}

	.btn-start:hover {
		background-color: #1d4ed8;
	}

	/* ========== MATERI SECTION ========== */
	.materi-section {
		background-color: #fff;
		padding: 100px 0;
	}

	.materi-card {
		border: none;
		border-radius: 12px;
		box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
		transition: all 0.3s ease;
	}

	.materi-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
	}

	.btn-cyan {
		background-color: #0ea5e9;
		color: #fff;
		border-radius: 8px;
		padding: 8px 20px;
		text-decoration: none;
		font-weight: 600;
		transition: 0.3s;
	}

	.btn-cyan:hover {
		background-color: #0284c7;
		color: #fff;
	}

	/* ========== NILAI SECTION ========== */
	.nilai-section {
		background-color: #fff;
		padding: 100px 0;
	}

	table {
		border-radius: 10px;
		overflow: hidden;
	}

	th {
		background-color: #2563eb;
		color: white;
	}

	tr:nth-child(even) {
		background-color: #f1f5f9;
	}

	tr:hover {
		background-color: #e2e8f0;
	}
	</style>

	<section class="home-section" id="home">
		<div class="home-content">
			<h1>Halo, {{ Auth::user()->name }}</h1>
			<p>Selamat datang di <strong>Florent English Course!</strong><br>Yuk, lanjutkan perjalanan belajarmu</p>
			<a href="#materi" class="btn-start">Mulai Belajar</a>
		</div>
	</section>

	<!-- ========== MATERI SECTION ========== -->
	<section class="materi-section" id="materi">
		<div class="container">
			<h2 class="text-center fw-bold mb-5">Daftar Materi</h2>
			<div class="row g-4">
				<div class="col-md-6">
					<div class="materi-card p-4 text-center">
						<h5 class="fw-bold mb-2 text-dark">Book</h5>
						<p class="text-muted mb-4">Buka ini untuk melihat dan mengunduh bukunya</p>
						<a href="{{ route('siswa.materi') }}" class="btn-cyan">Lihat</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="materi-card p-4 text-center">
						<h5 class="fw-bold mb-2 text-dark">Vocabulary</h5>
						<p class="text-muted mb-4">Cari kata-kata yang tidak kamu ketahui di sini</p>
						<a href="{{ route('siswa.vocabulary') }}" class="btn-cyan">Lihat</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ========== NILAI SECTION ========== -->
	<section class="nilai-section" id="nilai">
		<div class="container">
			<h2 class="text-center fw-bold mb-5">Nilai Kamu</h2>
			<div class="table-responsive">
				<table class="table table-bordered text-center align-middle shadow-sm">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Materi</th>
							<th>Nilai</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Vocabulary - Daily Activities</td>
							<td>85</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Grammar - Present Tense</td>
							<td>90</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Reading - Short Stories</td>
							<td>88</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
@endsection