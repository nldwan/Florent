<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Florent</title>
  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-light fixed-top navbar-custom">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="50" class="me-2">
      </a>

      <!-- Mobile Menu Button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item ms-2">
            <a href="{{ route('login') }}" class="btn btn-cyan px-3 py-2">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Floating WhatsApp -->
  <a href="https://wa.me/628179369954?text=Halo%20Florent,%20saya%20mau%20tanya%20tentang%20kursusnya" target="_blank" class="whatsapp-float">
    <i class="fab fa-whatsapp fs-2 text-white"></i>
  </a>

  <!-- Hero Section -->
  <section id="home" class="hero-section">
    <div class="container">
      <div class="row align-items-center g-4">
        <!-- Text Content -->
        <div class="col-md-6">
          <h1 class="display-4 fw-bold fs-1 text-dark lh-sm">
            Belajar Bahasa Inggris <br class="d-none d-sm-block"> Seru dan Menyenangkan!
          </h1>
          <p class="lead text-dark mt-3">
            Metode pembelajaran yang dirancang untuk semua level, dari pemula hingga mahir.
          </p>
        </div>

        <!-- Image -->
        <div class="col-md-6 d-flex justify-content-center align-items-end">
          <img src="{{ asset('images/home.png') }}" alt="home" class="hero-img img-fluid">
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-5">
    <div class="container">
      <!-- Title -->
      <div class="row">
        <div class="col-12 text-center mb-5">
          <h2 class="display-5 fw-bold fs-2 text-dark mb-3">About</h2>
          <p class="text-muted mx-auto" style="max-width: 600px;">
            Florent adalah platform kursus bahasa Inggris yang dirancang untuk semua level.
            Kami percaya bahwa belajar bahasa Inggris bisa dilakukan dengan cara yang menyenangkan, modern, dan fleksibel.
          </p>
        </div>
      </div>

      <!-- Vision & Mission Cards -->
      <div class="row g-4">
        <!-- Vision Card -->
        <div class="col-md-6">
          <div class="card h-100 border-0 shadow card-hover">
            <div class="card-body text-center p-4">
              <h3 class="h4 fw-semibold text-amber mb-3">Visi</h3>
              <p class="text-muted lh-lg">
                Florent adalah kursus bahasa Inggris yang dirancang untuk membantu siswa dari berbagai level meningkatkan kemampuan bahasa Inggris mereka. Dengan metode pembelajaran interaktif dan materi yang relevan, kami berkomitmen memberikan pengalaman belajar yang menyenangkan, efektif, dan mudah dipahami.
              </p>
            </div>
          </div>
        </div>

        <!-- Mission Card -->
        <div class="col-md-6">
          <div class="card h-100 border-0 shadow card-hover">
            <div class="card-body p-4">
              <h3 class="h4 fw-semibold text-amber mb-3 text-center">Misi</h3>
              <ul class="list-unstyled text-muted lh-lg">
                <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i>Menyediakan metode belajar yang interaktif dan menyenangkan.</li>
                <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i>Mendampingi siswa dari level dasar hingga mahir.</li>
                <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i>Menghadirkan materi yang praktis dan relevan dengan kehidupan nyata.</li>
                <li class="mb-2"><i class="fas fa-check-circle text-cyan me-2"></i>Menciptakan pengalaman belajar yang fleksibel dan nyaman.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Courses Section -->
  <section id="courses" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-5">
          <h2 class="display-5 fw-bold fs-2 text-dark">Courses</h2>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card border-0 shadow card-hover" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="card-body text-center p-4">
              <h4 class="h5 fw-semibold text-amber">Speaking Mastery</h4>
              <p class="text-muted mt-2">Tingkatkan kemampuan berbicara dengan cara yang natural dan percaya diri.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow card-hover" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="card-body text-center p-4">
              <h4 class="h5 fw-semibold text-amber">Grammar Essentials</h4>
              <p class="text-muted mt-2">Pelajari grammar dengan cara yang mudah dipahami tanpa ribet.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow card-hover" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="card-body text-center p-4">
              <h4 class="h5 fw-semibold text-amber">TOEFL/IELTS Prep</h4>
              <p class="text-muted mt-2">Persiapkan dirimu untuk ujian internasional dengan strategi efektif.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Location Section -->
  <section id="location" class="py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h2 class="display-6 fw-bold fs-2 text-dark mb-3">Location</h2>
          <p class="text-muted mb-4">Kunjungi tempat kami langsung di lokasi berikut:</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="overflow-hidden rounded shadow border">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.124624852239!2d110.36878707473377!3d-7.868727178688273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a578bb7c8bdbf%3A0x8f24f1a4e9e!2sSurabaya!5e0!3m2!1sen!2sid!4v1692969000000!5m2!1sen!2sid" 
              width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center">
  <section>
    <div class="container text-center text-md-start">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h6>Florent</h6>
          <p>
            Kursus Bahasa Inggris terpercaya untuk meningkatkan kemampuan Bahasa Inggris dengan metode modern dan interaktif.
          </p>
        </div>
        <div class="col-md-4 mb-4">
          <h6>Navigasi</h6>
          <p><a href="#home" class="text-reset">HOME</a></p>
          <p><a href="#biodata" class="text-reset">ABOUT</a></p>
          <p><a href="#pendidikan" class="text-reset">COURSES</a></p>
          <p><a href="#hobi" class="text-reset">LOCATION</a></p>
        </div>
        <div class="col-md-4 mb-4">
          <h6>Contact</h6>
          <p><i class="fas fa-home me-2"></i> Dukuh Kupang Barat 31</p>
          <p><i class="fas fa-envelope me-2"></i> neladwian@gmail.com</p>
          <p><i class="fas fa-phone me-2"></i> +62 896 1523 6674</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Social links -->
  <section class="mb-4">
    <a
      class="btn btn-twitter rounded-circle m-1"
      href="https://x.com/nullst"
      role="button"
    >
      <i class="fa-brands fa-x-twitter"></i>
    </a>
    <a
      class="btn btn-instagram rounded-circle m-1"
      href="https://www.instagram.com/neladw.an/"
      role="button"
    >
      <i class="fab fa-instagram"></i>
    </a>
  </section>

  <div class="text-center p-4 bg-dark text-light">
    &copy; 2025 Florent English Course. All Rights Reserved.
  </div>
  </footer>
  <!-- <footer class="bg-zinc-300 py-5">
    <div class="container">
      <div class="row g-4">

        <div class="col-md-4">
          <h2 class="h4 fw-bold">Florent English Course</h2>
          <p class="mt-3 text-dark">
            Kursus Bahasa Inggris terpercaya untuk meningkatkan kemampuan Bahasa Inggris dengan metode modern dan interaktif.
          </p>
        </div>

        <div class="col-md-4">
          <h3 class="h5 fw-semibold mb-3">Navigation</h3>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="/" class="text-dark text-decoration-none">Home</a></li>
            <li class="mb-2"><a href="#about" class="text-dark text-decoration-none">About</a></li>
            <li class="mb-2"><a href="#courses" class="text-dark text-decoration-none">Courses</a></li>
            <li class="mb-2"><a href="#contact" class="text-dark text-decoration-none">Contact</a></li>
          </ul>
        </div>

        <div class="col-md-4">
          <h3 class="h5 fw-semibold mb-3">Hubungi Kami</h3>
          <ul class="list-unstyled">
            <li class="mb-3 d-flex align-items-start">
              <i class="fas fa-map-marker-alt text-cyan me-3 mt-1"></i>
              <span>Jl. Pendidikan No.123, Suarabaya</span>
            </li>
            <li class="mb-3 d-flex align-items-center">
              <i class="fas fa-phone text-cyan me-3"></i>
              <a href="tel:+628179369954" class="text-dark text-decoration-none">+62 817-936-9954</a>
            </li>
            <li class="mb-3 d-flex align-items-center">
              <i class="fas fa-envelope text-cyan me-3"></i>
              <a href="mailto:info@florent.com" class="text-dark text-decoration-none">info@florent.com</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="bg-dark">
      <div class="container">
        <div class="text-center text-light">
          &copy; 2025 Florent English Course. All Rights Reserved.
        </div>
      </div>
    </div>
  </footer> -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>