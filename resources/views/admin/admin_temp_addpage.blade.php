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

        .mce-panel {
            border-width: 2px !important;
        }
    </style>
@endsection


@section('content')
    {{-- <div class="pagetitle">
    <h1><i class="mdi mdi-pen mdi-24px"></i>Templates</h1>

</div> --}}

    <div class="pagetitle">
        <h1><i class="mdi mdi-pen mdi-24px"></i>Template</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin_template') }}">Template List</a></li>
                <li class="breadcrumb-item active">Add Template</li>
            </ol>
        </nav>
    </div>
    {{-- @include('admin.show') --}}
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card" style="background-color: #fff;">
                <h4 class="card-header fw-bold">Template Form</h4>
                <div class="card-body mb-3">
                    <br>
                    <form class="forms-sample mb-3" id="formModal">
                        <div class="form-group row mb-3">

                            <div class="col-sm-3 col-md-2">
                                <label for="template_name"
                                    class=" col-form-label color-dark fs-14 fw-500 align-center fw-bold">Template Name<span
                                        class="text-danger">*</span> </label>
                            </div>

                            <div class="col-md-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15"
                                        id="template_name" name="template_name" placeholder="Template Name"
                                        autocomplete="off"> 
                                    <h5 class="invalid-feedback template_name"></h5>
                                    <label for="template_name" style="color:rgb(174, 153, 153)">Template Name</label>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-2">
                            </div>

                            <div class="col-sm-3 col-md-2">
                                <label for="template_name"
                                    class=" col-form-label color-dark fs-14 fw-500 align-center fw-bold">Template Edit<span
                                        class="text-danger">*</span> </label>
                            </div>

                            <div class="col-md-8">
                                <div class="toolbar">
                                    <select id="tagSelector">
                                        <option value="p">Paragraph</option>
                                        <option value="h1">Heading 1</option>
                                        <option value="h2">Heading 2</option>
                                        <option value="h3">Heading 3</option>
                                        <option value="h4">Heading 4</option>
                                        <option value="h5">Heading 5</option>
                                        <option value="h6">Heading 6</option>
                                    </select>
                                    <span class="side_border"></span>

                                    <button type="button" data-command="bold"><b>B</b></button>
                                    <button type="button" data-command="italic"><i>I</i></button>
                                    <button type="button" data-command="underline"><u>U</u></button>

                                    <span class="side_border"></span>
                                    <input type="file" id="imageUpload" style="display:none">
                                    {{-- <span id="uploadImageButton"> --}}
                                        <img class="img-icon" id="uploadImageButton" src="{{ asset('assets/images/image_download.png') }}">

                                    {{-- </span> --}}
                                    {{-- <button type="button" id="uploadImageButton"></button> --}}

                                    <select id="textalignSelector">
                                        <option value="left">Align Left</option>
                                        <option value="right">Align Right</option>
                                        <option value="center">Align Center</option>
                                        
                                    </select>

                                    <button type="button" data-command="justifyLeft">Align Left</button>
                                    <button  type="button" data-command="justifyCenter">Align Center</button>
                                    <button data-command="justifyRight">Align Right</button>
                                    <button type="button" id="insertTableButton">Insert Table</button>
                                    <button type="button" id="addRowButton">Add Row</button>
                                    <button type="button" id="addColumnButton">Add Column</button>
                                    <button type="button" id="deleteRowButton">Delete Row</button>
                                    <button type="button" id="deleteColumnButton">Delete Column</button>
                                    <input type="color" id="textColorPicker" title="Choose Text Color">
                                    <input type="color" id="bgColorPicker" title="Choose Background Color">
                                    <input type="file" id="bgImageUpload" accept="image/*" style="display:none">
                                    <button type="button" id="uploadBgImageButton">Upload Background Image</button>
                                    <button type="button" id="convertToHtml">Show HTML</button>
                                </div>

                                <div class="editor" contenteditable="true"></div>
                                {{-- <div class="html-output" id="htmlOutput"></div> --}}

                                {{-- <textarea name="" id="" class="editor" cols="75" rows="10"></textarea> --}}
                            </div>

                            {{-- <div class="col-md-2">
                                <div class="form-floating mb-3">
                                    <div class="txt_edit_tool">
                                        <div class="row text-center">
                                            <div class="col-md-6 mt-3">
                                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div class="image_tool_edit">
                                                   <i class="fa-regular fa-image"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                            
                                            <div class="col-md-6 mt-3">
                                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <i class="fa-regular fa-image"></i>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        </div>

                                     
                                    </div>
                                    <h5 class="invalid-feedback template_name"></h5>
                                </div>
                            </div> --}}

                        </div>


                        <button type="button" class="btn btn-primary" id="formSubmit">Submit</button>
                        <a href="{{ url('admin_template') }}" class="btn btn-dark" type="button">cancel</a>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('custom_scripts')
    <script src="{{ asset('assets/js/template.js') }}"></script>
@endsection
