@php
    $route = route('login');
    if(Auth::check()) {
        switch(Auth::user()->role_id){
            case 1: $route = route('admin.dashboard'); break;
            case 2: $route = route('customer.dashboard'); break;
            case 3: $route = route('broker.dashboard'); break;
            case 4: $route = route('developer.dashboard'); break;
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
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Property</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ route('customer.properties.index') }}" class="dropdown-item">PropertyList</a>
                                <a href="property-type.html" class="dropdown-item">Property Type</a>
                                <a href="property-agent.html" class="dropdown-item">Broker</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Contstruction</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="property-list.html" class="dropdown-item">House Developers</a>
                                <a href="property-type.html" class="dropdown-item">Contract Builders</a>
                                <a href="property-agent.html" class="dropdown-item">Building Materials</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Vehicles</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="testimonial.html" class="dropdown-item">All List</a>
                                <a href="404.html" class="dropdown-item">Add to Sale</a>
                                <a href="404.html" class="dropdown-item">Agents</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                        @php
                            $user = Auth::user();
                        @endphp
                        @if(Auth::check())
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                                <!-- Logout Form -->
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </div>
                        @else
                            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        @endif
                    
                    </div>
                    @auth
                        <a href="{{ route('customer.properties.create') }}" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a>
                    @else
                        <a href="{{ route('login.form', ['redirect' => route('customer.properties.create')]) }}" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a>
                    @endauth

                </div>
            </nav>
        </div>
        <!-- Navbar End -->