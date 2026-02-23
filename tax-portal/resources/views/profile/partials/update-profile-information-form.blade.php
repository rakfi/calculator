<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <!-- Name -->
    <div class="form-group mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="form-group mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="alert alert-info mt-3">
                <p class="mb-0">Your email address is unverified.</p>
                <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 text-decoration-underline">Click here to re-send the verification email.</button>
                </form>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-success fw-semibold mb-0">A new verification link has been sent to your email address.</p>
                @endif
            </div>
        @endif
    </div>

    <div class="d-flex gap-2 align-items-center pt-2">
        <button type="submit" class="btn btn-save">Save Changes</button>
        @if (session('status') === 'profile-updated')
            <span class="success-message"><i class="bi bi-check-circle"></i> Profile updated successfully!</span>
        @endif
    </div>
</form>
