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
          <img src="{{ $picture }}" class="user-image" alt="User Image" />
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
            <a class="active-menu"  href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a>
        </li>
        
        <li>
          <a href="{{route('home')}}"><i class="fa fa-user"></i> Home</a>
        </li>

        <li>
            <a href="{{route('admin.calls.index')}}"><i class="fa fa-phone"></i> All Call History</a>
        </li>
        
        <li>
            <a href="{{route('admin.calls.property')}}"><i class="fa fa-home"></i> Property Calls</a>
        </li>	
        
        <li>
            <a href="{{route('admin.calls.vehicle')}}"><i class="fa fa-car"></i> Vehicle Calls</a>
        </li>
        
        <li>
            <a href="{{route('admin.calls.directory')}}"><i class="fa fa-building"></i> Construction Calls </a>
        </li>				
                          
        <li>
            <a href="#"><i class="fa fa-shopping-cart"></i> Orders</a>
        </li>
        <li>
            <a href="{{route('login.history')}}"><i class="fa fa-lock"></i> Login History</a>
        </li>
        <li>
          <a href="{{route('admin.users.index')}}"><i class="fa fa-user"></i> Appoint an Employee </a>
      </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>