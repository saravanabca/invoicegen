@extends('admin.adminlayouts.adminapp')

@php
    $title = 'Admin Dashboard';
@endphp


@section('custom_style')
<style>
    .access-card {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        width: 250px;
        text-align: center;
        position: relative;
    }

    .action {
        padding: 10px;
        margin: 5px;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
    }

    .view {
        background-color: #3498db;
        color: #fff;
    }

    .add {
        background-color: #2ecc71;
        color: #fff;
    }

    .edit {
        background-color: #f39c12;
        color: #fff;
    }

    .delete {
        background-color: #e74c3c;
        color: #fff;
    }

    .access-card .ddsds {
        background-color: #465189;
        color: #fff;
    }

    /* Add tick mark for active state */
    .action::before {
        content: '\2713';
        /* Unicode character for check mark */
        position: absolute;
        top: 50%;
        left: 90%;
        /* Adjusted left position for the tick mark */
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 1.2em;
        opacity: 0;
        /* Initially hidden */
    }

    .action.active::before {
        opacity: 1;
        /* Show the tick mark for active state */
        background: #ffffff;
        color: #012970;
        border-radius: 50px;
        width: 30px;
    }

    /* Additional styles for Laravel-based dynamic classes */
    .action.act {
        background-color: #465189;
        /* Default color for active state */
        color: #fff;
    }

    .vl {
        border-left: 3px solid #012970;
        height: 315px;
    }

    .action:not(.active)::before {
        content: 'X';
        /* Show "X" for non-active state */
        opacity: 1;
        color: red !important;
        background: #ffffff;
        border-radius: 50px;
        width: 30px;
    }
</style>
@endsection


@section('content')


<div class="pagetitle">
    <h1><i class="mdi mdi-pen mdi-24px"></i>User details </h1>
    {{-- <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('list_User') }}">User List</a></li>
            <li class="breadcrumb-item active">List of User Details Table</li>
        </ol>
    </nav> --}}
</div>
<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="row">
            {{-- @include('admin.show') --}}
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">User List <span></span></h5>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                           
                        </div>
                    </div>
                    <br>
                    <table id="datatable" class="table table-bordered table-hover User-datatable table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Invoice User Mail</th>
                                <th scope="col">Invoice Number</th>

                            </tr>
                        </thead>
                        <style>
                            .btn_status {
                                font-size: .70rem;
                                font-weight: 500;
                                letter-spacing: 1px;
                                padding: 5px 10px;
                                border-radius: 0.25rem;
                                text-transform: uppercase;
                                box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
                            }
                        </style>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Invoice User Mail</th>
                                <th scope="col">Invoice Number</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div><!-- End Recent Sales -->
    </div>
</section>




@endsection



@section('custom_scripts')
<script src="{{ asset('assets/js/invoicedrafts_list.js')}}"></script>

@endsection

