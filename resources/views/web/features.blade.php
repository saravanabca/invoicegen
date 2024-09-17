@extends('layouts.app')
@php
    $title = 'Invocie Generator';
@endphp
@section('custom_style')
    <style>
        .accordion-button:not(.collapsed)::after {
            background-image: url('{{ asset('images/homepage/faq_up_arrow.png') }}');
            transform: none !important;
        }

        .accordion-button::after {
            background-image: url('{{ asset('images/homepage/faq_down_arrow.png') }}');
            transform: none !important;
        }

        .modal .btn-close {
            background: transparent url('{{ url('images/login/close_btn.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
        }

        /*
                .otp_btn:disabled {
                    background-color: grey;
                    cursor: not-allowed;
                } */


        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 19px;
            height: 18px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
            display: none;
            position: absolute;
            top: 20%;
            right: 10px;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }


        /* topnav */
        .navbar{
            background-color: #4285F4;
        }

        .navbar-brand{
            color: white !important;
        }
        .navbar-brand:hover{
            color: white !important;
        }
        .nav-menues{
            background-color: white;
        }


        
    </style>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/topnav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login_modal.css') }}">
@endsection

@section('content')
    {{-- start Banner --}}
    @include('layouts.top_navbar')

   
    <div class="container">
        <div class="main_features">
            <div class="section-header">
                <h2>Features of Invoice Generator</h2>
                <div class="underline-container">
                    <div class="underline blue"></div>
                    <div class="underline yellow"></div>
                    <div class="underline green"></div>
                    <div class="underline red"></div>
                </div>
            </div>
            <div class="row mt-5">

                <div class="col col-md-6">
                    <h3>Generate invoices in under 10 seconds</h3>
                    <p class="mt-3 fea_content">
                        Quickly produce detailed invoices in less than 10 seconds with our streamlined tool. Designed for
                        maximum efficiency, our solution ensures accurate and professional results, saving you valuable time
                        and simplifying your billing process with just a few clicks.
                    </p>
                </div>
                <div class="col col-md-6">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid fea_images" src="{{ asset('images/homepage/feature_1.png') }}" alt="">

                    </div>
                </div>







            </div>
            <div class="row" style="margin-top: 1rem">
                <div class="col col-md-6">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid fea_images" src="{{ asset('images/homepage/feature_2.png') }}" alt="">

                    </div>
                </div>
                <div class="col col-md-6">
                    <h3>Impressive Invoice Template</h3>
                    <p class="mt-3 fea_content">
                        Experience the excellence of our impressive invoice template, meticulously crafted to enhance
                        professionalism and efficiency. Simplify your billing process with this standout template, designed
                        to leave a lasting impression on your clients.
                    </p>
                </div>








            </div>

            <div class="row" style="margin-top: 1rem">

                <div class="col col-md-6">
                    <h3>Share Invoice via Email</h3>
                    <p class="mt-3 fea_content">
                        Easily send invoices to your clients via email. Our user-friendly system allows you to quickly share
                        detailed invoices, ensuring timely payments and efficient communication. Streamline your billing
                        process by delivering invoices directly to your clients' inboxes.
                    </p>
                </div>
                <div class="col col-md-6">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid fea_images" src="{{ asset('images/homepage/feature_3.png') }}"
                            alt="">

                    </div>
                </div>
            </div>




            <div class="row" style="margin-top: 1rem">
                <div class="col col-md-6">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid fea_images" src="{{ asset('images/homepage/feature_4.png') }}"
                            alt="">

                    </div>
                </div>
                <div class="col col-md-6">
                    <h3>Manage Client Invoices & Details</h3>
                    <p class="mt-3 fea_content">
                        Save client information for seamless invoice creation. Store client details securely to streamline
                        the invoicing process, ensuring accuracy and efficiency in generating invoices tailored to each
                        client's needs.
                    </p>
                </div>

            </div>




            <div class="row" style="margin-top: 1rem">

                <div class="col col-md-6">
                    <h3>Multi-user Addition & Dashboard</h3>
                    <p class="mt-3 fea_content">
                        Enable multiple users to join and access the invoice dashboard. Collaborate seamlessly and monitor
                        invoicing activities efficiently with our user-friendly interface, ensuring smooth operations for
                        your team.
                    </p>
                </div>
                <div class="col col-md-6">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid fea_images" src="{{ asset('images/homepage/feature_5.png') }}"
                            alt="">

                    </div>
                </div>
            </div>

        </div>
    </div>
    
    @include('modal.index')

    @include('layouts.footer')
@endsection

@section('custom_scripts')
    <script src="{{ asset('js/signup.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    {{-- <script>
        $(document).on("click", ".signup_link", function() {

            $("#signup").modal("show");
            $("#login").modal("hide");
        });

        $(document).on("click", ".login_link", function() {

            $("#login").modal("show");
            $("#signup").modal("hide");
        });

        $(document).on("click", ".forget_txt", function() {

            $("#login").modal("hide");
            $("#forget").modal("show");
        });

        $(document).on("click", ".forget_back", function() {

            $("#login").modal("show");
            $("#forget").modal("hide");
        });

        $(document).on("click", ".forget_email_btn", function() {

            $("#otpmodal").modal("show");
            $("#forget").modal("hide");
        });
        $(document).on("click", ".changepw_back", function() {

            $("#changepw").modal("hide");
            $("#forget").modal("show");
        });
        $(document).on("click", ".otp_verify_btn", function() {

            $("#changepw").modal("show");
            $("#forget").modal("hide");
        });
    </script> --}}
@endsection
