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
            <h4 class="text-success">₹ {{ number_format($property->price) }}</h4>
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
                    <li class="list-group-item"><strong>Area:</strong> {{ $property->area ?? 'N/A' }} sq ft</li>
                    <li class="list-group-item"><strong>Bedrooms:</strong> {{ $property->bedrooms ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Bathrooms:</strong> {{ $property->bathrooms ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Balconies:</strong> {{ $property->balconies ?? 'N/A' }}</li>
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
        </div>

        <!-- Sidebar: Contact Info -->
        <div class="col-md-4">
            <div class="card p-4 shadow">
                <h5 class="mb-3">Contact Seller</h5>
                <p><strong>Name:</strong> {{ $property->user->name }}</p>
                <p><strong>City:</strong> {{ $property->user->city->name }}</p>

                @auth
                    @if(auth()->id() !== $property->user_id)
                        <a href="tel:{{ $property->user->mobile_number }}" class="btn btn-outline-success w-100 mt-2">
                            📞 Call Now
                        </a>
                    @else
                        <span class="text-muted">This is your listing</span>
                    @endif
                @else
                    {{-- Option A: Inline --}}
                    @livewire('auth-form', [
                        'redirect' => request()->fullUrl(),
                        'propertyUserId' => $property->user_id,
                        'propertyUserMobile' => $property->user->mobile_number
                    ])

                    {{-- OR Option B: Modal trigger --}}
                    {{-- <a href="#" class="btn btn-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#authModal">Login to Contact</a> --}}
                @endauth
            </div>
            <!-- Auth Modal -->
            <div wire:ignore.self class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <button type="button" class="btn-close ms-auto me-2 mt-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    @livewire('auth-form', ['redirect' => request()->fullUrl()])
                </div>
                </div>
            </div>
            <!-- Displaying the youtube video if available -->
            <div class="card p-4 mt-4">
                <h5 class="mb-3">Video Tour</h5>
                <iframe width="350" 
                        height="200" 
                        src="https://www.youtube.com/embed/8u2pxT100aM?si=1qmZt_pLzcfsBEeG" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" 
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
