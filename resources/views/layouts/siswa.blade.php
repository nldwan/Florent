<!-- resources/views/layouts/siswa.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
	<title>{{ config('app.name', 'Florent') }}</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/layoutsiswa.css') }}">
</head>
<body>
	<!-- NAVBAR SISWA -->
	<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
		<div class="container">
			<!-- Logo -->
			<a class="navbar-brand" href="{{ route('siswa.dashboard') }}">
			<img src="{{ asset('images/logo.png') }}" alt="Logo Florent">
			</a>

			<!-- Toggle Button -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSiswa">
			<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Menu -->
			<div class="collapse navbar-collapse" id="navbarSiswa">
			<ul class="navbar-nav ms-auto align-items-center">
				<li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="#materi">Materi</a></li>
				<li class="nav-item"><a class="nav-link" href="#nilai">Nilai Saya</a></li>
				<li class="nav-item dropdown">
				<!-- <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a> -->
				<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">profil</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li>
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button type="submit" class="dropdown-item text-danger">Logout</button>
					</form>
					</li>
				</ul>
				</li>
			</ul>
			</div>
		</div>
	</nav>

	<!-- KONTEN UTAMA -->
	<main>
		@yield('content')
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
