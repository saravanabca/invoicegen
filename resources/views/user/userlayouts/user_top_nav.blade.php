<div class="app-header header">
    <div class="container-fluid">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" id="sidebarToggle" class="app-sidebar__toggle" data-bs-toggle="sidebar">
                <img src="{{ asset('user/images/sidenav/sidenav_btn1.png') }}" alt="">
            </a>
            <a class="header-brand1 d-flex d-md-none" href="">

            </a>

            <div class="d-flex order-lg-2 ms-auto header-right-icons">


                <div>
                    <button class="notification"><img
                            src="http://localhost/invoiceBill/public/images/homepage/nodify.png"
                            alt=""></button>
                </div>

                @if (auth()->check())

                    @php
                        $user = auth()->user();
                        $avatar = $user->avatar;
                        $nameParts = explode(' ', $user->name);
                        $firstName = $nameParts[0] ?? '';
                        $lastName = $nameParts[1] ?? '';
                        $firstInitial = strtoupper(substr($nameParts[0], 0, 1)); // First name initial
                        $lastInitial = isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : ''; // Last name initial, if available
                        $initials = $firstInitial . $lastInitial;
                        $username = $firstName . ' ' . $lastName;
                    @endphp

                    <div class="ml-auto d-flex">
                        <div class="dropdown  d-md-flex profile-1">
                            <a data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
                                @if ($avatar)
                                    <span>
                                        <img src="{{ $avatar }}" alt="profile-user"
                                            class="avatar  profile-user brround cover-image">
                                    </span>
                                    {{-- <img src="{{ $avatar }}" alt="profile-user" class="avatar profile-user brround cover-image"> --}}
                                @else
                                    <div class="avatar-initials profile-user brround cover-image">
                                        {{ $initials }}
                                    </div>
                                @endif

                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow home_dropdown">
                                <div class="drop-heading">
                                    <div class="text-center">
                                        <h5 class="text-dark">{{ $username }}</h5>
                                        <small class="text-muted role-name mt-2">Admin</small>
                                        <div class="drop_mail">{{ auth()->user()->email }}</div>
                                    </div>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                <div class="mt-2 drop_menu">
                                    <a class="dropdown-item" href="{{ url('invoice') }}">
                                        <img src="{{ asset('images/homepage/dashboard.png') }}" alt="">
                                        Dashboard
                                    </a>

                                    <a class="dropdown-item" href="{{ url('setting') }}">
                                        <img src="{{ asset('images/homepage/settings.png') }}" alt=""> Settings
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <img src="{{ asset('images/homepage/logout.png') }}" alt=""> Log out
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
