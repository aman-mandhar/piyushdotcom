@extends('layouts.front.layout')

@section('title', 'My Properties')
@section('description', 'Manage your posted properties.')
@section('og_title', 'My Properties')
@section('og_url', url()->current())

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Latest Properties Archive</h4>
        <a href="{{ route('properties.create') }}" class="btn btn-success">
            + Add New Property
        </a>
    </div>

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
                            <p class="mb-1"><strong>Price:</strong> ₹{{ number_format($property->price) }} {{ $property->price_in_unit }}</p>
                            <p class="mb-1"><strong>Type:</strong> {{ $property->property_type }} | {{ $property->listing_type }}</p>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-sm btn-outline-primary">View</a>
                            
                                @auth
                                    @if($property->user_id == auth()->user()->id)
                                        <a href="{{ route('properties.edit', $property->slug) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            
                                        <form action="{{ route('properties.destroy', $property->slug) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Not Found.
        </div>
    @endif
</div>
@endsection
