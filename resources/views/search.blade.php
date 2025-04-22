@extends('layouts.front.layout')

@section('title', 'Browse Properties')
@section('description', 'Find properties for sale, rent, lease or collaboration across India.')
@section('og_title', 'Property Listings')
@section('og_url', url()->current())

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Explore Properties</h3>

    @if($properties->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $property)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $property->image) }}" alt="Image of {{ $property->title }}" style="height: 90px; object-fit: cover;">
                            </td>
                            <td>{{ $property->property_title }}</td>
                            <td>{{ $property->location }}</td>
                            <td>₹{{ number_format($property->price) }} {{ $property->price_in_unit }}</td>
                            <td>{{ $property->property_type }} | {{ $property->listing_type }}</td>
                            <td>
                                <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{-- Preserve search filters on pagination --}}
            {{ $properties->appends(request()->query())->links() }}
        </div>
    @else
        <div class="alert alert-info">
            No properties found for your search.
        </div>
    @endif
</div>
@endsection
