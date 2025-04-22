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
<header class="main-header">
    <!-- Logo -->
    <a href="{{route('profile.show', $current)}}" class="logo"><b>{{$role->name}}</b></a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ $picture }}" class="user-image" alt="User Image" />
              <span class="hidden-xs">{{$current->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ $picture }}" class="user-image" alt="User Image" />
                <p>
                  {{$current->name}}
                  <small>Joined on : {{$current->created_at}}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('profile.show', $current)}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>