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
        .navbar {
            background-color: #4285F4;
        }

        .navbar-brand {
            color: white !important;
        }

        .navbar-brand:hover {
            color: white !important;
        }

        .nav-menues {
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
        <div class="main_faq_div">
            <div class="section-header">
                <h2>Frequently Asked Questions (FAQ)</h2>
                <div class="underline-container">
                    <div class="underline blue"></div>
                    <div class="underline yellow"></div>
                    <div class="underline green"></div>
                    <div class="underline red"></div>
                </div>
            </div>

            <div class="row">
                <div class="col col-md-1">

                </div>
                <div class="col col-lg-10">
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
                                    <div class="row">
                                        <div class="col col-md-6">
                                            Yes, Web version are absolutely free to use for life-time to create unlimited invoices,
                                            p manage customers share bills via Email .Start using Sky Invoice for Free!
                                        </div>
                                        <div class="col col-md-6">
                                           <img src="{{ asset('images/homepage/faq_img.png') }}" alt="">
                                        </div>
                                    </div>
                                  
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
                <div class="col col-md-1">

                </div>

                {{-- <div class="col col-lg-6">
                    <div class="faq_side_image">
                        <div class="d-flex justify-content-center">
                            <img class="img-fluid" src="{{ asset('images/homepage/faq_side_image.png') }}"
                                alt="">

                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    @include('modal.index')

    @include('layouts.footer')
@endsection

@section('custom_scripts')
    <script src="{{ asset('js/signup.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
