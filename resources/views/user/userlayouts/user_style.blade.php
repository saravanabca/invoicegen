<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('user/css/user_common.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('user/css/toast.css') }}"> --}}
{{-- font --}}
{{-- 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}

<link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


<link href="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css">

<link rel="stylesheet" href="{{ asset('user/css/settings.css') }}">


<style>
body{
    font-family: "Barlow", sans-serif;
    /* font-weight: 600; */
}


@keyframes slideInDown {
    0% {
        transform: translateY(-100%);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideOutUp {
    0% {
        transform: translateY(0);
        opacity: 1;
    }
    100% {
        transform: translateY(-100%);
        opacity: 0;
    }
}

.alert_toast {
    position: fixed;
    top: 25px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    width: 375px;
    background: #FFF;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 12px;
    border-left: 3px solid red;
    overflow: hidden;
    z-index: 9999;
    transform: translateY(-100%);
    opacity: 0;
    transition: all 0.5s ease;
}

.alert_toast.activee {
    display: flex; /* Ensures display is flex to apply animation */
    animation: slideInDown 0.3s forwards;
}

.alert_toast.inactive {
    animation: slideOutUp 0.5s forwards;
}

.alert_toast i:first-child {
    color: red;
    font-size: 20px;
}

.toast-text {
    margin: 0;
    font-size: 14px;
    /* text-transform: uppercase; */
}

.alert_toast i:last-child {
    color: #ccc;
    cursor: pointer;
    transition: 350ms;
}

.alert_toast i:last-child:hover {
    color: #333;
}

.container-toast {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}


.app-sidebar {
    transition: width 0.3s;
}

.app-sidebar.collapsed {
    width: 0;
    overflow: hidden;
}

.app-header {
    transition: margin-left 0.3s;
}

.app-header.expanded {
    margin-left: 0;
}

</style>