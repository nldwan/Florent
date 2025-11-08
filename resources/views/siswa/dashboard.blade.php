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
				<div class="col-md-4">
					<div class="materi-card p-4 text-center">
						<h5 class="fw-bold mb-2 text-dark">Book</h5>
						<p class="text-muted mb-4">Buka ini untuk melihat dan mengunduh bukunya</p>
						<a href="{{ route('siswa.materi') }}" class="btn-cyan">Lihat</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="materi-card p-4 text-center">
						<h5 class="fw-bold mb-2 text-dark">Vocabulary</h5>
						<p class="text-muted mb-4">Cari kata-kata yang tidak kamu ketahui di sini</p>
						<a href="{{ route('siswa.vocabulary') }}" class="btn-cyan">Lihat</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="materi-card p-4 text-center">
						<h5 class="fw-bold mb-2 text-dark">Conversation</h5>
						<p class="text-muted mb-4">Buka ini untuk melihat percakapan</p>
						<a href="{{ route('siswa.conversation') }}" class="btn-cyan">Lihat</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ========== NILAI SECTION (DESAIN BARU) ========== -->
	<section class="nilai-section" id="nilai">
		<style>
			.nilai-section {
				background-color: #f8fafc;
				padding: 100px 0;
				font-family: 'Poppins', sans-serif;
			}

			.nilai-section h2 {
				font-weight: 700;
				color: #1e293b;
			}

			.grade-grid {
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
				gap: 30px;
				margin-top: 50px;
			}

			.grade-card {
				background: #fff;
				border-radius: 16px;
				box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
				padding: 30px;
				transition: all 0.3s ease;
				position: relative;
				overflow: hidden;
			}

			.grade-card:hover {
				transform: translateY(-5px);
				box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
			}

			.grade-title {
				font-size: 1.3rem;
				font-weight: 600;
				color: #2563eb;
				margin-bottom: 20px;
			}

			.section-label {
				font-weight: 600;
				color: #475569;
				margin-bottom: 10px;
				text-transform: uppercase;
				letter-spacing: 0.5px;
			}

			.grade-list {
				display: flex;
				flex-direction: column;
				gap: 8px;
			}

			.grade-item {
				display: flex;
				justify-content: space-between;
				align-items: center;
				background: #f1f5f9;
				border-radius: 8px;
				padding: 8px 12px;
			}

			.grade-name {
				font-weight: 500;
				color: #1e293b;
			}

			.grade-value {
				background: #2563eb;
				color: #fff;
				font-weight: 600;
				border-radius: 6px;
				padding: 3px 10px;
				min-width: 40px;
				text-align: center;
			}

			.notes-box {
				background: #e0f2fe;
				border-left: 4px solid #0284c7;
				padding: 12px 16px;
				border-radius: 8px;
				margin-top: 20px;
				font-size: 0.95rem;
				color: #0369a1;
			}

			.empty-text {
				text-align: center;
				color: #94a3b8;
				font-size: 1rem;
				margin-top: 50px;
			}
		</style>

		<div class="container">
			<h2 class="text-center mb-5">Nilai</h2>

			@if($grades->isEmpty())
				<p class="empty-text">Belum ada nilai yang tersedia untukmu saat ini.</p>
			@else
				<div class="grade-grid">
					@foreach ($grades as $index => $grade)
						<div class="grade-card">
							<div class="grade-title">Penilaian #{{ $index + 1 }}</div>

							<!-- Speaking Section -->
							<div class="section-label">Speaking</div>
							<div class="grade-list">
								<div class="grade-item">
									<span class="grade-name">Pronouncing</span>
									<span class="grade-value">{{ $grade->speaking_pronouncing ?? '-' }}</span>
								</div>
								<div class="grade-item">
									<span class="grade-name">Intonation</span>
									<span class="grade-value">{{ $grade->speaking_intonation ?? '-' }}</span>
								</div>
								<div class="grade-item">
									<span class="grade-name">Fluency</span>
									<span class="grade-value">{{ $grade->speaking_fluency ?? '-' }}</span>
								</div>
							</div>

							<!-- Writing Section -->
							<div class="section-label mt-4">Writing</div>
							<div class="grade-list">
								<div class="grade-item">
									<span class="grade-name">Grammar</span>
									<span class="grade-value">{{ $grade->writing_grammar ?? '-' }}</span>
								</div>
								<div class="grade-item">
									<span class="grade-name">Reading</span>
									<span class="grade-value">{{ $grade->writing_reading ?? '-' }}</span>
								</div>
								<div class="grade-item">
									<span class="grade-name">Listening</span>
									<span class="grade-value">{{ $grade->writing_listening ?? '-' }}</span>
								</div>
								<div class="grade-item">
									<span class="grade-name">Vocabulary</span>
									<span class="grade-value">{{ $grade->writing_vocabulary ?? '-' }}</span>
								</div>
								<div class="grade-item">
									<span class="grade-name">Translation</span>
									<span class="grade-value">{{ $grade->writing_translation ?? '-' }}</span>
								</div>
								<div class="grade-item">
									<span class="grade-name">Composition</span>
									<span class="grade-value">{{ $grade->writing_composition ?? '-' }}</span>
								</div>
							</div>

							@if($grade->notes)
								<div class="notes-box mt-3">
									<strong>Catatan Guru:</strong> {{ $grade->notes }}
								</div>
							@endif
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</section>

	<!-- ========== NILAI SECTION ========== -->
	<!-- <section class="nilai-section" id="nilai">
		<div class="container">
			<h2 class="text-center fw-bold mb-5">Nilai Kamu</h2>

			@if($grades->isEmpty())
				<p class="text-center text-muted">Belum ada nilai yang tersedia.</p>
			@else
				@foreach ($grades as $index => $grade)
					<div class="card shadow-sm mb-5">
						<div class="card-body">
							<h5 class="fw-bold mb-3 text-primary">
								Nilai #{{ $index + 1 }}
							</h5>

							<div class="table-responsive mb-3">
								<table class="table table-bordered align-middle text-center">
									<thead class="table-primary">
										<tr>
											<th colspan="3">Speaking</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Pronouncing</td>
											<td>Intonation</td>
											<td>Fluency</td>
										</tr>
										<tr>
											<td>{{ $grade->speaking_pronouncing ?? '-' }}</td>
											<td>{{ $grade->speaking_intonation ?? '-' }}</td>
											<td>{{ $grade->speaking_fluency ?? '-' }}</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="table-responsive mb-3">
								<table class="table table-bordered align-middle text-center">
									<thead class="table-success">
										<tr>
											<th colspan="6">Writing</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Grammar</td>
											<td>Reading</td>
											<td>Listening</td>
											<td>Vocabulary</td>
											<td>Translation</td>
											<td>Composition</td>
										</tr>
										<tr>
											<td>{{ $grade->writing_grammar ?? '-' }}</td>
											<td>{{ $grade->writing_reading ?? '-' }}</td>
											<td>{{ $grade->writing_listening ?? '-' }}</td>
											<td>{{ $grade->writing_vocabulary ?? '-' }}</td>
											<td>{{ $grade->writing_translation ?? '-' }}</td>
											<td>{{ $grade->writing_composition ?? '-' }}</td>
										</tr>
									</tbody>
								</table>
							</div>

							@if($grade->notes)
								<div class="alert alert-info mt-3">
									<strong>Catatan Guru:</strong> {{ $grade->notes }}
								</div>
							@endif
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</section> -->
@endsection