<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @include('admin.adminlayouts.admin_meta')

        @include('admin.adminlayouts.admin_style')
        
        @yield('custom_style')

    </head>

    <body>
        @include('admin.adminlayouts.admin_topnav')

        @include('admin.adminlayouts.admin_sidenav')

        <main id="main" class="main">
        @yield('content')
        </main>


        @include('admin.adminlayouts.admin_script')
        @yield('custom_scripts')

    </body>
</html>