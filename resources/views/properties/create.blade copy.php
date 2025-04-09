@extends('layouts.front.layout')

@section('title', 'Add New Property')
@section('description', 'Post your property for sale, rent, lease or collaboration.')
@section('og_title', 'Add New Property')
@section('og_url', url()->current())

@section('content')
<div class="container py-5">
    <h4 class="mb-4">Add New Property</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('customer.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="card p-4 mb-4">
                <h6 class="mb-3">Property Details</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Listing Type</label>
                        <select name="listing_type" class="form-select" required>
                            @foreach($listingTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Property Type</label>
                        <select name="property_type" class="form-select" required>
                            @foreach($propertyTypes as $ptype)
                                <option value="{{ $ptype }}">{{ $ptype }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <select name="city_id" class="form-select" required>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Area (sq ft)</label>
                        <input type="text" name="area" class="form-control" value="{{ old('area') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Bedrooms</label>
                        <input type="number" name="bedrooms" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Bathrooms</label>
                        <input type="number" name="bathrooms" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Balconies</label>
                        <input type="number" name="balconies" class="form-control">
                    </div>
                </div>
            </div>

            <div class="card p-4 mb-4">
                <h6 class="mb-3">Amenities & Media</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Hospital Distance</label>
                        <input type="text" name="hospital_distance" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Railway Distance</label>
                        <input type="text" name="railway_distance" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Local Transport</label>
                        <input type="text" name="transport_distance" class="form-control">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                        
                        <div class="mt-2">
                            <img id="imagePreview" src="#" alt="Preview" style="display: none;" class="img-thumbnail" width="200">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <button type="submit" class="btn btn-primary w-100">Post Property</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();

    reader.onload = function() {
        const img = document.getElementById('imagePreview');
        img.src = reader.result;
        img.style.display = 'block';
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
