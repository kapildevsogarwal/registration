{{-- resources/views/adminlte/partials/header.blade.php --}}
<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/users') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>JMJ Infrastructure</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>JMJ Infrastructure</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <i class="fas fa-bars"></i>
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					{{--<img src="{{ asset('images/users/') }}/{{Auth::user()->profile_image}}" class="user-image" alt="User Image">--}}
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
						{{--<img src="<?php //echo asset('storage/documents/'.Auth::user()->id.'/'.Auth::user()->user_photo)?>" class="img-circle" alt="User Image"> --}}

                            <p>
                                {{ Auth::user()->name }}
                                <!-- <small>Member since {{ Auth::user()->created_at->format('M Y') }}</small> -->
                            </p>
                        </li>
                        <!-- Menu Body -->
                        {{-- <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li> --}}
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                {{-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> --}}
            </ul>
        </div>

    </nav>
</header>