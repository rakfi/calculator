<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <!-- Current Password -->
    <div class="form-group mb-3">
        <label for="update_password_current_password" class="form-label">Current Password</label>
        <input id="update_password_current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
        @error('current_password', 'updatePassword')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- New Password -->
    <div class="form-group mb-3">
        <label for="update_password_password" class="form-label">New Password</label>
        <input id="update_password_password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
        @error('password', 'updatePassword')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="form-group mb-3">
        <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
        @error('password_confirmation', 'updatePassword')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex gap-2 align-items-center pt-2">
        <button type="submit" class="btn btn-save">Update Password</button>
        @if (session('status') === 'password-updated')
            <span class="success-message"><i class="bi bi-check-circle"></i> Password updated successfully!</span>
        @endif
    </div>
</form>
