@extends('layouts.app')

@section('content')

<div class="container" style="margin-left:-80px">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f8f9fa; border-bottom: 5px solid #C78C06; margin-bottom: 10px;">
        <h4 style="font-weight: bold; color: #343a40; margin: 0; padding: 10px;">WELCOME TO THE STAFF ATTENDANCE MANAGEMENT SYSTEM</h4>
    </nav>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <!-- Quick Stats Section -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="font-weight-bold">Quick Stats</h5>
                    </div>
                    <div class="card-body">
                        <!-- Display key statistics and graphs here -->
                        <p class="font-weight-bold">Total Staff: {{$totalStaffCount}}</p>
                        <p class="font-weight-bold">Total Attendance: {{$totalAttendanceCount}}</p>
                        <!-- Add graphical representations if needed -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Recent Activities Feed -->
                <div class="card" style="height: 178px">
                    <div class="card-header">
                        <h5 class="font-weight-bold">Announcements</h5>
                    </div>
                    <div class="card-body">
                        <!-- Display upcoming events here -->
                        <ul>
                            @foreach ($notices as $notice)
                            <li class="font-weight-bold">Title : <span style="color: red">{{$notice->title}}</span></li>
                            <!-- Display more events as needed -->
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Events Section -->
        {{-- <div class="card mt-4">
            <div class="card-header">
                <h5 class="font-weight-bold">Announcements</h5>
            </div>
            <div class="card-body">
                <!-- Display upcoming events here -->
                <ul>
                    @foreach ($notices as $notice)
                    <li class="font-weight-bold">Title : {{$notice->title}}</li>
                    <!-- Display more events as needed -->
                    @endforeach
                </ul>
            </div>
        </div> --}}

        <!-- Quick Actions Section -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="font-weight-bold">Quick Actions</h5>
            </div>
            <div class="card-body">
                <!-- Add buttons or shortcuts for quick actions -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#addStaffModal">Add Staff</button>
                <button class="btn btn-success"><a href="{{route('admin_attendance')}}" class="text-white">Approve Leave</a></button>
                <!-- Add more action buttons as needed -->
            </div>
        </div>
    </div>
</div>
@endsection
@include('admin_dash.modals.filter_modal.add_staff_modal.index')

<script>
    function addRecentActivity(activity) {
        // Get the <ul> element
        var recentActivitiesList = document.getElementById('recentActivitiesList');

        // Create a new <li> element
        var newActivityItem = document.createElement('li');
        newActivityItem.className = 'font-weight-bold';
        newActivityItem.textContent = activity;

        // Append the new <li> to the <ul>
        recentActivitiesList.appendChild(newActivityItem);
    }
</script>
