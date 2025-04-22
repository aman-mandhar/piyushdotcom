@extends('layouts.front.layout')
@section('title', 'Directory of Construction Business')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Latest Directory of Construction Business</h4>
        <a href="{{ route('directory.create') }}" class="btn btn-success">
            + Add New Business
        </a>
    </div>
    <form action="{{ route('directory.search') }}" method="GET" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="keyword" class="form-control" placeholder="Search by name, mobile, or email">
        </div>
        <div class="col-md-3">
            <select name="city_id" class="form-select">
                <option value="">All Cities</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Search</button>
        </div>
    </form>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Business Name</th>
                <th>City</th>
                <th>Business Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($directories as $index => $directory)
                <tr>
                    <td>{{ $directories->firstItem() + $index }}</td>
                    <td>{{ $directory->name }}</td>
                    <td>{{ $directory->city->name ?? '-' }}</td>
                    <td>
                        @foreach(explode(',', $directory->business_type) as $type)
                            <span class="badge bg-info text-dark">{{ $type }}</span>
                        @endforeach
                    </td>
                    <td>
                        <!-- Show actions based on ownership -->
                        @if(Auth::check() && Auth::id() === $directory->user_id)
                            <a href="{{ route('directory.show', $directory->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('directory.edit', $directory->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('directory.destroy', $directory->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                        @else
                            <a href="{{ route('directory.show', $directory->id) }}" class="btn btn-sm btn-info">View</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Pagination -->
    <div class="mt-3">
        {{ $directories->links() }}
    </div>
</div>
@endsection    