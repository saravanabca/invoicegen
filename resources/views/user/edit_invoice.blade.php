@extends('user.userlayouts.user_app')
@php
    $title = 'Invocie Generator - Dashbord';
@endphp

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('user/css/create_invoice.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/customer.css') }}">
@endsection



@section('content')
    @include('user.userlayouts.user_top_nav_two')

    <div class="main_create_invoice">
        <header class="create_invoice_top">
            <a href="{{ url('invoice') }}"><button class="back_btn"><img
                        src="{{ asset('user/images/create_invoice/back_arrow.png') }}" alt="">Back</button></a>
            <h5 class="heading">Update Invoice</h5>
            <div class="ms-auto save_buttons">
                <button class="save_drafts_btn">Save & Drafts</button>
                <button type="button" class="save_btn">Save</button>
                <a href="{{ url('setting') }}"><button class="settings-btn"><img class="add_icon"
                            src="{{ asset('user/images/buttons_icon/setting_icon.png') }}" alt="">
                        Settings</button></a>

            </div>
        </header>



        <form id="invoice_form">
            <section class="invoice_number_main d-flex">
                <p>Invoice.Num</p>
                <select name="invoice_number_cat" class="form-selec" id="">
                    <option value="Inv">Inv</option>
                    <option value="Test">Test</option>
                    {{-- <option value="Test2">Test2</option>
                    <option value="">12133</option> --}}
                </select>
                <input type="number" name="invoice_number" class="invoice_number"
                    value="{{ $invoicedetails->invoice_number }}">

                    <input type="hidden" name="invoice_id" class=""
                    value="{{ $invoicedetails->id }}">
            </section>

            <section class="select_customer">
                <div class="d-flex">
                    <h4>Select Customer</h4>
                    <button type="button" class="add_customer_btn"><img class="add_icon"
                            src="{{ asset('user/images/buttons_icon/add_icon.png') }}" alt="">Add Customer</button>

                </div>

                <div class="d-flex customer_filds">


                    <div class="autocomplete-container">
                        <input name="customer_name" autocomplete="off"
                            value="{{ $invoice_page ? '' : $invoicedetails->customer_name ?? '' }}" class="search_customer"
                            id="customer_name" placeholder="Search customer name.." type="search">
                        <input name="customer_id" autocomplete="off"
                            value="{{ $invoice_page ? '' : $invoicedetails->customer_id ?? '' }}" id="customer_id"
                            type="hidden">
                        <ul id="customer_list"></ul>

                    </div>


                    <label for="">Invoice Date</label>
                    <input name="invoice_date" value="{{ $invoicedetails->invoice_date }}" class="inv_date" type="date">
                    <label class="due_label" for="">Due Date</label>
                    <input name="due_date" value="{{ $invoicedetails->due_date }}" class="due_date" type="date">
                </div>
            </section>


            <section class="select_product">
                <div class="d-flex ">
                    <h4>Select Product</h4>
                    <div class="ms-auto">
                        <input class="product_search" type="search" placeholder="Search exiting Product">
                        <button type="button" class="add_product_btn"><img class="add_icon"
                                src="{{ asset('user/images/buttons_icon/add_icon.png') }}" alt="">Add</button>
                    </div>
                </div>

                <div class="d-flex mt-4 product_add_buttons">

                    <button type="button"><img class="add_icon" src="{{ asset('user/images/buttons_icon/add_icon.png') }}"
                            alt="">Gst</button>
                    <button type="button"><img class="add_icon" src="{{ asset('user/images/buttons_icon/add_icon.png') }}"
                            alt="">IGST</button>
                    <button type="button"><img class="add_icon" src="{{ asset('user/images/buttons_icon/add_icon.png') }}"
                            alt="">Discount</button>
                    <button type="button"><img class="add_icon" src="{{ asset('user/images/buttons_icon/add_icon.png') }}"
                            alt="">HSN/SAC</button>
                    <button type="button"><img class="add_icon" src="{{ asset('user/images/buttons_icon/add_icon.png') }}"
                            alt="">Additional Charges</button>
                </div>

            </section>



            <section>
                <div class="product_details">

                    <div class="product_head">
                        <div class="row">
                            <div class="col col-md-2">
                                <span>Product Name</span>
                            </div>
                            <div class="col col-md-1">
                                <span>HSN/SAC</span>
                            </div>
                            <div class="col col-md-2">
                                <span>Rate</span>
                            </div>
                            <div class="col col-md-2">
                                <span>Quantity</span>
                            </div>
                            <div class="col col-md-1">
                                <span>GST</span>
                            </div>
                            <div class="col col-md-2">
                                <span>Discount</span>
                            </div>
                            <div class="col col-md-2">
                                <span>Amount</span>
                            </div>
                        </div>
                    </div>
                    <div class="product_append">

                        @if ($invoicedetails)
                            @php
                                $product_name = explode(',', $invoicedetails->product_name ?? '');
                                $product_hsnsac = explode(',', $invoicedetails->product_hsnsac ?? '');
                                $product_rate = explode(',', $invoicedetails->product_rate ?? '');
                                $product_quantity = explode(',', $invoicedetails->product_quantity ?? '');
                                $product_gst = explode(',', $invoicedetails->product_gst ?? '');
                                $product_discount = explode(',', $invoicedetails->product_discount ?? '');
                                $product_total = explode(',', $invoicedetails->product_total ?? '');
                                $product_quantity_type = explode(',', $invoicedetails->product_quantity_type);
                                $product_discount_type = explode(',', $invoicedetails->product_discount_type);

                                $count = max(
                                    count($product_name),
                                    count($product_hsnsac),
                                    count($product_rate),
                                    count($product_quantity),
                                    count($product_gst),
                                    count($product_discount),
                                    count($product_total),
                                );
                                // dd($count);
                            @endphp

                            @for ($i = 0; $i < $count; $i++)
                                <div class="product_add mt-3">
                                    <div class="row mt-3">
                                        <div class="col col-md-2">
                                            <div class="product_border_input">
                                                <input type="text" name="product_name"
                                                    value="{{ $product_name[$i] ?? '' }}" class="product_name"
                                                    id="">
                                            </div>
                                            <div class="mt-2">
                                                <button class="product_img_btn">
                                                    <img src="{{ asset('user/images/buttons_icon/add_icon.png') }}"
                                                        alt="">image
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col col-md-1">
                                            <div class="product_border_input product_border_hsn">
                                                <input type="text" name="product_hsnsac"
                                                    value="{{ $product_hsnsac[$i] ?? '' }}" class="product_hsnsac"
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="col col-md-2 position-relative">
                                            <div class="product_border_input product_border_rate">
                                                <span class="position-absolute">₹</span>
                                                <input type="number" class="product_rate"
                                                    value="{{ $product_rate[$i] ?? '' }}" name="product_rate"
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="col col-md-2 position-relative">
                                            <div class="product_border_input product_border_qua">
                                                <input type="number" name="product_quantity"
                                                    value="{{ $product_quantity[$i] ?? '' }}" class="product_quantity"
                                                    id="">
                                                <select name="product_quantity_type" class="product_qua_type">
                                                    <option value="num"
                                                        {{ isset($product_quantity_type[$i]) && $product_quantity_type[$i] == 'num' ? 'selected' : '' }}>
                                                        Numbers</option>
                                                    <option value="kgs"
                                                        {{ isset($product_quantity_type[$i]) && $product_quantity_type[$i] == 'kgs' ? 'selected' : '' }}>
                                                        Kilograms</option>
                                                    <option value="ltr"
                                                        {{ isset($product_quantity_type[$i]) && $product_quantity_type[$i] == 'ltr' ? 'selected' : '' }}>
                                                        Liter</option>
                                                    <option value="unt"
                                                        {{ isset($product_quantity_type[$i]) && $product_quantity_type[$i] == 'unt' ? 'selected' : '' }}>
                                                        Units</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-1 position-relative">
                                            <div class="product_border_input">
                                                {{-- <input type="text" name="product_gst" value="{{ $product_gst[$i] ?? '' }}" class="product_gst" id=""> --}}
                                                <select name="product_gst" class="product_gst_type">
                                                    <option value="0"
                                                        {{ $product_gst[$i] == '0' ? 'selected' : '' }}>GST@0%</option>
                                                    <option value="0.25"
                                                        {{ $product_gst[$i] == '0.25' ? 'selected' : '' }}>GST@0.25%
                                                    </option>
                                                    <option value="5"
                                                        {{ $product_gst[$i] == '5' ? 'selected' : '' }}>GST@5%</option>
                                                    <option value="12"
                                                        {{ $product_gst[$i] == '12' ? 'selected' : '' }}>GST@12%</option>
                                                    <option value="18"
                                                        {{ $product_gst[$i] == '18' ? 'selected' : '' }}>GST@18%</option>
                                                    <option value="28"
                                                        {{ $product_gst[$i] == '28' ? 'selected' : '' }}>GST@28%</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col col-md-2 position-relative">
                                            <div class="product_border_input product_border_discount">
                                                <input type="number" name="product_discount"
                                                    value="{{ $product_discount[$i] ?? '' }}" class="product_discount"
                                                    id="">
                                                <select name="product_discount_type" id=""
                                                    class="product_discount_type">
                                                    <option value="%"
                                                        {{ isset($product_discount_type[$i]) && $product_discount_type[$i] == '%' ? 'selected' : '' }}>
                                                        %</option>
                                                    <option value="₹"
                                                        {{ isset($product_discount_type[$i]) && $product_discount_type[$i] == '₹' ? 'selected' : '' }}>
                                                        ₹</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-md-2 position-relative">
                                            <div class="product_border_input product_border_total">
                                                <span class="position-absolute">₹</span>
                                                <input type="text" readonly class="product_total"
                                                    value="{{ $product_total[$i] ?? '' }}" name="product_total"
                                                    id="">
                                            </div>
                                            <img class="product_delete"
                                                src="{{ asset('user/images/product/product_delete.png') }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @else
                            <p>No invoice details found.</p>
                        @endif


                    </div>


                    <div class="product_add_new text-center">
                        <button class="product_add_btn" type="button"><img class="product_add_icon"
                                src="{{ asset('user/images/buttons_icon/add_icon.png') }}" alt=""> Add New
                            Product</button>
                    </div>

                    <div class="accordion additional_charge_main" id="">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo"><img class="additional_charge_icon"
                                        src="{{ asset('user/images/buttons_icon/remove_black.png') }}"
                                        alt="">Additional Charges
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body additional_body">
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <span></span>

                                        </div>
                                        <div class="col col-md-2">
                                            <span>Amt</span>

                                        </div>
                                        <div class="col col-md-2">
                                            <span>TAX</span>

                                        </div>
                                        <div class="col col-md-2">
                                            <span>without Tax in (₹)</span>

                                        </div>
                                        <div class="col col-md-2">
                                            <span>with Tax in (₹)</span>

                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col col-md-4">
                                            <span>Delivery/ Shipping Charges </span>

                                        </div>
                                        <div class="col col-md-2">
                                            <input type="text" name="" id="">

                                        </div>
                                        <div class="col col-md-2">
                                            <input type="text" name="" id="">

                                        </div>
                                        <div class="col col-md-2">
                                            <input type="text" name="" id="">

                                        </div>
                                        <div class="col col-md-2">
                                            <input type="text" name="" id="">

                                        </div>
                                    </div>


                                    <div class="row mt-3">
                                        <div class="col col-md-4">
                                            <span>Packaging Charges</span>

                                        </div>
                                        <div class="col col-md-2">
                                            <input type="text" name="" id="">

                                        </div>
                                        <div class="col col-md-2">
                                            <input type="text" name="" id="">

                                        </div>
                                        <div class="col col-md-2">
                                            <input type="text" name="" id="">

                                        </div>
                                        <div class="col col-md-2">
                                            <input type="text" name="" id="">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </section>




            <section>
                <div class="row">
                    <div class="col col-md-6">
                        <div class="accordion notes_main" id="">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingNotes">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseNotes" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseNotes">Notes
                                        <span class="dynmic_notes">
                                            <select name="notes_select" id="notes_select"
                                                onchange="updateNotesContent()">
                                                <option value="No Notes">Select Notes</option>
                                                @foreach ($getnotes as $note)
                                                    <option value="{{ $note->id }}"
                                                        data-note-content="{{ $note->notes }}"
                                                        {{ $note->notes_active ? 'selected' : '' }}>
                                                        {{ $note->notes_title ?? 'No Title' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </span>
                                        <img class="notes_icon"
                                            src="{{ asset('user/images/buttons_icon/remove_black.png') }}"
                                            alt="">
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseNotes" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingNotes">
                                    <div class="accordion-body additional_body">
                                        <textarea name="notes" id="notes_txt" class="notes_txt" cols="30" rows="5">{{ $invoicedetails->notes ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="accordion terms_main mt-5" id="">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTerms">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTerms" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTerms">Terms & Conditions
                                        <span class="dynmic_terms">
                                            <select name="terms_select" id="terms_select"
                                                onchange="updateTermsContent()">
                                                <option value="No Notes">No Terms</option>
                                                @foreach ($getterms as $terms)
                                                    <option value="{{ $terms->id }}"
                                                        data-terms-content="{{ $terms->terms }}"
                                                        {{ $terms->terms_active ? 'selected' : '' }}>
                                                        {{ $terms->terms_title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </span>
                                        <img class="notes_icon"
                                            src="{{ asset('user/images/buttons_icon/remove_black.png') }}"
                                            alt="">
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTerms" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingTerms">
                                    <div class="accordion-body additional_body">
                                        <textarea name="terms_condition" id="terms_txt" class="terms_txt" cols="30" rows="5">{{ $activeTerms->terms ?? '' }}</textarea>
                                        {{-- <button>Save</button> --}}
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="col col-md-6">
                        <div class="overall_amt_details">
                            <div class="row">
                                <div class="col col-md-6 amt_label">
                                    <span>SGST</span>
                                    <span>CGST</span>
                                    <span class=""><input class="round_off_check" id="round_off_check"
                                            type="checkbox" {{ $invoicedetails->round_off ? 'checked' : '' }}><label
                                            for="round_off_check" class="round_off_label">Round Off</label> </span>
                                    <span>Total Tax</span>
                                    <span>Amount</span>
                                    <span>Total Discount</span>
                                </div>
                                <div class="col col-md-6 amt_vale">
                                    <span>₹<input type="text" class="sgst" readonly name="sgst"
                                            id=""></span>
                                    <span>₹<input type="text" class="cgst" readonly name="cgst"
                                            id=""></span>
                                    <span>₹<input type="text" class="round_off"
                                            value="{{ $invoicedetails->round_off ?? '' }}" readonly name="round_off"
                                            id=""></span>
                                    <span>₹<input type="text" class="total_tax" readonly name="total_tax"
                                            id=""></span>
                                    <span>₹<input type="text" class="overall_amt" readonly name="overall_amt"
                                            id=""></span>
                                    <span>₹<input type="text" class="overall_discount" readonly
                                            name="overall_discount" id=""></span>


                                    {{-- <span>₹ 12.05</span>
                                    <span>₹ 1.00</span>
                                    <span>₹ 25.00</span>
                                    <span>₹ 515.00</span>
                                    <span>₹ 10.50</span> --}}
                                </div>
                            </div>
                        </div>

                        <div class="add_payment_main mt-5">
                            <div class="payment_title d-flex align-items-baseline">
                                <h4>Add Payment Received & Method</h4>
                                <button type="button" class="ms-auto add_bank_btn"><img class="product_add_icon"
                                        src="{{ asset('user/images/buttons_icon/add_icon.png') }}" alt=""> Add
                                    Bank Account</button>
                            </div>

                            <div class="payment_filds">
                                <div class="row">
                                    <div class="col col-md-8">
                                        <select name="bank_id" class="bank_list" id="bank_list">
                                            {{-- <option value="cash">Cash</option> --}}
                                            @foreach ($getbank as $bank)
                                                <option
                                                    value="{{ $bank->id }}"{{ $bank->bank_active ? 'selected' : '' }}>
                                                    {{ $bank->bank_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <div class="row mt-4 payment_type">
                                            <div class="col col-md-6">
                                                <input type="number" name="partially_paid" id="partially_paid"
                                                    placeholder="Enter Partially Amount">
                                            </div>

                                            <div class="col col-md-6">
                                                <select name="payment_type" id="payment_type">
                                                    <option value="cash">Cash</option>
                                                    <option value="upi">UPI</option>
                                                    <option value="card">Card</option>
                                                    <option value="netbanking">Net Banking</option>
                                                    <option value="cheque">Cheque</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col col-md-4 text-center balance_main">
                                        <input type="checkbox" name="transaction_method" id="transaction_paid">
                                        <label for="transaction_paid"> Mark as fully paid Cash</label><br>
                                        <div class="balance_amt_div">
                                            <span>Balance Amount ₹ <span class="balance_amt"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="add_signature_main mt-5">
                            <div class="signature_title d-flex align-items-baseline">
                                <h4>Add Signature</h4>
                                <button type="button" class="ms-auto add_signature_btn"><img class="product_add_icon"
                                        src="{{ asset('user/images/buttons_icon/add_icon.png') }}" alt="">Add
                                    Signature</button>
                            </div>

                            <div class="signature_filds">
                                <span>Signature Name</span>
                                <select name="signature_id" id="signature_name_select" onchange="updateSignatureImage()">
                                    <option value="0">
                                        No Signature
                                    </option>
                                    @foreach ($getsignature as $signature)
                                        <option value="{{ $signature->id }}"
                                            data-signature-image="{{ $signature->signature_image ? asset($signature->signature_image) : '' }}"
                                            data-canvas-image="{{ $signature->canvas_image ? asset($signature->canvas_image) : '' }}"
                                            {{ $signature->signature_active ? 'selected' : '' }}>
                                            {{ $signature->signature_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="signature_main d-flex">
                                    <div class="ms-auto">
                                        <span class="">Signature</span><br>
                                        <div class="signature_image">
                                            <img id="signature_image"
                                                src="{{ $activeSignature ? ($activeSignature->signature_image ? asset($activeSignature->signature_image) : asset($activeSignature->canvas_image)) : '' }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>
            </section>


            <div class="invoice_submit_btn d-flex mt-5">

                <div class="ms-auto">
                    <button type="button" class="save_drafts_btn">Save drafts</button>
                    <button type="button" class="save_btn">Save</button>
                </div>

            </div>

        </form>

        <footer>
            <div class="border_footer"></div>
            <div>
                <span class="logo_img">Sky Invoice</span>
                <p>2024 © Skyinvoice. All rights reserved </p>
            </div>
        </footer>

    </div>
    @include('user.settingsmodel.bank_modal')
    @include('user.settingsmodel.signature_modal')
    @include('user.settingsmodel.customer_modal')
@endsection


@section('custom_scripts')
    <script src="{{ asset('user/js/editinvoice.js') }}"></script>
    <script src="{{ asset('user/js/setting.js') }}"></script>
    <script src="{{ asset('user/js/customer.js') }}"></script>
    {{-- <script src="{{ asset('user/js/company.js') }}"></script> --}}
    <script src="{{ asset('user/js/bank.js') }}"></script>
    <script src="{{ asset('user/js/signature.js') }}"></script>

    <script></script>

    <script>
        function updateSignatureImage() {
            var select = document.getElementById("signature_name_select");
            var selectedOption = select.options[select.selectedIndex];
            var signatureImage = selectedOption.getAttribute("data-signature-image");
            var canvasImage = selectedOption.getAttribute("data-canvas-image");

            if (signatureImage) {
                document.getElementById("signature_image").src = signatureImage;
            } else if (canvasImage) {
                document.getElementById("signature_image").src = canvasImage;
            } else {
                document.getElementById("signature_image").src = ''; // Fallback if no image is available
            }
        }

        function updateNotesContent() {
            var select = document.getElementById("notes_select");
            var selectedOption = select.options[select.selectedIndex];
            var notesDescription = selectedOption.getAttribute("data-note-content");

            document.getElementById("notes_txt").value = notesDescription;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const notesSelect = document.getElementById('notes_select');
            const notesTextarea = document.getElementById('notes_txt');

            notesSelect.addEventListener('change', updateNotesContent);
        });


        function updateTermsContent() {
            var select = document.getElementById("terms_select");
            var selectedOption = select.options[select.selectedIndex];
            var termsDescription = selectedOption.getAttribute("data-terms-content");

            document.getElementById("terms_txt").value = termsDescription;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const termsSelect = document.getElementById('terms_select');
            const termsTextarea = document.getElementById('terms_txt');

            termsSelect.addEventListener('change', updateTermsContent);
        });

        $(document).ready(function() {
            var notesSelect = $('#notes_select');
            var notesTextarea = $('#notes_txt');
            var notesCollapseElement = $('#panelsStayOpen-collapseNotes')[0];
            var notesCollapse = new bootstrap.Collapse(notesCollapseElement, {
                toggle: false
            });

            function updateNotesContent() {
                var selectedOption = notesSelect.find('option:selected');
                var notesDescription = selectedOption.data('note-content');
                notesTextarea.val(notesDescription);

                // Ensure the accordion panel is expanded
                notesCollapse.show();
            }

            // Attach change event listener to the select element
            notesSelect.on('change', updateNotesContent);

            // Update textarea on page load if there's an active note
            if (notesSelect.find('option:selected').length) {
                updateNotesContent();
            }

        });
    </script>
@endsection
