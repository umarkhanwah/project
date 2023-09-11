<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: red;">
    <a class="navbar-brand mx-4 " href="/">
   <h1 class="display-5">

        Covni
    </h1>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('/') ? 'active' : '' }}" href="/" aria-current="page">Home <span class="visually-hidden">(current)</span></a>
            </li>
            @if(Auth::guard('user')->check())
            <li class="nav-item">
                <a class="nav-link {{ request()->is('booked_records') ? 'active' : '' }}" href="/booked_records" >Booked Records</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('myreports') ? 'active' : '' }}" href="/myreports" >See reports</a>
            </li>
            @endif
        </ul>
            <form class="d-flex my-2 my-lg-0">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-auto  mt-2 mt-lg-0">

                <li class="nav-item dropdown me-5">
                    <a href="#dropdown" class="nav-link active dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    
                    @auth('hospital')
                        {{ auth('hospital')->user()->name }}
                    @endauth
                    @auth('user')
                        {{ auth('user')->user()->name }}
                    @endauth
                    @auth('admin')
                        {{ auth('admin')->user()->name }}
                    @endauth
                        
                    </a>
                    <div class="dropdown-menu" aria-labelledby="triggerId">
                        @auth('hospital')
                            <a href="{{route('h_edit',auth('hospital')->user()->id)}}" class="dropdown-item" href="#">Edit Profile</a>
                            <a href="/h_logout" class="dropdown-item">Logout</a>
                            @endauth
                            @auth('user')
                            <a href="{{route('u_edit',auth('user')->user()->id)}}" class="dropdown-item" href="#">Edit Profile</a>
                            <a href="/u_logout" class="dropdown-item">Logout</a>
                            @endauth
                            @auth('admin')
                            <a href="{{route('u_edit',auth('admin')->user()->id)}}" class="dropdown-item" href="#">Edit Profile</a>
                            <a href="/a_logout" class="dropdown-item">Logout</a>
                        @endauth
                        
                        
                    </div>   
                    {{-- @yield('dropdown') --}}
                </li>
            </ul>
    </div>
</nav>
