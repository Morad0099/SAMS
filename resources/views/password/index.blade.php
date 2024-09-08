<div class="modal fade" id="password-modal" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="password-reset-form">
                    @csrf
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password" id="current_password"
                            class="form-control form-control-sm" autocomplete="current-password" required>
                    </div>
                    <div class="form-group">

                        <label>New Password</label>
                        <input type="password" name="new_password" id="new_password"
                            class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="email" id="email" value="{{ Auth::user()->email ?? null}}">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="form-control form-control-sm" required>
                    </div>

                    <button class="btn btn-outline-secondary shadow" form="password-reset-form"
                        type="reset">Clear</button>
                    <button id="save-changes-btn" class="btn btn-outline-primary shadow" type="button">Save
                        Changes</button>
                    <div>
                        <div id="change-password-feedback"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('save-changes-btn').addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure you want to save changes?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, save it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result) {
                submitPasswordResetForm();
            }
        });
    });

    function submitPasswordResetForm() {
        var formData = {
            current_password: $('#current_password').val(),
            new_password: $('#new_password').val(),
            new_password_confirmation: $('#new_password_confirmation').val(),
            email: $('#email').val()
        };

        $.ajax({
            url: '/api/reset_password',
            type: 'PUT',
            data: formData,
            success: function(response) {
                console.log(response); // Log the response for debugging
                handleResponse(response); // Handle the response

                // Reset and close the modal after successful password reset
                if (response && response.ok) {
                    $('#current_password').val('');
                    $('#new_password').val('');
                    $('#new_password_confirmation').val('');
                    $('#password-modal').modal('hide'); // Assuming modal ID is 'password-modal'
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                if (xhr.responseJSON) {
                    handleResponse(xhr.responseJSON);
                } else {
                    // Display a generic error message if the response is not in JSON format
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while processing your request',
                        type: 'error',
                        showConfirmButton: true
                    });
                }
            }
        });
    }

    function handleResponse(response) {
        if (response && typeof response === 'object') {
            if (response.ok) {
                Swal.fire({
                    title: 'Success!',
                    text: response.msg,
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                let errorMessage = response.msg || 'An error occurred while processing your request';
                if (response.errors) {
                    // Concatenate all error messages
                    errorMessage = response.errors_all.join(', ');
                }
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    type: 'error',
                    showConfirmButton: true
                });
            }
        } else {
            console.error('Invalid response format:', response);
            Swal.fire({
                title: 'Error!',
                text: 'Invalid response format',
                type: 'error',
                showConfirmButton: true
            });
        }
    }
});

</script>