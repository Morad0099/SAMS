@extends('layout.app')

@section('content')
    <div class="container-fluid" style="margin-left:-80px">
        <nav class="navbar navbar-expand-lg navbar-light"
            style="background-color: #f8f9fa; border-bottom: 5px solid #C78C06; margin-bottom: 10px;">
            <h4 style="font-weight: bold; color: #343a40; margin: 0; padding: 10px;">LEAVE MANAGEMENT</h4>
        </nav>

        <!-- Leave Management Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Summary of pending leave requests and upcoming leave schedules -->
                        <div class="mb-4 font-weight-bold">
                            <h5 class="font-weight-bold">Leave Summary</h5>
                            <p>Pending Leave Requests: <span class="text-danger">{{ $totalLeaveCounts }}</span></p>
                            <p>Approved Leave Requests: <span class="text-success"></span> </p>
                        </div>

                        <!-- Leave Requests Table -->
                        <h5 class="font-weight-bold">Leave Requests</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date Range</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($leaves as $leave)
                                        <tr>
                                            <td>{{ $leave->start_date ?? null}} - {{ $leave->end_date ?? null}}</td>
                                            <td>{{ $leave->status ?? null}}</td>
                                            <td>
                                                <!-- Delete Button -->
                                                <button class='btn btn-sm btn-outline-danger rounded delete-req-btn'
                                                    onclick="deleteLeaveRequest('{{ $leave->staff_id }}')">
                                                    <i class='fas fa-trash'></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No leave request found.</td>
                                        </tr>
                                        <!-- Add more rows with leave requests -->
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Leave Request Form -->
                        <h5 class="font-weight-bold mt-4">Submit Leave Request</h5>
                        <form id="leaveRequestForm">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" id="startDate" required>
                                    <input type="hidden" name="staff_id" class="form-control"
                                        value="{{ Auth::user()->staff_id }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="endDate">End Date</label>
                                    <input type="date" name="end_date" class="form-control" id="endDate" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason</label>
                                <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn text-white" style="background: #C78C06"
                                onclick="submitLeaveRequest()">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other sections or widgets can be added below -->

    </div>
@endsection

<script>
    const addLeaveRequestUrl = '/api/add_leave_request';

    function submitLeaveRequest() {
        var addLeaveRequestForm = document.getElementById('leaveRequestForm');

        // Prevent the default form submission
        event.preventDefault();

        // Show confirmation dialog using Swal
        Swal.fire({
            title: 'Are you sure you want to submit this leave request?',
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

                fetch(addLeaveRequestUrl, {
                    method: "POST",
                    body: new FormData(addLeaveRequestForm),
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
                        text: "Leave request submitted successfully",
                        type: "success"
                    });
                    // Optionally, you can perform additional actions here after successful submission
                }).catch(function(err) {
                    Swal.fire({
                        text: "Adding failed",
                        type: "error"
                    });
                });
            }
        });
    }

    function deleteLeaveRequest(staff_id) {
        const deleteLeaveRequestUrl = `/api/delete_leave_request/${staff_id}`;

        Swal.fire({
            title: "Are you sure you want to delete this leave request?",
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
                    url: deleteLeaveRequestUrl,
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
                    // Perform any additional actions after successful deletion
                }).fail(() => {
                    alert('Processing failed');
                });
            }
        });
    }
</script>
