<!-- Password Reset Modal -->
<div class="modal fade" id="passwordResetModal" tabindex="-1" role="dialog" aria-labelledby="passwordResetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordResetModalLabel">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="password-reset-form" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="current-password">Current Password</label>
                        <input type="password" class="form-control" id="current-password" name="current_password" required>
                    </div>

                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" class="form-control" id="new-password" name="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="new_password_confirmation" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
