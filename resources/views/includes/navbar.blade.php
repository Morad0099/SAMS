<nav class="navbar navbar-expand-lg navbar-dark bg-dark col-lg-12 col-12 p-0 fixed-top py-3"
    style="background: linear-gradient(to right, #1e2a3a, #B2BEB5);">
    <button class="navbar text-white px-5" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="sidebarCollapse"
        style="background: #2D5A27">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand ml-auto" href="#">
            <img src="{{ asset('images/logo.jpeg') }}" alt="School Logo"
                style="width: 120px; height: 100px; margin-right: 10px;">
            <h4 class="mb-0" style="color: #ffff; font-weight: bold; display: inline-block;">KADE TECHNICAL SHS</h4>
        </a>

        <div class="ml-auto">
            <div class="d-flex ml-auto">
                <!-- Card for displaying today's date in a specific timezone -->
                <div class="card text-white ml-2" style="background: #2D5A27">
                    <div class="card-body">
                        @php
                            // Set the desired timezone
                            $timezone = 'America/New_York';
                            // Display today's date in the specified timezone
                            $todayDate = now()->timezone($timezone)->format('l, F j, Y');
                        @endphp
                        <h6 class="mb-0">Today: {{ $todayDate }}</h6>
                    </div>
                </div>

                <!-- Card for displaying current time in a specific timezone (e.g., 'America/New_York') -->
                <div class="card text-white ml-2" style="background: #2D5A27">
                    <div class="card-body">
                        @php
                            // Set the desired timezone
                            $timezone = 'America/New_York';
                            // Display the current time in the specified timezone
                            $currentTime = now()
                                ->timezone($timezone)
                                ->format('h:i A');
                        @endphp
                        <h6 class="mb-0">Time: {{ $currentTime }}</h6>
                    </div>
                </div>
            </div>

            <!-- Add this button inside your navigation bar -->

        </div>
        <div class="card text-white ml-auto" style="background: #2D5A27">
            <div class="card-body p-2">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->role}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#"><i class="fas fa-user text-primary"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href=""
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="fas fa-sign-out-alt text-primary"></i> Logout</a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
