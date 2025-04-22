@extends('layouts.dashboard.admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <h2 class="mb-4 fw-semibold">Search Results for "<span class="text-primary">{{ $query }}</span>"</h2>

            @if ($users->isEmpty())
                <div class="alert alert-warning">No users found.</div>
            @else
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
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
                                @php $sn = 1; @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $sn++ }}</td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
