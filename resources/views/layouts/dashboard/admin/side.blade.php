<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('storage/' . $userProfile->profile_picture) }}" class="user-image" alt="User Image"/>
          <span class="hidden-xs">{{ Auth::user()->name }}</span>
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">USER NAVIGATION</li>
        <li>
            <a class="active-menu"  href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a>
        </li>
        
        <li>
            <a href="tab-panel.html"><i class="fa fa-phone"></i> Call History</a>
        </li>
        
        <li>
            <a href="chart.html"><i class="fa fa-home"></i> Property Progress</a>
        </li>	
        
        <li>
            <a href="table.html"><i class="fa fa-car"></i> Vehicle Progress</a>
        </li>
        
        <li>
            <a href="form.html"><i class="fa fa-building"></i> Construction Progress </a>
        </li>				
                          
        <li>
            <a href="blank.html"><i class="fa fa-shopping-cart"></i> Orders</a>
        </li>
        <li>
            <a href="{{route('login.history')}}"><i class="fa fa-lock"></i> Login History</a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>