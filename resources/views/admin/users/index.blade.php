@extends('layouts.dashboard.admin.layout')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 fw-semibold">Search User</h2>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search Form --}}
    <form action="{{ route('admin.users.search') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="query" class="form-control" placeholder="Search name, email, mobile...">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    {{-- All Users Table --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach($allUsers as $user)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile_number }}</td>
                            <td>{{ $user->role->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit-role', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                    Change Role
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    @if($allUsers->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">No users found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
