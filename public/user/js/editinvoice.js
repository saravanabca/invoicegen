$(document).ready(function () {
    $(document).on("click", ".save_btn", function () {
        // return;
        // showToast();
        // event.preventDefault();

        var isValid = true;
        var firstInvalidField = null;

        // Validate all fields
        if (!validateField($("#customer_name"))) {
            isValid = false;
            firstInvalidField = $("#customer_name");
        }

        if (isValid) {
            // invoice_number_check();
            send_invoice_data();
        } else {
            firstInvalidField.focus();
        }
    });

    function validateField(field) {
        var fieldId = field.attr("id");
        var fieldValue = field.val().trim();
        var isValid = true;
        var errorMessage = "";

        if (fieldId === "customer_name") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Please Select Customer";
                showToast(errorMessage);
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

    // product add and calculation:

    function send_invoice_data() {
        // product fileds:
        var fields = [
            "product_name",
            "product_hsnsac",
            "product_rate",
            "product_quantity",
            "product_gst_type",
            "product_discount",
            "product_discount_type",
            "product_total",
        ];
        var data = {};

        fields.forEach((field) => (data[field] = []));

        $(".product_add").each(function () {
            fields.forEach((field) => {
                var value = $(this).find(`.${field}`).val();
                data[field].push(value);
            });
        });

        var form = $("#invoice_form")[0];
        var formData = new FormData(form);

        fields.forEach((field) => formData.append(field, data[field]));

        // partially_paid:
        const transactionPaidCheckbox = $("#transaction_paid");
        const overallAmtInput = $(".overall_amt");
        const partiallyPaidInput = $("#partially_paid");

        const overallAmt = parseFloat(overallAmtInput.val()) || 0;
        const partiallyPaid = parseFloat(partiallyPaidInput.val()) || 0;
                
                if (transactionPaidCheckbox.is(":checked") || overallAmt === partiallyPaid) {
                    formData.append("transaction_method", "paid");
                } else if (!transactionPaidCheckbox.is(":checked") && partiallyPaid > 0 && partiallyPaid <= overallAmt) {
                    formData.append("transaction_method", "partially paid");
                } else {
                    // Handle the case where neither condition is met (optional)
                    // showToast("Please ensure the partially paid amount is valid.");
                }

        //   signature:
        const signatureImageFullUrl = document
            .getElementById("signature_image")
            .getAttribute("src");

        if (signatureImageFullUrl) {
            const url = new URL(signatureImageFullUrl);
            const pathSegments = url.pathname.split("/");

            // Get the last three segments
            const lastThreeSegments = pathSegments.slice(-3).join("/");

            console.log("Last Three Segments:", lastThreeSegments);

            // Append the last three segments to the FormData
            formData.append("signature_image", lastThreeSegments);
        } else {
            console.log("Signature image URL is empty.");
            // Handle the case where the URL is empty
            formData.append("signature_image", ""); // or handle it in a way suitable for your application
        }

        AjaxSubmit(formData, baseUrl + "/invoice_update", "POST");
    }

    function AjaxSubmit(formData, url, method, guest) {
        $.ajax({
            type: method,
            data: formData,
            url: url,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                // alert(data);
                if (data.success) {
                    showToast(data.message);
                    window.location.href = baseUrl + "/invoice";
                } else {
                    showToast(data.message);
                }
            },
            error: function (xhr, status, error,data) {
                // showToast(error);
                console.log(error);
            },
        });
    }

    //************************ Payement Selecttion ***********************

    const paymentTypeSelect = $("#payment_type");
    const bankListSelect = $("#bank_list");
    let previousPaymentType = paymentTypeSelect.val();


    function updatePaymentTypeBasedOnBank() {
        const activeBankId = bankListSelect.find("option:selected").val();
        if (activeBankId !== '1') {
            paymentTypeSelect.val("upi");
        } else if (paymentTypeSelect.val() === "cash") {
            bankListSelect.val("1");
        }
    }

    paymentTypeSelect.change(function () {
        if ($(this).val() !== "cash" && bankListSelect.val() === "1") {
            showToast("Please select a bank");
            $(this).val(previousPaymentType); // Revert to the previous value
            bankListSelect.focus();
        }

        if ($(this).val() === "cash" && bankListSelect.val() !== "1") {
            bankListSelect.val("1"); // Revert to the previous value
            bankListSelect.focus();
        }
    });

    bankListSelect.change(function () {
        if ($(this).val() === "1" && paymentTypeSelect.val() !== "cash") {
            paymentTypeSelect.val("cash"); // Revert to 'cash'
            paymentTypeSelect.focus();
        } else if (
            $(this).val() !== "1" &&
            paymentTypeSelect.val() === "cash"
        ) {
            paymentTypeSelect.val("upi");
            paymentTypeSelect.focus();
        }
    });

    updatePaymentTypeBasedOnBank();


    $("#transaction_paid").change(function () {
        if ($(this).is(":checked")) {
            var balanceAmt = $(".overall_amt").val();
            $("#partially_paid").val(balanceAmt).prop("disabled", true);
            $(".balance_amt").text("0.00");
            // console.log(balanceAmt);
        } else {
            var balanceAmt = $(".overall_amt").val();

            $(".balance_amt").text(balanceAmt);

            // If the checkbox is unchecked, re-enable the input and clear the value if needed
            $("#partially_paid").prop("disabled", false).val(""); // Optional: clear the input field
        }
    });

    $(document).on("input", "#partially_paid", function () {
        var inputValue = $(this).val();
        var overallAmt = parseFloat($(".overall_amt").val());

        // Prevent negative values, 'e' character, and continuous zeros
        if (
            inputValue < 0 ||
            inputValue.includes("e") ||
            /^0{2,}/.test(inputValue)
        ) {
            showToast("Invalid input. Please enter a valid amount.");
            $(this).val(""); // Clear the input field
            return;
        }

        // Prevent entering a value greater than the overall amount
        if (parseFloat(inputValue) > overallAmt) {
            showToast(
                "The partially paid amount cannot be greater than the overall amount."
            );
            $(this).val(overallAmt); // Clear the input field
            return;
        }
    });

    $("#partially_paid").on("paste", function (event) {
        var clipboardData = event.originalEvent.clipboardData.getData("text");
        if (
            clipboardData < 0 ||
            clipboardData.includes("e") ||
            /^0{2,}/.test(clipboardData) ||
            parseFloat(clipboardData) > parseFloat($(".overall_amt").val())
        ) {
            showToast("Invalid input. Please enter a valid amount.");
            event.preventDefault();
        }
    });

    // ***************** invoice number *********************************

    var invoiceNumberField = $(".invoice_number");

    function checkAndSetInvoiceNumber() {
        var invoiceNumberValue = parseInt(invoiceNumberField.val());

        if (isNaN(invoiceNumberValue) || invoiceNumberValue < 1) {
            invoiceNumberField.val(1);
        }
    }

    // Check and set the initial value of the invoice_number field
    // checkAndSetInvoiceNumber();

    // Re-check the value before form submission

    $(".invoice_number").on("focusout", function () {
        checkAndSetInvoiceNumber();
    });

    // var today = new Date().toISOString().split("T")[0];
    // $(".inv_date").val(today);
    // $(".due_date").val(today);

    function invoice_number_check() {
        var invoice_number = $(".invoice_number").val();

        $.ajax({
            url: baseUrl + "/check_invoice_unique",
            type: "POST",
            data: { invoice_number: invoice_number },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.exists) {
                    $(".invoice_number").focus();

                    showToast(
                        "Invoice number already exists. Please choose a different number."
                    );
                } else {
                    // alert();
                    send_invoice_data();
                }
            },
            error: function () {
                // showToast("Error checking invoice number uniqueness.");
            },
        });
    }

    // *****************  product calaulation **************************

    $(document).on("click", ".product_add_btn", function () {
        // showToast("test");
        var newRow = createNewRow();
        $(".product_append").append(newRow);

        var lastRow = $(".product_append .product_add").last();
        lastRow.find(".product_rate").val(0);
        lastRow.find(".product_quantity").val(1);
        lastRow.find(".product_total").val(0);
        lastRow.find(".product_discount").val(0);
        // updateTotalss();
    });

    $(document).on("click", ".product_delete", function () {
        $(this).closest(".product_add").remove();
        // updateTotalss();
        updateSummary();
    });

    function createNewRow() {
        var product_add = baseUrl + "/user/images/product/product_add.png";
        var product_delete =
            baseUrl + "/user/images/product/product_delete.png";

        var row = `<div class="product_add mt-3">
        <div class="row mt-3">
            <div class="col col-md-2">
                <div class="product_border_input">
                    <input type="text" name="product_name" class="product_name" id="">
                </div>
                <div class="mt-2">
                    <button type="button" class="product_img_btn">
                        <img src="${product_add}" alt="">image
                    </button>
                </div>
            </div>
            <div class="col col-md-1">                                  
                <div class="product_border_input product_border_hsn">
                    <input type="text" name="product_hsnsac" class="product_hsnsac" value="" id="">
                </div>
            </div>
            <div class="col col-md-2 position-relative">
                <div class="product_border_input product_border_rate">
                    <span class="position-absolute">₹</span>
                    <input type="number" class="product_rate" name="product_rate" id="">
                </div>
            </div>
            <div class="col col-md-2 position-relative">
                <div class="product_border_input product_border_qua">
                    <input type="number" name="product_quantity" class="product_quantity" id="">
                    <select name="" id="" class="product_qua_type">
                        <option value="num">Numbers</option>
                        <option value="kgs">Kilograms</option>
                        <option value="ltr">Liter</option>
                        <option value="unt">Units</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-1 position-relative">
                <div class="product_border_input">
                    <select name="product_gst" id="" class="product_gst_type">
                        <option value="0">GST@0%</option>
                        <option value="0.25">GST@0.25%</option>
                        <option value="5">GST@5%</option>
                        <option value="12">GST@12%</option>
                        <option value="18">GST@18%</option>
                        <option value="28">GST@28%</option>
                    </select> 
                </div>
            </div>
            <div class="col col-md-2 position-relative">
                <div class="product_border_input product_border_discount">
                    <input type="number" name="product_discount" class="product_discount" id="">
                    <select name="" id="" class="product_discount_type">
                        <option value="%">%</option>
                        <option value="₹">₹</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-2 position-relative">
                <div class="product_border_input product_border_total">
                    <span class="position-absolute">₹</span>
                    <input type="text" readonly class="product_total" name="product_total" id="">
                </div>
                <img class="product_delete" src="${product_delete}" alt="">
            </div>
        </div>
    </div>
    `;

        return row;
    }

    updateSummary();

    $(document).on(
        "input change",
        ".product_rate, .product_quantity, .product_gst_type, .product_discount_type, .product_discount, .round_off_check",
        function () {
            var row = $(this).closest(".product_add");
            var rate = parseFloat(row.find(".product_rate").val()) || 0;
            var qty = parseFloat(row.find(".product_quantity").val()) || 0;
            var gstPercentage =
                parseFloat(row.find(".product_gst_type").val()) || 0;
            var discount = parseFloat(row.find(".product_discount").val()) || 0;
            var discountType = row.find(".product_discount_type").val();

            // Ensure quantity is not negative
            if (qty < 1) {
                qty = 1;
                row.find(".product_quantity").val(qty);
            }

            // Calculate amount before GST and discount
            var amount = rate * qty;

            // Apply discount
            if (discountType === "%") {
                amount -= amount * (discount / 100);
            } else if (discountType === "₹") {
                amount -= discount;
            }

            // Apply GST
            var gstAmount = amount * (gstPercentage / 100);
            amount += gstAmount;

            row.find(".product_total").val(amount.toFixed(2));

            updateSummary();
        }
    );

    $(document).on(
        "focusout",
        ".product_rate, .product_quantity, .product_discount",
        function () {
            var $input = $(this);
            var value = parseFloat($input.val());

            // If the input is empty or NaN, set it to 0
            if (isNaN(value) || $input.val().trim() === "") {
                $input.val(0);
                $input.trigger("input"); // Trigger input event to recalculate total
            }

            // Ensure quantity is at least 1
            if ($input.hasClass("product_quantity")) {
                var qty = parseFloat($input.val());
                if (isNaN(qty) || qty <= 0) {
                    $input.val(1);
                    $input.trigger("input"); // Trigger input event to recalculate total
                }
            }
        }
    );

    function updateSummary() {
        // showToast();

        var totalSGST = 0;
        var totalCGST = 0;
        var totalAmount = 0;
        var totalDiscount = 0;
        var roundOff = 0; // Placeholder for round off calculation

        $(".product_add").each(function () {
            var rate = parseFloat($(this).find(".product_rate").val()) || 0;
            var qty = parseFloat($(this).find(".product_quantity").val()) || 0;
            var gstPercentage =
                parseFloat($(this).find(".product_gst_type").val()) || 0;
            var discount =
                parseFloat($(this).find(".product_discount").val()) || 0;
            var discountType = $(this).find(".product_discount_type").val();

            // Adjust discount based on its type
            if (discountType === "%") {
                discount = (discount / 100) * (rate * qty);
            }

            var amount = rate * qty - discount;
            var gstAmount = amount * (gstPercentage / 100);
            var sgstAmount = gstAmount / 2;
            var cgstAmount = gstAmount / 2;

            totalSGST += sgstAmount;
            totalCGST += cgstAmount;
            totalAmount += amount + gstAmount;
            totalDiscount += discount;
        });

        // Handle rounding off
        var balanceAmt = totalAmount;

        if ($(".round_off_check").is(":checked")) {
            if (balanceAmt - Math.floor(balanceAmt) >= 0.5) {
                // If the decimal part is 0.5 or greater, round up
                roundOff = Math.ceil(balanceAmt) - balanceAmt;

                totalAmount = Math.ceil(totalAmount); // Round up totalAmount
                // alert();
                console.log(totalAmount);
            } else {
                // If the decimal part is less than 0.5, round down
                roundOff = Math.floor(balanceAmt) - balanceAmt;
                totalAmount = Math.floor(totalAmount); // Round down totalAmount
            }
            $(".round_off").val(roundOff.toFixed(2));
        } else {
            $(".round_off").val(0.0);
        }

        $(".sgst").val(totalSGST.toFixed(2));
        $(".cgst").val(totalCGST.toFixed(2));
        $(".total_tax").val((totalSGST + totalCGST).toFixed(2));
        $(".overall_amt").val(totalAmount.toFixed(2));
        $(".overall_discount").val(totalDiscount.toFixed(2));
        $(".round_off").val(roundOff.toFixed(2));

        $(".balance_amt").text(totalAmount.toFixed(2));

        if ($("#transaction_paid").is(":checked")) {
            // showToast();
            let balanceAmt = $(".overall_amt").val();
            $("#partially_paid").val(balanceAmt).prop("disabled", true);
            console.log(balanceAmt);
        }
    }

    // ***************** Customer name and search *****************

    $(document).on("click", "#customer_list li", function () {
        $("#customer_name")
            .removeClass("danger-border")
            .addClass("success-border");
        // $("#" + fieldId + "_error").text("");
    });

    function fetchCustomers(searchTerm, callback) {
        $.ajax({
            url: baseUrl + "/search_customers", // Replace with your Laravel route
            method: "GET",
            dataType: "json",
            data: {
                search: searchTerm,
            },
            success: function (data) {
                callback(data); // Pass fetched data to callback
            },
            error: function (xhr, status, error) {
                console.error(error); // Log any errors to console
            },
        });
    }

    $("#customer_name").on("input", function () {
        var searchTerm = $(this).val().trim();
        if (searchTerm === "") {
            $("#customer_id").val("");
        }
        fetchCustomers(searchTerm, function (data) {
            var $customerList = $("#customer_list");
            $customerList.empty(); // Clear any existing items

            if (data.length > 0) {
                $customerList.show(); // Show the list
                $.each(data, function (index, item) {
                    $("<li>")
                        .text(item.customer_name)
                        .attr("data-id", item.id)
                        .appendTo($customerList)
                        .on("click", function () {
                            $("#customer_name").val(item.customer_name);
                            $("#customer_id").val(item.id); // Update the hidden input with customer_id

                            $customerList.hide(); // Hide the list after selection
                        });
                });
            } else {
                $customerList.show(); // Show the list (even if empty) for "No Customer" message
                $("<li>").text("No Customer").appendTo($customerList);
            }
        });
    });

    $("#customer_name").on("focus", function () {
        fetchCustomers("", function (data) {
            var $customerList = $("#customer_list");
            $customerList.empty(); // Clear any existing items

            if (data.length > 0) {
                $customerList.show(); // Show the list
                $.each(data, function (index, item) {
                    $("<li>")
                        .text(item.customer_name)
                        .attr("data-id", item.id)
                        .appendTo($customerList)
                        .on("click", function () {
                            $("#customer_name").val(item.customer_name);
                            $("#customer_id").val(item.id); // Update the hidden input with customer_id

                            $customerList.hide(); // Hide the list after selection
                        });
                });
            } else {
                $customerList.show(); // Show the list (even if empty) for "No Customer" message
                $("<li>").text("No Customer").appendTo($customerList);
            }
        });
    });
    // Hide the list when clicking outside
    $(document).on("click", function (event) {
        if (!$(event.target).closest("#customer_name, #customer_list").length) {
            $("#customer_list").hide();
        }
    });
});
