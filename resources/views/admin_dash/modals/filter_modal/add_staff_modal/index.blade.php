<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Add Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-staff-form">
                    @csrf
                    <div class="form-group">
                        <label for="staffNameFilter">Staff Name<span style="color: red; margin-left: 2px;">*</span></label>
                        <input type="text" class="form-control" name="name" id="staffNameFilter" required>
                    </div>
                    <div class="form-group">
                        <label for="staffIdFilter">Staff ID<span style="color: red; margin-left: 2px;">*</span></label>
                        <input type="text" class="form-control" name="id" id="staffIdFilter" required>
                    </div>
                    <div class="form-group">
                        <label for="staffIdFilter">Staff Email<span style="color: red; margin-left: 2px;">*</span></label>
                        <input type="email" class="form-control" name="email" id="staffIdFilter" required>
                    </div>
                    <div class="form-group">
                        <label for="staffIdFilter">Staff Phone<span style="color: red; margin-left: 2px;">*</span></label>
                        <input type="phone" class="form-control" name="phone" id="staffIdFilter" required>
                    </div>
                    <div class="form-group">
                        <label for="staffGenderFilter">Staff Gender<span style="color: red; margin-left: 2px;">*</span></label>
                        <select class="form-control" name="gender" id="staffGenderFilter" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label for="staffIdFilter">Staff Course<span style="color: red; margin-left: 2px;">*</span></label>
                        <input type="text" class="form-control" name="course" id="staffIdFilter" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" form="add-staff-form" type="reset">Reset</button>
                <button type="button" class="btn text-white" style="background: #2D5A27" onclick="submitAddStaffForm()">Add</button>
            </div>
        </div>
    </div>
</div>

<script>
    const addStaffUrl = '/api/add_staff';

    function submitAddStaffForm() {
        var addStaffForm = document.getElementById('add-staff-form');

        // Show confirmation dialog using Swal
        var formData = new FormData(addStaffForm);

        Swal.fire({
            title: 'Are you sure you want to add this staff?',
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
                    text: "Adding please wait...",
                    showConfirmButton: false,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });

                fetch(addStaffUrl, {
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
                        text: "Staff added successfully",
                        type: "error"
                    });
                    $("#addStaffModal").modal('hide');
                    $("select").val(null).trigger('change');
                    addStaffForm.reset();
                }).catch(function (err) {
                        Swal.fire({
                            text: "Adding failed",
                        });
                });
            }
        });
    }
</script>

