<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav" style="background-color:white">
    <div class="container">
        <a class="navbar-brand text-dark" href="{{url('/')}}">
            @if(Storage::disk('public')->exists(config('theme.logo')))
            <div class="position-absolute" style="top: 0">
                <img src="{{ asset(config('theme.logo')) }}" alt="" height="84" class="bg-white shadow-sm rounded p-1">
                <span class="position-absolute m-2" style="top:0">{{ config('theme.name') ?? 'Site Name' }}</span>
            </div>
            @else
            <span>{{ config('theme.name') ?? 'Site Name' }}</span>
            @endif
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0 mt-5 mt-sm-0">
                @foreach(config('menus') as $key => $menu)
                @if($menu->hasChildren())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="nav_menu_{{$key}}" role="button">
                        {{$menu->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="nav_menu_{{$key}}">
                        @foreach($menu->children as $sub_key => $sub_menu)
                        @if($sub_menu->hasChildren())
                        <div class="dropleft nav-item p-0">
                            <a class="dropdown-item dropdown-toggle text-dark px-4 py-1 d-block" href="#" id="sub_menu_dropdown_{{$sub_key}}" role="button">
                                {{$sub_menu->name}}
                            </a>
                            <div class="dropdown-menu">
                                @foreach($sub_menu->children as $sub_sub_menu)
                                <a class="dropdown-item text-dark" href="{{url($sub_sub_menu->url)}}">{{$sub_sub_menu->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <a class="dropdown-item text-dark" href="{{url($sub_menu->url)}}">{{$sub_menu->name}}</a>
                        @endif
                        @endforeach
                    </div>
                </li>
                @else
                <li class="nav-item"><a class="nav-link text-dark" href="{{$menu->url}}">{{$menu->name}}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>
