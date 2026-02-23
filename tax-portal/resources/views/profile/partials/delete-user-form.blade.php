<p class="text-muted mb-3">Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data you wish to retain before deleting your account.</p>

<button type="button" class="btn btn-danger-custom" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
    <i class="bi bi-trash"></i> Delete Account
</button>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUserDeletionLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-3"><strong>Are you sure you want to delete your account?</strong></p>
                    <p class="text-muted mb-3">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Enter your password" autocomplete="current-password">
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
