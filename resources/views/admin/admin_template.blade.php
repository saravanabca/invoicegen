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
    <h1><i class="mdi mdi-pen mdi-24px"></i>Templates</h1>
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
                            <h5 class="card-title">Templates<span></span></h5>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <div class="action-btn" align="right" style="padding-top:20px;">
                                <a href="{{ url('admin_temp_addpage') }}" class="btn btn-sm btn-primary btn-add">
                                    <i class="mdi mdi-pen mdi-18px"></i> Add Template </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <table id="datatable" class="table table-bordered table-hover User-datatable table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Template Name</th>
                                <th scope="col">Template Image</th>
                                <th scope="col">Action</th>

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
                                <th scope="col">Template Name</th>
                                <th scope="col">Template Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div><!-- End Recent Sales -->
    </div>
</section>



{{-- add-edit modal --}}
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Users</h5>
            </div>
            <form id="formModal">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                       
                        <div class="mb-3">
                            <label for="example-color-input" class="form-label">Template Name</label>
                            <input class="form-control" type="text" id="template_name" name="template_name" placeholder="Enter template name">
                            <h5 class="invalid-feedback template_name"></h5>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="example-color-input" class="form-label">Template Image</label>
                            <input class="form-control" type="text" id="template_image" name="template_image" placeholder="Enter billing email">
                            <h5 class="invalid-feedback template_image"></h5>
                        </div> --}}
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Template Image</label>
                            <input class="form-control" type="file" id="image_url" name="image_url">
                            <h5 class="invalid-feedback image_url"></h5>
                            <img src="" id="user_uploaded_image" alt="not-image" width="100px" style="padding-top: 15px; display:none;">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="formSubmit">Save </button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection



@section('custom_scripts')
<script src="{{ asset('assets/js/template.js')}}"></script>

@endsection

