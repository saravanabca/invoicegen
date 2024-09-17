<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('layouts.meta')
    @include('user.userlayouts.user_style')
    @yield('custom_style')
    <style>
        :root {
            --blue: #4285F4;
            --white: #ffffff;
            --btngreen: #34A853;
            --yellow: #FBBC05;
        }

        #change_company_modal .btn-close {

            background: transparent url('{{ url('user/images/buttons_icon/close_white.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
            margin-left: auto;
            margin-right: 10px;
            /* margin-top: 16px; */
            box-shadow: none;
            position: absolute;
            right: 0px;
            font-size: 20px;
            top: 20px;
        }
    </style>
</head>

<body>

    <div class="top_loader" id="top_loader"></div>

    <div class="container-toast">

        <div class="alert_toast" id="alert_toast">
            <i class="fas fa-exclamation-circle"></i>
            <p class="toast-text"></p>
            <i class="fas fa-close" id="close"></i>
        </div>

    </div>

    @yield('content')
    @include('user.settingsmodel.company_modal')
    @include('user.settingsmodel.change_company_modal')


    {{-- <div id="toast"><div id="img">Icon</div><div id="toast_msg"></div></div> --}}

    @include('user.userlayouts.user_script')

    @yield('custom_scripts')

</body>

</html>
