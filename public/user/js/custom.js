$(document).ready(function () {
    company_status();
    active_company();
    var coreJSON ,mode,id;




    function company_status() {
        $.ajax({
            url: baseUrl + "/check-company-table", // Your backend endpoint
            type: "GET", // Or 'POST' if needed
            success: function (response) {
                if (response.status === "error") {
                    // $('#company_status_container').html(`
                    //     <div class="add_company_side text-center">
                    //         <span class="comapny_img">
                    //             <img src="${baseUrl}/user/images/sidenav/add_company.png" alt="">
                    //         </span>
                    //         <p>Add Company</p>
                    //         <button class="add_company_btn">
                    //             <img src="${baseUrl}/user/images/buttons_icon/add_icon.png" alt=""> Add Company
                    //         </button>
                    //     </div>
                    // `);
                    $("#add_company_sidenav").show();
                } else {
                    // $('#company_status_container').html(`
                    //     <div class="user_company text-center">
                    //         <span class="comapny_name_shord">SK</span>
                    //         <p>Skyraan</p>
                    //         <button class="change_comapny_btn">Change Company</button>
                    //     </div>

                    // `);
                    $("#change_company_sidenav").show();
                }
            },
            error: function () {
                showToast("An error occurred. Please try again.");
            },
        });
    }

    function active_company() {
        $.ajax({
            url: baseUrl + "/check_company_active", // Your backend endpoint
            type: "GET", // Or 'POST' if needed
            success: function (response) {
                var companyDetails = response.companyactivedetails;

                var companyName = companyDetails.company_name;
                var displayName = companyName.length > 30 ? companyName.substring(0, 30) + '...' : companyName;
    
                var tooltipElement = $(".company_name_side .tooltiptext");
                var displayNameElement = $(".company_name_side .display_name");
                var companyContainer = $(".company_name_side");
    
                displayNameElement.text(displayName);
                if (companyName.length > 30) {
                    tooltipElement.text(companyName);
                    companyContainer.addClass("tooltipp");
                } else {
                    tooltipElement.text(''); // Clear tooltip text if not needed
                    companyContainer.removeClass("tooltipp");
                }
                // Check if the company image is null
                if (companyDetails.company_logo) {

                    // If company image exists, append the image
                    $(".comapny_name_shord").html(
                        '<img src="' +
                            baseUrl +
                            "/" +
                            companyDetails.company_logo +
                            '" alt="Company Image">'
                    );

                    // $(".company_name_text").css("display", "none");
                    $("#change_company_sidenav").removeClass("comapny_name_text");

                } else {
                    // If company image is null, append the first two letters of the company name
                    var companyNameInitials = companyDetails.company_name
                        .substring(0, 2)
                        .toUpperCase();
                    $(".comapny_name_text").text(companyNameInitials);
                    // $(".cmny_name").text(companyNameInitials);
                }
            },
            error: function () {
                showToast("An error occurred. Please try again.");
            },
        });
    }



    $(document).on("click", ".change_company_btn", function () {
        $("#change_company_modal").modal("show");
    });

    getcomapny();
    function getcomapny() {
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
        const companiesContainer = $(".change_cmny_container").get(0); // The container where company data will be appended

        companiesContainer.innerHTML = ""; // Clear the container before appending new data
        var edit_icon = baseUrl + "/user/images/buttons_icon/edit_cmny.png";


        response.companydetails.forEach((company, index) => {
            // console.log(index);
            const isActive = company.company_active === 1 ? "checked" : "";
            const colClass =
                response.companydetails.length === 1 ? "col-md-8" : "col-md-6";
            const centerDivClass =
                response.companydetails.length === 1
                    ? "justify-content-center"
                    : "";
            if (response.companydetails.length === 2) {
                $(".add_company_btn").remove();
            }

            var companyName = company.company_name;
            var displayName = companyName.length > 30 ? companyName.substring(0, 30) + '...' : companyName;

            const companyHTML = `
               <div class="col ${colClass}">
                        <div class="company_details_main_div">
                            <div class="company_main_menu ">
                            <div class="row">
                            <div class="col col-md-6">
                               <h6 class="tooltipp">${displayName}${companyName.length > 30 ? `<span class="tooltiptext">${companyName}</span>` : ''}</h6>

                            </div>
                             <div class="col col-md-6">
                               <div class="d-flex">
                                    <button class="change_company_edit_btn" dataid="${index}"><img src="${edit_icon}" alt="">Edit</button>
                                    <input type="radio" name="select_change_company"  class="active_company" id="${
                                        company.id
                                    }" value="company_${index + 1}" ${isActive}>
                                </div>
                            </div>
                            </div>
                               
                              
                            </div>
                            <div>
                                <p class="mt-3">${
                                    company.company_address
                                        ? company.company_address
                                        : "Address not available"
                                }</p>
                            </div>
                        </div>
            `;
            companiesContainer.insertAdjacentHTML("beforeend", companyHTML);
        });
    }

    $("#company_add_form input").on("keyup", function () {
        validateField($(this));
    });


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
                // showToast(id);
                // return;
                formData.append("company_id", id);
                AjaxSubmit(formData, baseUrl + "/company_update", "POST");
            }
        } else {
            firstInvalidField.focus();
        }
    });

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

    $(document).on("click", ".change_company_edit_btn", function () {
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

});
