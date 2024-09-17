// ***************************[Add] ********************************************************************

// Real-time validation on keyup
$("#feedback_form input").on("keyup", function () {
    validateField($(this));
});

// Form submission
$("#feedback_form").on("submit", function (e) {
    e.preventDefault();
    var form = $(this);
    var isValid = true;
    var firstInvalidField = null;

    // Validate all fields
    if (!validateField($("#feedback_name"))) {
        isValid = false;
        firstInvalidField = $("#feedback_name");
    } 
    else if (!validateField($("#feedback_email"))) {
        isValid = false;
        if (firstInvalidField === null)
            firstInvalidField = $("#feedback_email");
    } 
    else if (!validateField($("#feedback_message"))) {
        isValid = false;
        if (firstInvalidField === null)
            firstInvalidField = $("#feedback_message");
    }

    if (isValid) {
        var formData = new FormData(this);

        AjaxSubmit(formData, baseUrl + "/feedback_add", "POST");
    } else {
        firstInvalidField.focus();
    }
});

// Field validation function
function validateField(field) {
    // alert();
    var fieldId = field.attr("id");
    var fieldValue = field.val().trim();
    var isValid = true;
    var errorMessage = "";

    if (fieldId === "feedback_name") {
        if (fieldValue === "") {
            isValid = false;
            errorMessage = "Name is required";
        }
    } else if (fieldId === "feedback_email") {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (fieldValue === "") {
            isValid = false;
            errorMessage = "Email is required";
            // showToast("ssss");
        } else if (!emailRegex.test(fieldValue)) {
            isValid = false;
            errorMessage = "Enter a valid Email";
        }
    } else if (fieldId === "feedback_message") {
        if (fieldValue === "") {
            isValid = false;
            errorMessage = "Message is required";
        }

        if (isValid) {
            field.removeClass("danger-border").addClass("success-border");
            $("#" + fieldId + "_error").text("");
        } else {
            field.removeClass("success-border").addClass("danger-border");
            $("#" + fieldId +"_error").text(errorMessage);
            // field.focus();
        }

        return isValid;
    }
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
                        showToast(response.message);
                        window.location.reload();
                    } else {
                        showToast(response.message);
                    }
                }
                if (response.status === "company_update_success") {
                    if (response.status_value) {
                        showToast(response.message);
                        window.location.reload();
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

