@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\UserProfile;
    use App\Models\Role;
    use App\Models\User;

    $current = User::find(Auth::user()->id);
    $role = Role::find($current->role_id);
    $userProfile = UserProfile::where('user_id', $current->id)->first();
    $picture = $userProfile && $userProfile->profile_picture ? asset($userProfile->profile_picture) : asset('dashboard/dist/img/my-avatar.png');
@endphp
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('storage/' . $picture) }}" class="user-image" alt="User Image"/>
          <span class="hidden-xs">{{ Auth::user()->name }}</span>
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
            <a class="active-menu"  href="{{ route('customer.dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a>
        </li>
        
        <li>
          <a href="{{route('home')}}"><i class="fa fa-user"></i> Home</a>
        </li>

        <li>
            <a href="{{route('calls.my-calls')}}"><i class="fa fa-phone"></i> My Call History</a>
        </li>
        
        <li>
            <a href="{{route('properties.my-properties')}}"><i class="fa fa-home"></i>My Properties</a>
        </li>	
        
        <li>
            <a href="{{route('vehicles.my-vehicles')}}"><i class="fa fa-car"></i>My Vehicles</a>
        </li>
        
        <li>
            <a href="{{route('directory.my-directories')}}"><i class="fa fa-building"></i>My Directory List</a>
        </li>				
        
        <li>
            <a href="{{route('my-login.history')}}"><i class="fa fa-lock"></i> Login History</a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>