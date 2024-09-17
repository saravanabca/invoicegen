$(document).ready(function () {
    // user details :

    $.ajax({
        url: baseUrl + "/user_profile",
        type: "GET",
        dataType: "json",
        success: function (response) {
            disUserProfile(response.userdetails[0]);
        },
        error: function (xhr, status, error) {
            console.error("Error fetching invoice details:", error);
        },
    });

    function disUserProfile(userdetails) {
        console.log(userdetails);
        // return;
        var user_form = $("#user_profile_form");
        $(user_form).find('input[name="name"]').val(userdetails.name);
        $(user_form).find('input[name="phone"]').val(userdetails.phone);
        $(user_form).find('input[name="email"]').val(userdetails.email);

        let avatarUrl = userdetails.avatar;
        let finalAvatarUrl;
        let fileName;

        if (avatarUrl.startsWith('http') || avatarUrl.startsWith('https')) {
            finalAvatarUrl = avatarUrl;
        } else {
            finalAvatarUrl = baseUrl + '/' + avatarUrl;
        }


        if (avatarUrl.startsWith('http') || avatarUrl.startsWith('https')) {
            fileName = "Userimage";
        } else {
            // Extract filename from the path
            let pathSegments = avatarUrl.split('/');
            let fullFileName = pathSegments[pathSegments.length - 1];
    
            // Split the filename by underscore and join the parts after the second underscore
            let fileNameParts = fullFileName.split('_');
            if (fileNameParts.length > 1) {
                fileName = fileNameParts.slice(1).join('_');
            } else {
                fileName = fullFileName;
            }
        }
    
        $("#previewImageUser").attr("src", finalAvatarUrl);        
        $("#previewImageUser").removeClass("hidden");
        $(".user_logimg_text").css("display", "none");
        $("#user_removeFile").css("display", "block");  

        // $("#user_fileName").text(fileName); 
    
    }

    $("#user_profile_form input").on("keyup", function () {
        validateField($(this));
    });

    // Form submission
    $("#user_profile_form").on("submit", function (e) {
        e.preventDefault();
        var form = $(this);
        var isValid = true;
        var firstInvalidField = null;

        // Validate all fields
        if (!validateField($("#user_name"))) {
            isValid = false;
            firstInvalidField = $("#user_name");
        }

        if (isValid) {
            var user_form = $("#user_profile_form");
            $(user_form).find('input[name="phone"]').prop("disabled", true);
            $(user_form).find('input[name="email"]').prop("disabled", true);
            var form = $("#user_profile_form")[0];

            var formData = new FormData(form);
            formData.append("user_name", user_name);

            console.log(formData);
            //   showToast();
            update_profile_update(formData);
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

        if (fieldId === "user_name") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "User Name is required";
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

    function update_profile_update(formData) {
        console.log(formData);
        $.ajax({
            type: "POST",
            data: formData,
            url: baseUrl + "/user_profile_update",
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                if (data.success) {
                    showToast(data.message);
                } else {
                    showToast(data.message);
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
                // showToast(data.message);
            },
        });
    }

        // ***************************[Company logo Uploade] ********************************************************************

        $(document).on("change", ".user_profile", function (event) {
            // showToast();
            const file = event.target.files[0];
            console.log(file);
            if (file) {
                event.preventDefault();
    
                const reader = new FileReader();
    
                reader.onload = function (e) {
                    const previewImage = document.getElementById(
                        "previewImageUser"
                    );
                    const fileName = document.getElementById("user_fileName");
                    const removeFile =
                        document.getElementById("user_removeFile");
    
                    previewImage.src = e.target.result;
                    previewImage.classList.remove("hidden");
                    $(".user_logimg_text").css("display", "none"); // Hide all elements with class signature_img_text
    
                    // fileName.textContent = file.name;
                    removeFile.style.display = "block";
                };
                reader.readAsDataURL(file);
    
                // var msg = "success Upload";
                // launch_toast(msg);
            }
        });
    
        $(document).on("click", "#user_removeFile", function () {
            // showToast();
    
            $(".user_logimg_text").show();
            $(".user_profile").val(""); // Clear the file input
    
            const previewImage = document.getElementById("previewImageUser");
            const fileName = document.getElementById("user_fileName");
            const removeFile = document.getElementById("user_removeFile");
    
            previewImage.src = "";
            previewImage.classList.add("hidden");
            fileName.textContent = "";
            removeFile.style.display = "none";
        });
});

// Company details:
