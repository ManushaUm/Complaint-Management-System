@auth
<div class="navbar-header">
    <div class="d-flex align-items-center">
        <!-- LOGO -->


        <div class="shrink-0 d-flex align-items-center">
            <a href="{{ route('dashboard') }}">
                <x-application-logo />
            </a>
        </div>
    </div>

    <div class="d-flex align-items-center">
        <!-- Fullscreen Button -->
        <div class="dropdown d-none d-lg-inline-block ms-1">
            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                <i class="bx bx-fullscreen"></i>
            </button>
        </div>

        <!-- Notification Dropdown -->
        <div class="dropdown d-inline-block position-relative">
            <button class="btn header-item noti-icon waves-effect" id="notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-bell bx-tada"></i>
                <span class="badge bg-danger rounded-pill">3</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="notifications-dropdown">
                <li><a class="dropdown-item text-reset" href="#">New Notification</a></li>
                <li><a class="dropdown-item text-reset" href="#">Another Notification</a></li>
            </ul>
        </div>

        <!-- User Profile Dropdown -->
        <div class="dropdown d-inline-block position-relative">
            <button class="btn header-item waves-effect" id="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="../../../assets/images/users/avatar-1.jpg" alt="User Avatar">
                <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user-dropdown">
                <li><a class="dropdown-item" href="#"><i class="bx bx-user me-2"></i> Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="bx bx-cog me-2"></i> Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bx bx-power-off me-2 text-danger"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endauth