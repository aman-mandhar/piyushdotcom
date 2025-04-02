@extends('layouts.dashboard.admin.layout')
@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" name="profile_picture" class="form-control">
            @if($profile->profile_picture)
                <img src="{{ asset('storage/' . $profile->profile_picture) }}" width="100">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->phone) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ old('dob', $profile->dob) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control">{{ old('address', $profile->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $profile->city) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">State</label>
            <input type="text" name="state" class="form-control" value="{{ old('state', $profile->state) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Country</label>
            <input type="text" name="country" class="form-control" value="{{ old('country', $profile->country) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Zip Code</label>
            <input type="text" name="zipcode" class="form-control" value="{{ old('zipcode', $profile->zipcode) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-control">
                <option value="">Select Gender</option>
                <option value="Male" {{ $profile->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $profile->gender == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ $profile->gender == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea name="bio" class="form-control">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
