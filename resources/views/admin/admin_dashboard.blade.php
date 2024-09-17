@extends('admin.adminlayouts.adminapp')

@php
    $title = 'Admin Dashboard';
@endphp


@section('custom_style')

@endsection


@section('content')


    <div class="pagetitle">
        <h1> Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
 
        <div class="row gy-4 mt-2">
            <div class="col-xxl-12 col-md-12">
                <div class="row">
                    <div class="col-xxl-4 col-sm-6">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white">
                            <a class="item-link" href="{{url('user_list')}}" title="Click to view"
                                data-bs-toggle="tooltip"></a>
                            <i class="las la-address-book overlay-icon text--warning"></i>

                            <div class="widget-two__icon b-radius--5  bg--warning ">
                                <i class="las la-address-book"></i>
                            </div>

                            <div class="widget-two__content">
                                <h3><i class="fa fa-user" style="font-size: 23px"></i> {{$userdcount}}</h3>
                                <p>Total Users</p>
                            </div>

                            <a class="widget-two__btn btn btn-outline--warning"
                                href="{{url('user_list')}}/pending">View All</a>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-sm-6">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white">
                            <a class="item-link" href="{{url('admin_invoice_list')}}" title="Click to view"
                                data-bs-toggle="tooltip"></a>
                            <i class="las la-blog overlay-icon text--success"></i>

                            <div class="widget-two__icon b-radius--5  bg--success ">
                                <i class="las la-blog"></i>
                            </div>

                            <div class="widget-two__content">
                                <h3><i class="fa fa-user" style="font-size: 23px"></i>{{$Invoicecount}} </h3>
                                <p>Total Invoice</p>
                            </div>
                            <a class="widget-two__btn btn btn-outline--success"
                                href="{{url('admin_invoice_list')}}">View All</a>
                        </div>
                    </div>



                    <div class="col-xxl-4 col-sm-6">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white">
                            <a class="item-link" href="{{url('admin_invoiceDrafts_list')}}" title="Click to view"
                                data-bs-toggle="tooltip"></a>
                            <i class="las la-blog overlay-icon text--success"></i>

                            <div class="widget-two__icon b-radius--5  bg--success ">
                                <i class="las la-blog"></i>
                            </div>

                            <div class="widget-two__content">
                                <h3><i class="fa fa-user" style="font-size: 23px"></i>{{$InvoiceDraftscount}} </h3>
                                <p>Total Invoice Drafts</p>
                            </div>
                            <a class="widget-two__btn btn btn-outline--success"
                                href="{{url('admin_invoiceDrafts_list')}}">View All</a>
                        </div>
                    </div>

                    
                    <div class="col-xxl-4 col-sm-6 mt-3">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white">
                            <a class="item-link" href="{{url('admin_clients_list')}}" title="Click to view"
                                data-bs-toggle="tooltip"></a>
                            <i class="las la-list overlay-icon text-primary"></i>

                            <div class="widget-two__icon b-radius--5 bg--list">
                                <i class="las la-list"></i>
                            </div>

                            <div class="widget-two__content">
                                <h3><i class="fa fa-user" style="font-size: 23px"></i>{{$Clientscount}} </h3>
                                <p>Total Clients</p>
                            </div>
                            <a class="widget-two__btn btn btn-outline--success"
                                href="{{url('admin_clients_list')}}">View All</a>
                        </div>
                    </div>



                    <div class="col-xxl-4 col-sm-6 mt-3">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white">
                            <a class="item-link" href="{{url('admin_template')}}" title="Click to view"
                                data-bs-toggle="tooltip"></a>
                            <i class="las la-list overlay-icon text-primary"></i>

                            <div class="widget-two__icon b-radius--5 bg--temp">
                                <i class="las la-list"></i>
                            </div>

                            <div class="widget-two__content">
                                <h3><i class="fa fa-user" style="font-size: 23px"></i>{{$Templatescount}} </h3>
                                <p>Total Templates</p>
                            </div>
                            <a class="widget-two__btn btn btn-outline--success"
                                href="{{url('admin_template')}}">View All</a>
                        </div>
                    </div>


                  

                </div>
            </div>

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

         
        </div>
    </section>

@endsection



@section('custom_scripts')

@endsection

