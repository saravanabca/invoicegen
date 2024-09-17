  <nav class="navbar">
      <div class="container">
          <a class="navbar-brand" href="{{url('/')}}">Sky Invoice</a>

          {{-- <ul class="nav-menues">
              <li><a href="{{url('features')}}">Features</a></li>
          <li><a href="{{url('templates')}}">Template</a></li>
          <li><a href="{{url('faq')}}">FAQs</a></li>
          <li><a href="">Pricing</a></li>
          </ul> --}}

          <div class="nav-container">
              <nav class="nav-tabs">
                  <a href="{{url('features')}}"
                      class="nav-link {{ Request::is('features') ? 'active' : '' }}">Features</a>
                  <a href="{{url('templates')}}"
                      class="nav-link {{ Request::is('templates') ? 'active' : '' }}">Template</a>
                  <a href="{{url('faq')}}" class="nav-link {{ Request::is('faq') ? 'active' : '' }}">FAQs</a>
                  <a href="#" class="nav-link">Pricing</a>
              </nav>
          </div>

          @if (!auth()->check())
          <div class="ml-auto">
              <button class="login triggerModal" data-name="login">Login</button>
              <button class="signup triggerModal" data-name="signup">Signup</button>
          </div>
          @endif
          @if (auth()->check())

          @php
          $user = auth()->user();
          $avatar = $user->avatar;
          $nameParts = explode(' ', $user->name);
          $firstName = $nameParts[0] ?? '';
          $lastName = $nameParts[1] ?? '';
          $firstInitial = strtoupper(substr($nameParts[0], 0, 1)); // First name initial
          $lastInitial = isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : ''; // Last name initial, if
          available
          $initials = $firstInitial . $lastInitial;
          $username = $firstName .' '. $lastName;
          @endphp

          <div class="ml-auto d-flex">
              <button class="notify"><img src="{{ asset('images/homepage/nodify.png') }}" alt=""></button>
              <div class="dropdown  d-md-flex profile-1">
                  <a data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
                      @if ($avatar)
                      <span>
                          <img src="{{ $avatar }}" alt="profile-user" class="avatar  profile-user brround cover-image">
                      </span>
                      {{-- <img src="{{ $avatar }}" alt="profile-user" class="avatar profile-user brround cover-image">
                      --}}
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
                          <a class="dropdown-item" href="{{url('invoice')}}">
                              <img src="{{ asset('images/homepage/dashboard.png') }}" alt=""> Dashboard
                          </a>

                          <a class="dropdown-item" href="{{url('setting')}}">
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
  </nav>
  <div style="display:none;" class="get_idlgn"></div>

  {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <a class="navbar-brand logo_txt" href="http://localhost/invoiceBill/public/ ">Sky Invoice</a>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item active_nav">
                <a class="nav-link" href="http://localhost/invoiceBill/public#your_invoice">Your Invoice</a>
                <div class="down_r "></div>
            </li>
            <li class="nav-item active_nav">
                <a class="nav-link" href="#templates">Template</a>
                <div class="down_r "></div>
            </li>
            <li class="nav-item active_nav">
                <a class="nav-link" href="#faq">Faqs</a>
                <div class="down_r "></div>
            </li>
            <li class="nav-item">
                <a class="nav-link signup" data-bs-toggle="modal" data-bs-target="#signup">Log in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link signin" data-bs-toggle="modal" data-bs-target="#signin">Sign Up</a>
            </li>
        </ul>
    </div>
</div> --}}

  {{-- <div id="pre-loader">
    <div class="traditional"></div>
</div> --}}

  {{-- <div class="toast_message">
    <span class="success_msg"> Success</span>
    <span class="failure_msg"></span>
    <span class="warning_msg"></span>
    </div> --}}