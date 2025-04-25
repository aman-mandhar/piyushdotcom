@extends('layouts.front.layout')

@section('title', $property->title)
@section('description', Str::limit($property->description, 150))
@section('og_title', $property->title)
@section('og_description', Str::limit($property->description, 150))
@section('og_image', asset('storage/' . $property->image))
@section('og_url', url()->current())

@section('content')
<div class="container py-5">
    <!-- Heading -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <h2 class="mb-1">{{ $property->title }}</h2>
            <p class="text-muted mb-2">{{ $property->location }}, {{ $property->city->name }}</p>
            <span class="badge bg-primary">{{ $property->property_type }}</span>
            <span class="badge bg-secondary">{{ $property->listing_type }}</span>
        </div>
        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
            <h4 class="text-success">₹ {{ number_format($property->price) }} {{$property->price_in_unit}}</h4>
        </div>
    </div>

    <!-- Image -->
    @if($property->image)
        <div class="row mb-4">
            <div class="col-md-12">
                <img src="{{ asset('storage/' . $property->image) }}" class="img-fluid rounded w-100 shadow" alt="Property Image">
            </div>
        </div>
    @endif

    <!-- Property Details -->
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card p-4 mb-4">
                <h5 class="mb-3">Property Overview</h5>
                <ul class="list-group list-group-flush">
            
                    {{-- For Plot --}}
                    @if($property->property_type === 'Plot')
                        <li class="list-group-item"><strong>Plot Size:</strong> {{ $property->plot_size ?? 'N/A' }} {{ $property->measurement_unit }}</li>
                        <li class="list-group-item"><strong>Plot Front:</strong> {{ $property->plot_front ?? 'N/A' }} ft</li>
                        <li class="list-group-item"><strong>Plot Sides:</strong>
                            Side 1: {{ $property->plot_side_1 ?? 'N/A' }} ft,
                            Side 2: {{ $property->plot_side_2 ?? 'N/A' }} ft,
                            Back: {{ $property->plot_back ?? 'N/A' }} ft
                        </li>
            
                    {{-- For House/Apartment/Villa --}}
                    @elseif(in_array($property->property_type, ['House', 'Apartment', 'Villa']))
                        <li class="list-group-item"><strong>Area:</strong> {{ $property->area ?? 'N/A' }} {{ $property->area_unit }}</li>
                        <li class="list-group-item"><strong>Bedrooms:</strong> {{ $property->bedrooms ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Bathrooms:</strong> {{ $property->bathrooms ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Balconies:</strong> {{ $property->balconies ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Floor Number:</strong> {{ $property->floor_number ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Total Floors:</strong> {{ $property->total_floors ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Furnishing:</strong> {{ $property->furnishing_status ?? 'N/A' }}</li>
            
                    {{-- For Office --}}
                    @elseif($property->property_type === 'Office')
                        <li class="list-group-item"><strong>Area:</strong> {{ $property->office_area_size ?? 'N/A' }} {{ $property->office_area_size_unit }}</li>
                        <li class="list-group-item"><strong>Floor:</strong> {{ $property->office_floor ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Bathrooms:</strong> {{ $property->office_bathrooms ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Balconies:</strong> {{ $property->office_balconies ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Furnishing:</strong> {{ $property->office_furnishing_status ?? 'N/A' }}</li>
            
                    {{-- For Shop --}}
                    @elseif($property->property_type === 'Shop')
                        <li class="list-group-item"><strong>Shop Type:</strong> {{ $property->shop_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Area:</strong> {{ $property->shop_area_size ?? 'N/A' }} {{ $property->shop_area_size_unit }}</li>
                        <li class="list-group-item"><strong>Front:</strong> {{ $property->shop_front ?? 'N/A' }} ft</li>
                        <li class="list-group-item"><strong>Sides:</strong> 
                            Side 1: {{ $property->shop_side_1 ?? 'N/A' }} ft,
                            Side 2: {{ $property->shop_side_2 ?? 'N/A' }} ft,
                            Back: {{ $property->shop_back ?? 'N/A' }} ft
                        </li>
                        <li class="list-group-item"><strong>Floor:</strong> {{ $property->shop_floor ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Water Connection:</strong> {{ $property->shop_with_water_connection ? 'Yes' : 'No' }}</li>
            
                    {{-- For Agriculture Land --}}
                    @elseif($property->property_type === 'Agriculture Land')
                        <li class="list-group-item"><strong>Land Type:</strong> {{ $property->land_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Area:</strong> {{ $property->land_area_size ?? 'N/A' }} {{ $property->land_area_size_unit }}</li>
                        <li class="list-group-item"><strong>Status:</strong> {{ $property->current_status_of_land ?? 'N/A' }}</li>
            
                    {{-- Fallback --}}
                    @else
                        <li class="list-group-item">No detailed overview available for this property type.</li>
                    @endif
            
                </ul>
            </div>
            <div class="card p-4 mb-4">
                <h5 class="mb-3">Nearby Amenities</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Hospital:</strong> {{ $property->hospital_distance ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Railway Station:</strong> {{ $property->railway_distance ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Local Transport:</strong> {{ $property->transport_distance ?? 'N/A' }}</li>
                </ul>
            </div>

            <div class="card p-4 mb-4">
                <h5 class="mb-3">Description</h5>
                <p>{{ $property->description ?? 'No additional details provided.' }}</p>
            </div>
            <div class="card p-4 mb-4">
                <h5 class="mb-3">📢 Share This Property</h5>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-primary">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
            
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($property->title) }}" target="_blank" class="btn btn-sm btn-info">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
            
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($property->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-success">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
            
                    <a href="mailto:?subject={{ urlencode($property->title) }}&body={{ urlencode(url()->current()) }}" class="btn btn-sm btn-dark">
                        <i class="fas fa-envelope"></i> Email
                    </a>
            
                    <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link copied!');" class="btn btn-sm btn-secondary">
                        <i class="fas fa-link"></i> Copy Link
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar: Contact Info -->
        <div class="col-md-4">
            <div class="card p-4 shadow">
                <h5 class="mb-3">Contact Seller</h5>
                <p><strong>Name:</strong> {{ $property->user->name }}</p>
                <p><strong>City:</strong> {{ $property->user->city->name }}</p>
                @php
                    $user = Auth::user();
                @endphp
                @if($user == null)
                    <h6>
                        <div class="text-danger">Login to see the contact details</div>
                    </h6>
                    <div class="mt-3">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <span>New User <a href="{{ route('register') }}" class="btn btn-outline-primary w-100 mt-2">FREE SignUp!</a></span>
                    </div>
                @else
                @auth
                    @php
                        $city_id = $property->city_id;
                    @endphp
                    @if($property->user_id == auth()->user()->id)
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <p class="text-success">This Property is created by you.</p>
                            <a href="{{ route('properties.edit', $property->slug) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('properties.destroy', $property->slug) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('calls.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="city_id" value="{{ $city_id }}">
                        
                            @if(isset($property))
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <input type="hidden" name="mobile" value="+919216051212">
                            @elseif(isset($vehicle))
                                <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                <input type="hidden" name="mobile" value="+919216051212">
                            @elseif(isset($directory))
                                <input type="hidden" name="directory_id" value="{{ $directory->id }}">
                                <input type="hidden" name="mobile" value="+919216051212">
                            @endif
                        
                            <button type="submit" class="btn btn-outline-success w-100 mt-2">📞 Call Now</button>
                        </form>
                    @endif
                        {{-- OR Option B: Modal trigger --}}
                        {{-- <a href="#" class="btn btn-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#authModal">Login to Contact</a> --}}
                @endauth
                @endif
            </div>
            <!-- Displaying the youtube video if available -->
            <div class="card p-4 mt-4">
                <h5 class="mb-3">Video Tour</h5>
                @php
                    use Illuminate\Support\Str;

                    $embedUrl = null;

                    if (!empty($property->video_link)) {
                        $url = $property->video_link;

                        // Check for full YouTube link
                        if (Str::contains($url, 'watch?v=')) {
                            $parsed = parse_url($url);
                            parse_str($parsed['query'] ?? '', $queryParams);
                            if (!empty($queryParams['v'])) {
                                $embedUrl = 'https://www.youtube.com/embed/' . $queryParams['v'];
                            }
                        }

                        // Check for short youtu.be link
                        if (Str::contains($url, 'youtu.be/')) {
                            $segments = explode('/', $url);
                            $videoId = end($segments);
                            $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                        }
                    }
                @endphp

                @if ($embedUrl)
                    <div class="card p-4 mt-4">
                        <h5 class="mb-3">🎥 Video Tour</h5>
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $embedUrl }}"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
