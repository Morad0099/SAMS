@extends('layout.app')

@section('content')
    <div class="container-fluid" style="margin-left:-80px">
        <nav class="navbar navbar-expand-lg navbar-light"
            style="background-color: #f8f9fa; border-bottom: 5px solid #C78C06; margin-bottom: 10px;">
            <h4 style="font-weight: bold; color: #343a40; margin: 0; padding: 10px;">CLOCK IN FOR ATTENDANCE</h4>
        </nav>

        <!-- Clock In/Out Section -->
        <div class="row">
            <div class="col-md-12" style="margin-top: 20px">
                <div class="card md-12">
                    <div class="card-body">
                        <!-- Display current clock-in status and last clock-in/out times -->
                        <p class="card-text font-weight-bold">Current Status: <span class="text-success">{{ $clockins->status ?? 'N/A' }}</span></p>
                        <p class="card-text font-weight-bold">Last Time Clocked In: <span class="text-success">{{ $clockins->clockin_time ?? 'N/A' }}</span></p>
                        {{-- <p class="card-text font-weight-bold">Last Time Clocked Out: 05:15 PM</p> --}}

                        <!-- Clock In/Out form -->
                        <form id="clockin-form" action="" method="post">
                            @csrf
                            <div class="form-group" style="width: 200px">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ now()->toDateString() }}" readonly required>
                            </div>


                            <div class="form-group" style="width: 200px">
                                <label for="status">Status:</label>
                                <input type="hidden" name="staff_id" value="{{ Auth::user()->staff_id }}">
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Clock In">Clock In</option>
                                    <!-- Add other status options if needed -->
                                </select>
                            </div>

                            <div class="mt-4">
                                <button type="button" onclick="submitClockinForm()" class="btn text-white"
                                    style="background: #C78C06">Clock In</button>
                                {{-- <button type="button" class="btn btn-warning ml-2" onclick="clockOut()">Clock Out</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    <script>
        function submitClockinForm() {
            var clockinForm = document.getElementById("clockin-form");

            Swal.fire({
                title: 'Are you sure you want to clock in for attendance?',
                text: "Or click cancel to abort!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Clock In'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        text: "Clocking in for attendance, please wait...",
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });

                    // Obtain the user's location using Geolocation API
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            function(position) {
                                // Success callback
                                // Add the latitude and longitude to the form data
                                var latitude = position.coords.latitude;
                                var longitude = position.coords.longitude;

                                // Append location data to the form data
                                var formData = new FormData(clockinForm);
                                formData.append('latitude', latitude);
                                formData.append('longitude', longitude);

                                // Make the Ajax request with updated form data
                                submitClockinRequest(formData);
                            },
                            function(error) {
                                // Error callback
                                console.error(error);
                                Swal.fire({
                                    text: "Failed to obtain location. Clocking in without location data.",
                                    type: "warning"
                                });

                                // Make the Ajax request without location data
                                submitClockinRequest(new FormData(clockinForm));
                            }
                        );
                    } else {
                        // Geolocation not supported
                        console.error("Geolocation is not supported by this browser.");
                        Swal.fire({
                            text: "Geolocation is not supported by your browser. Clocking in without location data.",
                            type: "warning"
                        });

                        // Make the Ajax request without location data
                        submitClockinRequest(new FormData(clockinForm));
                    }
                }
            });
        }

        function submitClockinRequest(formData) {
            $.ajax({
                    type: 'POST',
                    url: "{{ route('clockin_attendance') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                })
                .done(function(data) {
                    Swal.fire({
                        text: data.msg,
                        type: data.ok ? "success" : "error"
                    });

                    if (data.ok) {
                        clockinForm.reset();
                    }
                })
                .fail(function(err) {
                    console.error(err);
                    Swal.fire({
                        text: "Clocking in failed",
                        type: "error"
                    });
                });
        }
    </script>
