@extends('layouts.app')

@section('content')

    <div class="container" style="margin-left:-80px">
        <div class="row">
            <!-- Content -->
            <div class="col-md-12">
                {{-- <div class="card mt-4"> --}}
                <nav class="navbar navbar-expand-lg navbar-light"
                    style="background-color: #f8f9fa; border-bottom: 5px solid #C78C06; margin-bottom: 10px;">
                    <h4 style="font-weight: bold; color: #343a40; margin: 0; padding: 10px;">ANNOUNCEMENT MANAGEMENT</h4>
                </nav>
                <div class="card-body">
                    <!-- Announcement Form -->
                    <form id="announcementForm">
                        <div class="form-group">
                            <label for="announcementTitle">Title</label>
                            <input type="text" name="title" class="form-control" id="announcementTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="announcementContent">Content</label>
                            <textarea class="form-control" name="content" id="announcementContent" rows="3" required></textarea>
                        </div>
                        <button type="button" class="btn text-white" style="background: #C78C06"
                            onclick="submitAnnouncement()">Submit Announcement</button>
                    </form><br>

                    <!-- Display Announcements -->
                    <div class="mt-4 table-responsive">
                        <h5 class="font-weight-bold">Recent Announcements</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="announcementList">
                                @forelse ($notices as $notice)
                                    <!-- Announcements will be dynamically added here -->
                                    <tr>
                                        <td>{{ $notice->submitted_date }}</td>
                                        <td>{{ $notice->title }}</td>
                                        <td>{{ $notice->content }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class='btn btn-sm btn-outline-success rounded edit-req-btn'
                                                {{-- data-toggle="modal" data-target="#edit-cat-modal" --}} data-title="{{ $notice->title }}"
                                                data-submitted_date="{{ $notice->submitted_date }}"
                                                data-content="{{ $notice->content }}" data-id="{{ $notice->id }}">
                                                <i class='fas fa-edit'></i>
                                            </button>

                                            <!-- Delete Button -->
                                            <button class='btn btn-sm btn-outline-danger rounded delete-req-btn'
                                                data-title="{{ $notice->title }}"
                                                data-submitted_date="{{ $notice->submitted_date }}"
                                                data-content="{{ $notice->content }}" data-id="{{ $notice->id }}">
                                                <i class='fas fa-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No staff found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@include('admin_dash.modals.announcement.edit_announcement')

<script>
    const addAnnouncementUrl = '/api/add_announcement';

    function submitAnnouncement() {
        var addAnnouncementForm = document.getElementById('announcementForm');

        // Show confirmation dialog using Swal
        var formData = new FormData(addAnnouncementForm);

        Swal.fire({
            title: 'Are you sure you want to add this notice?',
            text: "Or click cancel to abort!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C78C06',
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

                fetch(addAnnouncementUrl, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "Authorization": "d16xA0oqWRi2barEd1Ru3JVM3uveym6nw2ntVsfSUl0kf8T5XNVhSykpoqswweeJI7OjiYTc1rtkDTKE",
                    }
                }).then(function(res) {
                    // Check the HTTP status code
                    if (!res.ok) {
                        throw new Error(`HTTP error! Status: ${res.status}`);
                    }
                    return res.json();
                }).then(function(data) {
                    if (!data.success) {
                        Swal.fire({
                            text: data.msg || "Adding failed",
                            type: "success"
                        });
                        return;
                    }
                    Swal.fire({
                        text: "Notice added successfully",
                        type: "error"
                    });
                    $("#addStaffModal").modal('hide');
                    $("select").val(null).trigger('change');
                    addStaffForm.reset();
                }).catch(function(err) {
                    Swal.fire({
                        text: "Adding failed",
                    });
                });
            }
        });
    }

    $(document).ready(function() {
        $(".edit-req-btn").click(function() {
            // var phone = $(this).data("phone");
            // var course = $(this).data("course");
            var title = $(this).data("title");
            var content = $(this).data("content");
            var id = $(this).data("id");
            // var gender = $(this).data("gender");

            console.log("ID:", id);

            // Set values in the modal fields
            $("#edit-cat-phone").val(title);
            $("#edit-cat-id").val(content);
            $("#edit-cat-user").val(id); // Add similar lines for other fields
            // ...

            // Assuming the edit modal has the ID "edit-cat-modal"
            $("#edit-cat-modal").modal("show");
        });
    });

    //Delete expense
    $(document).ready(function() {
        $(".delete-req-btn").click(function() {
            var title = $(this).data("title");
            var content = $(this).data("content");
            var id = $(this).data("id");

            console.log("ID:", id);

            // Ensure id is captured correctly before constructing the URL
            const deleteAnnouncementUrl = `/api/delete_announcement/${id}`;

            Swal.fire({
                title: "Are you sure you want to delete announcement?",
                text: "Or you can click cancel to abort!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Delete"
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        text: "Deleting please wait...",
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    $.ajax({
                        url: deleteAnnouncementUrl,
                        type: "POST",
                    }).done(function(data) {
                        if (!data.ok) {
                            Swal.fire({
                                text: data.msg,
                                type: "error"
                            });
                            return;
                        }
                        Swal.fire({
                            text: "Deleted successfully",
                            type: "success"
                        });
                        // requisitionTable.ajax.reload(null, false);

                    }).fail(() => {
                        alert('Processing failed');
                    });
                }
            });
        });
    });
</script>
