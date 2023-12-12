
    

<header class="bg-surface-primary border-bottom d-none d-lg-block pt-3 pb-3">
    <div class="container-fluid">
        <div class="mb-npx">
            <div class="row align-items-center">
                <div class="col-sm-6 mb-4 mb-sm-0">
                    <!-- Title -->
                </div>

                <!-- Actions -->
                <div class="col-sm-6 text-sm-end">
                    <!-- Title -->

                    <div class="mx-n1">
                        <!-- name -->
                        <span style="font-size: 16px; font-weight: 700; padding: 10px 10px">

                        @auth
                            {{auth()->user()->name}}
                        @endauth
                      </span>
                        <!-- Dropdown -->
                        <div class="dropdown">
                            <!-- Toggle -->
                            <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="avatar-parent-child">
                                    <img alt="Image Placeholder"
                                        src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                                        class="avatar avatar- rounded-circle" />
                                    <span class="avatar-child avatar-badge bg-success"></span>
                                </div>
                            </a>
                            <!-- Menu -->
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Settings</a>
                                <a href="#" class="dropdown-item">Billing</a>
                                <hr class="dropdown-divider" />
                                <a href="{{route('logout')}}" class="dropdown-item" >Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
