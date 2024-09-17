<div class="modal " id="company_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog company-dialog modal-l">
        <div class="modal-content">
            <p class="company_add_title">Add Company Details</p>

            <div class="modal-header">

            </div>

            <div class="modal-body">
                <form id="company_add_form">
                    <div class="company_add_main">
                        <div class="row">
                            <div class="col col-md-6">
                                <h6 for="">Company Name</h6>
                                <div class="form-floatin text-center w-100">
                                    <input type="text" class="form-control" id="companyName" class="companyName" placeholder="Enter Company Name"
                                        name="company_name">
                                    {{-- <label for="companyName">company Name</label> --}}
                                    <div class="error-message" id="companyName_error"></div>

                                </div>

                                <div class="mt-4">
                                    <h6 for="">Email</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="company_email" placeholder="Enter Email"
                                            name="company_email">
                                        {{-- <label for="company_email">Enter Email</label> --}}
                                        <div class="error-message" id="company_email_error"></div>

                                    </div>
                                </div>
                                <div class=" mt-4">
                                    <h6 for="">Mobile Number</h6>
                                    <div class="form-floatin text-center w-100">
                                        <input type="text" class="form-control" id="company_mobile_number" placeholder="Enter Mobile Number"
                                            name="company_mobile">
                                        {{-- <label for="company_mobile_number">Enter Mobile Number</label> --}}
                                        <div class="error-message" id="company_mobile_number_error"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <h6 for="">Company Logo</h6>

                                <div class="drop_company_logo" id="dropAreaCompanylogo">
                                    
                                    <div class="d-flex">
                                        <span id="company_fileName" class="file-name"></span>
                                        <span id="company_removeFile" class="remove-file"><img
                                                src="{{ asset('user/images/buttons_icon/red_close_new.png') }}"
                                                alt=""></span>
                                    </div>

                                    <label for="company_logo">

                                        <input type="file" id="company_logo" name="company_logo" class="logo_img company_logo"
                                        style="display: none;" accept="image/png, image/jpeg">
                                        
                                        <img id="previewImageCompany" class="hidden" src=""
                                            alt="Placeholder Image">
                                      
                                        <p class="company_logimg_text"> <img
                                                src="{{ asset('user/images/buttons_icon/uploade_icon.png') }}"
                                                alt="" class="upload_icon"> Upload</p>

                                    </label>

                                </div>

                                
                                {{-- <p class="company_upload_img_txt">Upload PNG or JPEG, recommended minimum 512 x 512 px
                                </p> --}}

                            </div>


                        </div>

                        <div class="row">
                            <div class="col col-md-9 mt-4">
                                <h6 for="">GST Number <span class="optional_txt">(Optional)</span></h6>
                                <div class="form-floatin text-center w-100">
                                    <input type="text" class="form-control" id="company_gstin_number" placeholder="Enter GST number"
                                        name="company_gstin_number">
                                    {{-- <label for="company_gstin_number">Enter GST number</label> --}}
                                    
                                </div>
                                <div class="error-message" id="company_gstin_number_error"></div>

                            </div>
                            <div class="col col-md-3 mt-4">
                                <button type="button" class="gst_fetch_btn">Fetch Details</button>
                            </div>
                        </div>

                        <div class="col col-md-12 mt-4 ">

                            <div class="d-flex">
                                <h6>Address <span class="optional_txt">(Optional)</span></h6>
                                <span class="ms-auto copy_shipping_address optional_txt">Copy to Shipping Address</span>
                            </div>

                            <div class="company_address_main">
                                <div class="row">
                                    <div class="col col-md-8">
                                        <h6 for="">Address</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="company_address"
                                                placeholder="Enter Address" name="company_address">
                                                
                                            {{-- <label for="company_address">Address</label> --}}
                                        </div>
                                    </div>
                                    <div class="col col-md-4">
                                        <h6 for="">Pin code</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="company_pin_code"
                                                placeholder="Enter Pin code" name="company_pin_code">
                                                <span id="company_pin_code_error" class="text-danger"></span>

                                            {{-- <label for="company_pin_code">Pin code</label> --}}
                                        </div>
                                    </div>

                                    <div class="col col-md-4">
                                        <h6 for="" class="mt-2">City</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="City" placeholder="Enter City"
                                                name="company_city">
                                            {{-- <label for="City">City</label> --}}
                                        </div>
                                    </div>
                                    <div class="col col-md-4">
                                        <h6 for="" class="mt-2">State</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="State" placeholder="Enter State"
                                                name="company_state">
                                            {{-- <label for="State">State</label> --}}
                                        </div>
                                    </div>
                                    <div class="col col-md-4">
                                        <h6 for="" class="mt-2">Country</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="Country" placeholder="Enter Country"
                                                name="company_country">
                                            {{-- <label for="Country">Country</label> --}}
                                        </div>
                                    </div>  
                                </div>


                            </div>



                            <div class="d-flex mt-3">
                                <h6>Shipping Address <span class="optional_txt">(Optional)</span></h6>
                            </div>

                            <div class="shipping_address_main">
                                <div class="row">
                                    <div class="col col-md-8">
                                        <h6 for="">Address</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="company_shipping_address"
                                                placeholder="Enter Address" name="company_shipping_address">
                                            {{-- <label for="company_shipping_address">Address</label> --}}
                                        </div>
                                    </div>
                                    <div class="col col-md-4">
                                        <h6 for="">Pin code</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="company_shipping_pin_code"
                                                placeholder="Enter Pin code" name="company_shipping_pin_code">
                                            {{-- <label for="company_shipping_pin_code">Pin code</label> --}}
                                        </div>
                                    </div>

                                    <div class="col col-md-4">
                                        <h6 for="" class="mt-2">City</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="company_shipping_city" placeholder="Enter City"
                                                name="company_shipping_city">
                                            {{-- <label for="company_shipping_city">City</label> --}}
                                        </div>
                                    </div>
                                    <div class="col col-md-4">
                                        <h6 for="" class="mt-2">State</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="company_shipping_state" placeholder="Enter State"
                                                name="company_shipping_state">
                                            {{-- <label for="company_shipping_state">State</label> --}}
                                        </div>
                                    </div>
                                    <div class="col col-md-4">
                                        <h6 for="" class="mt-2">Country</h6>
                                        <div class="form-floatin text-center w-100">
                                            <input type="text" class="form-control" id="company_shipping_country" placeholder="Enter Country"
                                                name="company_shipping_country">
                                            {{-- <label for="company_shipping_country">Country</label> --}}
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="d-flex mt-4">
                                <div class="ms-auto">
                                    <button type="button" class="cancel_btn" data-bs-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                    <button type="submit" class="save_company_details">Save</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
