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
            <span class="badge bg-primary">{{ $property->propertyType->name }}</span>
            <span class="badge bg-secondary">{{ $property->listingType->name }}</span>
        </div>
        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
            <h4 class="text-success">₹ {{ number_format($property->price) }} {{$property->price_in}}</h4>
        </div>
    </div>

    <!-- Image -->
    <div class="row mb-4">
        @if($property->thumbnail)
            <div class="col-md-12">
                <img src="{{ asset('storage/' . $property->thumbnail) }}" class="img-fluid rounded w-100 shadow" alt="Property Image">
            </div>
        @else
            <div class="col-md-12">
                No Image
            </div>
        @endif
    </div>
    
    <!-- Property Details -->
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card p-4 mb-4">
                <h5 class="mb-3">Property Overview</h5>
                <ul class="list-group list-group-flush">
            
                    {{-- For Plot --}}
                    @if($property->property_type_id === '1')
                        <li class="list-group-item"><strong>Plot Size:</strong> {{ property->plot->plot_size ?? 'N/A' }} {{ $property->plot->plot_are_units }}</li>
                        <li class="list-group-item"><strong>Plot Front:</strong> {{ $property->plot->plot_front ?? 'N/A' }} ft</li>
                        <li class="list-group-item"><strong>Plot Sides:</strong>
                            Side 1: {{ $plot->plot_side_1 ?? 'N/A' }} ft,
                            Side 2: {{ $plot->plot_side_2 ?? 'N/A' }} ft,
                            Back: {{ $plot->plot_back ?? 'N/A' }} ft
                        </li>
            
                    {{-- For House --}}
                    @elseif($property->property_type_id === '2')
                        <li> class="list-group-item"><strong>House Type:</strong> {{ $property->house->house_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Area:</strong> {{ $property->house->house_area_size ?? 'N/A' }} {{ $property->house->house_area_units }}</li>
                        <li class="list-group-item"><strong>Construction Completed on:</strong> {{ $property->house->house_construction_year ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Last Renovation Completed on:</strong> {{ $property->house->house_renovation_year ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Bedrooms:</strong> {{ $property->house->house_bedrooms ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Bathrooms:</strong> {{ $property->house->house_bathrooms ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Balconies:</strong> {{ $property->house->house_balconies ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Facing:</strong> {{ $property->house->house_facing ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Total Floors:</strong> {{ $property->house->house_floors ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Furnishing Status:</strong> {{ $property->house->house_furnishing_status ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Advantage:</strong> {{ $property->house->advantage ?? 'N/A' }}</li>
            
                    {{-- For Appartment --}}
                    @elseif($property->property_type_id === '3')
                        <li class="list-group-item"><strong>Type:</strong> {{ $property->apartment->apartment_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Area:</strong> {{ $property->apartment->apartment_area_size ?? 'N/A' }} {{ $property->apartment->apartment_area_units }}</li>
                        <li class="list-group-item"><strong>Floor:</strong> {{ $property->apartment->apartment_floor ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Total Floors:</strong> {{ $property->apartment->apartment_floors ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Bedrooms:</strong> {{ $property->apartment->apartment_bedrooms ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Bathrooms:</strong> {{ $property->apartment->apartment_bathrooms ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Furnishing:</strong> {{ $property->apartment->apartment_furnishing_status ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Features:</strong>
                            View: {{ $property->apartment->apartment_view ?? 'N/A' }},
                            Lift: {{ $property->apartment->apartment_elevator ?? 'N/A' }},
                            Power Backup: {{ $property->apartment->apartment_power_backup ?? 'N/A' }},
                            Water Supply: {{ $property->apartment->apartment_water_supply ?? 'N/A' }}
                        </li>
                        <li class="list-group-item"><strong>Amenities:</strong>
                            Gym: {{ $property->apartment->apartment_gym }},
                            Pool: {{ $property->apartment->apartment_swimming_pool }},
                            Clubhouse: {{ $property->apartment->apartment_clubhouse }},
                            Garden: {{ $property->apartment->apartment_garden }},
                            Play Area: {{ $property->apartment->apartment_play_area }}
                        </li>
                    {{-- For Villa --}}
                    @elseif($property->property_type_id === '4')
                        <li class="list-group-item"><strong>Villa Type:</strong> {{ $villa->villa_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Area:</strong> {{ $villa->villa_area_size ?? 'N/A' }} {{ $villa->villa_area_units }}</li>
                        <li class="list-group-item"><strong>Bedrooms:</strong> {{ $villa->villa_bedrooms ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Bathrooms:</strong> {{ $villa->villa_bathrooms ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Floors:</strong> {{ $villa->villa_floors ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Furnishing:</strong> {{ $villa->villa_furnishing_status ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Facilities:</strong> Parking: {{ $villa->villa_parking }},
                        Pool: {{ $villa->villa_swimming_pool }},
                        Garden: {{ $villa->villa_garden }}</li>

                    {{-- For Office --}}
                    @elseif($property->property_type_id === '5')
                        <li class="list-group-item"><strong>Office Type:</strong> {{ $office->office_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Area:</strong> {{ $office->office_area_size ?? 'N/A' }} {{ $office->office_area_units }}</li>
                        <li class="list-group-item"><strong>Floor:</strong> {{ $office->floor_number ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Facing:</strong> {{ $office->office_facing ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Furnishing:</strong> {{ $office->office_furnishing_status ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Amenities:</strong> AC: {{ $office->office_air_conditioned }}, Meeting Room: {{ $office->office_meeting_room }}, Internet: {{ $office->office_internet }}</li>
                        <li class="list-group-item"><strong>Security:</strong> {{ $office->office_security ?? 'N/A' }}</li>
    
                    {{-- Shop --}}
                    @elseif($property->property_type_id === '6')
                        <li class="list-group-item"><strong>Shop Type:</strong> {{ $shop->shop_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Area:</strong> {{ $shop->shop_area_size ?? 'N/A' }} {{ $shop->shop_area_units }}</li>
                        <li class="list-group-item"><strong>Floor:</strong> {{ $shop->shop_floor ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Facing:</strong> {{ $shop->shop_facing ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Advantage:</strong> {{ $shop->advantage ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Amenities:</strong> Power Backup: {{ $shop->shop_power_backup }}, AC: {{ $shop->shop_air_conditioned }}, Toilet: {{ $shop->shop_toilet }}, Storage: {{ $shop->shop_storage }}</li>
    
                    {{-- Agriculture Land --}}
                    @elseif($property->property_type_id === '7')
                        <li class="list-group-item"><strong>Land Type:</strong> {{ $land->land_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Area:</strong> {{ $land->land_area_size ?? 'N/A' }} {{ $land->land_area_units }}</li>
                        <li class="list-group-item"><strong>Facing:</strong> {{ $land->land_facing ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Soil Type:</strong> {{ $land->land_soil_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Irrigation:</strong> {{ $land->land_irrigation ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Water Source:</strong> {{ $land->land_water_source ?? 'N/A' }}</li>
    
                    {{-- Industrial Land --}}
                    @elseif($property->property_type_id === '8')
                        <li class="list-group-item"><strong>Land Type:</strong> {{ $land->land_type ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Area:</strong> {{ $land->land_area_size ?? 'N/A' }} {{ $land->land_area_units }}</li>
                        <li class="list-group-item"><strong>Zone:</strong> {{ $land->land_zone ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Power Supply:</strong> {{ $land->land_power_supply ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Fire Safety:</strong> {{ $land->land_fire_safety ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Security:</strong> {{ $land->land_security ?? 'N/A' }}</li>
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
                @php
                    $city_id = $property->city_id;
                @endphp
                <h5 class="mb-3">Contact Seller</h5>
                <p><strong>Name:</strong> {{ $property->user->name }}</p>
                <p><strong>City:</strong> {{ $property->city->name }}</p>

                @if (!Auth::check())
                    {{-- Guest user --}}
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                        🔐 Login
                    </button>
                
                    <x-login-modal />
                    <x-register-modal />

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                            loginModal.show();
                        });
                    </script>
                @else
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
                @endif
            </div>
            <!-- Displaying the youtube video if available -->
            <div class="card p-4 mt-4">
                <h5 class="mb-3">Video Tour</h5>
                
            </div>
        </div>
    </div>
</div>
@endsection
