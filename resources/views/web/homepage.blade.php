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

        .signup-dialog .btn-close {
            background: transparent url('{{ url('images/login/close_login.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
            font-size:20px;
        }

        .forget_modal_content .btn-close {
            background: transparent url('{{ url('images/login/close_login.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
            margin-left: auto;
            margin-right: 25px;
            /* margin-top: 16px; */
            box-shadow: none;
            position: absolute;
            right: 0px;
            font-size: 18px;
            top: 33px;
        }
        .signup_content .signup_otp_close{
            background: transparent url('{{ url('images/login/close_login.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
            margin-left: auto;
            margin-right: 25px;
            /* margin-top: 16px; */
            box-shadow: none;
            position: absolute;
            right: 0px;
            font-size: 18px;
            top: 33px;
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

        .nav-tabs {
            background-color: white !important;
            box-shadow: 0 3px 10px rgb(0 0 0 / 12%) !important;
        }

        .nav-link {
            color: #4285F4 !important;
            font-weight: 600 !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login_modal.css') }}">
@endsection

@section('content')
    {{-- start Banner --}}
    @include('layouts.top_navbar')

    <div id="page-container">
        <div class="home">
            <div class="section-1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-4">
                                <h3>Free Invoice Generator</h3>
                            </div>
                            <div class="mb-4">
                                <h1 class="fw-bolder">" Create <span>invoices</span><br> in less than 10 seconds</h1>
                            </div>
                            <p class="home_desc_con">Easily generate professional invoices in just minutes
                                using our intuitive tool. Simplify your billing process
                                with a user-friendly interface designed for
                                efficiency and accuracy. Perfect for freelancers,
                                small businesses, and large enterprises alike,
                                our tool ensures your invoicing is streamlined
                                and hassle-free, saving you valuable time and effort ”</p>

                            @if (!auth()->check())
                                <div class="mt-4">
                                    <button class="triggerModal" data-name="signup">Sign Up for Free</button>
                                </div>
                            @else
                                <div class="mt-4">
                                    <a href="{{ url('invoice') }}"><button class="">Generate Free Invoice</button></a>
                                </div>
                            @endif


                        </div>
                        <div class="col-md-7 align-self-center">
                            <div class="layer_2">
                                <img src="{{ asset('images/homepage/ban_img_2.png') }}" alt="">
                            </div>
                            <div class="img text-end">
                                <img src="{{ asset('images/homepage/ban_img_1.png') }}" alt="invoice-image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layer">
                <img src="{{ asset('images/homepage/banner_svg.png') }}" alt="">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main_feature">
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
                        <img class="img-fluid fea_images" src="{{ asset('images/homepage/feature_1.png') }}"
                            alt="">

                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 1rem">
                <div class="col col-md-6">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid fea_images" src="{{ asset('images/homepage/feature_2.png') }}"
                            alt="">

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

    <div class="container">
        <div class="main_faq_div">
            <div class="section-header mt-5">
                <h2>Frequently Asked Questions (FAQ)</h2>
                <div class="underline-container">
                    <div class="underline blue"></div>
                    <div class="underline yellow"></div>
                    <div class="underline green"></div>
                    <div class="underline red"></div>
                </div>
            </div>

            <div class="row">
                <div class="col col-lg-6">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Can I use Sky Invoice for Free?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Yes, Web version are absolutely free to use for life-time to create unlimited invoices,
                                    p manage customers share bills via Email .Start using Sky Invoice for Free!
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Is it possible to add multiple users?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and hiding
                                    via CSS transitions. You can modify any of this with custom CSS or overriding our
                                    default variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Is it possible to add multiple users?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and hiding
                                    via CSS transitions. You can modify any of this with custom CSS or overriding our
                                    default variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Is it possible to add multiple users?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and hiding
                                    via CSS transitions. You can modify any of this with custom CSS or overriding our
                                    default variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Is it possible to add multiple users?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and hiding
                                    via CSS transitions. You can modify any of this with custom CSS or overriding our
                                    default variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-6">
                    <div class="faq_side_image">
                        <div class="d-flex justify-content-center">
                            <img class="img-fluid" src="{{ asset('images/homepage/faq_side_image.png') }}"
                                alt="">

                        </div>
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
