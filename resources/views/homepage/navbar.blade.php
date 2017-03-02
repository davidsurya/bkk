<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="{{ url('/') }}">BKK SMK 2 Wonosari</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                {{-- <li>
                    <a class="page-scroll" href="#about">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="#services">Services</a>
                </li> --}}
                <li>
                    <a class="page-scroll" href="#about">Profil</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Kontak</a>
                </li>
                @if(Auth::guest())
                <li>
                    <a class="page-scroll" href="{{ url('/login') }}">Login</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ url('/register') }}">Register</a>
                </li>
                @else
                <li>
                    <a class="page-scroll" href="{{ url('/dashboard') }}" style="color: #F05F40;">Dashboard <span class="fa fa-sign-in"></span></a>
                </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>