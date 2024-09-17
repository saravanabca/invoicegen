$(document).ready(function () {
    var coreJSON, r_index;

    $.ajax({
        url: baseUrl + "/invoice_get",
        type: "GET",
        dataType: "json",
        success: function (response) {
            disInvoice(response);
            coreJSON = response.invoicedetails;
            console.log(coreJSON);

           
        },
        error: function (xhr, status, error) {
            console.error("Error fetching invoice details:", error);
        },
    });

    function disInvoice(data) {
        var i = 0;

        var view_icon = baseUrl + "/user/images/buttons_icon/view_icon.png";
        var download_icon =
            baseUrl + "/user/images/buttons_icon/download_icon.png";
        var edit_icon =
            baseUrl + "/user/images/buttons_icon/edit_invoice_icon.png";
        var email_icon = baseUrl + "/user/images/buttons_icon/email.png";
        var whatsapp_icon = baseUrl + "/user/images/buttons_icon/whatsapp.png";
        var delete_icon =
            baseUrl + "/user/images/buttons_icon/delete_invoice.png";
        var extra_dot_icon =
            baseUrl + "/user/images/buttons_icon/extra_dot_icon.png";

        // Calculate totals

        function updateSummary(table) {
            let totalAmount = 0;
            let paidAmount = 0;
            let pendingAmount = 0;

            table
                .rows({ search: "applied" })
                .data()
                .each(function (invoice) {
                    const amount = parseFloat(invoice.overall_amt);
                    totalAmount += amount;
                    if (invoice.transaction_method.toLowerCase() === "paid") {
                        paidAmount += amount;
                    } else {
                        pendingAmount += amount;
                    }
                });

            $(
                ".summary"
            ).html(`<button class="total">Total ₹${totalAmount.toLocaleString(
                "en-IN",
                {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                }
            )}</button>
                <button class="paid">Paid ₹${paidAmount.toLocaleString(
                    "en-IN",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    }
                )}</button>
                <button class="pending">Pending ₹${pendingAmount.toLocaleString(
                    "en-IN",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    }
                )}</button>`);
        }

        var table = $("#datatable").DataTable({
            aaSorting: [],
            order: [[0, "desc"]],
            aaData: data.invoicedetails,

            aoColumns: [
                { mData: "invoice_number" },
                {
                    mData: function (data) {
                        const date = new Date(data.created_at);
                        const formattedDate = date.toLocaleDateString("en-GB");
                        const formattedTime = date.toLocaleTimeString("en-GB");
                        return `${formattedDate}<br>${formattedTime}`;
                    },
                },
                { mData: "customer_name" },
                { mData: "payment_type" },
                {
                    mData: function (data) {
                        return `${parseFloat(data.overall_amt).toLocaleString(
                            "en-IN",
                            {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            }
                        )}`;
                    },
                },
                {
                    mData: function (data) {
                        let backgroundColor =
                            data.transaction_method === "paid"
                                ? "#319E56"
                                : "#D9A815";
                        return `<span style="background-color: ${backgroundColor}; color: white; text-align:center; padding: 5px 25px; border-radius: 3px; width : 70%">${data.transaction_method}</span>`;
                    },
                },
                {
                    mData: function (data, type, full, meta) {
                        return `
                            <button class="view-btn" id="${meta.row}">
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
        });

        updateSummary(table);

        // paymentFilter :

        $("#paymentFilter").on("change", function () {
            var selectedPaymentType = $(this).val();
            if (selectedPaymentType) {
                table
                    .column(3)
                    .search("^" + selectedPaymentType + "$", true, false)
                    .draw();
            } else {
                table.column(3).search("").draw();
            }
            updateSummary(table);
        });

        //transactionFilter:

        $("#transactionFilter").on("change", function () {
            var selectedTransactionType = $(this).val();
            if (selectedTransactionType) {
                table
                    .column(5)
                    .search("^" + selectedTransactionType + "$", true, false)
                    .draw();
            } else {
                table.column(5).search("").draw();
            }
            updateSummary(table);
        });

        // des_asefilter:
        
        $("#des_asefilter").on("change", function () {
            var order = $(this).val();
            table.order([0, order]).draw(); // Sort based on the first column (Invoice Number)
        });

        // Date Range Filter:

        $("#daterange_By").daterangepicker({
            autoUpdateInput: false,
            opens: "left",
            numberOfMonths: 2,
            locale: {
                cancelLabel: "Clear",
                format: "DD-MM-YYYY",
            },

            ranges: {
                Today: [moment(), moment()],
                Yesterday: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
                "All Date": [moment("1900-01-01"), moment("2100-12-31")],
                "This Year": [moment().startOf("year"), moment().endOf("year")],
                "Last Year": [
                    moment().subtract(1, "year").startOf("year"),
                    moment().subtract(1, "year").endOf("year"),
                ],
                "This Quarter": [
                    moment().startOf("quarter"),
                    moment().endOf("quarter"),
                ],
                // Add more custom ranges as needed
            },
        });

        $("#daterange_By").val(
            moment().format("DD-MM-YYYY") +
                " - " +
                moment().format("DD-MM-YYYY")
        );

        $("#daterange_By").on("apply.daterangepicker", function (ev, picker) {
            $(this).val(
                picker.startDate.format("DD-MM-YYYY") +
                    " - " +
                    picker.endDate.format("DD-MM-YYYY")
            );

            $.ajax({
                url: baseUrl + '/invoiceDateFilter', // Replace with your endpoint URL
                method: 'GET',
                data: {
                    daterange_By: $(this).val(),
                },
                success: function (response) {
                    // Assuming response contains the updated data
                    table.clear().rows.add(response).draw();
                    updateSummary(table); // Update summary if needed
                }
            });
        });

    }


    $(".create_btn_placeholder").click(function () {
        $.ajax({
            url: baseUrl + '/check-company-table', // Your backend endpoint
            type: 'GET', // Or 'POST' if needed
            success: function(response) {
                if (response.status === 'error') {
                    showToast('Add a company to create an invoice');
                } else {
                    window.location.href = baseUrl +'/create_invoice_page';
                }
            },
            error: function() {
                showToast('An error occurred. Please try again.');
            }
        });
    });

    // ***************************[Invoice template method] ********************************************************************

    $(document).on("click", ".view-btn", function () {
        //    $('#pre-loader').addClass('is-active');

        r_index = $(this).attr("id");
        $("#view_invoice").modal("show");
        // return;

        ActiveInvoicePreview(r_index);

    });

    function invoice_data(r_index) {
        console.log(coreJSON[r_index]);

        var maindiv = $("#invoice_preview");
        maindiv.find('input').prop('readonly', true);
        maindiv.find(".CustomerName").val(coreJSON[r_index].customer_name);
        maindiv.find(".invoice_number").val(coreJSON[r_index].invoice_number);
        maindiv.find(".due_date").val(coreJSON[r_index].due_date);
        maindiv.find(".invoice_date").val(coreJSON[r_index].invoice_date);
        maindiv.find(".company_logo").attr("src", baseUrl + '/' + coreJSON[r_index].company.company_logo);
        
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
                    var templateElement = $(`[tempname="${response.active_template}"]`);
        
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

