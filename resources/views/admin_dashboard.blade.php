<!DOCTYPE html>
<html lang="en">
<head>
    @include("includes.header")
    @include("includes.styles")
</head>
<body>


@include('includes.navbar')

<div id="content">
    @yield('content')
</div>

</body>
</html>
