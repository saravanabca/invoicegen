@extends('user.userlayouts.user_app')
@php
    $title = 'Invocie Generator - Dashbord';
@endphp

@section('custom_style')
    <style>
        #view_customer .btn-close {
            background: transparent url('{{ url('user/images/invoice/view_close.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
            /* margin-left: auto; */
            margin-right: 10px;
            /* margin-top: 5px; */
            box-shadow: none;
        }
        #view_invoice .btn-close {
            background: transparent url('{{ url('user/images/invoice/view_close.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
            margin-left: auto;
            margin-right: 10px;
            margin-top: 5px;
            box-shadow: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('user/css/customer.css') }}">
@endsection


@section('content')
    @include('user.userlayouts.user_side_nav')

    @include('user.userlayouts.user_top_nav')
    <div class="page-container">

        <div class="main_page_div">
            <div class="main_head1 d-flex">
                <p class="page_heading">Customer</p>

                @if (!$customerdetails->isEmpty())
                    <button class="create_btn ms-auto add_customer_btn"><img class="add_icon"
                            src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}" alt=""> New
                        Customer</button>
                @endif
            </div>

            @if (!$customerdetails->isEmpty())
                <table class="data_tabel" id="datatable">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Mobile.No</th>
                            <th>Email</th>
                            <th>Total Invoice</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customerTableBody">

                    </tbody>
                </table>
            @else
                <div class="emety_invoice">
                    <img class="customer_emety_img" src="{{ asset('user/images/invoice/customer_emety_new.png') }}" alt=""><br>
                    {{-- <h3>Create Your First Invoice</h3> --}}
                    <button class="create_invoice_btn mt-5 add_customer_btn"><img class="add_icon"
                            src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}" alt="">Add New
                        Customer</button>
                </div>
            @endif
        </div>
    </div>

    @include('user.settingsmodel.customer_modal')



    <div class="modal " id="view_customer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog modal-xl invoice_view_dialo">
            <div class="modal-content">

                <div class="modal-header">
                    @if (!$invoicedetails->isEmpty())
                    <h6 class="ms-auto"><span class="customer_name_title"></span> All Invoices</h6>
                    @else
                    <h6 class="ms-auto"><span class="customer_name_title"></span> No Invoice</h6>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
               

                <div class="modal-body">

                    <div class="main_view_customer style-3">

                        @if (!$invoicedetails->isEmpty())
                        {{-- <div class="main_head2 d-flex">
                            <select class="transactions_btn" name="cars" id="transactionFilter">
                                <option value="">All Transactions</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                                <option value="drafts">Drafts</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
        
                            <div class="date_filter">
                                <input readonly class="form-select selectbox custom-pull-right"
                                        placeholder="Select date to filter" name="daterange_By"
                                        autocomplete="off" type="text" 
                                        id="daterange_By">
            
                            </div>
        
                            <select class="payment_btn" name="cars" id="paymentFilter">
                                <option value="">All Pay.Method</option>
                                <option value="cash">Cash</option>
                                 <option value="upi">UPI</option>
                                 <option value="card">Card</option>
                                 <option value="netbanking">Net Banking</option>
                                 <option value="cheque">Cheque</option>
                            </select>
        
                          
        
                            <div class="ms-auto">
                                <select class="des_asefilter_btn" name="cars" id="des_asefilter">
                                    <option value="desc">Descending </option>
                                    <option value="asc">Ascending</option>
                                   
                                </select>
                            </div>
        
        
        
                        </div> --}}

                        <table class="data_tabel_customer" id="datatable_custominvoice">
                            <thead>
                                <tr>
                                    <th>Inv.No</th>
                                    <th>Date/Time</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th class="">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="">

                            </tbody>
                        </table>
{{-- 
                        <div class="summary mt-3">
               
                        </div> --}}

                        @else
                        <div class="emety_custom_invoice">
                            <img src="{{ asset('user/images/invoice/invoice_emety.png') }}" alt=""><br>
                            {{-- <h3>Create Your First Invoice</h3> --}}
                           <button class="create_btn_placeholder mt-5"><img class="add_icon"
                                        src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}" alt="">Create New
                                    Invoice</button>
                        </div>
                        @endif

                    </div>
                </div>

               


            </div>
        </div>

    </div>



    
    <div class="modal " id="view_invoice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog modal-x invoice_view_dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="modal-header">
                    <p class="invoice_view_title">Invoice Preview</p>

                    <div class="ms-auto view_action_btn">
                        <button class="view_email_btn"><img src="{{ asset('user/images/invoice/view_email.png') }}"
                                alt="">Email</button>
                        <button class="view_whatsapp_btn"><img src="{{ asset('user/images/invoice/view_whatsapp.png') }}"
                                alt="">Whatsapp</button>
                        <button class="view_download_btn" id=""><img src="{{ asset('user/images/invoice/view_download.png') }}"
                                alt="">Download</button>
                    </div>

                </div>

                <div class="modal-body">
                    <div class="main_view_invoice style-3">
                        <div class="row">
                            <div class="col col-md-8">
                                <div id="invoice_preview">

                             
                                    <div id="pre-loader">
                                        <div class="traditional"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="col col-md-4 templates_invoice_view">
                                <div class="row">
                                    <div class="col col-lg-4">
                                        <img class="template_img" tempname="temp_1" src="{{ asset('user/images/invoice/temp_1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="col col-lg-4">
                                        <img class="template_img" tempname="temp_2" src="{{ asset('user/images/invoice/temp_3.png') }}"
                                            alt="">
                                    </div>
                                    <div class="col col-lg-4">
                                        <img class="template_img" tempname="temp_3" src="{{ asset('user/images/invoice/temp_4.png') }}"
                                            alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img class="template_img" src="{{ asset('user/images/invoice/temp_5.png') }}"
                                            alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img src="{{ asset('user/images/invoice/temp_6.png') }}" alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img src="{{ asset('user/images/invoice/temp_7.png') }}" alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img src="{{ asset('user/images/invoice/temp_8.png') }}" alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img src="{{ asset('user/images/invoice/temp_9.png') }}" alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img src="{{ asset('user/images/invoice/temp_10.png') }}" alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img src="{{ asset('user/images/invoice/temp_11.png') }}" alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img src="{{ asset('user/images/invoice/temp_12.png') }}" alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img src="{{ asset('user/images/invoice/temp_13.png') }}" alt="">
                                    </div>
                                    <div class="col col-lg-4 mt-3">
                                        <img src="{{ asset('user/images/invoice/temp_14.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

@endsection


@section('custom_scripts')
    <script src="{{ asset('user/js/customer.js') }}"></script>
    <script src="{{ asset('user/js/custominvoice.js') }}"></script>
    <script>
        //    setTimeout(function() {
        //     document.getElementById('top_loader').style.display = 'none';
        // }, 3000);
    </script>
@endsection
