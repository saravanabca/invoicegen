$(document).ready(function () {
    var mode, id, coreJSON;
    // Declare coreJSON outside the scope

    // ***************************[Get] ********************************************************************
    getbank();
    
    function getbank(){
        $.ajax({
            url: baseUrl + "/bank_get",
            type: "GET",
            dataType: "json",
            success: function (response) {
                disBank(response);
                coreJSON = response.bankdetails;
                console.log(coreJSON);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching invoice details:", error);
            },
        });
    }


    function disBank(response) {
        const bankContainer = document.getElementById("bankContainer"); // The container where bank data will be appended
        bankContainer.innerHTML = ""; // Clear the container before appending new data
        var edit_icon = baseUrl + "/user/images/buttons_icon/edit.png";
        var delete_icon = baseUrl + "/user/images/buttons_icon/delete.png";

        response.bankdetails.forEach((bank, index) => {
            const isActive = bank.bank_active === 1 ? "checked" : "";
            let bankHTML = `
            <div class="row bank_data">
                <div class="col col-md-3 bank_defalut_align">
                    <input type="radio" name="select_bank" class="active_bank" id="${bank.id}" value="bank_${index + 1}" ${isActive}>
                </div>
                <div class="col col-md-6">
                    <span class="bank_name">${bank.bank_name}</span><br>
                </div>
                ${bank.type !== 'cash' ? `
                <div class="col col-md-3">
                    <div class="bank_action_btns d-flex">
                        <button class="bank_edit_btn d-flex" id="${index}"><img src="${edit_icon}" alt="">Edit</button>
                        <button class="bank_delete_btn d-flex" id="${bank.id}"><img src="${delete_icon}" alt="">Delete</button>
                    </div>
                </div>
                ` : ''}
            </div>
        `;
        
        // console.log(bankHTML);
        
            bankContainer.insertAdjacentHTML("beforeend", bankHTML);
        });

        // Add the default "Cash" account if it doesn't exist
        
    }

    // ***************************[Active bank] ********************************************************************

    $(document).on("change", ".active_bank", function () {
        var bankactiveid = $(this).attr("id");
        $.ajax({
            url: baseUrl + "/bank_active",
            type: "POST",
            data: { bankactiveid: bankactiveid },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // Handle success
                if (response.status) {
                    showToast(response.message);
                    getbank();
                }
            },
            error: function (xhr, status, error) {
                console.error("Error submitting form:", error);
                // Handle error
            },
        });
    });

    // ***************************[Add] ********************************************************************

    // $(".add_bank_btn").click(function () {
    //     mode = "new";
    //     $("#bank_modal").modal("show");
    // });

    $(".add_bank_btn").click(function () {
        $.ajax({
            url: baseUrl + '/check-company-table', // Your backend endpoint
            type: 'GET', // Or 'POST' if needed
            success: function(response) {
                if (response.status === 'error') {
                    showToast("Add a company to enter bank details");
                } else {
                    mode = "new";
                    $("#bank_modal").modal("show");
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });

    $("#bank_modal").on("show.bs.modal", function () {
        $(this).find("form").trigger("reset");
        // $('.invalid-feedback').hide();
        $(".form-control").removeClass("danger-border success-border");
        $(".error-message").html("");
    });

    // Real-time validation on keyup
    $("#bank_add_form input").on("keyup", function () {
        validateField($(this));
    });

    // Form submission
    $("#bank_add_form").on("submit", function (e) {
        e.preventDefault();
        var form = $(this);
        var isValid = true;
        var firstInvalidField = null;

        // Validate all fields
        if (!validateField($("#account_no"))) {
            isValid = false;
            firstInvalidField = $("#account_no");
        } else if (!validateField($("#confirm_account_no"))) {
            isValid = false;
            if (firstInvalidField === null) firstInvalidField = $("#confirm_account_no");
        } else if (!validateField($("#ifsc_code"))) {
            isValid = false;
            if (firstInvalidField === null)
                firstInvalidField = $("#ifsc_code");
        }
        else if (!validateField($("#bank_name"))) {
            isValid = false;
            if (firstInvalidField === null)
                firstInvalidField = $("#bank_name");
        }
        else if (!validateField($("#branch_name"))) {
            isValid = false;
            if (firstInvalidField === null)
                firstInvalidField = $("#branch_name");
        }
      
        if (isValid) {
            var formData = new FormData(this);

            // var fileInput = document.getElementById("bank_logo");
            // var file = fileInput.files[0];
            // formData.append("bank_logo", file);

            // console.log(mode);
            if (mode == "new") {
                // return;
                AjaxSubmit(formData, baseUrl + "/bank_add", "POST");
            } else if (mode == "update") {
                // alert(id);
                // return;
                formData.append("bank_id", id);
                AjaxSubmit(formData, baseUrl + "/bank_update", "POST");
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

        if (fieldId === "account_no") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Account number is required";
            }
        }   
        else if (fieldId === "confirm_account_no") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Confirm Account number is required";
            }
            else if (fieldValue !== $("#account_no").val().trim()) {
                isValid = false;
                errorMessage = "The bank account numbers you entered do not match!";
                $("#confirm_image_container .confirm_img").remove();

            }
        }
        else if (fieldId === "ifsc_code") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "IFSC code is required";
            }
        }

        else if (fieldId === "bank_name") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Bank name is required";
            }
        }

        else if (fieldId === "branch_name") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Branch name is required";
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

        if ($("#account_no").val().trim() !== "" && 
            $("#account_no").val().trim() === $("#confirm_account_no").val().trim() ) {
            if ($("#confirm_image_container .confirm_img").length === 0) {
                $("#confirm_image_container").append(`
                    <div class="confirm_img">
                        <img src="${baseUrl}/user/images/buttons_icon/confirm.png" alt="">
                    </div>
                `);
            }
            $("#confirm_account_no").removeClass("danger-border").addClass("success-border");
            $("#confirm_account_no_error").text("");
        } else {
            // $("#confirm_image_container .confirm_img").remove();
            // $("#confirm_account_no").addClass("danger-border").removeClass("success-border");
            // $("#confirm_account_no_error").text("The bank account numbers you entered do not match!");
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
                if (response.status === "bank_add_success") {
                    if (response.status_value) {
                      
                        $("#bank_modal").modal("hide");
                      
                        showToast(response.message);
                        getbank();
                    } else {
                        alert(response.message);
                    }
                }
                if (response.status === "bank_update_success") {
                    if (response.status_value) {
                        $("#bank_modal").modal("hide");
                      
                        showToast(response.message);
                        getbank();
                       
                    } else {
                        alert(response.message);
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

    $(document).on("click", ".bank_edit_btn", function () {
        var r_index = $(this).attr("id");
        mode = "update";
        $("#bank_modal").modal("show");
        $("#account_no").val(coreJSON[r_index].account_no);
        $("#confirm_account_no").val(coreJSON[r_index].confirm_account_no);
        $("#ifsc_code").val(coreJSON[r_index].ifsc_code);
        $("#bank_name").val(coreJSON[r_index].bank_name);
        $("#branch_name").val(coreJSON[r_index].branch_name);
        console.log(coreJSON);
        id = coreJSON[r_index].id;
        // console.log(id);
    });

    // ***************************[Delete] ********************************************************************
    $(document).on("click", ".bank_delete_btn", function () {
        var selectedId = $(this).attr("id");
        $.confirm({
            title: "Confirmation!",
            content: "Are you sure want to delete?",
            type: "red",
            typeAnimated: true,
            // autoClose: 'cancelAction|8000',
            buttons: {
                deletebank: {
                    text: "delete bank",
                    action: function () {
                        $.ajax({
                            url: baseUrl + "/bank_delete",
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            data: { selectedId: selectedId }, // Send data as an object
                            success: function (data) {
                                if (data.status) {
                                    showToast(data.message);
                                    getbank();
                                } else {
                                    showToast(response.message);
                                    getbank();

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
                    // $.alert('action is canceled');
                },
            },
        });
    });

  


// ***************************[Copy to shipping address] ********************************************************************
$(document).on("click", ".copy_shipping_address", function () {
    // Get values from the bank_address_main section
    const address = $("input[name='bank_address']").val();
    const pinCode = $("input[name='bank_pin_code']").val();
    const city = $("input[name='bank_city']").val();
    const state = $("input[name='bank_state']").val();
    const country = $("input[name='bank_country']").val();

    // Set values in the shipping_address_main section
    $("input[name='bank_shipping_address']").val(address);
    $("input[name='bank_shipping_pin_code']").val(pinCode);
    $("input[name='bank_shipping_city']").val(city);
    $("input[name='bank_shipping_state']").val(state);
    $("input[name='bank_shipping_country']").val(country);
});
// ***************************[getIFSCBank details] ********************************************************************

    $(document).on("click", ".bank_fetch_btn", function () {

        if ($("#ifsc_code").val().trim() === "") {
            $("#ifsc_code").addClass("danger-border").removeClass("success-border");
            $("#ifsc_code_error").text("IFSC code is required");
    }



        // event.preventDefault();
        var ifscCode = $('#ifsc_code').val();

        $.ajax({
            url:  baseUrl + '/getBankDetails',
            method: 'GET',
            data: { ifsc_code: ifscCode },
            success: function(response) {
                if(response.status === 'success') {
                    var bankDetails = response.data;
                    $("#bank_name").val(bankDetails.BANK);
                    $("#branch_name").val(bankDetails.BRANCH);
                    $("#bank_name").removeClass("danger-border").addClass("success-border");
                    $("#bank_name_error").text("");
                    $("#branch_name").removeClass("danger-border").addClass("success-border");
                    $("#branch_name_error").text("");
                } else {
                    $('#ifsc_code_error').html(response.message);
                }
            },
            error: function() {
                $('#ifsc_code_error').html('<p>Invalid IFSC code. Please check and try again.</p>');
            }
        });
    });

});
