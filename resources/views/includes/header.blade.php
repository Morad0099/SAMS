<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAMS</title>

    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-9/yo9wSc6fapZfN1caEV3ZuYG2CjkOrK/Ep5Cn6CmCQZlqJKQcBLbJciykFx4uIb/uG4tfcIjzZW1DOmW7JMI5A==" crossorigin="anonymous" />

<!-- Typicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.10/typicons.min.css" integrity="sha512-3m4Wv8l7Qt9p7qBRohZlPm5bTsOLpBGRcaUxwL0c8FX9HKehaaGmq2MDW1SdolC1l6DTFJi86uyX63mZYYQVpA==" crossorigin="anonymous" />

    <!-- Add your additional stylesheets, scripts, or other head content here -->
</head>
<body>
    {{-- <header class="bg-primary text-white text-center py-3">
        <h1>Staff Attendance Management System</h1>
    </header> --}}

    {{-- @include('includes.navbar') --}}

    <div id="content">
        @yield('content')
    </div>

    <!-- Include Bootstrap JS and Popper.js from CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Add your scripts or other footer content here -->
</body>
</html>
