<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="ti ti-menu-2 ti-sm"></i>
    </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <a class="nav-item nav-link search-toggler d-flex align-items-center px-0"
                href="javascript:void(0);">
                <i class="ti ti-search ti-md me-2"></i>
                <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
            </a>
        </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Language -->
        <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                data-bs-toggle="dropdown">
                <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-language="en">
                        <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                        <span class="align-middle">English</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-language="fr">
                        <i class="fi fi-fr fis rounded-circle me-1 fs-3"></i>
                        <span class="align-middle">French</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-language="de">
                        <i class="fi fi-de fis rounded-circle me-1 fs-3"></i>
                        <span class="align-middle">German</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-language="pt">
                        <i class="fi fi-pt fis rounded-circle me-1 fs-3"></i>
                        <span class="align-middle">Portuguese</span>
                    </a>
                </li>
            </ul>
        </li>
        <!--/ Language -->

        <!-- Style Switcher -->
        <li class="nav-item me-2 me-xl-0">
            <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                <i class="ti ti-md"></i>
            </a>
        </li>
        <!--/ Style Switcher -->

        <!-- Quick links  -->
        @include('components.dashboard.navbar_link')
        <!-- Quick links -->

        <!-- Notification -->
        @include('components.dashboard.navbar_notification')
        <!--/ Notification -->

        <!-- User -->
        @include('components.dashboard.navbar_user')
        <!--/ User -->
    </ul>
</div>

<!-- Search Small Screens -->
<div class="navbar-search-wrapper search-input-wrapper d-none">
    <input type="text" class="form-control search-input container-xxl border-0"
        placeholder="Search..." aria-label="Search..." />
    <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
</div>
</nav>