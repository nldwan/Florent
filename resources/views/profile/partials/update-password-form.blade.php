<form method="post" action="{{ route('profile.password.update') }}">
    @csrf
    @method('patch')

    <!-- Current Password -->
    <div>
        <label for="current_password">Current Password</label>
        <input id="current_password" name="current_password" type="password" class="mt-1 block w-full">
        @error('current_password')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- New Password -->
    <div class="mt-4">
        <label for="password">New Password</label>
        <input id="password" name="password" type="password" class="mt-1 block w-full">
        @error('password')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full">
    </div>

    <div class="flex items-center gap-4 mt-4">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Save
        </button>
        @if (session('status') === 'password-updated')
            <p class="text-green-600 text-sm">Password berhasil diperbarui!</p>
        @endif
    </div>
</form>
