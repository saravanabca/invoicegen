<div class="modal " id="signature_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog company-dialog modal-l">
        <div class="modal-content">
            <p class="company_add_title">Signature</p>

            <div class="modal-header">

            </div>

            <div class="modal-body">
                <form id="signature_add_form">
                    <div class="company_add_main">
                        <div class="row">
                            <div class="col col-md-12">
                                <h6 for="">Signature Name</h6>

                                <div class="form-floatin text-center w-100">
                                    <input type="text" class="form-control signaturename" id="signature_name" placeholder="Enter Signature Name"
                                        name="signature_name">
                                    {{-- <label for="signature_name">Enter Signature Name</label> --}}
                                    <div class="error-message" id="signature_name_error"></div>

                                </div>
                            </div>

                            <div class="col col-md-12 mt-4">
                                <h6 for="">Upload Or Draw Signature </h6>

                                <ul class="nav signature_button">
                                    <li class="upload_btn_main">
                                        <button class="nav-link active upload_btn_signature" id="upload_btn_sign_tab"
                                            data-bs-toggle="tab" data-bs-target="#upload_btn_sign" type="button"
                                            role="tab" aria-controls="upload_btn_sign"
                                            aria-selected="true">Upload</button>
                                    </li>
                                    <li class="draw_btn_main">
                                        <button class="nav-link draw_btn_signature" id="draw_btn_sign_tab"
                                            data-bs-toggle="tab" data-bs-target="#draw_btn_sign" type="button"
                                            role="tab" aria-controls="draw_btn_sign"
                                            aria-selected="false">Draw</button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="upload_btn_sign" role="tabpanel"
                                        aria-labelledby="upload_btn_sign_tab">

                                        <div class="drop_signature_image" id="dropAreaSignature">
                                            <div class="d-flex justify-content-end">
                                                <span id="signature_file_name" class="file-name"></span>
                                                <span id="signature_removeFile" class="remove-file"><img
                                                        src="{{ asset('user/images/buttons_icon/red_close_new.png') }}"
                                                        alt=""></span>
                                            </div>
                                            
                                            <label class="signature_input_label" for="signature_input">
                                                <input type="file" id="signature_input" class="signature_input" name="signature_image"
                                                class="logo_img" style="display: none;" accept="image/png, image/jpeg">

                                                <img id="previewImageSignature" class="hidden" src="" alt="Placeholder Image">

                                                 <p class="signature_img_text"> <img
                                                        src="{{ asset('user/images/buttons_icon/add_icon_black.png') }}"
                                                        alt="Placeholder Image"> Upload</p>

                                            </label>
                                        </div>

                                        {{-- <p class="company_upload_img_txt">Upload PNG or JPEG, recommended minimum 512 x
                                            512
                                            px
                                        </p> --}}
                                    </div>


                                    <div class="tab-pane fade" id="draw_btn_sign" role="tabpanel"
                                        aria-labelledby="draw_btn_sign_tab">

                                        <div class="draw_sign_canvas" id="">

                                            <canvas id="signatureCanvas"></canvas>
                                            <div class="remove_draw_sign">
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="error-message" id="signature_error"></div>


                            </div>
                            
                            <div class="d-flex mt-4">
                                <div class="ms-auto">
                                    <button type="button" class="cancel_btn" id="sign_cancel_modal" data-bs-dismiss="modal"
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
