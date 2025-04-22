@extends('layouts.dashboard.employee.layout')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Business: {{ $directory->name }}</h2>
    @livewire('employee-call-register')
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $directory->name }}</td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td>{{ $directory->address }}</td>
                    </tr>

                    <tr>
                        <th>City</th>
                        <td>{{ $directory->city->name ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Mobile</th>
                        <td>
                            <a href="tel:{{ $directory->mobile }}">{{ $directory->mobile }}</a>
                        </td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>
                            <a href="mailto:{{ $directory->email }}">{{ $directory->email }}</a>
                        </td>
                    </tr>

                    <tr>
                        <th>Business Type</th>
                        <td>{{ $directory->business_type }}</td>
                    </tr>

                    @if ($directory->video_link)
                    <tr>
                        <th>Video Link</th>
                        <td>
                            <a href="{{ $directory->video_link }}" target="_blank">Watch Video</a>
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <th>Added By</th>
                        <td>{{ $directory->user->name ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <th>Created At</th>
                        <td>{{ $directory->created_at->format('d M Y h:i A') }}</td>
                    </tr>

                    <tr>
                        <th>Updated At</th>
                        <td>{{ $directory->updated_at->format('d M Y h:i A') }}</td>
                    </tr>
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