@extends('layout.app')

@section('content')
    <div class="container-fluid" style="margin-left:-80px">
        <nav class="navbar navbar-expand-lg navbar-light"
             style="background-color: #f8f9fa; border-bottom: 5px solid #C78C06; margin-bottom: 10px;">
            <h4 style="font-weight: bold; color: #343a40; margin: 0; padding: 10px;">ATTENDANCE</h4>
        </nav>

        <!-- Attendance Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Graphical representation of attendance trends -->
                        <div class="mb-4">
                            <h5 class="font-weight-bold">Attendance Trends</h5>

                            <!-- Include your chart or graph here (e.g., using Chart.js or other charting libraries) -->
                            <canvas id="attendanceChart" width="400" height="200"></canvas>
                        </div>

                        <!-- Attendance Records Table -->
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="font-weight-bold">Attendance Records</h5>
                            <button class="btn text-white" style="background: #C78C06" data-toggle="modal"
                                    data-target="#announcementFilterModal"><i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Time In</th>
                                    {{-- <th>Time Out</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($records as $record)
                                    <tr>
                                        <td>{{ $record->attendance_date }}</td>
                                        <td>{{ $record->status }}</td>
                                        <td>{{ $record->clockin_time }}</td>
                                        {{-- <td>05:00 PM</td> --}}
                                    </tr>
                                    <!-- Add more rows with attendance records -->
                                @empty
                                    <tr>
                                        <td colspan="5">No records available.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other sections or widgets can be added below -->

    </div>

    <canvas id="attendanceChart" width="400" height="200"></canvas>

    @include('user_dash.modals.filter.announcement')
@endsection


<!-- Add an HTML canvas element for the chart -->

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    // Fetch data from the Laravel route
    fetch('{{ route('getAttendanceData') }}')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Extract relevant data for the chart (replace with actual properties)
            const dates = [...new Set(data.map(entry => entry.attendance_date))];
            const datasets = [];

            // Extract counts for each status
            const clockInCounts = data.filter(entry => entry.status === 'Clock In').map(entry => entry.count);
            const absentCounts = data.filter(entry => entry.status === 'Absent').map(entry => entry.count);

            // Create datasets for each status
            datasets.push({
                label: 'Clock In',
                data: clockInCounts,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false,
            });

            // datasets.push({
            //     label: 'Absent',
            //     data: absentCounts,
            //     borderColor: 'rgba(255, 99, 132, 1)',
            //     borderWidth: 2,
            //     fill: false,
            // });

            var ctx = document.getElementById('attendanceChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                    datasets: datasets,
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const date = context.label;
                                    const clockInCount = clockInCounts[context.dataIndex] || 0;
                                    const absentCount = absentCounts[context.dataIndex] || 0;

                                    return `Attendance Trend: ${clockInCount + absentCount} | Clock In: ${clockInCount} | Absent: ${absentCount}`;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Fetch error:', error));
});

</script>
