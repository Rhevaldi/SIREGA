<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link font-italic font-weight-bold" data-toggle="dropdown" href="#">
                {{ env('APP_NAME') }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    Profile
                </a> --}}

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger">Logout</button>
                </form>
            </div>
        </li>
    </ul>

</nav>
