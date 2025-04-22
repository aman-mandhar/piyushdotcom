@extends('layouts.front.layout')
@section('content')
<div class="container">
    <h2 class="mb-4">My Vehicles</h2>

    @if($vehicles->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Brand & Model</th>
                    <th>City</th>
                    <th>Price (₹)</th>
                    <th>Reg. Year</th>
                    <th>Post on</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicles as $vehicle)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vehicle->brand }} {{ $vehicle->model }} <small>({{ $vehicle->variant }})</small></td>
                        <td>{{ $vehicle->city->name ?? '-' }}</td>
                        <td>₹ {{ number_format($vehicle->price) }}</td>
                        <td>{{ $vehicle->registration_year }}</td>
                        <td>{{ $vehicle->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('vehicles.show', $vehicle->slug) }}" class="btn btn-sm btn-info">View</a>
                            @if($vehicle->user_id == auth()->id())
                                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        
    @else
        <div class="alert alert-info">You haven't posted any vehicles yet.</div>
    @endif
</div>
@endsection
