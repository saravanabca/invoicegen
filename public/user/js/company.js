$(document).ready(function () {
    var mode, id, coreJSON;
    // Declare coreJSON outside the scope

    // ***************************[Get] ********************************************************************
    getcomapny();
    function getcomapny(){
        $.ajax({
            url: baseUrl + "/company_get",
            type: "GET",
            dataType: "json",
            success: function (response) {
                disCompany(response);
                coreJSON = response.companydetails;
                console.log(coreJSON);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching invoice details:", error);
            },
        });
    }


    function disCompany(response) {
        const companiesContainer =
            document.getElementById("companiesContainer"); // The container where company data will be appended
        companiesContainer.innerHTML = ""; // Clear the container before appending new data
        var edit_icon = baseUrl + "/user/images/buttons_icon/edit.png";
        var delete_icon = baseUrl + "/user/images/buttons_icon/delete.png";
        response.companydetails.forEach((company, index) => {
            // console.log(index);
            const isActive = company.company_active === 1 ? "checked" : "";
         
            const companyHTML = `
                <div class="row company_data">
                    <div class="col col-md-2">
                        <input type="radio" name="select_company" class="active_company" id="${
                            company.id
                        }" value="company_${index + 1}" ${isActive}>
                    </div>
                    <div class="col col-md-3">
                        <span class="company_name">${
                            company.company_name
                        }</span><br>
                        <img class="company_img_show" src="${ baseUrl + '/' + company.company_logo
                        }" alt="">
                    </div>
                    <div class="col col-md-4">
                        <span class="company_address">${
                            company.company_address
                                ? company.company_address
                                : "Address not available"
                        }</span>                               
                    </div>
                    <div class="col col-md-3">
                        <div class="company_action_btns d-flex">
                            <button class="company_edit_btn d-flex" dataid="${index}"><img src="${edit_icon}" alt="">Edit</button>
                           
                        </div>
                    </div>
                </div>
            `;
            companiesContainer.insertAdjacentHTML("beforeend", companyHTML);
        });
        if (response.companydetails.length === 2) {
            $(".add_company_btn").remove();
        }
    }


    // <button class="company_delete_btn d-flex" id="${
    //     company.id
    // }"><img src="${delete_icon}" alt="">Delete</button>

    // ***************************[Active Company] ********************************************************************

    $(document).on("change", ".active_company", function () {
        var companyactiveid = $(this).attr("id");
        $.ajax({
            url: baseUrl + "/company_active",
            type: "POST",
            data: { companyactiveid: companyactiveid },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // Handle success
                if (response.status) {
                    location.reload();
                    showToast(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error submitting form:", error);
                // Handle error
            },
        });
    });

    // ***************************[Add] ********************************************************************

    $(".add_company_btn").click(function () {
        mode = "new";

        $("#change_company_modal").modal("hide");
        $("#company_modal").modal("show");

    });

    $("#company_modal").on("show.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#company_removeFile").css("display", "none");
        $("#previewImageCompany").addClass("hidden");
        $(".company_logimg_text").css("display", "block");

        
        // $('.invalid-feedback').hide();
        $(".form-control").removeClass("danger-border success-border");
        $(".error-message").html("");
    });

    // Real-time validation on keyup
    $("#company_add_form input").on("keyup", function () {
        validateField($(this));
    });

    // Form submission
    $("#company_add_form").on("submit", function (e) {
        e.preventDefault();
        var form = $(this);
        var isValid = true;
        var firstInvalidField = null;

        // Validate all fields
        if (!validateField($("#companyName"))) {
            isValid = false;
            firstInvalidField = $("#companyName");
        } else if (!validateField($("#company_email"))) {
            isValid = false;
            if (firstInvalidField === null) firstInvalidField = $("#company_email");
        } else if (!validateField($("#company_mobile_number"))) {
            isValid = false;
            if (firstInvalidField === null)
                firstInvalidField = $("#company_mobile_number");
        }

        if (isValid) {
            var formData = new FormData(this);

            // var fileInput = document.getElementById("company_logo");
            // var file = fileInput.files[0];
            // formData.append("company_logo", file);

            // console.log(mode);
            if (mode == "new") {
                // return;
                AjaxSubmit(formData, baseUrl + "/company_add", "POST");
            } else if (mode == "update") {
                showToast(id);
                // return;
                formData.append("company_id", id);
                AjaxSubmit(formData, baseUrl + "/company_update", "POST");
            }
        } else {
            firstInvalidField.focus();
        }
    });

    // Field validation function
    function validateField(field) {
        var fieldId = field.attr("id");
        var fieldValue = field.val().trim();
        var isValid = true;
        var errorMessage = "";

        if (fieldId === "companyName") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "company Name is required";
            }
        } else if (fieldId === "company_email") {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Email is required";
                // showToast("ssss");

            } else if (!emailRegex.test(fieldValue)) {
                isValid = false;
                errorMessage = "Enter a valid Email";
            }
        } else if (fieldId === "company_mobile_number") {
            var mobileRegex = /^[0-9]{10}$/;
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Mobile Number is required";
            } else if (!mobileRegex.test(fieldValue)) {
                isValid = false;
                errorMessage = "Enter a valid Mobile Number";
            }
        }

        if (isValid) {
            field.removeClass("danger-border").addClass("success-border");
            $("#" + fieldId + "_error").text("");
        } else {
            field.removeClass("success-border").addClass("danger-border");
            $("#" + fieldId + "_error").text(errorMessage);
            // field.focus();
        }

        return isValid;
    }

    // AJAX submit function
    function AjaxSubmit(formData, url, method) {
        $.ajax({
            url: url,
            type: method,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // Handle success
                if (response.status === "company_add_success") {
                    if (response.status_value) {
                        // showToast(response.message);

                        // showToast(response.message);
                        $("#company_modal").modal("hide");
                      
                        showToast(response.message);
                        window.location.reload();
                        // getcomapny();
                    } else {
                        showToast(response.message);
                    }
                }
                if (response.status === "company_update_success") {
                    if (response.status_value) {
                        showToast(response.message);
                        window.location.reload();

                        // showToast(response.message);
                    } else {
                        showToast(response.message);
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error("Error submitting form:", error);
                // Handle error
            },
        });
    }



    // ***************************[Edit] ********************************************************************

    $(document).on("click", ".company_edit_btn", function () {
        var r_index = $(this).attr("dataid");
        mode = "update";
    // console.log(coreJSON[r_index]);
        $("#change_company_modal").modal("hide");
        $("#company_modal").modal("show");
        $("#companyName").val(coreJSON[r_index].company_name);
        $("#company_email").val(coreJSON[r_index].company_email);
        $("#company_mobile_number").val(coreJSON[r_index].company_mobile);
        $("#company_address").val(coreJSON[r_index].company_address);
        $("#company_pin_code").val(coreJSON[r_index].company_pin_code);
        $("#City").val(coreJSON[r_index].company_city);
        $("#State").val(coreJSON[r_index].company_state);
        $("#Country").val(coreJSON[r_index].company_country);
        $("#previewImageCompany").attr("src", baseUrl + '/' + coreJSON[r_index].company_logo);
        $("#previewImageCompany").removeClass("hidden");
        $(".company_logimg_text").css("display", "none");
        $("#company_removeFile").css("display", "block");
        $("#company_shipping_address").val(coreJSON[r_index].company_address);
        $("#company_shipping_pin_code").val(coreJSON[r_index].company_pin_code);
        $("#company_shipping_city").val(coreJSON[r_index].company_city);
        $("#company_shipping_state").val(coreJSON[r_index].company_state);
        $("#company_shipping_country").val(coreJSON[r_index].company_country);

        console.log(coreJSON);
        id = coreJSON[r_index].id;
        // console.log(id);
    });

    // ***************************[Delete] ********************************************************************
    $(document).on("click", ".company_delete_btn", function () {
        var selectedId = $(this).attr("id");
        $.confirm({
            title: "Confirmation!",
            content: "Are you sure want to delete?",
            type: "red",
            typeAnimated: true,
            // autoClose: 'cancelAction|8000',
            buttons: {
                deletecompany: {
                    text: "delete company",
                    action: function () {
                        $.ajax({
                            url: baseUrl + "/company_delete",
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            data: { selectedId: selectedId }, // Send data as an object
                            success: function (data) {
                                if (data.status) {
                                    $.toast({
                                        heading: "Success",
                                        text: data.message,
                                        showHideTransition: "plain",
                                        icon: "success",
                                        position: "top-center",
                                        stack: false,
                                        hideAfter: 2000,
                                        // bgColor: '#f3b634',
                                        textColor: "white",
                                        beforeHide: function () {
                                            // Reload the page after the toast notification is shown
                                            getcomapny();
                                        },
                                    });
                                } else {
                                    $.toast({
                                        heading: "Fail",
                                        text: data.message,
                                        showHideTransition: "plain",
                                        icon: "fail",
                                        position: "top-right",
                                        stack: false,
                                        hideAfter: 2000,
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                // Handle error response
                            },
                        });
                    },
                    btnClass: "btn-red",
                },
                cancel: function () {
                    // $.showToast('action is canceled');
                },
            },
        });
    });

    // ***************************[Company logo Uploade] ********************************************************************

    $(document).on("change", ".company_logo", function (event) {
        // showToast();
        const file = event.target.files[0];
        console.log(file);
        if (file) {
            event.preventDefault();

            const reader = new FileReader();

            reader.onload = function (e) {
                const previewImage = document.getElementById(
                    "previewImageCompany"
                );
                const fileName = document.getElementById("company_fileName");
                const removeFile =
                    document.getElementById("company_removeFile");

                previewImage.src = e.target.result;
                previewImage.classList.remove("hidden");
                $(".company_logimg_text").css("display", "none"); // Hide all elements with class signature_img_text

                fileName.textContent = file.name;
                removeFile.style.display = "block";
            };
            reader.readAsDataURL(file);

            // var msg = "success Upload";
            // launch_toast(msg);
        }
    });

    $(document).on("click", "#company_removeFile", function () {
        // showToast();

        $(".company_logimg_text").show();
        $(".company_logo").val(""); // Clear the file input

        const previewImage = document.getElementById("previewImageCompany");
        const fileName = document.getElementById("company_fileName");
        const removeFile = document.getElementById("company_removeFile");

        previewImage.src = "";
        previewImage.classList.add("hidden");
        fileName.textContent = "";
        removeFile.style.display = "none";
    });


// ***************************[Copy to shipping address] ********************************************************************
$(document).on("click", ".copy_shipping_address", function () {
    // Get values from the company_address_main section
    const address = $("input[name='company_address']").val();
    const pinCode = $("input[name='company_pin_code']").val();
    const city = $("input[name='company_city']").val();
    const state = $("input[name='company_state']").val();
    const country = $("input[name='company_country']").val();

    // Set values in the shipping_address_main section
    $("input[name='company_shipping_address']").val(address);
    $("input[name='company_shipping_pin_code']").val(pinCode);
    $("input[name='company_shipping_city']").val(city);
    $("input[name='company_shipping_state']").val(state);
    $("input[name='company_shipping_country']").val(country);
});




// ***************************[company_pin_code details] ********************************************************************

$("#company_pin_code").on("keyup", function () {
    var pinCode = $(this).val().trim();
    var errorMessage = "";

    if (!/^\d{0,6}$/.test(pinCode)) {
        errorMessage = pinCode.length > 6 ? "Pin code cannot exceed 6 characters" : "Pin code should only contain numbers";
        pinCode = pinCode.replace(/\D/g, '').substring(0, 6);
        showToast(errorMessage);
    }

    $(this).val(pinCode);
});

$("#company_shipping_pin_code").on("keyup", function () {
    var pinCode = $(this).val().trim();
    var errorMessage = "";

    if (!/^\d{0,6}$/.test(pinCode)) {
        errorMessage = pinCode.length > 6 ? "Pin code cannot exceed 6 characters" : "Pin code should only contain numbers";
        pinCode = pinCode.replace(/\D/g, '').substring(0, 6);
        showToast(errorMessage);
    }

    $(this).val(pinCode);
});

$("#City, #State, #Country").on("keyup", function () {
    var inputVal = $(this).val().trim();
    var errorMessage = "";

    // Regex to match any character that is not a letter
    if (!/[a-zA-Z]/.test(inputVal)) {
        errorMessage = "This field should only contain letters";
        inputVal = inputVal.replace(/[^a-zA-Z]/g,''); // Replace unwanted characters
        showToast(errorMessage);
    }

    $(this).val(inputVal); // Update the input value with the cleaned value
});

$("#company_shipping_country, #company_shipping_state, #company_shipping_city").on("keyup", function () {
    var inputVal = $(this).val().trim();
    var errorMessage = "";

    // Regex to match any character that is not a letter
    if (/[^a-zA-Z]/.test(inputVal)) {
        errorMessage = "This field should only contain letters";
        inputVal = inputVal.replace(/[^a-zA-Z]/g, ''); // Replace unwanted characters
        showToast(errorMessage);
    }

    $(this).val(inputVal); // Update the input value with the cleaned value
});


// ***************************[getIFSCBank details] ********************************************************************
var gstinRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/;
var generalRegex = /^[0-9A-Z]{0,15}$/;

$("#company_gstin_number").on("keyup", function () {
    var gstinNumber = $(this).val().trim();
    var errorMessage = "";

    if (gstinNumber.length > 15) {
        errorMessage = "GSTIN Number cannot exceed 15 characters";
        gstinNumber = gstinNumber.substring(0, 15);
    } else if (!generalRegex.test(gstinNumber)) {
        showToast("GSTIN Number should only contain alphanumeric characters");
        gstinNumber = gstinNumber.replace(/[^0-9A-Z]/g, '');
    }

    $(this).val(gstinNumber);
    $(this).toggleClass("danger-border", errorMessage !== "").toggleClass("success-border", errorMessage === "");
    $("#company_gstin_number_error").text(errorMessage);
});


$(document).on("click", ".gst_fetch_btn", function () {
    var gstinNumber = $("#company_gstin_number").val().trim();
        var errorMessage = "";

        if (gstinNumber === "") {
            errorMessage = "GSTIN Number is required";
        } else if (!gstinRegex.test(gstinNumber)) {
            errorMessage = "Enter Valid GSTN number";
        }

        $("#company_gstin_number").toggleClass("danger-border", errorMessage !== "").toggleClass("success-border", errorMessage === "");
        $("#company_gstin_number_error").text(errorMessage);

        if (errorMessage === "") {
            // Proceed with fetching GSTIN details (e.g., AJAX call)

            $("#company_gstin_number").addClass("success-border").removeClass("danger-border");

    // event.preventDefault();
    var company_gstin_number = $('#company_gstin_number').val();

    $.ajax({
        url:  baseUrl + '/getCompanyGstin',
        method: 'GET',
        data: { company_gstin_number: company_gstin_number },
        success: function(response) {
            if(response.status === 'success') {
                var bankDetails = response.data;

                $("#company_address").text(response.address);

                // $("#bank_name").val(bankDetails.BANK);
                // $("#branch_name").val(bankDetails.BRANCH);
                // $("#bank_name").removeClass("danger-border").addClass("success-border");
                // $("#bank_name_error").text("");
                // $("#branch_name").removeClass("danger-border").addClass("success-border");
                // $("#branch_name_error").text("");
            } else {
                $('#company_gstin_number_error').html(response.message);
            }
        },
        error: function() {
            $('#ifsc_code_error').html('<p>Failed to retrieve bank details.</p>');
        }
    });
        }




});

});


