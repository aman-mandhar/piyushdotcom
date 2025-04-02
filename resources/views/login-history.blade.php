@extends('layouts.dashboard.admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Login History</h4>
                        <p class="card-category">List of all login activities</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User-Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Login</th>
                                        <th>Logout</th>
                                        <th>IP Address</th>
                                        <th>Device</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $key => $log)
                                        @php
                                            $user = \App\Models\User::find($log->user_id);
                                            $profile = \App\Models\UserProfile::where('user_id', $log->user_id)->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $log->user_id }}</td>
                                            <td>
                                                @if($profile->profile_picture)
                                                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" width="50">
                                                @else
                                                    <span class="text-danger">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $log->login_at }}</td>
                                            <td>{{ $log->logout_at ?? 'Still Logged In' }}</td>
                                            <td>{{ $log->ip_address }}</td>
                                            <td>{{ $log->user_agent }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
