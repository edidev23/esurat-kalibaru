<nav class="navbar-default navbar-static-side fixed-menu" role="navigation">
    <div class="sidebar-collapse">
        <div id="hover-menu"></div>
        <ul class="nav metismenu" id="side-menu">
            <li class="menu-bg">
                <div class="logopanel" style="margin-left: 0px; z-index: 99999">
                    <div class="profile-element">
                        <a href="{{ url('admin') }}"><img src="{{ url('assets/images/logo-web.png') }}"></a>
                    </div>
                    <div class="logo-element">
                        <img src="{{ url('assets/images/icon.png') }}">
                    </div>
                </div>
            </li>
            <li>
                <div class="leftpanel-profile">
                    <div class="media-left">
                        <a href="{{ url('admin') }}">
                            <img src="@if(Auth::user()->foto != '' ){{ asset('upload/user/'. Auth::user()->foto) }}@else{{ asset('assets/images/profile.png') }}@endif"
                                alt="" class="media-object img-circle">
                        </a>
                    </div>
                    <div class="media-body profile-name" style="white-space:nowrap;">
                        <h4 class="media-heading">{{ Auth::user()->name }}</h4>
                        <span>@if(Auth::user()->jabatan == 'kepala_desa') Kepala Desa @elseif(Auth::user()->jabatan ==
                            'sekdes') Sekretaris @else Administrator @endif</span>
                    </div>
                </div>

            </li>
            <li>
                <div class="nano left-sidebar">
                    <div class="nano-content">
                        <ul class="nav nav-pills nav-stacked nav-inq">
                            {{-- role admin, kades, sekdes --}}
                            @if( Auth::user()->jabatan == 'kepala_desa' || Auth::user()->jabatan == 'sekdes' )
                            <li class="{{ (request()->is('kades') ? 'active' : '') }}">
                                <a href="{{ url('kades') }}"><i class="fa fa-home"></i> <span
                                        class="nav-label">Dashboards</span></a>
                            </li>

                            <li
                                class="{{ (request()->is('kades/surat-masuk', 'kades/surat-masuk/*') ? 'active' : '') }}">
                                <a href="{{ url('kades/surat-masuk') }}"><i class="fa fa-envelope"></i> <span
                                        class="nav-label">Reg. Surat masuk</span></a>
                            </li>

                            <li
                            class="{{ (request()->is('kades/surat-masuk', 'kades/surat-masuk/*') ? 'active' : '') }}">
                                <a href="{{ url('kades/surat-masuk') }}"><i class="fa fa-envelope"></i> 
                                    <span
                                        class="nav-label">Surat Keluar</span></a>
                            </li>

                            <li
                                class="{{ (request()->is('kades/surat-keluar', 'kades/surat-keluar/*') ? 'active' : '') }}">
                                <a href="{{ url('kades/surat-keluar') }}"><i class="fa fa-envelope"></i> <span
                                        class="nav-label">Reg. Surat keluar</span></a>
                            </li>

                            @endif

                            {{-- role admin only --}}
                            @if(Auth::user()->jabatan == 'admin')
                            <li class="{{ (request()->is('admin') ? 'active' : '') }}">
                                <a href="{{ url('admin') }}"><i class="fa fa-home"></i> <span
                                        class="nav-label">Dashboards</span></a>
                            </li>

                            <li class="{{ (request()->is('admin/users', 'admin/users/*') ? 'active' : '') }}">
                                <a href="{{ url('admin/users') }}"><i class="fa fa-users"></i> <span
                                        class="nav-label">User</span></a>
                            </li>
                            <li
                                class="{{ (request()->is('admin/penduduk', 'admin/penduduk/*') ? 'active' : '') }} nav-parent">
                                <a href="#"><i class="fa fa-map-signs"></i> <span class="nav-label">Penduduk</span></a>
                                <ul class="children nav">
                                    {{-- <li><a href="#">Tambah Data Penduduk</a></li> --}}
                                    <li><a href="{{ url('admin/penduduk') }}">Data Penduduk</a></li>
                                </ul>

                            </li>
                            <li
                                class="{{ (request()->is('admin/surat-masuk', 'admin/surat-masuk/*') ? 'active' : '') }}">
                                <a href="{{ url('admin/surat-masuk') }}"><i class="fa fa-envelope"></i> <span
                                        class="nav-label">Reg. Surat masuk</span></a>
                            </li>

                            <li
                            class="{{ (request()->is('admin/surat-masuk', 'admin/surat-masuk/*') ? 'active' : '') }}">
                                <a href="{{ url('admin/surat-masuk') }}"><i class="fa fa-envelope"></i> <span
                                        class="nav-label">Surat Keluar</span></a>
                            </li>

                            <li
                            class="{{ (request()->is('admin/jenis-surat-keluar', 'admin/jenis-surat-keluar/*') ? 'active' : '') }}">
                                <a href="{{ url('admin/jenis-surat-keluar') }}"><i class="fa fa-envelope"></i> <span
                                        class="nav-label">Pelayanan Surat Desa</span></a>
                            </li>

                            {{-- <li
                                class="{{ (request()->is('admin/surat-keluar', 'admin/surat-keluar/*', 'admin/jenis-surat-keluar', 'admin/jenis-surat-keluar/*') ? 'active' : '') }} nav-parent">
                                <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Surat
                                        Keluar</span></a>
                                <ul class="children nav">
                                    <li><a href="{{ url('admin/surat-keluar') }}">Surat Keluar</a></li>
                                    <li><a href="{{ url('admin/jenis-surat-keluar') }}">Jenis Surat Keluar</a></li>
                                </ul>
                            </li> --}}
                            <li
                                class="{{ (request()->is('admin/profil-desa', 'admin/profil-desa/*') ? 'active' : '') }}">
                                <a href="{{ url('admin/profil-desa') }}"><i class="fa fa-user"></i> <span
                                        class="nav-label">Profil Desa</span></a>
                            </li>
                            @endif

                            <li>
                                <a href=""><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>