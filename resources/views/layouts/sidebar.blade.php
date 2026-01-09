<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset(env('APP_LOGO_PATH')) }}" alt="AdminLTE Logo" class="brand-image mx-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">SIREGA</span>
    </a>

    <div class="sidebar">


        <div class="user-panel py-2 d-flex">
            <div class="image mt-2">
                <img src="{{ asset('adminlte/img/user1-128x128.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-uppercase">
                    {{ auth()->user()->name }}
                </a>
                <small class="d-block text-muted text-capitalize">{{ auth()->user()->roles()->first()->name }}</small>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">


                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @role('admin')
                    <div class="nav-header">MANAJEMEN DATA</div>
                    {{-- <li class="nav-item">
                        <a href="{{ route('desa.index') }}" class="nav-link {{ request()->is('desa*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map-marker-alt"></i>
                            <p>Data Desa</p>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('rt.index') }}" class="nav-link {{ request()->is('rt*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Data RT</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('warga.index') }}" class="nav-link {{ request()->is('warga*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Warga</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('media_warga.index') }}"
                            class="nav-link {{ request()->is('media_warga*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-images"></i>
                            <p>Media Warga</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}"
                            class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-balance-scale"></i>
                            <p>Indikator Warga</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('bansos.index') }}"
                            class="nav-link {{ request()->is('bansos*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hand-holding-heart"></i>
                            <p>Program Bansos</p>
                        </a>
                    </li>


                    <div class="nav-header">LAPORAN</div>
                    <li class="nav-item">
                        <a href="{{ route('reports.warga') }}"
                            class="nav-link {{ request()->routeIs('reports.warga') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Data Warga</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-archive"></i>
                            <p>Penerima Bantuan</p>
                        </a>
                    </li>
                @endrole

                <div class="nav-header">SISTEM</div>
                @role('superadmin')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Pengguna</p>
                        </a>
                    </li>
                @endrole
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                        class="nav-link {{ request()->is('profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Akun Saya</p>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link btn btn-link text-left text-white">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
