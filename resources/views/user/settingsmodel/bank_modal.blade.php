<div class="modal " id="bank_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog company-dialog modal-l">
        <div class="modal-content">
            <p class="bank_add_title">Bank Details</p>

            <div class="modal-header">

            </div>

            <div class="modal-body">
                <form id="bank_add_form">
                    <div class="bank_add_main">
                        <div class="row">
                            <div class="col col-md-12">
                                <h6 for="">Account No</h6>

                                <div class="form-floatin text-center w-100">
                                    <input type="password" class="form-control" id="account_no" placeholder="Enter Account No"
                                        name="account_no">
                                    {{-- <label for="account_no">Enter Account No</label> --}}
                                    <div class="error-message" id="account_no_error"></div>

                                </div>
                            </div>
                            <div class="col col-md-12 mt-4">
                                <h6 for="">Confirm Account No</h6>
                                <div class="form-floatin text-center w-100">
                                    <input type="text" class="form-control" id="confirm_account_no" placeholder="Enter Confirm Account No"
                                        name="confirm_account_no">
                                    {{-- <label for="confirm_account_no">Enter Confirm Account No</label> --}}
                                    <div class="error-message" id="confirm_account_no_error"></div>
                                    <div id="confirm_image_container"></div>
                                </div>
                            </div>


                            <form id="ifscForm">
                            <div class="col col-md-9 mt-4">
                                <h6 for="">IFSC Code</h6>
                                <div class="form-floatin text-center w-100">
                                    <input type="text" class="form-control" id="ifsc_code" placeholder="Enter Bank IFSC"
                                        name="ifsc_code">
                                    {{-- <label for="ifsc_code">Enter Bank IFSC</label> --}}
                                </div>
                                <div class="error-message" id="ifsc_code_error"></div>
                            </div>
                            <div class="col col-md-3 mt-4">
                                <button type="button" class="bank_fetch_btn">Fetch Bank Details</button>
                            </div>
                            </form>


                            <div class="col col-md-12 mt-4">
                                <h6 for="">Bank Name</h6>

                                <div class="form-floatin text-center w-100">
                                    <input type="text" class="form-control" id="bank_name" placeholder="Enter Bank Name"
                                        name="bank_name">
                                    {{-- <label for="bank_name">Enter Bank Name</label> --}}
                                    <div class="error-message" id="bank_name_error"></div>
                                </div>
                            </div>
                            <div class="col col-md-12 mt-4">
                                <h6 for="">Branch Name</h6>
                                <div class="form-floatin text-center w-100">
                                    <input type="text" class="form-control" id="branch_name" placeholder="Enter Branch Name"
                                        name="branch_name">
                                    {{-- <label for="branch_name">Enter Branch Name</label> --}}
                                    <div class="error-message" id="branch_name_error"></div>
                                </div>
                            </div>

                            <div class="d-flex mt-4">
                                <div class="ms-auto">
                                    <button type="button" class="cancel_btn" data-bs-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                    <button type="submit" class="save_bank_details">Save</button>
                                </div>

                            </div>
                        </div>

                       

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
