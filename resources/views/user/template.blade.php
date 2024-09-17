@extends('user.userlayouts.user_app')
@php
    $title = 'Invocie Generator - Dashbord';
@endphp

@section('custom_style')
    <style>
        #view_invoice .btn-close {
            background: transparent url('{{ url('user/images/invoice/view_close.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
            margin-left: auto;
            margin-right: 10px;
            margin-top: 5px;
            box-shadow: none;
        }

        .template_active_img {
            position: absolute;
            right: 60px;
            top: 15px;
            height: 20px;
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('user/css/settings.css') }}">
@endsection

@include('user.userlayouts.user_side_nav')

@include('user.userlayouts.user_top_nav')
@section('content')
    <div class="page-container">

        <div class="main_page_div">
            <div class="main_head1 d-flex">
                <p class="page_heading">Template</p>
            </div>

            <div class="template_main">
                <div class="row">
                    <div class="col col-md-4 mt-3">
                        <div class="position-relative">
                            <img class="template_img" tempname="temp_1"
                                src="{{ asset('user/images/template/template_5.png') }}" alt="">
                            <img class="template_active_img" src="{{ asset('user/images/template/template_active.png') }}"
                                alt="">
                        </div>

                    </div>
                    <div class="col col-md-4 mt-3 position-relative">

                        <img class="template_img" tempname="temp_2" src="{{ asset('user/images/template/template_1.png') }}"
                            alt="">
                            <div>
                                <img class="template_active_img" src="{{ asset('user/images/template/template_active.png') }}"
                                alt="">
                            </div>
                         

                    </div>

                    <div class="col col-md-4 mt-3">
                        <div class="position-relative">

                        <img class="template_img" tempname="temp_3" src="{{ asset('user/images/template/template_3.png') }}"
                            alt="">
                            <img class="template_active_img" src="{{ asset('user/images/template/template_active.png') }}"
                            alt="">
                    </div>
                </div>
                    <div class="col col-md-4 mt-3">
                        <img class="template_im" src="{{ asset('user/images/template/template_4.png') }}" alt="">
                    </div>
                    <div class="col col-md-4 mt-3">
                        <img class="template_im" src="{{ asset('user/images/template/template_2.png') }}" alt="">
                    </div>
                    <div class="col col-md-4 mt-3">
                        <img class="template_img" src="{{ asset('user/images/template/template_6.png') }}" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('custom_scripts')
    <script src="{{ asset('user/js/template.js') }}"></script>
@endsection
