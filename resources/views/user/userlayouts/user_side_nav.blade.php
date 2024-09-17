<aside class="app-sidebar ps ps--active-y" id="appSidebar">
    <div class="side-header active">
        <a class="header-brand1" href="{{ url('/') }}">
          
            {{-- <img src="https://codeigniter.spruko.com/zanex/ltr/public/assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo"> --}}
           Sky Invoice
        </a><!-- LOGO -->
    </div>
    <ul class="side-menu">
        
        <div class="add_company_side text-center" id="add_company_sidenav">
            <span class="company_img"><img src="{{ asset('user/images/sidenav/add_company.png') }}" alt=""></span>
            <p>Add Company</p>
            <button class="add_company_btn"><img class="add_icon_img" src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}" alt=""> Add Comapny</button>
        </div>

        {{-- <div id="company_status_container" class="text-center">
          
        </div> --}}

        <div class="user_company text-center" id="change_company_sidenav">
            <span class="comapny_name_shord">
            <span class="comapny_name_text"></span></span>
            <p class="company_name_side"><span class="display_name"></span>
                <span class="tooltiptext"></span></p>
            <button class="change_company_btn">Change Comapny</button>
        </div>

        <li class="slide first_menu {{ Request::is('invoice') ? 'sidenav_active' : '' }}">
            <a class="side-menu__item active d-inline" data-bs-toggle="slide" href="{{ url('invoice') }}">          
                <img class="side_img {{ Request::is('invoice') ? 'd-none' : '' }}" src="{{ asset('user/images/sidenav/side_invoice.png') }}" alt="">
                <img class="{{ Request::is('invoice') ? '' : 'd-none' }}" src="{{ asset('user/images/sidenav/side_invoice_active.png') }}" alt="">
            <p class="side-menu__label d-inline">Invoice</p></a>
        </li>

        <li class="slide {{ Request::is('customer') ? 'sidenav_active' : '' }}">
            <a href="{{ url('customer') }}" class="side-menu__item active d-inline" data-bs-toggle="slide">          
            <img src="{{ asset('user/images/sidenav/side_customer.png') }}" class="{{ Request::is('customer') ? 'd-none' : '' }}" alt="">
            <img src="{{ asset('user/images/sidenav/side_customer_active.png') }}" class="{{ Request::is('customer') ? '' : 'd-none' }}" alt="">
            <p class="side-menu__label d-inline">Customer</p></a>
        </li>

        <li class="slide  {{ Request::is('template') ? 'sidenav_active' : '' }}">
            <a class="side-menu__item active d-inline" data-bs-toggle="slide" href="{{ url('template') }}">          
            <img class="{{ Request::is('template') ? 'd-none' : '' }}" src="{{ asset('user/images/sidenav/side_template.png') }}" alt="">
            <img class="{{ Request::is('template') ? '' : 'd-none' }}" src="{{ asset('user/images/sidenav/side_template_active.png') }}" alt="">
            <p class="side-menu__label d-inline">Template</p></a>
        </li>

        <li class="slide {{ Request::is('setting') ? 'sidenav_active' : '' }}">
            <a class="side-menu__item active d-inline" data-bs-toggle="slide" href="{{ url('setting') }}">          
            <img class="{{ Request::is('setting') ? 'd-none' : '' }}" src="{{ asset('user/images/sidenav/side_settings.png') }}" alt="">
            <img class="{{ Request::is('setting') ? '' : 'd-none' }}" src="{{ asset('user/images/sidenav/side_settings_active.png') }}" alt="">
            <p class="side-menu__label d-inline">Settings</p></a>
        </li>

        <li class="slide {{ Request::is('feedback') ? 'sidenav_active' : '' }}">
            <a class="side-menu__item active d-inline" data-bs-toggle="slide" href="{{ url('feedback') }}">          
                <img class="{{ Request::is('feedback') ? 'd-none' : '' }}" src="{{ asset('user/images/sidenav/side_feedback.png') }}" alt="">
                <img class="{{ Request::is('feedback') ? '' : 'd-none' }}" src="{{ asset('user/images/sidenav/side_feedback_active.png') }}" alt="">
            <p class="side-menu__label d-inline">Feedback</p></a>
        </li>


        <li class="slide {{ Request::is('contact') ? 'sidenav_active' : '' }}">
            <a class="side-menu__item active d-inline" data-bs-toggle="slide" href="{{ url('contact') }}">          
                <img class="{{ Request::is('contact') ? 'd-none' : '' }}" src="{{ asset('user/images/sidenav/side_contact.png') }}" alt="">
                <img class="{{ Request::is('contact') ? '' : 'd-none' }}" src="{{ asset('user/images/sidenav/side_contact_active.png') }}" alt="">
            <p class="side-menu__label d-inline">Contact</p></a>
        </li>

     
       <div class="subscripe_side_div text-center">
        <img src="{{ asset('user/images/sidenav/gem.png') }}" alt="">
        <p>Benefit from customizable invoice 
            templates and premium support.</p>
            <button>Subscribe Now</button>
       </div>


    </ul>





<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 358px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 114px;"></div></div>
</aside>

