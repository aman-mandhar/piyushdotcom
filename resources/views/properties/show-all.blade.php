@extends('layouts.dashboard.employee.layout')
@section('content')
<div class="container mt-4">
    @livewire('employee-call-register')
    <h2 class="mb-4">{{ $property->property_title }}</h2>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered table-striped">
                <tbody>
                    {{-- Owner Details --}}
                    <tr><th>Owner Name</th><td>{{ $property->owner_name }}</td></tr>
                    <tr><th>Contact</th><td>{{ $property->owner_contact }}</td></tr>
                    <tr><th>Email</th><td>{{ $property->owner_email }}</td></tr>
                    <tr><th>Address</th><td>{{ $property->owner_address }}</td></tr>
                    <tr><th>Nationality</th><td>{{ $property->owner_nationality }}</td></tr>
                    <tr><th>Type</th><td>{{ $property->owner_type }}</td></tr>
                    <tr><th>Document Type</th><td>{{ $property->owner_document_type }}</td></tr>
                    {{-- Property Details --}}
                    <tr><th>Address</th><td>{{ $property->property_address }}</td></tr>
                    <tr><th>Court Case</th><td>{{ $property->court_case }}</td></tr>
                    <tr><th>Court Case Details</th><td>{{ $property->court_case_details }}</td></tr>
                    <tr><th>Status</th><td>{{ $property->current_status }}</td></tr>
                    <tr><th>Listing Type</th><td>{{ $property->listing_type }}</td></tr>
                    <tr><th>Property Type</th><td>{{ $property->property_type }}</td></tr>
                        
                    @if($property->property_type === 'Plot')
                        {{-- Plot --}}
                        <tr><th>Plot Category</th><td>{{ $property->plot_category }}</td></tr>
                        <tr><th>Measurement Unit</th><td>{{ $property->measurement_unit }}</td></tr>
                        <tr><th>Plot Type</th><td>{{ $property->plot_type }}</td></tr>
                        <tr><th>Plot Number</th><td>{{ $property->plot_number }}</td></tr>
                        <tr><th>Front</th><td>{{ $property->plot_front }}</td></tr>
                        <tr><th>Side 1</th><td>{{ $property->plot_side_1 }}</td></tr>
                        <tr><th>Side 2</th><td>{{ $property->plot_side_2 }}</td></tr>
                        <tr><th>Back</th><td>{{ $property->plot_back }}</td></tr>
                        <tr><th>Size</th><td>{{ $property->plot_size }}</td></tr>
                        <tr><th>Price / Sqft</th><td>{{ $property->price_per_sqft }}</td></tr>
                    @elseif(in_array($property->property_type, ['House', 'Apartment', 'Villa']))
                        {{-- House / Apartment / Villa --}}
                        <tr><th>Floor No</th><td>{{ $property->floor_number }}</td></tr>
                        <tr><th>Bedrooms</th><td>{{ $property->bedrooms }}</td></tr>
                        <tr><th>Bathrooms</th><td>{{ $property->bathrooms }}</td></tr>
                        <tr><th>Balconies</th><td>{{ $property->balconies }}</td></tr>
                        <tr><th>Total Floors</th><td>{{ $property->total_floors }}</td></tr>
                        <tr><th>Furnishing</th><td>{{ $property->furnishing_status }}</td></tr>
                    @elseif($property->property_type === 'Office')
                        {{-- Office --}}
                        <tr><th>Office Floor</th><td>{{ $property->office_floor }}</td></tr>
                        <tr><th>Office Bathrooms</th><td>{{ $property->office_bathrooms }}</td></tr>
                        <tr><th>Office Balconies</th><td>{{ $property->office_balconies }}</td></tr>
                        <tr><th>Office Area Unit</th><td>{{ $property->office_area_size_unit }}</td></tr>
                        <tr><th>Office Area</th><td>{{ $property->office_area_size }}</td></tr>
                        <tr><th>Office Furnishing</th><td>{{ $property->office_furnishing_status }}</td></tr>
                    @elseif($property->property_type === 'Shop')
                        {{-- Shop --}}
                        <tr><th>Shop Type</th><td>{{ $property->shop_type }}</td></tr>
                        <tr><th>Area Unit</th><td>{{ $property->shop_area_size_unit }}</td></tr>
                        <tr><th>Shop Front</th><td>{{ $property->shop_front }}</td></tr>
                        <tr><th>Shop Side 1</th><td>{{ $property->shop_side_1 }}</td></tr>
                        <tr><th>Shop Side 2</th><td>{{ $property->shop_side_2 }}</td></tr>
                        <tr><th>Shop Back</th><td>{{ $property->shop_back }}</td></tr>
                        <tr><th>Area Size</th><td>{{ $property->shop_area_size }}</td></tr>
                        <tr><th>Floor</th><td>{{ $property->shop_floor }}</td></tr>
                        <tr><th>Water Connection</th><td>{{ $property->shop_with_water_connection ? 'Yes' : 'No' }}</td></tr>
                    @elseif($property->property_type === 'Agriculture Land')
                        {{-- Agriculture --}}
                        <tr><th>Land Type</th><td>{{ $property->land_type }}</td></tr>
                        <tr><th>Area Unit</th><td>{{ $property->land_area_size_unit }}</td></tr>
                        <tr><th>Area Size</th><td>{{ $property->land_area_size }}</td></tr>
                        <tr><th>Land Status</th><td>{{ $property->current_status_of_land }}</td></tr>
                    @endif
                    {{-- Common --}}
                    <tr><th>Price Unit</th><td>{{ $property->price_in_unit }}</td></tr>
                    <tr><th>Price</th><td>₹{{ number_format($property->price) }}</td></tr>
                    <tr><th>Negotiable</th><td>{{ $property->negotiable_price ? 'Yes' : 'No' }}</td></tr>
                    <tr><th>Market Price</th><td>₹{{ number_format($property->market_price) }}</td></tr>
                    <tr><th>Hospital Distance</th><td>{{ $property->hospital_distance }}</td></tr>
                    <tr><th>Railway Distance</th><td>{{ $property->railway_distance }}</td></tr>
                    <tr><th>Transport Distance</th><td>{{ $property->transport_distance }}</td></tr>
                    <tr><th>City</th><td>{{ $property->city->name ?? '-' }}</td></tr>
                    <tr><th>Area</th><td>{{ $property->area }} {{ $property->area_unit }}</td></tr>
                    <tr><th>Location</th><td>{{ $property->location }}</td></tr>
                    <tr><th>Facing</th><td>{{ $property->facing }}</td></tr>
                    <tr><th>Status</th><td>{{ ucfirst($property->status) }}</td></tr>
                    <tr><th>Description</th><td>{{ $property->description }}</td></tr>
                    <tr><th>Created At</th><td>{{ $property->created_at->format('d M Y') }}</td></tr>

                    @if ($property->image)
                    <tr>
                        <th>Image</th>
                        <td><img src="{{ asset('storage/' . $property->image) }}" alt="Image" style="max-width: 200px;" class="img-thumbnail"></td>
                    </tr>
                    @endif

                    @if ($property->video_link)
                    <tr>
                        <th>Video</th>
                        <td><a href="{{ $property->video_link }}" target="_blank">Watch Video</a></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <form action="{{ route('employee.calls.progress') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="call_id" value="{{ $call->id }}">
                @error('call_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <label for="call_details" class="form-label">Call Details</label>
                <input type="text" name="call_details" class="form-control" placeholder="Call Details" required>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection