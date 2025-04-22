@extends('layouts.dashboard.employee.layout')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">📞 All Call Logs</h2>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Called By</th>
                    <th>Mobile</th>
                    <th>Calling for</th>
                    <th>City</th>
                    <th>Call Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($calls as $index => $call)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $call->user->name }}</td>
                        <td>
                            <a href="tel:{{ $call->user->mobile_number }}">
                                {{ $call->user->mobile_number }}
                            </a>
                        </td>
                        <td>
                            @php
                                $callInCallProgress = App\Models\CallProgress::where('call_id', $call->id)->first();
                            @endphp
                            @if ($callInCallProgress == null)
                                @if ($call->property_id)
                                    <a href="{{ route('properties.show-all', $call->id) }}">
                                        Property - {{ $call->property->property_title ?? '—' }}<br>ID - {{ $call->property_id }}
                                    </a>
                                @elseif ($call->vehicle_id)
                                    <a href="{{ route('vehicles.show-all', $call->id) }}">
                                        Vehicle - {{ $call->vehicle->model ?? '—' }}<br>ID - {{ $call->vehicle_id }}
                                    </a>
                                @elseif ($call->directory_id)
                                    <a href="{{ route('directory.show-all', $call->id) }}">
                                        Directory - {{ $call->directory->name ?? '—' }}<br>ID - {{ $call->directory_id }}
                                    </a>
                                @else
                                    <span class="text-muted">No specific item</span>
                                @endif
                            @else
                                @if ($call->property_id)
                                    Property - {{ $call->property->property_title ?? '—' }}<br>ID - {{ $call->property_id }}
                                @elseif ($call->vehicle_id)
                                    Vehicle - {{ $call->vehicle->model ?? '—' }}<br>ID - {{ $call->vehicle_id }}
                                @elseif ($call->directory_id)
                                    Directory - {{ $call->directory->name ?? '—' }}<br>ID - {{ $call->directory_id }}
                                @else
                                    <span class="text-muted">No specific item</span>
                                @endif
                            @endif
                        </td>
                        <td>{{ $call->city->name ?? '-' }}</td>
                        <td>{{ $call->created_at->format('d M Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">No calls found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection