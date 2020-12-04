<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('partials.heads')
</head>

<body id="page-top">
    @include('partials.navigation')
    
    @yield('content')
    @include('partials.footer')
    @include('partials.scripts')
</body>

</html>