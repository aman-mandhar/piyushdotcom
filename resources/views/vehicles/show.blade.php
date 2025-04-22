@extends('layouts.front.layout')
@section('title', $vehicle->brand . ' ' . $vehicle->model . ' ' . $vehicle->variant)

@section('content')
<div class="container py-5">
    {{-- Vehicle Header --}}
    <div class="mb-4 border-bottom pb-2">
        <h2 class="fw-bold">{{ $vehicle->brand }} {{ $vehicle->model }} 
            <span class="text-muted small">{{ $vehicle->variant }}</span>
        </h2>
    </div>

    {{-- Featured Image --}}
    @if ($vehicle->featured_image)
        <div class="mb-4 text-center">
            <img src="{{ asset('storage/' . $vehicle->featured_image) }}"
                 class="img-fluid rounded shadow-sm"
                 style="max-height: 400px;">
        </div>
    @endif

    {{-- Vehicle Details --}}
    <div class="row g-4">
        {{-- Left Column --}}
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h5 class="mb-3">📝 Vehicle Info</h5>
                <ul class="list-unstyled">
                    <li><strong>💰 Price:</strong> ₹{{ number_format($vehicle->price) }}</li>
                    <li><strong>📅 Registration Year:</strong> {{ $vehicle->registration_year ?? 'N/A' }}</li>
                    <li><strong>🚗 KM Driven:</strong> {{ $vehicle->km_driven ?? 'N/A' }}</li>
                    <li><strong>⛽ Fuel Type:</strong> {{ $vehicle->fuel_type ?? 'N/A' }}</li>
                    <li><strong>🔀 Transmission:</strong> {{ $vehicle->transmission ?? 'N/A' }}</li>
                    <li><strong>👤 Owners:</strong> {{ $vehicle->no_of_owners ?? 'N/A' }}</li>
                    <li><strong>🛡️ Insurance:</strong> {{ $vehicle->insurance_status ?? 'N/A' }}</li>
                    <li><strong>🏙️ City:</strong> {{ $vehicle->city->name ?? 'N/A' }}</li>
                </ul>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h5 class="mb-3">🔎 Additional Info</h5>

                {{-- Accident Info --}}
                <p>
                    <strong>🛑 Accident History:</strong>
                    {{ $vehicle->any_accident ? 'Yes' : 'No' }}
                </p>
                @if ($vehicle->any_accident)
                    <p><strong>Details:</strong> {{ $vehicle->accident_detail }}</p>
                @endif

                {{-- Loan Info --}}
                <p>
                    <strong>💳 Loan Running:</strong>
                    {{ $vehicle->loan_running ? 'Yes' : 'No' }}
                </p>
                @if ($vehicle->loan_running)
                    <ul class="list-unstyled ps-3">
                        <li><strong>🏦 Bank:</strong> {{ $vehicle->loan_bank_name }}</li>
                        <li><strong>📆 Pending EMIs:</strong> {{ $vehicle->pending_emis }}</li>
                        <li><strong>💸 EMI Amount:</strong> ₹{{ number_format($vehicle->emi_amount) }}</li>
                    </ul>
                @endif

                {{-- Call Button / Edit-Delete --}}
                @auth
                    @php $city_id = $vehicle->city_id; @endphp

                    @if ($vehicle->user_id == auth()->user()->id)
                        <div class="alert alert-success mt-3">This vehicle is listed by you.</div>

                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('vehicles.edit', $vehicle->slug) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                            <form action="{{ route('vehicles.destroy', $vehicle->slug) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('calls.store') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="city_id" value="{{ $city_id }}">
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                            <input type="hidden" name="mobile" value="+919216051212">

                            <button type="submit" class="btn btn-success w-100">📞 Call Now</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    {{-- Description --}}
    @if ($vehicle->description)
        <div class="card p-4 mt-5 shadow-sm">
            <h5 class="mb-3">📝 Description</h5>
            <p>{{ $vehicle->description }}</p>
        </div>
    @endif
</div>
@endsection
