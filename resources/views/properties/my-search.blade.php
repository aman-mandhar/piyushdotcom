@extends('layouts.front.layout')

@section('title', 'My Properties')
@section('description', 'Manage your posted properties.')
@section('og_title', 'My Properties')
@section('og_url', url()->current())

@section('content')
@guest
    <x-login-modal />
    <x-register-modal />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });
    </script>
@endguest
@auth
<div class="container my-5">
    <form action="{{ route('properties.my-search') }}" method="GET">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="number" name="min-price" class="form-control" placeholder="10" value="{{ request('min-price') }}">
            </div>
            <div class="col-md-3">
                <input type="number" name="max-price" class="form-control" placeholder="25" value="{{ request('max-price') }}">
            </div>
            <div class="col-md-3">
                <select name="price_in_unit" class="form-select">
                    <option value="Lakh">Lakh</option>
                    @foreach(['Thousand', 'Lakh', 'Crore', 'Millon', 'Billon', 'Trillion'] as $unit)
                        <option value="{{ $unit }}" {{ request('price_in_unit') == $unit ? 'selected' : '' }}>
                            {{ $unit }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>
    <h2 class="mb-4 text-primary">Search Results</h2>

    {{-- Show total results --}}
    <div class="mb-3">
        <strong>{{ $properties->total() }}</strong> results found.
    </div>

    {{-- Loop through properties --}}
    @forelse($properties as $property)
        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($property->image)
                    <img src="{{ asset('storage/' . $property->image) }}" class="img-fluid rounded w-100 shadow" alt="Property Image">
                    @else
                        <img src="https://via.placeholder.com/300x200" class="img-fluid rounded-start" alt="No Image">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="card-text">
                            <strong>Location:</strong> {{ $property->location }}<br>
                            <strong>Type:</strong> {{ $property->property_type }} | {{ $property->listing_type }}<br>
                            <strong>Price:</strong> ₹{{ number_format($property->price) }}
                        </p>
                        <p class="card-text"><small class="text-muted">Posted by {{ $property->user->name ?? 'N/A' }} in {{ $property->city->name ?? 'N/A' }}</small></p>
                        <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">No properties found matching your search.</div>
    @endforelse

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $properties->links() }}
    </div>
</div>
@endauth
@endsection