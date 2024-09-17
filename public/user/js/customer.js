$(document).ready(function () {
    var mode, id, coreJSON;
    // Declare coreJSON outside the scope
    var currentPage = 0; // Declare a variable to store the current page number

    // ***************************[Get] ********************************************************************
    Getcustomer();

    function Getcustomer(){
        $.ajax({
            url: baseUrl + "/customer_get",
            type: "GET",
            dataType: "json",
            success: function (response) {
                disCustomer(response);
                coreJSON = response.customerdetails;
                console.log(coreJSON);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching invoice details:", error);
            },
        });
    }

    function disCustomer(data) {
        var i = 0;

        var view_icon = baseUrl + "/user/images/buttons_icon/view_icon.png";
        var invoice_icon = baseUrl + "/user/images/buttons_icon/add_icon1.png";
        var edit_icon = baseUrl + "/user/images/buttons_icon/edit.png";
        var delete_icon = baseUrl + "/user/images/buttons_icon/delete.png";

        var table =   $("#datatable").dataTable({
            aaSorting: [],
            aaData: data.customerdetails,
            aoColumns: [
                {
                    mData: function (data, type, full, meta) {
                        if (data.customer_name.length > 10) {
                            return '<span data-toggle="tooltip" title="' + data.customer_name + '">' + data.customer_name.substring(0, 10) + '...</span>';
                        } else {
                            return data.customer_name;
                        }
                    },
                },
                {
                    mData: function (data, type, full, meta) {
                        return data.customer_mobile;
                    },
                },

                {
                    mData: function (data, type, full, meta) {
                        return data.customer_email;
                    },
                },

                {
                    mData: function (data, type, full, meta) {
                        return `${data.invoices_count} <button class="view-btn ms-2"  id="${data.id}"><img class="view_icon" src="${view_icon}" alt="">View</button>`;
                    },
                },

                {
                    mData: function (data, type, full, meta) {
                        // console.log(data.id);
                        return `<a  href="${baseUrl}/invoice_add/${data.id}" ><button class="invoice-btn" id="${data.id}"><img class="invoice_add_icon" src="${invoice_icon}" alt="">Invoice</button> </a>
                        <button class="edit-btn" id="${meta.row}"><img class="edit_icon" src="${edit_icon}" alt="">Edit</button>
                        <button class="delete-btn" id="${data.id}"><img class="delete_icon" src="${delete_icon}" alt="">Delete</button>
                        `;
                    },
                },
            ],
            drawCallback: function () {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

    
        $('[data-toggle="tooltip"]').tooltip();
        // table.page(currentPage).draw(false);

    }

    function refreshDetails()
    {
        currentPage = $('#datatable').DataTable().page(); // Capture the current page number
        $.when(Getcustomer()).done(function(){
            var table = $('#datatable').DataTable();
            table.destroy();    
            disCustomer(coreJSON);               
        });     
    }


//     function refreshCustomerTable() {
//     var table = $('#datatable').DataTable();
//     table.ajax.reload(null, false); // false to keep the current paging
// }

    // ***************************[Add] ********************************************************************

    $(".add_customer_btn").click(function () {
        $.ajax({
            url: baseUrl + "/check-company-table", // Your backend endpoint
            type: "GET", // Or 'POST' if needed
            success: function (response) {
                if (response.status === "error") {
                    showToast("Add a company to create an customer");
                } else {
                    mode = "new";
                    $("#add_customer").modal("show");
                }
            },
            error: function () {
                showToast("An error occurred. Please try again.");
            },
        });
    });

    $("#add_customer").on("show.bs.modal", function () {
        $(this).find("form").trigger("reset");
        // $('.invalid-feedback').hide();
        $(".form-control").removeClass("danger-border success-border");
        $(".error-message").html("");
    });

    // Real-time validation on keyup
    $("#customer_add_form input").on("keyup", function () {
        validateField($(this));
    });

    // Form submission

    $("#customer_add_form").on("submit", function (e) {
        e.preventDefault();
        
        var form = $(this);
        var isValid = true;
        var firstInvalidField = null;

        // Validate all fields
        if (!validateField($("#CustomerName"))) {
            isValid = false;
            firstInvalidField = $("#CustomerName");
        } else if (!validateField($("#email"))) {
            isValid = false;
            if (firstInvalidField === null) firstInvalidField = $("#email");
        } else if (!validateField($("#mobile_number"))) {
            isValid = false;
            if (firstInvalidField === null)
                firstInvalidField = $("#mobile_number");
        }

        if (isValid) {
            var formData = new FormData(this);
            console.log(formData);
            if (mode == "new") {
                // showToast("add");
                // return;
                AjaxSubmit(formData, baseUrl + "/customer_add", "POST");

            } else if (mode == "update") {
                // showToast(id);
                // return;
                formData.append("customer_id", id);
                AjaxSubmit(formData, baseUrl + "/customer_update", "POST");
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

        if (fieldId === "CustomerName") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Customer Name is required";
            }
        } else if (fieldId === "email") {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Email is required";
            } else if (!emailRegex.test(fieldValue)) {
                isValid = false;
                errorMessage = "Enter a valid Email";
            }
        } else if (fieldId === "mobile_number") {
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
    // var table = $('#datatable').DataTable(); // Initialize your DataTable

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
                if (response.status === "customer_add_success") {
                    if (response.status_value) {
                        
                        $("#add_customer").modal("hide");

                        // Getcustomer();
                        showToast(response.message);

                        refreshDetails();
                        // showToast(response.message); 
                        // location.reload();
                        // disInvoice(coreJSON);
                    } else {
                        showToast(response.message);
                    }
                }
                if (response.status === "customer_update_success") {
                    if (response.status_value) {
                        $("#add_customer").modal("hide");
                        showToast(response.message);
                        refreshDetails();

                        // Getcustomer();

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

    $(document).on("click", ".edit-btn", function () {
        var r_index = $(this).attr("id");
        console.log(coreJSON);
        mode = "update";
        $("#add_customer").modal("show");
        
        $("#CustomerName").val(coreJSON[r_index].customer_name);
        $("#email").val(coreJSON[r_index].customer_email);
        $("#mobile_number").val(coreJSON[r_index].customer_mobile);
        $("#customer_address").val(coreJSON[r_index].customer_address);
        $("#customer_pin_code").val(coreJSON[r_index].customer_pin_code);
        $("#City").val(coreJSON[r_index].customer_city);
        $("#State").val(coreJSON[r_index].customer_state);
        $("#Country").val(coreJSON[r_index].customer_country);
        $("#customer_gstin_number").val(coreJSON[r_index].customer_gstin_number);
        $("#cus_shipping_address").val(coreJSON[r_index].cus_shipping_address);
        $("#cus_shipping_pin_code").val(
            coreJSON[r_index].cus_shipping_pin_code
        );
        $("#cus_shipping_city").val(coreJSON[r_index].cus_shipping_city);
        $("#cus_shipping_state").val(coreJSON[r_index].cus_shipping_state);
        $("#cus_shipping_country").val(coreJSON[r_index].cus_shipping_country);
        console.log(coreJSON);
        id = coreJSON[r_index].id;
    });

    // ***************************[Delete] ********************************************************************

    $(document).on("click", ".delete-btn", function () {
        var selectedId = $(this).attr("id");
        $.confirm({
            title: "Confirmation!",
            content: "Are you sure want to delete?",
            type: "red",
            typeAnimated: true,
            // autoClose: 'cancelAction|8000',
            buttons: {
                deleteCustomer: {
                    text: "delete Customer",
                    action: function () {
                        $.ajax({
                            url: baseUrl + "/customer_delete",
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
                                   refreshDetails();
                                } else {
                                    showToast(data.message);
                                    refreshDetails();
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

    // ***************************[company_pin_code details] ********************************************************************

    $("#customer_pin_code").on("keyup", function () {
        var pinCode = $(this).val().trim();
        var errorMessage = "";

        if (!/^\d{0,6}$/.test(pinCode)) {
            errorMessage =
                pinCode.length > 6
                    ? "Pin code cannot exceed 6 characters"
                    : "Pin code should only contain numbers";
            pinCode = pinCode.replace(/\D/g, "").substring(0, 6);
            showToast(errorMessage);
        }

        $(this).val(pinCode);
    });

    $("#cus_shipping_pin_code").on("keyup", function () {
        var pinCode = $(this).val().trim();
        var errorMessage = "";

        if (!/^\d{0,6}$/.test(pinCode)) {
            errorMessage =
                pinCode.length > 6
                    ? "Pin code cannot exceed 6 characters"
                    : "Pin code should only contain numbers";
            pinCode = pinCode.replace(/\D/g, "").substring(0, 6);
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
            inputVal = inputVal.replace(/[^a-zA-Z]/g, ""); // Replace unwanted characters
            showToast(errorMessage);
        }

        $(this).val(inputVal); // Update the input value with the cleaned value
    });

    $(
        "#cus_shipping_city, #cus_shipping_state, #cus_shipping_country"
    ).on("keyup", function () {
        var inputVal = $(this).val().trim();
        var errorMessage = "";

        // Regex to match any character that is not a letter
        if (/[^a-zA-Z]/.test(inputVal)) {
            errorMessage = "This field should only contain letters";
            inputVal = inputVal.replace(/[^a-zA-Z]/g, ""); // Replace unwanted characters
            showToast(errorMessage);
        }

        $(this).val(inputVal); // Update the input value with the cleaned value
    });

    // ***************************[getIFSCBank details] ********************************************************************
    var gstinRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/;
    var generalRegex = /^[0-9A-Z]{0,15}$/;

    $("#customer_gstin_number").on("keyup", function () {
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
        $("#customer_gstin_number_error").text(errorMessage);
    });
    

    $(document).on("click", ".gst_fetch_btn", function () {
        var gstinNumber = $("#customer_gstin_number").val().trim();
        var errorMessage = "";

        if (gstinNumber === "") {
            errorMessage = "GSTIN Number is required";
        } else if (!gstinRegex.test(gstinNumber)) {
            errorMessage = "Enter Valid GSTN number";
        }

        $("#customer_gstin_number")
            .toggleClass("danger-border", errorMessage !== "")
            .toggleClass("success-border", errorMessage === "");
        $("#customer_gstin_number_error").text(errorMessage);

        if (errorMessage === "") {
            // Proceed with fetching GSTIN details (e.g., AJAX call)

            $("#customer_gstin_number")
                .addClass("success-border")
                .removeClass("danger-border");

            // event.preventDefault();
            var customer_gstin_number = $("#customer_gstin_number").val();

            $.ajax({
                url: baseUrl + "/getCustomerGstin",
                method: "GET",
                data: { customer_gstin_number: customer_gstin_number },
                success: function (response) {
                    if (response.status === "success") {
                        var bankDetails = response.data;

                        $("#company_address").text(response.address);

                        // $("#bank_name").val(bankDetails.BANK);
                        // $("#branch_name").val(bankDetails.BRANCH);
                        // $("#bank_name").removeClass("danger-border").addClass("success-border");
                        // $("#bank_name_error").text("");
                        // $("#branch_name").removeClass("danger-border").addClass("success-border");
                        // $("#branch_name_error").text("");
                    } else {
                        $("#customer_gstin_number_error").html(
                            response.message
                        );
                    }
                },
                error: function () {
                    $("#ifsc_code_error").html(
                        "<p>Failed to retrieve bank details.</p>"
                    );
                },
            });
        }
    });
    // ***************************[Copy to shipping address] ********************************************************************

    $(document).on("click", ".copy_shipping_address", function () {
        // Get values from the company_address_main section
        const address = $("input[name='customer_address']").val();
        const pinCode = $("input[name='customer_pin_code']").val();
        const city = $("input[name='customer_city']").val();
        const state = $("input[name='customer_state']").val();
        const country = $("input[name='customer_country']").val();

        // Set values in the shipping_address_main section
        $("input[name='cus_shipping_address']").val(address);
        $("input[name='cus_shipping_pin_code']").val(pinCode);
        $("input[name='cus_shipping_city']").val(city);
        $("input[name='cus_shipping_state']").val(state);
        $("input[name='cus_shipping_country']").val(country);
    });
    $(this).css("color", "green");
});
