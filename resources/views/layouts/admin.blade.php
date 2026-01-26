<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Florent') }}</title>
<link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
}

/* Sidebar desktop */
.sidebar-desktop {
    width: 220px;
    min-height: 100vh;
    background-color: #343a40;
    color: #ddd;
    transition: all 0.3s;
}
.sidebar-desktop a {
    color: #ddd;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
}
.sidebar-desktop a.active, .sidebar-desktop a:hover {
    background-color: #495057;
    color: #fff;
}

/* Sidebar header */
.sidebar-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 15px 20px;
}
.sidebar-header img {
    height: 30px;
}
.sidebar-header h3 {
    color: #fff;
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
}

/* Topbar */
.topbar {
    height: 60px;
    background-color: #fff;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 0 20px;
}
.topbar .initials {
    width: 40px;
    height: 40px;
    background-color: #0d6efd;
    color: #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 600;
    text-transform: uppercase;
    cursor: pointer;
    user-select: none;
}

/* Profile popup ala Phoenix */
.profile-popup {
    position: absolute;
    top: 55px;
    right: 0;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    padding: 20px;
    min-width: 220px;
    display: none;
    z-index: 1000;
    animation: fadeSlide 0.2s ease;
}

@keyframes fadeSlide {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.profile-popup .avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background-color: #e7f1ff;
    color: #0d6efd;
    font-size: 1.4rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
}

.profile-popup .name {
    text-align: center;
    font-weight: 600;
    margin-bottom: 15px;
}

/* Content */
.content {
    padding: 20px;
}

/* Mobile adjustments */
@media (max-width: 768px) {
    .sidebar-desktop {
        display: none;
    }
}
</style>
</head>
<body>

<div class="d-flex">

    <!-- Sidebar desktop -->
    <div class="sidebar-desktop d-none d-md-block">
        <div class="sidebar-header">
            <img src="{{ asset('images/favicon.png') }}" alt="Florent Logo">
            <h3>Florent</h3>
        </div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i><span>Dashboard</span>
            </a>

           <!-- USER MANAGEMENT -->
            <a href="#userManagement"
            data-bs-toggle="collapse"
            class="d-flex justify-content-between align-items-center {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-people-fill"></i>
                    <span>User Management</span>
                </div>
                <i class="bi bi-chevron-down small"></i>
            </a>

            <div class="collapse ps-4 {{ request()->routeIs('admin.users.*') ? 'show' : '' }}"
                id="userManagement">

                <a href="{{ route('admin.users.admin') }}"
                class="{{ request()->routeIs('admin.users.admin') ? 'active' : '' }}">
                    <i class="bi bi-shield-lock"></i>
                    <span>Admin Accounts</span>
                </a>

                <a href="{{ route('admin.users.siswa') }}"
                class="{{ request()->routeIs('admin.users.siswa') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard"></i>
                    <span>Student Accounts</span>
                </a>
            </div>

            <!-- LEARNING MANAGEMENT -->
             @php
                $learningActive =
                    request()->routeIs('admin.materials.*') ||
                    request()->routeIs('admin.vocabulary.*') ||
                    request()->routeIs('admin.conversations.*') ||
                    request()->routeIs('admin.grades.*');
            @endphp

            <a href="#learningManagement"
            data-bs-toggle="collapse"
            class="d-flex justify-content-between align-items-center {{ $learningActive ? 'active' : '' }}">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Learning Management</span>
                </div>
                <i class="bi bi-chevron-down small"></i>
            </a>

            <div class="collapse ps-4
                {{ $learningActive ? 'show' : '' }}"id="learningManagement">

                <a href="{{ route('admin.materials.index') }}"
                class="{{ request()->routeIs('admin.materials.*') ? 'show' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Materials</span>
                </a>

                <a href="{{ route('admin.vocabulary.index') }}"
                class="{{ request()->routeIs('admin.vocabulary.*') ? 'active' : '' }}">
                    <i class="bi bi-spellcheck"></i>
                    <span>Vocabulary</span>
                </a>

                <a href="{{ route('admin.conversations.index') }}"
                class="{{ request()->routeIs('admin.conversations.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots"></i>
                    <span>Conversations</span>
                </a>

                <a href="{{ route('admin.grades.index') }}"
                class="{{ request()->routeIs('admin.grades.*') ? 'active' : '' }}">
                    <i class="bi bi-award-fill"></i>
                    <span>Grades</span>
                </a>
            </div>
            <!-- PAYMENTS -->
            <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                <i class="bi bi-receipt-cutoff"></i><span>Payments</span>
            </a>
        </nav>
    </div>

    <div class="flex-grow-1">

        <!-- Topbar -->
        <div class="topbar position-relative">
            <!-- Mobile toggle button -->
            <button class="btn btn-outline-secondary d-md-none me-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                <i class="bi bi-list"></i>
            </button>

            <!-- Profile -->
            <div class="position-relative">
                <div id="profileBtn" class="initials">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div id="profilePopup" class="profile-popup">
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="name">
                        {{ auth()->user()->name }}
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 btn-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content">
            @yield('content')
        </div>

    </div>

</div>

<!-- Sidebar mobile Offcanvas -->
<div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Florent</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="nav flex-column">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.users.admin') }}" class="nav-link {{ request()->routeIs('admin.users.admin') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users Admin
            </a>
            <a href="{{ route('admin.users.siswa') }}" class="nav-link {{ request()->routeIs('admin.users.siswa') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users Siswa
            </a>

            <!-- Link Logout -->
            <a href="#" class="text-danger mt-3 d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i>
                <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const profileBtn = document.getElementById('profileBtn');
    const profilePopup = document.getElementById('profilePopup');

    profileBtn.addEventListener('click', () => {
        profilePopup.style.display = profilePopup.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function(event) {
        if (!profileBtn.contains(event.target) && !profilePopup.contains(event.target)) {
            profilePopup.style.display = 'none';
        }
    });
</script>

@yield('modals')

@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

</body>
</html>
