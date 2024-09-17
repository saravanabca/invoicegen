<div class="modal " id="add_customer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="false">
<div class="modal-dialog customer-dialog modal-l">
    <div class="modal-content">
        <p class="customer_add_title">Add Customer Details</p>

        <div class="modal-header">
          
        </div>

        <div class="modal-body">
            <form id="customer_add_form">
                <div class="customer_add_main">
                    <div class="row">
                        <div class="col col-md-12">
                            <h6 for="">Customer Name</h6>
                            <div class="form-floatin text-center w-100">
                                <input type="text" class="form-control" id="CustomerName" placeholder="Customer Name"
                                    name="customer_name">
                                {{-- <label for="CustomerName">Customer Name</label>--}}
                                <div class="error-message" id="CustomerName_error"></div>

                            </div>
                        </div>
                        <div class="col col-md-6 mt-4">
                            <h6 for="">Email</h6>
                            <div class="form-floatin text-center w-100">
                                <input type="text" class="form-control" id="email" placeholder="Enter Email"
                                    name="customer_email">
                                {{-- <label for="email">Enter Email</label>--}}
                                <div class="error-message" id="email_error"></div>

                            </div>
                        </div>
                        <div class="col col-md-6 mt-4">
                            <h6 for="">Mobile Number</h6>
                            <div class="form-floatin text-center w-100">
                                <input type="text" class="form-control" id="mobile_number" placeholder="Enter Mobile Number"
                                    name="customer_mobile">
                                {{-- <label for="mobile_number">Enter Mobile Number</label>--}}
                                <div class="error-message" id="mobile_number_error"></div>

                            </div>
                        </div>

                        <div class="col col-md-9 mt-4">
                            <h6 for="">GST Number (Optional)</h6>
                            <div class="form-floatin text-center w-100">
                                <input type="text" class="form-control" id="customer_gstin_number" placeholder="Enter GST number"
                                    name="customer_gstin_number">
                                {{-- <label for="email">Enter GST number</label>--}}
                            </div>
                            <div class="error-message" id="customer_gstin_number_error"></div>

                        </div>
                        <div class="col col-md-3 mt-4">
                            <button type="button" class="gst_fetch_btn">Fetch Details</button>
                        </div>
                    </div>

                    <div class="col col-md-12 mt-4 ">

                        <div class="d-flex">
                            <h6>Address <span class="optional_txt">(Optional)</h6>
                            <span class="ms-auto copy_shipping_address">Copy to Shipping Address</span>
                        </div>

                        <div class="customer_address">
                            <div class="row">
                                <div class="col col-md-8">
                                    <h6 for="">Address</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="customer_address"
                                            placeholder="Address" name="customer_address">
                                        {{-- <label for="customer_address">Address</label>--}}
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <h6 for="">Pin code</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="customer_pin_code"
                                            placeholder="Pin code" name="customer_pin_code">
                                        {{-- <label for="customer_pin_code">Pin code</label>--}}
                                    </div>
                                 </div>

                                <div class="col col-md-4">
                                    <h6 for="" class="mt-2">City</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="City" placeholder="City"
                                            name="customer_city">
                                        {{-- <label for="City">City</label>--}}
                                    </div>
                                </div>

                                <div class="col col-md-4">
                                    <h6 for="" class="mt-2">State</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="State" placeholder="State"
                                            name="customer_state">
                                        {{-- <label for="State">State</label>--}}
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <h6 for="" class="mt-2">Country</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="Country" placeholder="Country"
                                            name="customer_country">
                                        {{-- <label for="Country">Country</label>--}}
                                    </div>
                                </div>
                            </div>


                        </div>



                        <div class="d-flex mt-3">
                            <h6>Shipping Address <span class="optional_txt">(Optional)</span></h6>
                        </div>

                        <div class="shipping_address">
                            <div class="row">
                                <div class="col col-md-8">
                                    <h6 for="">Address</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="cus_shipping_address"
                                            placeholder="Address" name="cus_shipping_address">
                                        {{-- <label for="cus_shipping_address">Address</label>--}}
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <h6 for="">Pin code</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="cus_shipping_pin_code"
                                            placeholder="Pin code" name="cus_shipping_pin_code">
                                        {{-- <label for="cus_shipping_pin_code">Pin code</label>--}}
                                    </div>
                                </div>

                                <div class="col col-md-4">
                                    <h6 for="" class="mt-2">City</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="cus_shipping_city" placeholder="City"
                                            name="cus_shipping_city">
                                        {{-- <label for="cus_shipping_city">City</label>--}}
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <h6 for="" class="mt-2">State</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="cus_shipping_state" placeholder="State"
                                            name="cus_shipping_state">
                                        {{-- <label for="cus_shipping_state">State</label>--}}
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <h6 for="" class="mt-2">Country</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="cus_shipping_country" placeholder="Country"
                                            name="cus_shipping_country">
                                        {{-- <label for="cus_shipping_country">Country</label>--}}
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="d-flex mt-4">
                            <div class="ms-auto">
                                <button type="button" class="cancel_btn" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button type="submit" class="save_customer_details">Save</button>
                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
</div>