{{-- @include('includes.header') --}}
<div class="modal fade" id="edit-cat-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Announcement</h5>
                <a href="#"><span class="close text-white" data-dismiss="modal" aria-label="Close"
                        aria-hidden="false">×</span></a>
            </div>
            <div class="modal-body">
                <form id="edit-task-form">
                    @csrf
                    <div class="form-group">
                        <label for="edit-cat-exp">Title</label>
                        <input type="text" name="title" id="edit-cat-phone" placeholder="" class="form-control">
                        <label for="edit-cat-exp">Content</label>
                        <input type="text" name="content" id="edit-cat-id" placeholder="" class="form-control" required>
                        <input type="hidden" name="id" id="edit-cat-user" placeholder="" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-sm rounded" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-light btn-sm rounded" form="edit-task-form" type="reset">Reset</button>
                <button class="btn btn-primary btn-sm rounded" form="edit-task-form" type="button" onclick="submitEditForm()" name="submit"> <i
                        class=""></i> Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Construct the full URL using the route name
    const editAnnouncementUrl = '/api/edit_announcement';
    function submitEditForm(){
        var addEditForm = document.getElementById('edit-task-form');

        // Show confirmation dialog using Swal
        var formData = new FormData(addEditForm);

        Swal.fire({
            title: 'Are you sure you want to update this announcement?',
            text: "Or click cancel to abort!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2D5A27',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit'
         }).then((result) => {
            if (result.value) {
                // If the user confirms, submit the form
                Swal.fire({
                    text: "Updating please wait...",
                    showConfirmButton: false,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });

                fetch(editAnnouncementUrl, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "Authorization": "d16xA0oqWRi2barEd1Ru3JVM3uveym6nw2ntVsfSUl0kf8T5XNVhSykpoqswweeJI7OjiYTc1rtkDTKE",
                    }
                }).then(function (res) {
                    // Check the HTTP status code
                    if (!res.ok) {
                        throw new Error(`HTTP error! Status: ${res.status}`);
                    }
                    return res.json();
                }).then(function (data) {
                    if (!data.success) {
                        Swal.fire({
                            text: data.msg || "Adding failed",
                            type: "success"
                        });
                        return;
                    }
                    Swal.fire({
                        text: "Phone number updated successfully",
                        type: "error"
                    });
                    $("#edit-cat-modal").modal('hide');
                    $("select").val(null).trigger('change');
                    // requisitionCatTable.ajax.reload(null, false);
                    addEditForm.reset();
                }).catch(function (err) {
                        Swal.fire({
                            text: "Adding failed",
                        });
                });
            }
        });
    }
    
    
</script>
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
