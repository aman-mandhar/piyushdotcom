@extends('layouts.front.layout')

@section('title', 'Browse Properties')
@section('description', 'Find properties for sale, rent, lease or collaboration across India.')
@section('og_title', 'Property Listings')
@section('og_url', url()->current())

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Explore Properties</h3>

    <!-- Search Filter -->
    <form method="GET" action="{{ route('properties.search') }}" class="row g-3 mb-5">
        <div class="col-md-3">
            <select name="city_id" class="form-select">
                <option value="">All Cities</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="property_type" class="form-select">
                <option value="">Property Type</option>
                @foreach($propertyTypes as $type)
                    <option value="{{ $type }}" {{ request('property_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
        </div>

        <div class="col-md-2">
            <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    <!-- Property Grid -->
    <div class="row g-4">
        @forelse($properties as $property)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="property-item rounded overflow-hidden shadow-sm">
                    <div class="position-relative overflow-hidden">
                        <a href="{{ route('properties.show', $property->slug) }}">
                            <img class="img-fluid" src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}" style="height: 250px; object-fit: cover;">
                        </a>
                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-3 py-1 px-3 text-capitalize">
                            {{ $property->listing_type }}
                        </div>
                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-3 pt-1 px-3 text-capitalize">
                            {{ $property->property_type }}
                        </div>
                    </div>
                    <div class="p-4 pb-0">
                        <h5 class="text-primary mb-2">₹{{ number_format($property->price) }}</h5>
                        <a class="d-block h5 mb-2" href="{{ route('properties.show', $property->slug) }}">
                            {{ Str::limit($property->title, 50) }}
                        </a>
                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->location }}, {{ $property->city->name }}</p>
                    </div>
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->area ?? '-' }} Sqft
                        </small>
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-bed text-primary me-2"></i>{{ $property->bedrooms ?? '-' }} Bed
                        </small>
                        <small class="flex-fill text-center py-2">
                            <i class="fa fa-bath text-primary me-2"></i>{{ $property->bathrooms ?? '-' }} Bath
                        </small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No properties found.</div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-5">
        {{ $properties->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>
@endsection