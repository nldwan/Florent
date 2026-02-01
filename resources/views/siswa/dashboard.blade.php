@extends('layouts.siswa')

@section('content')
<style>

	body {
		font-family: "Poppins", sans-serif;
		color: #1f2937;
		background-color: #fff;
	}

	h1, h2, h5 {
		margin: 0;
		padding: 0;
	}

	section {
		padding: 80px 0;
	}

	/* HOME */
	.home-section {
		background: url('/images/bg.png') center/cover no-repeat;
		min-height: 100vh;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 50px 20px;
		color: #0f172a;
	}

	.home-content {
		max-width: 600px;
		text-align: center;
	}

	.home-content h1 {
		font-weight: 700;
		font-size: 2.2rem;
		color: #0f172a;
		margin-bottom: 15px;
	}

	.home-content p {
		color: #475569;
		font-size: 1rem;
		line-height: 1.6;
		margin-bottom: 25px;
	}

	/* MATERI */
	.materi-section {
		background-color: #fff;
	}

	.materi-section h2 {
		font-weight: 700;
		color: #1e293b;
		text-align: center;
		margin-bottom: 50px;
	}

	.materi-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
		gap: 30px;
	}

	.materi-card {
		background: #fff;
		border-radius: 12px;
		padding: 30px 20px;
		text-align: center;
		box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
		transition: all 0.3s ease;
	}

	.materi-card:hover {
		box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
	}

	.materi-card h5 {
		font-weight: 600;
		margin-bottom: 10px;
	}

	.materi-card p {
		color: #64748b;
		margin-bottom: 20px;
		font-size: 0.95rem;
	}

	.btn-cyan {
		display: inline-block;
		background-color: #0ea5e9;
		color: #fff;
		border-radius: 8px;
		padding: 8px 20px;
		font-weight: 600;
		text-decoration: none;
	}

	.btn-cyan:hover {
		background-color: #0284c7;
	}

	/* ======== NILAI SECTION ======== */
	.nilai-section {
		background-color: #fff;
	}

	.nilai-section h2 {
		font-weight: 700;
		color: #1e293b;
		text-align: center;
		margin-bottom: 50px;
	}

	.grade-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
		gap: 30px;
	}

	.grade-card {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
		padding: 30px 25px;
	}

	.grade-card:hover {
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
		margin: 15px 0 10px;
		text-transform: uppercase;
		font-size: 0.9rem;
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
		background: #0ea5e9;
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
		margin-top: 30px;
	} 

	/* TABLET */
	@media (min-width: 640px) {
		.home-section {
			justify-content: flex-start;
			padding-left: 8%;
			text-align: left;
		}

		.home-content {
			text-align: left;
		}

		.home-content h1 {
			font-size: 2.6rem;
		}

		.home-content p {
			font-size: 1.1rem;
		}
	}

	/* DESKTOP */
	@media (min-width: 1024px) {
		.home-content h1 {
			font-size: 3rem;
		}

		.home-content p {
			font-size: 1.15rem;
		}
	}
</style>

<!-- HOME -->
<section class="home-section" id="home">
	<div class="home-content">
		<h1>Halo, {{ Auth::user()->name }}</h1>
		<p>Selamat datang di <strong>Florent English Course!</strong><br>Yuk, lanjutkan perjalanan belajarmu</p>
		<button id="pay-button" class="btn btn-cyan">
			Bayar Sekarang
		</button>
	</div>
</section>

<!-- MATERI -->
<section class="materi-section" id="materi">
	<div class="container">
		<h2>Daftar Materi</h2>
		<div class="materi-grid">
			<div class="materi-card">
				<h5>Book</h5>
				<p>Buka ini untuk melihat dan mengunduh bukunya</p>
				<a href="{{ route('siswa.materi') }}" class="btn-cyan">Lihat</a>
			</div>
			<div class="materi-card">
				<h5>Vocabulary</h5>
				<p>Cari kata-kata yang tidak kamu ketahui di sini</p>
				<a href="{{ route('siswa.vocabulary') }}" class="btn-cyan">Lihat</a>
			</div>
			<div class="materi-card">
				<h5>Conversation</h5>
				<p>Buka ini untuk melihat percakapan</p>
				<a href="{{ route('siswa.conversation') }}" class="btn-cyan">Lihat</a>
			</div>
		</div>
	</div>
</section>

<!-- NILAI -->
<section class="nilai-section" id="nilai">
	<div class="container">
		<h2>Nilai</h2>

		@if($grades->isEmpty())
			<p class="empty-text">Belum ada nilai yang tersedia untukmu saat ini.</p>
		@else
			<div class="grade-grid">
				@foreach ($grades as $index => $grade)
					<div class="grade-card">
						<div class="grade-title">
							{{ $grade->course->name ?? '' }}
							{{ $grade->level->name ?? '' }}
							{{ $grade->sublevel->order ?? '' }}
						</div>

						<div class="section-label">Writing</div>
						<div class="grade-list">
							<div class="grade-item">
								<span class="grade-name">Grammar</span>
								<span class="grade-value">{{ $grade->writing_grammar ?? '-' }}</span>
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

						<div class="section-label">READING</div>
						<div class="grade-list">
							<div class="grade-item">
								<span class="grade-name">Reading</span>
								<span class="grade-value">{{ $grade->reading_compre ?? '-' }}</span>
							</div>
							<div class="grade-item">
								<span class="grade-name">Vocabulary</span>
								<span class="grade-value">{{ $grade->reading_vocabulary ?? '-' }}</span>
							</div>
						</div>

						<div class="section-label">Listening</div>
						<div class="grade-list">
							<div class="grade-item">
								<span class="grade-name">Listening</span>
								<span class="grade-value">{{ $grade->listening_compre ?? '-' }}</span>
							</div>
						</div>

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

						@if($grade->notes)
							<div class="notes-box">
								<strong>Catatan Guru:</strong> {{ $grade->notes }}
							</div>
						@endif
					</div>
				@endforeach
			</div>
		@endif
	</div>
</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
document.getElementById('pay-button')?.addEventListener('click', function () {
    fetch("{{ route('siswa.payment.create') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(res => res.json())
    .then(data => {
        snap.pay(data.snap_token, {
            onSuccess: function(result) {
                window.location.href = "{{ route('siswa.dashboard') }}?payment=success";
            },
            onPending: function(result) {
                alert("Menunggu pembayaran...");
            },
            onError: function(result) {
                alert("Pembayaran gagal");
            }
        });
    });
});
</script>

@endsection
