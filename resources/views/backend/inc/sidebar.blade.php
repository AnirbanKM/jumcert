<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    {{-- Dashboard Route --}}
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- All Details --}}
    <div class="sidebar-heading">
        Category
    </div>

    {{-- Category Route --}}
    <li class="nav-item {{ request()->routeIs('admin.category') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.category') }}">
            <i class="fa fa-list-alt"></i>
            <span>Category</span>
        </a>
    </li>

    {{-- User Info --}}
    <div class="sidebar-heading">
        Site Info
    </div>

    <!-- Nav Item - view Site info -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Media Info</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Media info</h6>

                {{-- user created channel --}}
                <a class="collapse-item {{ request()->routeIs('admin.user_channel') ? 'active' : '' }}"
                    href="{{ route('admin.user_channel') }}">
                    User created channel
                </a>

                {{-- user created playlist --}}
                <a class="collapse-item {{ request()->routeIs('admin.user_playlist') ? 'active' : '' }}"
                    href="{{ route('admin.user_playlist') }}">
                    User created playlist
                </a>

                {{-- user uploaded videos --}}
                <a class="collapse-item {{ request()->routeIs('admin.user_video') ? 'active' : '' }}"
                    href="{{ route('admin.user_video') }}">
                    User Uploaded Videos
                </a>

                {{-- uAll Registered Users --}}
                <a class="collapse-item {{ request()->routeIs('admin.all_user') ? 'active' : '' }}"
                    href="{{ route('admin.all_user') }}">
                    All Registered Users
                </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Payment Info
    </div>

    <!-- Nav Item - view payment info -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Payment Info</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Payment info</h6>

                {{-- user created channel --}}
                <a class="collapse-item {{ request()->routeIs('admin.payments_info') ? 'active' : '' }}"
                    href="{{ route('admin.payments_info') }}">
                    User payment info
                </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Commission Info
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-cog"></i>
            <span>Commission</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Set Commission</h6>

                {{-- Admin Commission route --}}
                <a class="collapse-item {{ request()->routeIs('admin.add_commision') ? 'active' : '' }}"
                    href="{{ route('admin.add_commision') }}">
                    Set Commission
                </a>
                <a class="collapse-item {{ request()->routeIs('admin.view_all_commission') ? 'active' : '' }}"
                    href="{{ route('admin.view_all_commission') }}">
                    View Commission
                </a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
