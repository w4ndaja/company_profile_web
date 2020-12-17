<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('') }}" target="_blank"> {{ config('theme.name') }} </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Situs
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown2" style="min-width:110px;right:0!important;left:auto!important">
                    <a class="dropdown-item" href="{{ route('menu.index') }}">Menu</a>
                    <a class="dropdown-item" href="{{ route('static-page.index') }}">Halaman</a>
                    <a class="dropdown-item" href="{{ route('theme.index') }}">Pengaturan</a>
                </div>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Artikel
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width:110px;right:0!important;left:auto!important">
                    <a class="dropdown-item" href="{{ route('post.index') }}">Artikel</a>
                    <a class="dropdown-item" href="{{ route('category.index') }}">Kategori</a>
                    <a class="dropdown-item" href="{{ route('tag.index') }}">Tag</a>
                </div>
            </li> --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width:110px;right:0!important;left:auto!important">
                    <div class="dropdown-header my-0 py-0 text-wrap"><strong class="h6">Selamat Datang, {{ Auth::user()->name }}</strong></div>
                    <div class="dropdown-header my-0 py-0"><strong class="h4"></strong></div>
                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item" href="{{ route('user.index') }}">Manajemen Pengguna</a> --}}
                    <a class="dropdown-item" href="{{ route('change-password') }}">Ganti Password</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-secondary bg-dark rounded-0 border-0 text-light py-1 px-0 m-0 w-100 nav-link" href="#">
                            <strong>Logout</strong>
                        </button>
                    </form>
                </div>
            </li>
            @endauth
        </ul>
        {{-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> --}}
    </div>
</nav>
