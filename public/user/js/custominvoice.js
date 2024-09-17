$(document).ready(function () {
    var coreJSON, r_index;

    $(".create_btn_placeholder").click(function () {
        $.ajax({
            url: baseUrl + "/check-company-table", // Your backend endpoint
            type: "GET", // Or 'POST' if needed
            success: function (response) {
                if (response.status === "error") {
                    showToast(response.message);
                } else {
                    window.location.href = baseUrl + "/create_invoice_page";
                }
            },
            error: function () {
                showToast("An error occurred. Please try again.");
            },
        });
    });

    // ***************************[View Button] **************************************************************

    $(document).on("click", ".view-btn", function () {
        var customer_id = $(this).attr("id");
        console.log(customer_id);
        // return;
        $("#view_customer").modal("show");
        $.ajax({
            url: baseUrl + "/get_single_customer_invoice",
            type: "POST",
            dataType: "json",
            data: { customer_id: customer_id },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                discustomInvoice(response);

                coreJSON = response.custominvoicedetails;

                var customername = response.customername[0];

                if (customername) {
                    $(".customer_name_title").html(customername.customer_name);
                } else {
                    $(".customer_name_title").html("");
                }

                // var get_data = response.custominvoicedetails[0];
                // if (
                //     get_data &&
                //     get_data.hasOwnProperty("customer_name") &&
                //     get_data.customer_name
                // ) {
                //     $(".customer_name_title").html(get_data.customer_name);
                // } else {
                //     console.log("Customer name is not available.");
                //     $(".customer_name_title").html(""); // Optional: Provide a default message
                // }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching invoice details:", error);
            },
        });
    });

    function discustomInvoice(data) {
        var i = 0;

        var view_icon = baseUrl + "/user/images/buttons_icon/view_icon.png";
        var edit_icon =
            baseUrl + "/user/images/buttons_icon/edit_invoice_icon.png";
        var delete_icon =
            baseUrl + "/user/images/buttons_icon/delete_invoice.png";
        var download_icon =
            baseUrl + "/user/images/buttons_icon/download_icon.png";

        var email_icon = baseUrl + "/user/images/buttons_icon/email.png";
        var whatsapp_icon = baseUrl + "/user/images/buttons_icon/whatsapp.png";

        var extra_dot_icon =
            baseUrl + "/user/images/buttons_icon/extra_dot_icon.png";

        if ($.fn.DataTable.isDataTable("#datatable_custominvoice")) {
            // Destroy the existing DataTable instance
            $("#datatable_custominvoice").DataTable().clear().destroy();
        }

       $("#datatable_custominvoice").dataTable({
            aaSorting: [],
            aaData: data.custominvoicedetails,
            aoColumns: [
                {
                    mData: function (data, type, full, meta) {
                        return data.invoice_number;
                    },
                },
                {
                    mData: function (data, type, full, meta) {
                        const date = new Date(data.created_at);
                        const formattedDate = date.toLocaleDateString("en-GB"); // Format: DD-MM-YYYY
                        const formattedTime = date.toLocaleTimeString("en-GB"); // Format: HH:MM AM/PM
                        return `${formattedDate}<br>${formattedTime}`;
                    },
                },

                {
                    mData: function (data, type, full, meta) {
                        return data.payment_type;
                    },
                },

                {
                    mData: function (data, type, full, meta) {
                        return data.overall_amt;
                    },
                },

                {
                    mData: function (data, type, full, meta) {
                        // console.log(data.id);
                        return `  <button class="view_invoice_btn" id="${meta.row}">
                                    <img class="view_icon" src="${view_icon}" alt=""> View
                                </button>
                                <button class="download-btn" id="${meta.row}">
                                    <img class="download_icon" src="${download_icon}" alt=""> Download
                                </button>
                                <div class="dropdown d-inline-flex">
                                    <a data-bs-toggle="dropdown" class="" aria-expanded="false"><img class="extra_menu_icon" src="${extra_dot_icon}" alt=""> </a>    
                                    <div class="dropdown-menu dropdown-menu-invoice dropdown-menu-" style="">
                                        <a class="dropdown-invoice-list" href="${baseUrl}/edit_invoice/${data.id}">
                                            <img class="extra_menu_icon" src="${edit_icon}" alt="">Edit
                                        </a>
                                        <a class="dropdown-invoice-list">
                                            <img class="extra_menu_icon" src="${email_icon}" alt="">Email
                                        </a>
                                        <a class="dropdown-invoice-list">
                                            <img class="extra_menu_icon" src="${whatsapp_icon}" alt="">Whatsapp
                                        </a>
                                        <a class="dropdown-invoice-list delete_invoice" id="${data.id}">
                                            <img class="extra_menu_icon" src="${delete_icon}" alt="">Delete Invoice
                                        </a>
                                    </div>
                                </div>
                            `;
                    },
                },
            ],
            autoWidth: false,
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthChange: true,
            pageLength: 10,
        });

       

      
    }

    // ***************************[Invoice template method] ********************************************************************

    $(document).on("click", ".view_invoice_btn", function () {
        //    $('#pre-loader').addClass('is-active');

        r_index = $(this).attr("id");
        $("#view_invoice").modal("show");
        // return;

        ActiveInvoicePreview(r_index);
    });

    function invoice_data(r_index) {
        console.log(coreJSON[r_index]);

        var maindiv = $("#invoice_preview");
        maindiv.find("input").prop("readonly", true);
        maindiv.find(".CustomerName").val(coreJSON[r_index].customer_name);
        maindiv.find(".invoice_number").val(coreJSON[r_index].invoice_number);
        maindiv.find(".due_date").val(coreJSON[r_index].due_date);
        maindiv.find(".invoice_date").val(coreJSON[r_index].invoice_date);
        maindiv
            .find(".company_logo")
            .attr(
                "src",
                baseUrl + "/" + coreJSON[r_index].company.company_logo
            );
    }

    $(document).on("click", ".template_img", function () {
        var temp_name = $(this).attr("tempname");
        $(".template_img").css("border", "none");

        $(this).css("border", "4px solid #34a853");

        $(this).find(".corner-image").remove();

        // Create a new image element
        var cornerImage = $("<img />", {
            src: baseUrl + "/user/images/invoice/temp_active.png",
            class: "corner-image",
            alt: "Active Template",
        });

        // $('#pre-loader').removeClass('is-active');
        $("#pre-loader").addClass("is-active");
        // Append the image to the clicked element
        $(this).append(cornerImage);

        $.ajax({
            url: baseUrl + "/template_active",
            type: "POST",
            data: { temp_name: temp_name },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status) {
                    updateInvoicePreview(response.active_template, r_index);
                    showToast(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching invoice details:", error);
            },
        });
    });

    function updateInvoicePreview(templateName, r_index, callback) {
        $.ajax({
            url: baseUrl + "/get_template_content",
            type: "POST",
            data: { template_name: templateName },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.content) {
                    // $('#pre-loader').removeClass('is-active');
                    // $('#pre-loader').addClass('active-is');
                    $("#invoice_preview").html(response.content);

                    invoice_data(r_index);
                    if (typeof callback === "function") {
                        callback();
                    }
                    // showToast("invoice update scuuess")
                    // showToast('Invoice updated successfully');
                } else {
                    $("#invoice_preview").html(
                        '<h4 class="text-center">Error loading template</h4>'
                    );
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching template content:", error);
                $("#invoice_preview").html(
                    '<h4 class="text-center">Error loading template</h4>'
                );
            },
        });
    }

    function ActiveInvoicePreview(r_index, callback) {
        $.ajax({
            url: baseUrl + "/active_invoice",
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status) {
                    updateInvoicePreview(
                        response.active_template,
                        r_index,
                        callback
                    );
                    var templateElement = $(
                        `[tempname="${response.active_template}"]`
                    );

                    // Apply the border to the found element
                    templateElement.css("border", "4px solid #34a853");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching invoice details:", error);
            },
        });
    }

    $(document).on("click", ".download-btn", function () {
        var r_index = $(this).attr("id");
        ActiveInvoicePreview(r_index, function () {
            var element = document.getElementById("invoice_preview");
            var opt = {
                margin: 1,
                filename: "converted.pdf",
                image: { type: "png", quality: 0.5 },
                html2canvas: { scale: 2 },
                jsPDF: {
                    unit: "in",
                    format: "letter",
                    orientation: "portrait",
                },
            };
            html2pdf().from(element).set(opt).save();
        });
    });

    $(document).on("click", ".view_download_btn", function () {
        var element = $(this)
            .closest(".modal-content")
            .find("#invoice_preview")[0];

        var opt = {
            margin: 1,
            filename: "converted.pdf",
            image: { type: "png", quality: 0.5 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
        };

        html2pdf().from(element).set(opt).save();
    });

    // ***************************[Delete] ********************************************************************
    $(document).on("click", ".delete_invoice", function () {
        var selectedId = $(this).attr("id");
        $.confirm({
            title: "Confirmation!",
            content: "Are you sure want to delete?",
            type: "red",
            typeAnimated: true,
            // autoClose: 'cancelAction|8000',
            buttons: {
                deleteCustomer: {
                    text: "delete Invoice",
                    action: function () {
                        $.ajax({
                            url: baseUrl + "/invoice_delete",
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
                                            location.reload(true);
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
});
