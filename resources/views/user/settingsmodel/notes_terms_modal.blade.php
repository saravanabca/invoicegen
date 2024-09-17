<div class="modal" id="notes_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog company-dialog modal-l">
        <div class="modal-content">
            <p class="company_add_title notes_title">Notes</p>

            <div class="modal-header">

            </div>

            <div class="modal-body">
                <form id="notes_add_form">
                    <div class="company_add_main">
                        <div class="row">

                            <div class="col col-md-12">
                              

                                <div class="form-floatin text-center w-100">
                                    <input type="text" class="form-control notetitile" id="notes_title" placeholder="Enter title"
                                        name="notes_title">
                                    {{-- <label for="notes_title">Notes Title</label> --}}
                                    <div class="error-message" id="notes_title_error"></div>
                                </div>
                            </div>

                            <div class="col col-md-12 mt-4">
                              

                                <div class="form-floatin text-center w-100">
                                    <textarea row="10" cols="20" class="notes_input" id="notes_filed" 
                                        name="notes" placeholder="Enter notes"></textarea>
                                    <div class="error-message" id="notes_filed_error"></div>
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



<div class="modal" id="terms_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog company-dialog modal-l">
        <div class="modal-content">
            <p class="company_add_title terms_title">Terms & Conditions</p>

            <div class="modal-header">

            </div>

            <div class="modal-body">
                <form id="terms_add_form">
                    <div class="company_add_main">
                        <div class="row">
                            <div class="col col-md-12">
                              

                                <div class="form-floatin text-center w-100">
                                    <input type="text" class="form-control termstitile" id="terms_title" placeholder="Enter title"
                                        name="terms_title">
                                    {{-- <label for="terms_title">Terms Title</label> --}}
                                    <div class="error-message" id="terms_title_error"></div>
                                </div>
                                
                            </div>

                            <div class="col col-md-12 mt-4">
                              

                                <div class="form-floating text-center w-100">
                                    <textarea row="10" cols="20" class="terms_input" id="terms_filed" 
                                        name="terms" placeholder="Enter terms"></textarea>
                                    <div class="error-message" id="terms_filed_error"></div>
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



