@extends('user.userlayouts.user_app')
@php
    $title = 'Invocie Generator - Dashbord';
@endphp

@section('custom_style')
    <style>
        #view_invoice .btn-close {
            background: transparent url('{{ url('user/images/invoice/view_close.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
            margin-left: auto;
            margin-right: 10px;
            margin-top: 5px;
            box-shadow: none;
        }

        #template_modal .btn-close {
            background: transparent url('{{ url('images/login/close_btn.png') }}') center / 1em auto no-repeat !important;
            opacity: unset;
        }

        .template_active_img {
            position: absolute;
            right: 7px;
            top: 7px;
            height: 17px;
            display: none;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('user/css/settings.css') }}">
@endsection


@section('content')
    @include('user.userlayouts.user_side_nav')

    @include('user.userlayouts.user_top_nav')



    <div class="page-container">

        <div class="main_page_div">
            <div class="main_head1 d-flex">
                <p class="page_heading">Settings</p>


                <button class="template_btn ms-auto" data-bs-toggle="modal" data-bs-target="#template_modal"><img
                        class="add_icon_temp" src="{{ asset('user/images/buttons_icon/template_btn_icon.png') }}"
                        alt="">Set as
                    Template</button>

            </div>

            <div class="settings_main_div">
                <div class="row setting_height">
                    <div class="col col-md-3 setting_side_nav">


                        <ul class="nav">
                            <li class="">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">User</button>
                            </li>
                            <li class="mt-3">
                                <button class="nav-link" id="company-tab" data-bs-toggle="tab" data-bs-target="#company"
                                    type="button" role="tab" aria-controls="company"
                                    aria-selected="false">Company</button>
                            </li>
                            <li class="mt-3">
                                <button class="nav-link" id="bank_details-tab" data-bs-toggle="tab"
                                    data-bs-target="#bank_details" type="button" role="tab"
                                    aria-controls="bank_details" aria-selected="false">Bank Details</button>
                            </li>

                            <li class="mt-3">
                                <button class="nav-link" id="signature-tab" data-bs-toggle="tab" data-bs-target="#signature"
                                    type="button" role="tab" aria-controls="signature"
                                    aria-selected="false">Signature</button>
                            </li>

                            <li class="mt-3">
                                <button class="nav-link" id="role-tab" data-bs-toggle="tab" data-bs-target="#role"
                                    type="button" role="tab" aria-controls="role" aria-selected="false">All
                                    Users/Roles</button>
                            </li>

                            <li class="mt-3">
                                <button class="nav-link" id="document-tab" data-bs-toggle="tab" data-bs-target="#document"
                                    type="button" role="tab" aria-controls="document" aria-selected="false">Document
                                    Settings</button>
                            </li>

                            <li class="mt-3">
                                <button class="nav-link" id="notes_terms-tab" data-bs-toggle="tab"
                                    data-bs-target="#notes_terms" type="button" role="tab" aria-controls="notes_terms"
                                    aria-selected="false">Notes</button>
                            </li>

                            <li class="mt-3">
                                <button class="nav-link" id="terms_condition-tab" data-bs-toggle="tab"
                                    data-bs-target="#terms_condition" type="button" role="tab"
                                    aria-controls="terms_condition" aria-selected="false">Terms & Conditions</button>
                            </li>

                        </ul>


                    </div>
                    <div class="col col-md-9">

                        {{-- User details --}}
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <form id="user_profile_form">
                                    <div class="row">
                                        <div class="col col-md-3">
                                            <label for="" class="user_input_label"> Profil Image</label>
                                        </div>

                                        <div class="col col-md-9">
                                            <div class="drop_user_img" id="dropArea">
                                                {{-- <label for="fileInput">
                                                    <input type="file" id="fileInput" class="logo_img"
                                                        style="display: none;" accept="image/png, image/jpeg">
                                                    <img id="previewImage" src="{{ asset('images/placholder_image.png') }}"
                                                alt="Placeholder Image">
                                                    <p class="logimg_text"> Uploade</p>

                                                </label>
                                            </div>
                                            <p class="company_upload_img_txt">Upload PNG or JPEG, recommended minimum 512 x
                                                512 px</p> --}}

                                                <div class="d-flex">
                                                    <span id="user_fileName" class="file-name"></span>
                                                    <span id="user_removeFile" class="remove-file"><img
                                                            src="{{ asset('user/images/buttons_icon/red_close_new.png') }}"
                                                            alt=""></span>
                                                </div>

                                                <label for="user_profile">

                                                    <input type="file" id="user_profile" name="avatar"
                                                        class="user_profile" style="display: none;"
                                                        accept="image/png, image/jpeg">

                                                    <img id="previewImageUser" class="hidden" src=""
                                                        alt="Placeholder Image">

                                                    <p class="user_logimg_text"> <img
                                                            src="{{ asset('user/images/buttons_icon/uploade_icon.png') }}"
                                                            alt="" class="upload_icon"> Upload</p>

                                                </label>
                                            </div>
                                        </div>


                                        <div class="col col-md-3 mt-3">
                                            <label for="" class="user_input_label"> Name</label>
                                        </div>

                                        <div class="col col-md-9 mt-3">
                                            <input type="text" name="name" id="user_name" class="user_input"
                                                placeholder="">
                                               
                                            <div class="error-message" id="user_name_error"></div>

                                        </div>

                                        <div class="col col-md-3 mt-4">
                                            <label for="" class="user_input_label"> Mobile Number</label>
                                        </div>
                                        <div class="col col-md-9 mt-4 position-relative">
                                            <input type="text" name="phone" class="user_input" placeholder=""
                                                disabled>
                                                <div class="user_confirm_img">
                                                    <img src="{{asset('user/images/buttons_icon/confirm.png') }}" alt="">
                                                </div>
                                        </div>


                                        <div class="col col-md-3 mt-4">
                                            <label for="" class="user_input_label"> Email</label>
                                        </div>
                                        <div class="col col-md-9 mt-4 position-relative">
                                            <input type="email" name="email" class="user_input" placeholder=""
                                                disabled>
                                                <div class="user_confirm_img">
                                                    <img src="{{asset('user/images/buttons_icon/confirm.png') }}" alt="">
                                                </div>
                                        </div>
                                        <div class="d-flex">
                                            <button class="ms-auto update_profile">Save</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                            {{-- Comapny details --}}

                            <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
                                @if (!$companydetails->isEmpty())
                                    <div class="d-flex">
                                        <button class="ms-auto add_company_btn"><img class="add_icon"
                                                src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}"
                                                alt="">Add
                                            Comapny Details</button>
                                    </div>

                                    <div class="row company_head">
                                        <div class="col col-md-2">
                                            Set as Default
                                        </div>
                                        <div class="col col-md-3">
                                            Company Name
                                        </div>
                                        <div class="col col-md-4">
                                            Address
                                        </div>
                                        <div class="col col-md-3">
                                            Action
                                        </div>

                                    </div>


                                    <div id="companiesContainer">

                                    </div>
                                    <h6 class="mt-5"> * Company can add up to two companies</h6>
                                @else
                                    <div class="placeholder_images">
                                        <img class="company_placeholder_img" src="{{ asset('user/images/invoice/invoice_emety_new.png') }}"
                                            alt=""><br>
                                        {{-- <h3>Create Your First Invoice</h3> --}}
                                        <button class="ms-auto add_company_btn mt-4"><img class="add_icon"
                                                src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}"
                                                alt="">Add
                                            Comapny Details</button>
                                    </div>
                                @endif

                            </div>

                            {{-- Bank details --}}
                            <div class="tab-pane fade style-3" id="bank_details" role="tabpanel"
                                aria-labelledby="bank_details-tab">
                                <div class="d-flex">
                                    <button class="ms-auto add_bank_btn"><img class="add_icon"
                                            src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}" alt="">Add
                                        Bank Account</button>
                                </div>

                                <div class="row bank_head">
                                    <div class="col col-md-3">
                                        Set as Default
                                    </div>
                                    <div class="col col-md-6">
                                        Bank Details
                                    </div>

                                    <div class="col col-md-3">
                                        Action
                                    </div>

                                </div>

                                <div id="bankContainer" class="style-3">

                                </div>




                                {{-- <div class="row bank_data">
                                    <div class="col col-md-3">
                                        <input type="radio" name="select_bank" value="comapny_2">
                                    </div>
                                    <div class="col col-md-5">
                                        <span class="comapny_name">Skyraan</span><br>
                                        <img src="{{ asset('user/images/buttons_icon/template_btn_icon.png') }}"
                                            alt="">
                                    </div>

                                    <div class="col col-md-4">
                                        <div class="bank_action_btns d-flex">
                                            <button class="bank_edit_btn d-flex"><img
                                                    src="{{ asset('user/images/buttons_icon/edit.png') }}"
                                                    alt="">Edit</button>
                                            <button class="bank_delete_btn d-flex"><img
                                                    src="{{ asset('user/images/buttons_icon/delete.png') }}"
                                                    alt="">Delete</button>
                                        </div>
                                    </div>

                                </div> --}}

                            </div>


                            {{-- signature details --}}


                            <div class="tab-pane fade" id="signature" role="tabpanel" aria-labelledby="signature-tab">
                                @if (!$signaturedetails->isEmpty())
                                    <div class="d-flex">
                                        <button class="ms-auto add_signature_btn"><img class="add_icon"
                                                src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}"
                                                alt="">Add
                                            Signature</button>
                                    </div>

                                    <div class="row signature_head">
                                        <div class="col col-md-2">
                                            Set As Default
                                        </div>
                                        <div class="col col-md-3">
                                            Name
                                        </div>

                                        <div class="col col-md-3">
                                            Signature
                                        </div>

                                        <div class="col col-md-4">
                                            Action
                                        </div>

                                    </div>

                                    <div id="signatureContainer" class="style-3">

                                    </div>

                                    {{-- <div class="row signature_data">
                                    <div class="col col-md-2">
                                        <input type="radio" name="select_signature" value="comapny_1">
                                    </div>
                                    <div class="col col-md-3">
                                        <span class="signature_name">Skyraan</span><br>
                                    </div>
                                    <div class="col col-md-3">
                                        <span class="signature_name">Skyraan</span><br>
                                    </div>

                                    <div class="col col-md-4">
                                        <div class="signature_action_btns d-flex">
                                            <button class="signature_edit_btn d-flex"><img
                                                    src="{{ asset('user/images/buttons_icon/edit.png') }}"
                                                    alt="">Edit</button>
                                            <button class="signature_delete_btn d-flex"><img
                                                    src="{{ asset('user/images/buttons_icon/delete.png') }}"
                                                    alt="">Delete</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="row signature_data">
                                    <div class="col col-md-2">
                                        <input type="radio" name="select_signature" value="comapny_1">
                                    </div>
                                    <div class="col col-md-3">
                                        <span class="signature_name">Skyraan</span><br>
                                    </div>
                                    <div class="col col-md-3">
                                        <span class="signature_name">Skyraan</span><br>
                                    </div>

                                    <div class="col col-md-4">
                                        <div class="signature_action_btns d-flex">
                                            <button class="signature_edit_btn d-flex"><img
                                                    src="{{ asset('user/images/buttons_icon/edit.png') }}"
                                                    alt="">Edit</button>
                                            <button class="signature_delete_btn d-flex"><img
                                                    src="{{ asset('user/images/buttons_icon/delete.png') }}"
                                                    alt="">Delete</button>
                                        </div>
                                    </div>

                                </div> --}}
                                @else
                                    <div class="placeholder_images">
                                        <img class="signature_placeholder_img" src="{{ asset('user/images/settings/signature_placehold.png') }}"
                                            alt=""><br>
                                        {{-- <h3>Create Your First Invoice</h3> --}}
                                        <button class="ms-auto add_signature_btn mt-4"><img class="add_icon"
                                                src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}"
                                                alt="">Add
                                            Signature</button>
                                    </div>
                                @endif

                            </div>



                            {{-- Role details --}}
                            <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab">
                                <div class="d-flex">
                                    <button class="ms-auto add_role_btn"><img class="add_icon"
                                            src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}" alt="">Add
                                        User</button>
                                </div>

                                <div class="row role_head">
                                    <div class="col col-md-2">
                                        Name
                                    </div>
                                    <div class="col col-md-3">
                                        Email
                                    </div>

                                    <div class="col col-md-3">
                                        Mobile
                                    </div>

                                    <div class="col col-md-2">
                                        Permissions
                                    </div>

                                    <div class="col col-md-2">
                                        Role
                                    </div>

                                </div>

                                <div class="row role_data">
                                    <div class="col col-md-2">
                                        <input type="radio">
                                        <span class="role_name">Skyraan</span>
                                    </div>
                                    <div class="col col-md-3">
                                        <span class="role_name">Skyraan@gmail.com</span>
                                    </div>
                                    <div class="col col-md-3">
                                        <span class="role_name">91+ 458920942</span><br>
                                    </div>

                                    <div class="col col-md-2">
                                        <span class="role_name">All</span><br>
                                    </div>

                                    <div class="col col-md-2">
                                        <div class="role_action_btns d-flex">
                                            <button class="role_edit_btn d-flex"><img
                                                    src="{{ asset('user/images/buttons_icon/edit.png') }}"
                                                    alt="">Admin</button>

                                        </div>
                                    </div>

                                </div>



                            </div>


                            {{-- Document details --}}
                            <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="row">

                                            <div class="col col-md-6">
                                                <span class="invoice_prefix_title">Invoice Prefix</span>
                                            </div>
                                            <div class="col col-md-6">
                                                <button class="invoice_prefix_btn"><img class="add_icon"
                                                        src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}"
                                                        alt=""> Add New Prefix</button>
                                            </div>
                                            <div class="col col-md-12">
                                                <select class="select_invoice_prefix" name="" id="">
                                                    <option value="inv">INV</option>
                                                    <option value="inv">INV</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col col-md-6">
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <span class="doc_txt_title">Document Text Color <span></span></span>

                                            </div>
                                            <div class="col col-md-12">
                                                <input class="doc_txt_color" type="text" name=""
                                                    id="" value="000000">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col col-md-6">
                                        <span class="font_fam_title">Select Font Family</span><br>
                                        <select class="select_font_fam" name="" id="">
                                            <option value="inv">Barlow</option>
                                            <option value="inv">INV</option>
                                        </select>
                                    </div>
                                    <div class="col col-md-6">
                                        <span class="font_style_title">Slect Font Style <span></span></span><br>
                                        <select class="select_font_style" name="" id="">
                                            <option value="inv">Regular</option>
                                            <option value="inv">INV</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            {{-- Notes and Terms --}}
                            <div class="tab-pane fade" id="notes_terms" role="tabpanel"
                                aria-labelledby="notes_terms-tab">


                                @if (!$notesdetails->isEmpty())
                                    <div class="d-flex">
                                        <h5>Notes</h5>
                                        <button class="ms-auto add_notes_btn"><img class="add_icon_notes"
                                                src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}"
                                                alt="">Add
                                            Notes</button>
                                    </div>

                                    <div class="row notes_head">
                                        <div class="col col-md-3">
                                            Set as Default
                                        </div>
                                        <div class="col col-md-5">
                                            Notes
                                        </div>
                                        <div class="col col-md-4">
                                            Action
                                        </div>
                                    </div>

                                    <div id="notesContainer" class="style-3">
                                        {{-- Populate notes here --}}
                                    </div>
                                @else
                                    <div class="placeholder_images">
                                        <img class="terms_placeholder_img" src="{{ asset('user/images/settings/notesterms_placeholder.png') }}"
                                            alt=""><br>
                                        {{-- <h3>Create Your First Invoice</h3> --}}
                                        <button class="ms-auto add_notes_btn"><img class="add_icon_notes"
                                                src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}"
                                                alt="">Add
                                            Notes</button>

                                    </div>
                                @endif


                            </div>

                            {{-- Notes and Terms --}}
                            <div class="tab-pane fade" id="terms_condition" role="tabpanel"
                                aria-labelledby="terms_condition-tab">



                                @if (!$termsdetails->isEmpty())
                                    <div class="d-flex">
                                        <h5>Terms & Conditions</h5>
                                        <button class="ms-auto add_terms_btn"><img class="add_icon_terms"
                                                src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}"
                                                alt="">Add
                                            Terms & Conditions</button>
                                    </div>

                                    <div class="row notes_head">
                                        <div class="col col-md-3">
                                            Set as Default
                                        </div>
                                        <div class="col col-md-5">
                                            Terms & Conditions
                                        </div>
                                        <div class="col col-md-4">
                                            Action
                                        </div>
                                    </div>

                                    <div id="termsContainer" class="style-3">

                                    </div>
                                @else
                                    <div class="placeholder_images">
                                        <img class="terms_placeholder_img" src="{{ asset('user/images/settings/notesterms_placeholder.png') }}"
                                            alt=""><br>
                                        {{-- <h3>Create Your First Invoice</h3> --}}
                                        <button class="ms-auto add_terms_btn"><img class="add_icon_terms"
                                                src="{{ asset('user/images/buttons_icon/add_icon_new.png') }}"
                                                alt="">Add
                                            Terms & Conditions</button>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    @include('user.settingsmodel.company_modal')
    @include('user.settingsmodel.templatemodal')
    @include('user.settingsmodel.bank_modal')
    @include('user.settingsmodel.signature_modal')
    @include('user.settingsmodel.notes_terms_modal')
@endsection


@section('custom_scripts')
    <script src="{{ asset('user/js/setting.js') }}"></script>
    {{-- <script src="{{ asset('user/js/company.js') }}"></script> --}}
    <script src="{{ asset('user/js/bank.js') }}"></script>
    <script src="{{ asset('user/js/signature.js') }}"></script>
    <script src="{{ asset('user/js/notes.js') }}"></script>
    <script src="{{ asset('user/js/terms.js') }}"></script>
    <script src="{{ asset('user/js/template.js') }}"></script>
@endsection
