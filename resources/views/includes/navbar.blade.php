<nav class="navbar navbar-expand-lg navbar-dark bg-dark col-lg-12 col-12 p-0 fixed-top py-3">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="#">
            <h4 class="mb-0" style="color: aquamarine">PADI'S SCHOOL</h4>
        </a>

         <!-- Sidebar Toggle Button -->
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="d-flex ">
            <div class="card text-white bg-primary ml-auto">
                <div class="card-body p-2">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ADM
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#"><i class="fas fa-user text-primary"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt text-primary"></i> Logout</a>
                            <form id="logout-form" action="" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card text-white bg-primary ml-2">
                <div class="card-body">
                    <h6 class="mb-0">Today : {{ now()->format('l, F j, Y') }}</h6>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="collapse" id="sidebarCollapse">
    <div class="card sidebar">
        <div class="card-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
                <!-- Add more menu items as needed -->
            </ul>
        </div>
    </div>
</div>


