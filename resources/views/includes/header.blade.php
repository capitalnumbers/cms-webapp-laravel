<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>

    <!-- Bootstrap -->

    <link href="{{{ url('assets/css/bootstrap/dist/css/bootstrap.min.css')}}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{{ url('assets/css/font-awesome/css/font-awesome.min.css') }}}" rel="stylesheet">
    <link href="{{{ url('assets/css/custom.css') }}}" rel="stylesheet">
   
    <!-- Custom Theme Style -->
    <link href="{{{ url('assets/build/css/custom.min.css') }}}" rel="stylesheet">
   <!-- jQuery -->
     <script src="{{{ url('assets/js/jquery.min.js') }}}"></script>
     <script type="text/javascript"> baseUrl="{{url('/')}}";</script>
    <!-- Bootstrap -->
    <script src="{{{ url('assets/js/bootstrap.min.js')}}}"></script>
    <script src="{{{ url('assets/tinymce/tinymce.min.js')}}}"></script>
  </head>
  <body class="nav-md">
     <!-- jConfirm -->
     <script src="{{{ url('assets/js/jConfirm-v2.min.js') }}}"></script>
     <script src="{{{ url('assets/js/custom.js') }}}"></script>

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('/')}}" class="site_title"><i class="fa fa-paw"></i> <span>Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img  alt="..." src="{{url('assets/images/alogin.png')}}" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome</span>
                <h2></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Admin</h3>
                <ul class="nav side-menu">
                  <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i> Dashboard </span></a>
                  </li>
                  
                  <li><a href="{{url('administrator/users')}}"><i class="fa fa-registered" ></i>Users</span></a></li>

                  <!--************** Settings Section **************-->
                  <?php $menu_array=['post-category']?>

                  <li {{{ ((in_array(Request::segment(1), $menu_array)) ? 'class=active' : '') }}}><a ><i class="fa fa-cogs" ></i>Posts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" {{ ((in_array(Request::segment(1), $menu_array)) ? 'style=display:block' : '') }}>
                        <li><a href="{{url('administrator/post-categories')}}">Post Categories</a></li>
                        <li><a href="{{url('administrator/posts')}}">Posts</a></li>
                      </ul>
                  </li>
                  <!--************** Settings Section **************-->
                  <?php $menu_array=[]?>

                  <li {{{ ((in_array(Request::segment(1), $menu_array)) ? 'class=active' : '') }}}><a ><i class="fa fa-cogs" ></i>Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" {{ ((in_array(Request::segment(1), $menu_array)) ? 'style=display:block' : '') }}>
                        <li><a href="{{url('administrator/settings')}}">Admin Settings</a></li>
                      </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu --> 

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
				<a data-toggle="tooltip" data-placement="top" title="Settings">
					<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
				</a>
				<a data-toggle="tooltip" data-placement="top" title="FullScreen">
					<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
				</a>
				<a data-toggle="tooltip" data-placement="top" title="Lock">
					<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
				</a>
				<a data-toggle="tooltip" data-placement="top" title="Logout" href="url('index.php/logout')" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
					<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
				</a>
				<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{url('assets/images/alogin.png')}}" alt="">Admin
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                      @if(Auth::user()->role=='vendor')
                      <li><a href="{{url('merchant-profile')}}"> Profile</a></li>
                      @else
                      <li><a href="{{url('user/profile')}}"> Profile</a></li>
                      @endif
                    <li><a href="{{url('user/change-password')}}">Change Password</a></li>
                    <li><a href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green"></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
