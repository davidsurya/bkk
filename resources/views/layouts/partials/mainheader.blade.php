<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->    
    <a href="{{ url('/') }}" class="logo" target="_blank">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>BKK</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Halaman Utama <b>BKK</b> </span>
    </a>    

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        @if(Auth::check())        
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>        
        @endif

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            @if(Auth::check())
                {{-- @if(Auth::user()->is('alumni'))
                    <li><a href="{{ url('/alumni/lamar') }}">Lamaran Saya <i class="fa fa-hand-o-up"></i></a></li>
                @endif --}}

                @if(Auth::user()->is('Admin'))
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a target="_blank" href="https://leona.rapidplex.com:2096/" title="Email">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success"></span>
                    </a>                    
                </li><!-- /.messages-menu -->
                @endif                        
            @endif

                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ asset(Auth::user()->img) }}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ asset(Auth::user()->img) }}" class="img-circle" alt="User Image" />
                                <p>
                                    {{ Auth::user()->name }}
                                    <?php $date = new Date(Auth::user()->created_at); ?> 
                                    <small>Menjadi anggota sejak {{ $date->format('F Y') }}</small>
                                </p>
                            </li>                            
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    @if(Auth::user()->is('admin'))
                                        <a href="{{ url('/admin/profil') }}" class="btn btnprofil btn-flat">Profil <span class="fa fa-user"></span></a>
                                    @else
                                        <a href="{{ url('/alumni/profil') }}" class="btn btnprofil btn-flat">Profil <span class="fa fa-user"></span></a>
                                    @endif
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-flat btnlogout">Keluar <span class="fa fa-sign-out"></span></a>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>