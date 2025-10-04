<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input 
                type="text" 
                class="form-control" 
                id="username" 
                name="username" 
                value="{{ old('username') }}" 
                required 
                autofocus 
                autocomplete="username"
                placeholder="Masukkan username">
            @error('username')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password" 
                required 
                autocomplete="current-password"
                placeholder="Masukkan password">
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input 
                type="checkbox" 
                class="form-check-input" 
                id="remember_me" 
                name="remember">
            <label class="form-check-label" for="remember_me">Ingat saya</label>
        </div>

        <!-- Tombol Login -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary w-100 py-2" style="border-radius: 10px; font-weight: 600;">
                Login
            </button>
        </div>
    </form>
</x-guest-layout>