<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link font-weight-bold">Dashboard</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" target="_blank" class="nav-link text-info">
                <i class="fas fa-external-link-alt mr-1"></i> View Site
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">5</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header font-weight-bold">Pending Actions</span>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.offer.index') }}" class="dropdown-item">
                    <i class="fas fa-file-invoice-dollar mr-2 text-primary"></i> New Offers
                    <span class="float-right text-muted text-sm">3 requests</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.free-sample.index') }}" class="dropdown-item">
                    <i class="fas fa-vial mr-2 text-success"></i> Sample Requests
                    <span class="float-right text-muted text-sm">2 requests</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.offer.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('back/dist/img/user2-160x160.jpg') }}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline font-weight-bold">{{ auth()->user()->name ?? 'Admin' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow border-0">
                <li class="user-header bg-navy">
                    <img src="{{ asset('back/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    <p>
                        {{ auth()->user()->name ?? 'Administrator' }}
                        <small>Member since {{ auth()->user()->created_at->format('M. Y') ?? '2025' }}</small>
                    </p>
                </li>
                <li class="user-footer bg-light d-flex justify-content-between">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-default btn-flat rounded">Profile</a>

                    {{-- Logout Form --}}
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-flat rounded"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-1"></i> Sign Out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
