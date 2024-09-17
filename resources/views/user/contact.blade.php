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
                <p class="page_heading">Contact</p>
            </div>

            <div class="contact_main">
                <form id="contact_form">
                <div class="row">
                    <div class="col col-md-12">
                        <h6 for="">Name</h6>
                        <div class="form-floating text-center w-100">
                            <input type="text" class="form-control" id="contact_name"
                                placeholder="" name="contact_name">
                            <label for="contact_name">Enter Name</label>
                        </div>
                    </div>
                    <div class="col col-md-12 mt-3">
                        <h6 for="">Email</h6>
                        <div class="form-floating text-center w-100">
                            <input type="text" class="form-control" id="contact_email"
                                placeholder="" name="contact_email">
                            <label for="contact_email">Enter Email</label>
                        </div>
                    </div>
                    <div class="col col-md-12 mt-3">
                        <h6 for="">Message</h6>
                        <div class="form-floating text-center w-100">
                            <input type="text" class="form-control" id="contact_message"
                                placeholder="" name="contact_message">
                            <label for="contact_message">Write your message...</label>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <button type="button" class="contact_submit_btn ms-auto">Submit</button>
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
