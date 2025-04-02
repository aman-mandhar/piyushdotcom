@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\UserProfile;
    use App\Models\Role;
    use App\Models\User;

    $current = Auth::user();
    $role = Role::find($current->role_id);
    $userProfile = UserProfile::where('user_id', $current->id)->first();
@endphp

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                @if($userProfile && $userProfile->profile_picture)
                    <img src="{{ asset('storage/' . $userProfile->profile_picture) }}" class="user-image" alt="User Image"/>
                @else
                    <img src="{{ asset('dashboard/dist/img/user1.jpg') }}" class="user-image" alt="User Image"/>
                @endif
                <span class="hidden-xs">{{ $current->name }}</span>
            </div>
            <div class="pull-left info">
                <p>{{ $current->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>

        <!-- Sidebar menu -->
        <ul class="sidebar-menu">
            <li class="header">USER NAVIGATION</li>
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
            <li><a href="tab-panel.html"><i class="fa fa-phone"></i> Call History</a></li>
            <li><a href="chart.html"><i class="fa fa-home"></i> Property Progress</a></li>
            <li><a href="table.html"><i class="fa fa-car"></i> Vehicle Progress</a></li>
            <li><a href="form.html"><i class="fa fa-building"></i> Construction Progress</a></li>
            <li><a href="blank.html"><i class="fa fa-shopping-cart"></i> Orders</a></li>
            <li><a href="{{ route('login.history') }}"><i class="fa fa-lock"></i> Login History</a></li>
        </ul>
    </section>
</aside>
