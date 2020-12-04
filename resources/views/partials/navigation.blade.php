<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav" style="background-color:white">
    <div class="container">
        <a class="navbar-brand" href="#page-top">
            @if(config('theme.logo'))<img src="{{ asset(config('theme.logo')) }}" alt="" height="84" class="position-absolute bg-white shadow-sm rounded" style="top: 0">@endif
            {{ config('site.name') }}
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0 mt-5 mt-sm-0">
                <li class="nav-item"><a class="nav-link active" href="/">About</a></li>
                <li class="nav-item"><a class="nav-link text-dark " href="/login">Login</a></li>
            </ul>
        </div>
    </div>
</nav>