@extends('layout.app')

@section('content')
    <div class="container-fluid" style="margin-left:-80px">

        <nav class="navbar navbar-expand-lg navbar-light"
            style="background-color: #f8f9fa; border-bottom: 5px solid #C78C06; margin-bottom: 10px;">
            <h4 style="font-weight: bold; color: #343a40; margin: 0; padding: 10px;">WELCOME TO THE STAFF ATTENDANCE
                MANAGEMENT SYSTEM</h4>
        </nav>
        <!-- Main Content -->
        <main role="main" class="col-md-12">
            <div
                class="row d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2 class="font-weight-bold">Staff Dashboard</h2>
            </div>

            <!-- Welcome Message -->
            {{-- <div class="card mb-4">
            <div class="card-header">
                <h5 class="font-weight-bold">Welcome to the Staff Attendance Management System</h5>
            </div>
            <div class="card-body">
                <p class="card-text">This dashboard provides tools and features for managing attendance, viewing reports, and performing other tasks related to attendance tracking.</p>
            </div>
        </div> --}}

            <!-- Clock Status and Last Time Section -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="font-weight-bold">Clock Status</h5>
                        </div>
                        <div class="card-body">
                            
                            <p class="card-text font-weight-bold">Current Status: <span class="text-success">{{$items->status ?? 'N/A'}}</span></p>
                            <p class="card-text font-weight-bold">Last Time Clocked In: <span class="text-success">{{$items->clockin_time ?? 'N/A'}}</span></p>
                            {{-- <p class="card-text">Last Time Clocked Out: 05:15 PM</p> --}}
                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="font-weight-bold">Announcements</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($notices as $notice)
                                <li class="list-group-item font-weight-bold">Title : <span style="color: red">{{$notice->title}}</span></li>
                                <!-- Add more events as needed -->
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    <!-- Quick Actions Section -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Leave Request</h5>
                    <p class="card-text">View detailed information about your leave requests</p>
                    <a href="/staff/leave" class="btn text-white" style="background: #C78C06">Go to Leave Management</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body" style="height: 180px">
                    <h5 class="card-title font-weight-bold">Clock-In/Out</h5>
                    <p class="card-text">Manually clock in or out for attendance tracking.</p>
                    <a href="/staff/clockin" class="btn text-white" style="background: #C78C06; margin-top: 25px">Clock In/Out</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Attendance Trends</h5>
                    <p class="card-text">Explore graphical representations of attendance trends.</p>
                    <a href="/staff/attendance" class="btn text-white" style="background: #C78C06">View Trends</a>
                </div>
            </div>
        </div>
    </div>
    </main>
    </div>
</div>
@endsection
