@extends('layouts.front.layout')

@section('title', 'My Properties')
@section('description', 'Manage your posted properties.')
@section('og_title', 'My Properties')
@section('og_url', url()->current())

@section('content')
@livewire('search-property')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">My Posted Properties</h4>
        <a href="{{ route('customer.properties.create') }}" class="btn btn-success">
            + Add New Property
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($properties->count())
        <div class="row g-4">
            @foreach($properties as $property)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top" alt="Image of {{ $property->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="mb-1"><strong>Location:</strong> {{ $property->location }}, {{ $property->city->name }}</p>
                            <p class="mb-1"><strong>Price:</strong> ₹{{ number_format($property->price) }}</p>
                            <p class="mb-1"><strong>Type:</strong> {{ $property->property_type }} | {{ $property->listing_type }}</p>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="{{ route('customer.properties.edit', $property) }}" class="btn btn-sm btn-outline-warning">Edit</a>

                                <form action="{{ route('customer.properties.destroy', $property) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $properties->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">
            You haven't posted any properties yet.
        </div>
    @endif
</div>
@endsection
