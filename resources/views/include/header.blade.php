
    
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
                            {{auth()->user()->first_name}}
                        @endauth
                      </span>
                        <!-- Dropdown -->
                        <div class="dropdown">
                            <!-- Toggle -->
                            <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                @auth
                                <div class="avatar-parent-child rounded-circle border border-2 border-secondary p-1" style="width:40px; height:40px;">
                                    <img alt="Image Placeholder"
                                    src="{{ asset('storage/uploads/' . auth()->user()->image_path) }}"
                                        class="avatar avatar- rounded-circle"
                                        style="width:30px; height:30px;" />
                                    <span class="avatar-child avatar-badge bg-success"></span>
                                </div>
                                @endauth
                            </a>
                            <!-- Menu -->
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                                <a href="{{ route('ProfileView', ['user' => auth()->user()->id]) }}" class="dropdown-item">Profile</a>
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
