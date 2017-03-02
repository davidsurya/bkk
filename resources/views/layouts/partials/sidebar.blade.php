<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset(Auth::user()->img) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) >
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Pencarian"/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->        
        <ul class="sidebar-menu">
            {{-- <li class="header">HEADER</li> --}}
            <!-- Optionally, you can add icons to the links -->
            @if(Auth::check())
                @if(Auth::user()->is('admin'))
                <li><a href="{{ url('/admin') }}"><i class='fa fa-home'></i> <span>Beranda</span></a></li>
                <li><a href="{{ url('/admin/alumni') }}"><i class='fa fa-user'></i> <span>Manajemen Alumni</span></a></li>
                <li><a href="{{ url('/admin/informasi') }}"><i class='fa fa-info'></i> <span>Manajemen Informasi</span></a></li>
                <li><a href="{{ url('/admin/tenaga-kerja') }}"><i class='fa fa-users'></i> <span>Keterserapan Tenaga Kerja</span></a></li>
                <li><a href="{{ url('/admin/prodi') }}"><i class='fa fa-university'></i> <span>Manajemen Jurusan</span></a></li>
                <li><a href="{{ url('/admin/industri') }}"><i class='fa fa-industry'></i> <span>Manajemen Industri</span></a></li>
                <li><a href="{{ url('/admin/pengaturan') }}"><i class='fa fa-cog'></i> <span>Pengaturan</span></a></li>
                @else
                <li><a href="{{ url('/alumni') }}"><i class='fa fa-home'></i> <span>Beranda</span></a></li>
                <li><a href="{{ url('/alumni/pemberitahuan') }}"><i class='fa fa-bell'></i><span>Pemberitahuan </span> <span class="label bg-red pull-right">{{ App\Http\Controllers\UserController::notifCount() }}</span></a></li>
                <li><a href="{{ url('/alumni/lamar') }}"><i class='fa fa-hand-o-up'></i> <span>Lamaran Saya</span></a></li>
                @endif
            @endif     
        </ul><!-- /.sidebar-menu -->       
    </section>
    <!-- /.sidebar -->
</aside>