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
    </style>
    <link rel="stylesheet" href="{{ asset('user/css/feedback.css') }}">
@endsection

@include('user.userlayouts.user_side_nav')

@include('user.userlayouts.user_top_nav')
@section('content')
    <div class="page-container">

        <div class="main_page_div">
            <div class="main_head1 d-flex">
                <p class="page_heading">Feedback</p>
            </div>

            <div class="feedback_main">
                <form id="feedback_form">
                    <div class="row">
                        <div class="col col-md-12">
                            <h6 for="">Name</h6>
                            <div class="form-floating text-center w-100">
                                <input type="text" class="form-control" id="feedback_name" placeholder=""
                                    name="feedback_name">
                                <label for="feedback_name">Enter Name</label>
                                <div class="error-message" id="feedback_name_error"></div>

                            </div>
                        </div>
                        <div class="col col-md-12 mt-3">
                            <h6 for="">Email</h6>
                            <div class="form-floating text-center w-100">
                                <input type="text" class="form-control" id="feedback_email" placeholder=""
                                    name="feedback_email">
                                <label for="feedback_email">Enter Email</label>
                                <div class="error-message" id="feedback_email_error"></div>

                            </div>
                        </div>
                        <div class="col col-md-12 mt-3">
                            <h6 for="">Message</h6>
                            <div class="form-floating text-center w-100">
                                <input type="text" class="form-control" id="feedback_message" placeholder=""
                                    name="feedback_message">
                                <label for="feedback_message">Write your message...</label>
                                <div class="error-message" id="feedback_message_error"></div>

                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <button class="feedback_submit_btn ms-auto">Submit</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection


@section('custom_scripts')
    <script src="{{ asset('user/js/feedback.js') }}"></script>
@endsection
