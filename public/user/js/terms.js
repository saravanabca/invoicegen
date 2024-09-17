$(document).ready(function () {
    var mode, id, coreJSON;
    // Declare coreJSON outside the scope

    // ***************************[Get] ********************************************************************
    get_terms();
    function get_terms(){
        $.ajax({
            url: baseUrl + "/terms_get",
            type: "GET",
            dataType: "json",
            success: function (response) {
                disterms(response);
                coreJSON = response.termsdetails;
                console.log(coreJSON);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching invoice details:", error);
            },
        });
    }


    function disterms(response) {
        const termsContainer = document.getElementById('termsContainer'); // The container where terms data will be appended
        termsContainer.innerHTML = ''; // Clear the container before appending new data
        var edit_icon = baseUrl + "/user/images/buttons_icon/edit.png";
        var delete_icon = baseUrl + "/user/images/buttons_icon/delete.png";
        response.termsdetails.forEach((terms, index) => {
            // console.log(index);
        const isActive = terms.terms_active === 1 ? 'checked' : '';

            const termsHTML = `
            <div class="row terms_data">
                    <div class="col col-md-3">
                        <input type="radio" id="${terms.id}" class="terms_active" name="select_terms" value="terms_${index + 1}" ${isActive}>
                    </div>
                    <div class="col col-md-5">
                        <span class="terms_name">${terms.terms}</span><br>
                        <img src="{{ asset('user/images/buttons_icon/template_btn_icon.png') }}" alt="">
                    </div>
                    
                    <div class="col col-md-4">
                        <div class="terms_action_btns d-flex">
                            <button class="terms_edit_btn d-flex" id="${index}"><img src="${edit_icon}" alt="">Edit</button>
                            <button class="terms_delete_btn d-flex" id="${terms.id}"><img src="${delete_icon}" alt="">Delete</button>
                        </div>
                    </div>
                </div>
            `;
            termsContainer.insertAdjacentHTML('beforeend', termsHTML);
        });
    }


    // ***************************[Active terms] ********************************************************************

    $(document).on("change", ".terms_active", function () {
        var termsactiveid = $(this).attr("id");
    
        $.ajax({
            url: baseUrl + "/terms_active",
            type: "POST",
            data: {termsactiveid: termsactiveid },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // Handle success
                if (response.status) {
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

    // $(".add_terms_btn").click(function () {
    //     mode = "new";
    //     $("#terms_modal").modal("show");
    // });

    $(".add_terms_btn").click(function () {
        $.ajax({
            url: baseUrl + '/check-company-table', // Your backend endpoint
            type: 'GET', // Or 'POST' if needed
            success: function(response) {
                if (response.status === 'error') {
                    showToast("Add a company to set terms and conditions");
                } else {
                    mode = "new";
                    $("#terms_modal").modal("show");
                }
            },
            error: function() {
                showToast('An error occurred. Please try again.');
            }
        });
    });

    $("#terms_modal").on("show.bs.modal", function () {
        $(this).find("form").trigger("reset");
        // $('.invalid-feedback').hide();
        $("#terms_add_form").removeClass("danger-border success-border");
        $(".error-message").html("");
    });


    // Real-time validation on keyup
    $("#terms_add_form textarea").on("keyup", function () {
        validateField($(this));
    });

    $("#terms_add_form #terms_title").on("keyup", function () {
        validateField($(this));
    });

    // Form submission
    $("#terms_add_form").on("submit", function (e) {
        e.preventDefault();
        var form = $(this);
        var isValid = true;
        var firstInvalidField = null;

        // Validate all fields
        if (!validateField($("#terms_title"))) {
            isValid = false;
            firstInvalidField = $("#terms_title");
        }

       else if (!validateField($("#terms_filed"))) {
            isValid = false;
            firstInvalidField = $("#terms_filed");
        }

        if (isValid) {
            var formData = new FormData(this);
            console.log(formData);
            // return;
            if (mode == "new") {
                // showToast("add");
                // return;
                AjaxSubmit(formData, baseUrl + "/terms_data_add", "POST");
            } else if (mode == "update") {
                // showToast(id);
                // return;
                formData.append("terms_id", id);
                AjaxSubmit(formData, baseUrl + "/terms_update", "POST");
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

        if (fieldId === "terms_title") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Terms title is required";
            }
            else if (fieldValue.length > 25) {
                isValid = false;
                fieldValue = fieldValue.substring(0, 25);
                field.val(fieldValue);
                errorMessage = "Terms title cannot exceed 25 characters";
            }
        } 
      else  if (fieldId === "terms_filed") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Terms is required";
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
                if (response.status === "terms_add_success") {
                    if (response.status_value) {
                        showToast(response.message);

                        // showToast(response.message);
                        $("#terms_modal").modal("hide");

                        get_terms();
                    } else {
                        showToast(response.message);
                    }
                }
                if (response.status === "terms_update_success") {
                    if (response.status_value) {
                        showToast(response.message);
                        $("#terms_modal").modal("hide");
                        get_terms();
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

    $(document).on("click", ".terms_edit_btn", function () {
        var r_index = $(this).attr("id");
        mode = "update";
        $("#terms_modal").modal("show");
        $("#terms_filed").val(coreJSON[r_index].terms);
        $("#terms_title").val(coreJSON[r_index].terms_title);
       
        console.log(coreJSON);
        id = coreJSON[r_index].id;
        // console.log(id);

    });


    // ***************************[Delete] ********************************************************************
    $(document).on("click", ".terms_delete_btn", function () {
        var selectedId = $(this).attr("id");
        $.confirm({
            title: "Confirmation!",
            content: "Are you sure want to delete?",
            type: "red",
            typeAnimated: true,
            // autoClose: 'cancelAction|8000',
            buttons: {
                deleteterms: {
                    text: "delete terms",
                    action: function () {
                        $.ajax({
                            url: baseUrl + "/terms_delete",
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
                                    get_terms();
                                } else {
                                    showToast(data.message);

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

});


