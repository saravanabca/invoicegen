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
        <div class="main_features">
            <div class="section-header">
                <h2>Make Invoices with Over 100 Stunning Templates</h2>
                <div class="underline-container">
                    <div class="underline blue"></div>
                    <div class="underline yellow"></div>
                    <div class="underline green"></div>
                    <div class="underline red"></div>
                </div>
            </div>
            <div class="row mt-5">

                <div class="col col-md-4">
                    <div class="mb-4">
                          <img class="" src="{{ asset('user/images/template/template_1.png') }}"
                            alt="">                    
                    </div>
                </div>

                <div class="col col-md-4">
                    <div class="mb-4">
                          <img class="" src="{{ asset('user/images/template/template_2.png') }}"
                            alt="">                    
                    </div>
                </div>


                <div class="col col-md-4">
                    <div class="mb-4">
                          <img class="" src="{{ asset('user/images/template/template_3.png') }}"
                            alt="">                    
                    </div>
                </div>


                <div class="col col-md-4">
                    <div class="mb-4">
                          <img class="" src="{{ asset('user/images/template/template_4.png') }}"
                            alt="">                    
                    </div>
                </div>


                <div class="col col-md-4">
                    <div class="mb-4">
                          <img class="" src="{{ asset('user/images/template/template_5.png') }}"
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
@endsection
