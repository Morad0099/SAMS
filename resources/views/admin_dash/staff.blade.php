@extends('layouts.app')

@section('content')
    <div class="container" style="margin-left:-80px">
        {{-- <div class="row"> --}}
        <div class="col-md-12">
            {{-- <div class="card"> --}}
            <nav class="navbar navbar-expand-lg navbar-light"
                style="background-color: #f8f9fa; border-bottom: 5px solid #2D5A27; margin-bottom: 10px;">
                <h4 style="font-weight: bold; color: #343a40; margin: 0; padding: 10px;">STAFF MANAGEMENT</h4>
            </nav>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- User Management Section -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="font-weight-bold">User Management</h5>
                                    </div>
                                    {{-- <div class="col-auto"> --}}
                                    <div class="btn-group" role="group">
                                        <!-- Add buttons for actions (add, edit, delete) -->
                                        <button class="btn btn-primary" style="left: -20px; height: 35px"
                                            data-toggle="modal" data-target="#addStaffModal">Add
                                            Staff</button>
                                        <button class="btn text-white"
                                            style="background: #2D5A27; left: -10px; height: 35px" data-toggle="modal"
                                            data-target="#filterModal">
                                            <i class="fas fa-filter"></i> Filter
                                        </button>
                                        <form id="excelForm" enctype="multipart/form-data">
                                            <label for="excelFile" class="custom-excel-btn">
                                                <i class="far fa-file-excel"></i> Import Excel
                                            </label>
                                            <input type="file" name="excelFile" id="excelFile" accept=".xls, .xlsx">
                                            <button type="button" class="btn btn-success"
                                                style="height: 35px; margin-top: -8px"
                                                onclick="uploadExcel()">Upload</button>
                                        </form>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Staff Name</th>
                                            <th scope="col">Staff ID</th>
                                            <th scope="col">Staff Subject</th>
                                            <th scope="col">Staff Phone</th>
                                            <th scope="col">Staff Gender</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($staffs as $staff)
                                            <tr id="staffRow_{{ $staff->employee_id }}">
                                                <!-- Your table rows will go here -->
                                                <td>{{ $staff->name ?? 'null' }}</td>
                                                <td>{{ $staff->employee_id ?? 'null' }}</td>
                                                <td>{{ $staff->course ?? 'null' }}</td>
                                                <td>{{ $staff->phone ?? 'null' }}</td>
                                                <td>{{ $staff->gender ?? 'null' }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button class='btn btn-sm btn-outline-success rounded edit-req-btn'
                                                        {{-- data-toggle="modal" data-target="#edit-cat-modal" --}} data-phone="{{ $staff->phone }}"
                                                        data-name="{{ $staff->name }}" data-id="{{ $staff->employee_id }}"
                                                        data-course="{{ $staff->course }}"
                                                        data-gender="{{ $staff->gender }}">
                                                        <i class='fas fa-edit'></i>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <button class='btn btn-sm btn-outline-danger rounded delete-req-btn'
                                                    data-phone="{{ $staff->phone }}"
                                                        data-name="{{ $staff->name }}" data-id="{{ $staff->employee_id }}"
                                                        data-course="{{ $staff->course }}"
                                                        data-gender="{{ $staff->gender }}">
                                                        <i class='fas fa-trash'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No staff found.</td>
                                            </tr>
                                        @endforelse
                                        <!--action column will have two button one for editing and one for deletion-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Records Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="font-weight-bold">Attendance Records</h5>
                    </div>
                    <div class="card-body">
                        <!-- Display a bar chart for attendance records -->
                        <canvas id="attendanceRecordsChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
@include('admin_dash.modals.filter_modal.index')
@include('admin_dash.modals.filter_modal.add_staff_modal.index')
@include('admin_dash.modals.edit_staff_modal.index')
<!-- Script to create the attendance records chart -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch data from the Laravel route
        fetch('{{ route('getStaffAttendanceData') }}')
            .then(response => response.json())
            .then(data => {
                // Extract relevant data for the chart
                const staffNames = data.map(entry => entry.staff_name);
                const attendanceCounts = data.map(entry => entry.attendance_count);

                // Get the canvas element
                var ctx = document.getElementById('attendanceRecordsChart').getContext('2d');

                // Create the attendance records chart
                var attendanceRecordsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: staffNames,
                        datasets: [{
                            label: 'Attendance Records',
                            data: attendanceCounts,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    });

    $(document).ready(function() {
        $(".edit-req-btn").click(function() {
            var phone = $(this).data("phone");
            var course = $(this).data("course");
            var employee_id = $(this).data("id");
            var email = $(this).data("email");
            var name = $(this).data("name");
            var gender = $(this).data("gender");

            console.log("ID:", employee_id);

            // Set values in the modal fields
            $("#edit-cat-phone").val(phone);
            $("#edit-cat-id").val(employee_id); // Add similar lines for other fields
            // ...

            // Assuming the edit modal has the ID "edit-cat-modal"
            $("#edit-cat-modal").modal("show");
        });
    });

    $(document).ready(function() {
        $('#filterModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset(); // Reset the form inside the modal
        });
        // Function to filter rows based on staff ID
        function filterStaffById(staffId) {
            // Hide all rows
            $('table tbody tr').hide();

            // Show only rows that match the staff ID
            $(`#staffRow_${staffId}`).show();
        }

        // Trigger filtering when the Search button is clicked
        $('#filterModal button.btn-primary').click(function() {
            var staffId = $('#staffIdFilter').val();
            filterStaffById(staffId);

            // Close the modal
            $('#filterModal').modal('hide');
        });
    });

    //Delete expense
    $(document).ready(function() {
        $(".delete-req-btn").click(function() {
            var phone = $(this).data("phone");
            var course = $(this).data("course");
            var employee_id = $(this).data("id");
            var email = $(this).data("email");
            var name = $(this).data("name");
            var gender = $(this).data("gender");

            console.log("ID:", employee_id);

            // Ensure id is captured correctly before constructing the URL
            const deleteStaffUrl = `/api/delete/${employee_id}`;

            Swal.fire({
                title: "Are you sure you want to delete request?",
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
                        url: deleteStaffUrl,
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
