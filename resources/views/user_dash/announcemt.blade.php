@extends('layout.app')

@section('content')

<div class="container-fluid" style="margin-left:-80px">
    <nav class="navbar navbar-expand-lg navbar-light"
    style="background-color: #f8f9fa; border-bottom: 5px solid #2D5A27; margin-bottom: 10px;">
    <h4 style="font-weight: bold; color: #343a40; margin: 0; padding: 10px;">ANNOUNCEMENTS</h4>
</nav>

    <!-- Announcement Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <!-- Recent Announcements List -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="font-weight-bold">Recent Announcements</h4>
                        {{-- <button class="btn text-white" style="background: #2D5A27" data-toggle="modal" data-target="#announcementFilterModal"><i class="fas fa-filter"></i> Filter</button> --}}
                    </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notices as $notice)
                                <tr class="font-weight-bold">
                                    <td>{{$notice->submitted_date}}</td>
                                    <td>{{$notice->title}}</td>
                                    <td>{{$notice->content}}</td>
                                </tr>
                                <!-- Add more rows with announcements -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Other sections or widgets can be added below -->

</div>

@endsection
@include('user_dash.modals.filter.announcement')
