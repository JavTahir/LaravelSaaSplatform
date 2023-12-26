
    <!-- Vertical Navbar -->
    <nav
      class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg"
      id="navbarVertical"
    >
      <div class="container-fluid">
        <!-- Toggler -->
        <button
          class="navbar-toggler ms-n2"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#sidebarCollapse"
          aria-controls="sidebarCollapse"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
          <img src="images/probizlogo2.png" alt="..." />
        </a>
        <!-- User menu (mobile) -->
        <div class="navbar-user d-lg-none">
          <!-- Dropdown -->
          <div class="dropdown">
            <!-- Toggle -->
            <a
              href="#"
              id="sidebarAvatar"
              role="button"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <div class="avatar-parent-child">
                <img
                  alt="Image Placeholder"
                  src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                  class="avatar avatar- rounded-circle"
                />
                <span class="avatar-child avatar-badge bg-success"></span>
              </div>
            </a>
            <!-- Menu -->
            <div
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="sidebarAvatar"
            >
              <a href="#" class="dropdown-item">Profile</a>
              <a href="#" class="dropdown-item">Settings</a>
              <a href="#" class="dropdown-item">Billing</a>
              <hr class="dropdown-divider" />
              <a href="#" class="dropdown-item">Logout</a>
            </div>
          </div>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
          <!-- Navigation -->
          <ul class="navbar-nav">
            <li class="nav-item ">
              <a class="nav-link {{ Request::is('dashboardadm') ? 'navbar_active' : '' }}" href="">
                <i class="bi bi-house-fill"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('analytics-adm') ? 'navbar_active' : '' }}" href="{{ route('analytics-adm') }}">
              <i class="bi bi-bar-chart-line-fill"></i> Analytics
              </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{ Request::is('users') ? 'navbar_active' : '' }}" href="{{ route('users') }}">
                <i class="bi bi-people-fill"></i>Users
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('payment') ? 'navbar_active' : '' }}" href="">
                <i class="bi bi-credit-card-2-front-fill"></i> Payment
              </a>
            </li>


          </ul>
          <!-- Divider -->
          <hr class="navbar-divider my-5 opacity-20" />
          <!-- Navigation -->

          <!-- Push content down -->
          <div class="mt-auto"></div>
          <!-- User (md) -->
          <ul class="navbar-nav">
          <li class="nav-item ">
                <a class="nav-link {{ Request::is('aanalytics') ? 'navbar_active' : '' }}" href="{{ route('profile') }}">
                  <i class="bi bi-gear-fill"></i> Profile Settings
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('janalytics') ? 'navbar_active' : '' }}" href="#">
                <i class="bi bi-box-arrow-left"></i> Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

