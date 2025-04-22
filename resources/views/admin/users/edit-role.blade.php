@extends('layouts.dashboard.admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mb-4 fw-semibold">Change Role for <span class="text-primary">{{ $user->name }}</span></h2>

            <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="role_id" class="form-label fw-semibold">Select Role</label>
                    <select name="role_id" id="role_id" class="form-select">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-3 mt-3">
                    <button type="submit" class="btn btn-success">Update Role</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
