@php
    $route = route('login');
    if(Auth::check()) {
        switch(Auth::user()->role_id){
            case 1: $route = route('admin.dashboard'); break;
            case 2: $route = route('customer.dashboard'); break;
            case 3: $route = route('employee.dashboard'); break;
            default:
                Auth::logout();
                session()->flash('error', 'Invalid role! You have been logged out.');
                $route = route('login');
                break;
        }
    }
@endphp
        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="{{ route('home')}}" class="navbar-brand d-flex align-items-center text-center">
                    <img src="{{ asset('img/aps-title.png') }}" alt="Logo" style="height: 30px;">
                    <!-- <h1 class="m-0 text-primary">Makaan</h1> -->
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{ route('home')}}" class="nav-item nav-link active">Home</a>
                        <a href="{{ route('properties.index') }}" class="nav-item nav-link">Property</a>
                    </div>
                        <div class="navbar-nav ms-auto nav-item dropdown">
                            <a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown">Contstruction</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{route('directory.create')}}" class="dropdown-item">Add your Business</a>
                                <a href="{{route('directory.index')}}" class="dropdown-item">View Direcory</a>
                            </div>
                        </div>
                        <div class="navbar-nav ms-auto nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Vehicles</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{route('vehicles.index')}}" class="dropdown-item">Vehicle List</a>
                                <a href="{{route('vehicles.create')}}" class="dropdown-item">Add Vehicle</a>
                            </div>
                        </div>
                        <div class="navbar-nav ms-auto">
                            <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                        </div>
                        
                        @php
                            $user = Auth::user();
                        @endphp
                        @if(Auth::check())
                        <div class="navbar-nav ms-auto nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ $route }}" class="dropdown-item">Dashboard</a>
                                <!-- Logout Form -->
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="navbar-nav ms-auto">
                            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        </div>
                        @endif
                    
                    </div>
                    <a href="{{ route('properties.create') }}" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a>
                    <a href="{{ route('properties.my-search') }}" class="btn btn-secondary px-3 d-none d-lg-flex">Search Property</a>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->