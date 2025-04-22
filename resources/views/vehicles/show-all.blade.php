@extends('layouts.dashboard.employee.layout')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Vehicle: {{ $vehicle->brand }} {{ $vehicle->model }}</h2>
    @livewire('employee-call-register')
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr><th>Brand</th><td>{{ $vehicle->brand }}</td></tr>
                    <tr><th>Model</th><td>{{ $vehicle->model }}</td></tr>
                    <tr><th>Variant</th><td>{{ $vehicle->variant }}</td></tr>
                    <tr><th>Registration Number</th><td>{{ $vehicle->registration_number }}</td></tr>
                    <tr><th>Registration Year</th><td>{{ $vehicle->registration_year }}</td></tr>
                    <tr><th>KM Driven</th><td>{{ $vehicle->km_driven }} km</td></tr>
                    <tr><th>Fuel Type</th><td>{{ $vehicle->fuel_type }}</td></tr>
                    <tr><th>Transmission</th><td>{{ $vehicle->transmission }}</td></tr>
                    <tr><th>Number of Owners</th><td>{{ $vehicle->no_of_owners }}</td></tr>
                    <tr><th>Insurance Status</th><td>{{ $vehicle->insurance_status }}</td></tr>

                    {{-- Owner Info --}}
                    <tr><th>Owner Name</th><td>{{ $vehicle->owner_name }}</td></tr>
                    <tr><th>Mobile</th><td>{{ $vehicle->owner_mobile }}</td></tr>
                    <tr><th>Email</th><td>{{ $vehicle->owner_email }}</td></tr>
                    <tr><th>Address</th><td>{{ $vehicle->owner_address }}</td></tr>
                    <tr><th>City</th><td>{{ $vehicle->city->name ?? '-' }}</td></tr>

                    {{-- Description --}}
                    <tr><th>Description</th><td>{{ $vehicle->description }}</td></tr>
                    <tr><th>Price</th><td>₹{{ number_format($vehicle->price) }}</td></tr>
                    <tr><th>Verification</th><td>{{ $vehicle->is_verified ? 'Verified' : 'Not Verified' }}</td></tr>
                    <tr><th>Status</th><td>{{ ucfirst($vehicle->status) }}</td></tr>

                    {{-- Conditional: Accident --}}
                    <tr><th>Any Accident</th><td>{{ $vehicle->any_accident ? 'Yes' : 'No' }}</td></tr>
                    @if ($vehicle->any_accident)
                        <tr><th>Accident Detail</th><td>{{ $vehicle->accident_detail }}</td></tr>
                    @endif

                    {{-- Conditional: Loan --}}
                    <tr><th>Loan Running</th><td>{{ $vehicle->loan_running ? 'Yes' : 'No' }}</td></tr>
                    @if ($vehicle->loan_running)
                        <tr><th>Bank Name</th><td>{{ $vehicle->loan_bank_name }}</td></tr>
                        <tr><th>Pending EMIs</th><td>{{ $vehicle->pending_emis }}</td></tr>
                        <tr><th>EMI Amount</th><td>₹{{ number_format($vehicle->emi_amount) }}</td></tr>
                    @endif

                    {{-- Image --}}
                    @if ($vehicle->featured_image)
                        <tr>
                            <th>Featured Image</th>
                            <td>
                                <img src="{{ asset('storage/' . $vehicle->featured_image) }}"
                                     alt="Vehicle Image" class="img-thumbnail" style="max-width: 250px;">
                            </td>
                        </tr>
                    @endif

                    <tr><th>Posted On</th><td>{{ $vehicle->created_at->format('d M Y') }}</td></tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <form action="{{ route('employee.calls.progress') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="call_id" value="{{ $call->id }}">
                @error('call_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <label for="call_details" class="form-label">Call Details</label>
                <input type="text" name="call_details" class="form-control" placeholder="Call Details" required>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection