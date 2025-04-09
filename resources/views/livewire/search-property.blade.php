<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-bold fs-5">🔍 Search Properties</div>
        <div class="card-body">

            <form wire:submit.prevent="search">
                <div class="row g-3">

                    <!-- Property Title -->
                    <div class="col-md-6">
                        <label class="form-label">Keyword / Title</label>
                        <input type="text" wire:model.lazy="title" class="form-control" placeholder="e.g. 3BHK House in Model Town">
                    </div>

                    <!-- Property Type -->
                    <div class="col-md-3">
                        <label class="form-label">Property Type</label>
                        <select wire:model="property_type" class="form-select">
                            <option value="">Any</option>
                            <option>Plot</option>
                            <option>House</option>
                            <option>Apartment</option>
                            <option>Villa</option>
                            <option>Office</option>
                            <option>Shop</option>
                            <option>Agriculture Land</option>
                        </select>
                    </div>

                    <!-- Listing Type -->
                    <div class="col-md-3">
                        <label class="form-label">Listing Type</label>
                        <select wire:model="listing_type" class="form-select">
                            <option value="">Any</option>
                            <option>Sale</option>
                            <option>Rent</option>
                            <option>Lease</option>
                            <option>Collaborate</option>
                        </select>
                    </div>

                    <!-- City -->
                    <div class="col-md-4">
                        <label class="form-label">City</label>
                        <select wire:model="city_id" class="form-select">
                            <option value="">Any</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location -->
                    <div class="col-md-4">
                        <label class="form-label">Locality / Area</label>
                        <input type="text" wire:model="location" class="form-control" placeholder="e.g. Model Town">
                    </div>

                    <!-- Price Range -->
                    <div class="col-md-2">
                        <label class="form-label">Min Price (₹)</label>
                        <input type="number" wire:model="min_price" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Max Price (₹)</label>
                        <input type="number" wire:model="max_price" class="form-control">
                    </div>

                    <!-- Area Range -->
                    <div class="col-md-2">
                        <label class="form-label">Min Area</label>
                        <input type="number" wire:model="min_area" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Max Area</label>
                        <input type="number" wire:model="max_area" class="form-control">
                    </div>

                    <!-- Bedrooms -->
                    <div class="col-md-2">
                        <label class="form-label">Bedrooms</label>
                        <select wire:model="bedrooms" class="form-select">
                            <option value="">Any</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}+</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Bathrooms -->
                    <div class="col-md-2">
                        <label class="form-label">Bathrooms</label>
                        <select wire:model="bathrooms" class="form-select">
                            <option value="">Any</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}+</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Furnishing -->
                    <div class="col-md-2">
                        <label class="form-label">Furnishing</label>
                        <select wire:model="furnishing_status" class="form-select">
                            <option value="">Any</option>
                            <option>Furnished</option>
                            <option>Semi-Furnished</option>
                            <option>Unfurnished</option>
                        </select>
                    </div>

                    <!-- Facing -->
                    <div class="col-md-2">
                        <label class="form-label">Facing</label>
                        <select wire:model="facing" class="form-select">
                            <option value="">Any</option>
                            <option>North</option>
                            <option>South</option>
                            <option>East</option>
                            <option>West</option>
                            <option>North-East</option>
                            <option>South-East</option>
                            <option>North-West</option>
                            <option>South-West</option>
                        </select>
                    </div>

                    <!-- Negotiable -->
                    <div class="col-md-2">
                        <label class="form-label">Negotiable</label>
                        <select wire:model="negotiable_price" class="form-select">
                            <option value="">Any</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                    <!-- Court Case -->
                    <div class="col-md-2">
                        <label class="form-label">Court Case</label>
                        <select wire:model="court_case" class="form-select">
                            <option value="">Any</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                    <!-- With Image -->
                    <div class="col-md-2">
                        <label class="form-label">Image Available</label>
                        <select wire:model="with_image" class="form-select">
                            <option value="">Any</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i> Search Properties
                    </button>
                </div>
            </form>

        </div>
    </div>
    <hr class="my-4">

    <h5>Showing {{ $properties->total() }} Properties</h5>

    <div class="row">
        @forelse($properties as $property)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    @if ($property->image)
                        <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->property_title }}</h5>
                        <p class="mb-1"><strong>Location:</strong> {{ $property->location }}, {{ $property->city->name }}</p>
                        <p class="mb-1"><strong>Type:</strong> {{ $property->property_type }}</p>
                        <p class="mb-1"><strong>Price:</strong> ₹{{ number_format($property->price) }} 
                            @if($property->negotiable_price) <span class="badge bg-success">Negotiable</span> @endif
                        </p>
                        <a href="{{ route('property.show', $property->slug) }}" class="btn btn-sm btn-primary mt-2">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No properties found matching your criteria.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $properties->links() }}
    </div>
</div>

