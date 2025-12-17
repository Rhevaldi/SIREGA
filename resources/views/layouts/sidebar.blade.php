<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light ml-3">SIREGA</span>
    </a>


    <div class="sidebar">


        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    {{ auth()->user()->name }}
                    <small class="d-block text-muted">{{ auth()->user()->role }}</small>
                </a>
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
                    <li class="nav-item">
                        <a href="{{ route('rt.index') }}" class="nav-link {{ request()->is('rt*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Data RT</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('warga.index') }}" class="nav-link {{ request()->is('warga*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Warga</p>
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
