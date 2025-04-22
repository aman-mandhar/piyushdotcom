<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div x-data="{ open: false }">
                <button class="btn btn-info mb-3" @click="open = !open">📋 View Call Register</button>

                <div x-show="open" @click.outside="open = false" class="card p-3 shadow-sm">
                    <table class="table table-bordered table-hover table-responsive">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Mobile</th>
                                <th>Calling For</th>
                                <th>City</th>
                                <th>Call Date</th>
                                <th>Progress Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($callRegister as $index => $call)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $call->user_name }}</td>
                                    <td><a href="tel:{{ $call->mobile_number }}">{{ $call->mobile_number }}</a></td>
                                    <td>
                                        @if ($call->property_title)
                                            Property - {{ $call->property_title }}
                                        @elseif ($call->vehicle_model)
                                            Vehicle - {{ $call->vehicle_model }}
                                        @elseif ($call->directory_name)
                                            Directory - {{ $call->directory_name }}
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $call->city_name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($call->call_date)->format('d M Y h:i A') }}</td>
                                    <td>{{ $call->call_details }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center text-muted">No call progress found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

