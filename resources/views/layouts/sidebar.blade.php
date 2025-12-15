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

       
                @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ url('/admin/dashboard') }}"
                            class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('warga.index') }}"
                            class="nav-link {{ request()->is('warga*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Warga</p>
                        </a>
                    </li>

                    <li class="nav-header">MASTER DATA</li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Pengaturan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>RT</p>
                                </a>
                            </li>
                        </ul>
                    </li>

    
                @else
                    <li class="nav-item">
                        <a href="{{ url('/user/dashboard') }}"
                            class="nav-link {{ request()->is('user/dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('warga.index') }}"
                            class="nav-link {{ request()->is('warga*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Data Saya</p>
                        </a>
                    </li>
                @endif


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
