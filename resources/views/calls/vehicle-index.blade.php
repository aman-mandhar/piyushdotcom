@extends('layouts.dashboard.admin.layout')
@section('title', 'Vehicle Call History')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">📞 Vehicle Call History</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Called By</th>
                <th>Calling for</th>
                <th>City</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($calls as $index => $call)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $call->user->name }}</td>
                    <td>
                        @if ($call->property_id) Property - {{ $call->property->property_title ?? '—' }} || ID - {{ $call->property_id }}
                        @elseif ($call->vehicle_id) Vehicle - {{ $call->vehicle->model ?? '—' }} || ID - {{ $call->vehicle_id }}
                        @elseif ($call->directory_id) Directory - {{ $call->directory->name ?? '—' }} || ID - {{ $call->directory_id }}
                        @endif
                    </td>
                    <td>{{ $call->city->name ?? '-' }}</td>
                    <td>{{ $call->created_at->format('d M Y h:i A') }}</td>
                    <td>
                        @if($call->property_id)<a href="{{ route('properties.show', $call->property->slug) }}" class="btn btn-primary">View Property</a>
                        @elseif($call->vehicle_id)<a href="{{ route('vehicles.show', $call->vehicle->slug) }}" class="btn btn-primary">View Vehicle</a>
                        @elseif($call->directory_id)<a href="{{ route('directory.show', $call->directory_id) }}" class="btn btn-primary">View Directory</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No calls found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection