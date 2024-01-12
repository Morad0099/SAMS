@extends('layouts.app')

@section('content')
    {{-- <div class="container-fluid" style="margin-left:-80px"> --}}
        {{-- <div class="row"> --}}
        <div class="container-fluid" style="margin-left:-80px">
            <nav class="navbar navbar-expand-lg navbar-light"
                style="background-color: #f8f9fa; border-bottom: 5px solid #2D5A27; margin-bottom: 10px;">
                <h4 style="font-weight: bold; color: #343a40; margin: 0; padding: 10px;">ATTENDANCE MANAGEMENT</h4>
            </nav>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Real-time Attendance Tracking Section -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="font-weight-bold">Real-time Attendance Tracking</h5>
                            </div>
                            <div class="card-body table-responsive">
                                <!-- Display real-time attendance records here -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Staff Name</th>
                                            <th scope="col">Clock-in Time</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop through and display attendance records -->
                                        @foreach ($clockinstatus as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->clockin_time}}</td>
                                            <td>{{$item->status}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{-- <div class="col-md-6"> --}}
                        <!-- Attendance Overview Section -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="font-weight-bold">Attendance Overview</h5>
                            </div>
                            <div class="card-body">
                                <!-- Chart.js Canvas -->
                                <canvas id="attendanceChart" width="400" height="200"></canvas>
                            </div>
                        </div>

                        <!-- Leave Management Section -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="font-weight-bold">Leave Management</h5>
                            </div>
                            <div class="card-body">
                                <!-- Summary of Pending Leave Requests -->
                                <div class="mb-4">
                                    <h6 class="font-weight-bold">Pending Leave Requests</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Staff Name</th>
                                                    <th>Leave Type</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Loop through pending leave requests and display them in the table -->
                                                @foreach ($items as $item)
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->reason }}</td>
                                                        <td>{{ $item->start_date }}</td>
                                                        <td>{{ $item->end_date }}</td>
                                                        <td>
                                                            <button class="btn btn-outline-success btn-sm rounded">
                                                                <i class="fas fa-check"></i> Approve
                                                            </button>

                                                            <button class="btn btn-outline-danger btn-sm rounded">
                                                                <i class="fas fa-times"></i> Reject
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var attendanceData = {!! json_encode($attendanceData) !!};
            console.log(attendanceData);
    
            var months = [
                'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
            ];
    
            var labels = attendanceData.map(entry => months[entry.month - 1]);
            var attendanceCounts = attendanceData.map(entry => entry.attendance_count);
            var clockInCounts = attendanceData.map(entry => entry.clock_in_count);
            var absentCounts = attendanceData.map(entry => entry.absent_count);
    
            var ctx = document.getElementById('attendanceChart').getContext('2d');
    
            var attendanceChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Attendance Trends',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            data: attendanceCounts,
                            fill: false,
                        },
                        {
                            label: 'Clock In',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            data: clockInCounts,
                            fill: false,
                        },
                        {
                            label: 'Absent',
                            backgroundColor: 'rgba(255, 255, 255, 0)', // Transparent
                            borderColor: 'rgba(255, 99, 132, 1)',
                            data: absentCounts,
                            fill: false,
                        },
                    ]
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
    </script>
    
@endsection
