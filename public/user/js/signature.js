$(document).ready(function () {
    var mode, signature_id, coreJSON;
    // Declare coreJSON outside the scope

    // ***************************[Get] ********************************************************************
    GetSignature()
    function GetSignature(){
        $.ajax({
            url: baseUrl + "/signature_get",
            type: "GET",
            dataType: "json",
            success: function (response) {
                DisplaySignature(response);
                coreJSON = response.signaturedetails;
                console.log(coreJSON);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching invoice details:", error);
            },
        });
    }
 

    function DisplaySignature(response) {
        const signatureContainer =
            document.getElementById("signatureContainer"); // The container where company data will be appended
        signatureContainer.innerHTML = ""; // Clear the container before appending new data
        var edit_icon = baseUrl + "/user/images/buttons_icon/edit.png";
        var delete_icon = baseUrl + "/user/images/buttons_icon/delete.png";
        response.signaturedetails.forEach((signature, index) => {
            // console.log(index);
            const isActive = signature.signature_active === 1 ? "checked" : "";

            let imageHtml = "";

            if (signature.signature_image) {
                imageHtml = `<img src="${
                    baseUrl + "/" + signature.signature_image
                }" alt="Signature Image">`;
            } else if (signature.canvas_image) {
                imageHtml = `<img src="${
                    baseUrl + "/" + signature.canvas_image
                }" alt="Canvas Image">`;
            } else {
                imageHtml = "<span>No image available</span>";
            }

            const SiganatureHTML = `
                <div class="row signature_data">
                                    <div class="col col-md-2">
                                        <input type="radio" class="active_signature" id="${signature.id}" name="select_signature" value="comapny_1" ${isActive}>
                                    </div>
                                    <div class="col col-md-3">
                                        <span class="signature_name">${signature.signature_name}</span><br>
                                    </div>
                                    <div class="col col-md-3">
                                        <span class="signature_img">${imageHtml}</span><br>
                                    </div>

                                    <div class="col col-md-4">
                                        <div class="signature_action_btns d-flex">
                                            <button class="signature_edit_btn d-flex" id="${index}"><img
                                                    src="${edit_icon}"
                                                    alt="">Edit</button>
                                            <button class="signature_delete_btn d-flex" id="${signature.id}"><img
                                                    src="${delete_icon}"
                                                    alt="">Delete</button>
                                        </div>
                                    </div>

                                </div>
            `;

            signatureContainer.insertAdjacentHTML("beforeend", SiganatureHTML);
        });
    }

    // ***************************[Active Signature] ********************************************************************

    $(document).on("change", ".active_signature", function () {
        var signatureactiveid = $(this).attr("id");

        $.ajax({
            url: baseUrl + "/signature_active",
            type: "POST",
            data: { signatureactiveid: signatureactiveid },
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

    // $(".add_signature_btn").click(function () {
    //     mode = "new";
    //     $("#signature_modal").modal("show");
    // });


    $(".add_signature_btn").click(function () {
        $.ajax({
            url: baseUrl + '/check-company-table', // Your backend endpoint
            type: 'GET', // Or 'POST' if needed
            success: function(response) {
                if (response.status === 'error') {
                    showToast("Add a company to create a signature");
                } else {
                    mode = "new";
                    $("#signature_modal").modal("show");
                }
            },
            error: function() {
                showToast('An error occurred. Please try again.');
            }
        });
    });


    $("#signature_modal").on("show.bs.modal", function () {
        $(this).find("#signature_add_form").trigger("reset");
        // $('.invalid-feedback').hide();
        $(".form-control").removeClass("danger-border success-border");
        $(".error-message").html("");
        ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
        // $(".remove_draw_sign").css("display","none");
        // const previewImage = document.getElementById("previewImageSignature");
        // previewImage.src = "";
        // previewImage.style.display = "none";
        const removeFile = document.getElementById("signature_removeFile");
        removeFile.style.display = "none";
        const signatureInput = document.getElementById("signature_input");
        if (signatureInput) {
            signatureInput.value = ""; // Clear the file input value
        }
        // const previewImage = document.getElementById("previewImageSignature");
        // if (previewImage) {
        //     previewImage.src = ""; // Clear the src of the image
        //     previewImage.style.display = "none"; // Hide the image
        // }

    });



    // Real-time validation on keyup
    $("#signature_add_form input").on("keyup", function () {
        validateField($(this));
    });

    // Form submission
    $("#signature_add_form").on("submit", function (e) {
     
        e.preventDefault();
        var form = $(this);
        var isValid = true;
        var firstInvalidField = null;
        const file = $("#signature_input")[0].files[0];
        console.log(!file);
        console.log(isCanvasEmpty(canvas));
        console.log(mode);
        //  return;
        // Validate all fields
        if (!validateField($("#signature_name"))) {
            isValid = false;
            firstInvalidField = $("#signature_name");
        } else if (isCanvasEmpty(canvas) && !file) {
            isValid = false;
            $("#signature_error").text(
                "Please select a file or draw signature to upload."
            );
            if (!firstInvalidField) {
                firstInvalidField = $("#signature_input");
            }
        } else if (!isCanvasEmpty(canvas) && file) {
            isValid = false;
            $("#signature_error").text(
                "Please upload only one: either a file or a drawn signature."
            );
        } else {
            isValid = true;
            $("#signature_error").text("");
        }

        if (isValid) {
            var formData = new FormData(this);

            if (!isCanvasEmpty(canvas)) {
                var imageData = canvas.toDataURL("image/png");
                var canvasBlob = dataURLToBlob(imageData);
                formData.append("canvas_image", canvasBlob, "canvas_image.png");
            }

            // Append file input image if a file is selected
            if (file) {
                formData.append("signature_image", file);
                // If canvas is empty, set the preview to file image
            }
            console.log(formData);
            if (mode == "new") {
                // return;
                AjaxSubmit(formData, baseUrl + "/signature_add", "POST");
            } else if (mode == "update") {
                // showToast(id);
                // return;
                formData.append("signature_id", signature_id);
                AjaxSubmit(formData, baseUrl + "/signature_update", "POST");
            }
        } else {
            firstInvalidField.focus();
        }
    });
    function dataURLToBlob(dataURL) {
        const binary = atob(dataURL.split(",")[1]);
        const array = [];
        for (let i = 0; i < binary.length; i++) {
            array.push(binary.charCodeAt(i));
        }
        return new Blob([new Uint8Array(array)], { type: "image/png" });
    }

    // Field validation function
    function validateField(field) {
        var fieldId = field.attr("id");
        var fieldValue = field.val().trim();
        var isValid = true;
        var errorMessage = "";

        if (fieldId === "signature_name") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Signature Name is required";
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
                if (response.status_content === "signature_add_success") {
                    if (response.status) {
                        showToast(response.message);

                        // showToast(response.message);
                        $("#signature_modal").modal("hide");
                        GetSignature()
                        // DisSignature(coreJSON);
                    } else {
                        showToast(response.message);
                    }
                }
                if (response.status === "company_update_success") {
                    if (response.status_value) {
                        showToast(response.message);
                        $("#signature_modal").modal("hide");
                        GetSignature()
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

    $(document).on("click", ".signature_edit_btn", function () {
        var r_index = $(this).attr("id");
        mode = "update";
        $("#signature_modal").modal("show");
        $("#signature_name").val(coreJSON[r_index].signature_name);
        // $("#signature_input").val(baseUrl+ coreJSON[r_index].signature_name);

        let signatureImage = coreJSON[r_index].signature_image;
        let canvasImage = coreJSON[r_index].canvas_image;

        // Show the appropriate image or hide the image preview if none are available
        if (signatureImage) {
            $("#signature_input")[0].files[0];
            $("#previewImageSignature")
                .attr("src", baseUrl + "/" + signatureImage)
                .removeClass("hidden");
            $("#signature_file_name").text(signatureImage.split("/").pop()); // Display the file name
            $(".signature_img_text").hide(); // Hide the placeholder text
        } else if (canvasImage) {
            $("#previewImageSignature")
                .attr("src", baseUrl + "/" + canvasImage)
                .removeClass("hidden");
            $("#signature_file_name").text(canvasImage.split("/").pop()); // Display the file name
            $(".signature_img_text").hide(); // Hide the placeholder text
        } else {
            $("#previewImageSignature").attr("src", "").addClass("hidden");
            $("#signature_file_name").text("");
            $(".signature_img_text").show(); // Show the placeholder text
        }
        console.log(coreJSON);
        signature_id = coreJSON[r_index].id;
        // console.log(id);
    });

    // ***************************[Delete] ********************************************************************

    $(document).on("click", ".signature_delete_btn", function () {
        var selectedId = $(this).attr("id");
        $.confirm({
            title: "Confirmation!",
            content: "Are you sure want to delete?",
            type: "red",
            typeAnimated: true,
            // autoClose: 'cancelAction|8000',
            buttons: {
                deletecompany: {
                    text: "delete signature",
                    action: function () {
                        $.ajax({
                            url: baseUrl + "/signature_delete",
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
                                    GetSignature();

                                   
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

    // ***************************[Signature logo Uploade] ********************************************************************
    // Siganature upload:

    $(document).on("change", ".signature_input", function (event) {
        // showToast();
        const file = event.target.files[0];
        console.log(file);
        if (file) {
            event.preventDefault();

            const reader = new FileReader();

            reader.onload = function (e) {
                const previewImage = document.getElementById(
                    "previewImageSignature"
                );
                const fileName = document.getElementById("signature_file_name");
                const removeFile = document.getElementById(
                    "signature_removeFile"
                );

                previewImage.src = e.target.result;
                previewImage.classList.remove("hidden");
                $(".signature_img_text").css("display", "none"); // Hide all elements with class signature_img_text

                // fileName.textContent = file.name;
                removeFile.style.display = "block";
            };
            reader.readAsDataURL(file);

            // var msg = "success Upload";
            // launch_toast(msg);
        
        }
    });

    $(document).on("click", "#signature_removeFile", function () {
        // showToast();

        $(".signature_img_text").show();
        $("#signature_input").val(""); // Clear the file input

        const previewImage = document.getElementById("previewImageSignature");
        const fileName = document.getElementById("signature_file_name");
        const removeFile = document.getElementById("signature_removeFile");

        previewImage.src = "";
        previewImage.classList.add("hidden");
        fileName.textContent = "";
        removeFile.style.display = "none";
    });

    // Siganature Draw:

    var canvas = document.getElementById("signatureCanvas");
    var ctx = canvas.getContext("2d");

    // Track mouse movements for drawing
    var isDrawing = false;
    var lastX = 0;
    var lastY = 0;

    canvas.addEventListener("mousedown", function (e) {
        isDrawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
    });

    canvas.addEventListener("mousemove", function (e) {
        if (isDrawing) {
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.strokeStyle = "#000"; // Set drawing color
            ctx.lineWidth = 3; // Set drawing line width
            ctx.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY];

            if (!isCanvasEmpty(canvas)) {
                remove_canvas_btn();
            }
        }
    });

    canvas.addEventListener("mouseup", function () {
        isDrawing = false;
    });

    function remove_canvas_btn() {
        // showToast();d
        console.log($(".remove_draw_sig").length);
        if ($(".remove_draw_sign_icon").length === 0) {
            var romove_btn_canvas =
                baseUrl + "/user/images/buttons_icon/cross_circle.png";
            var row = `<img class="remove_draw_sign_icon" src="${romove_btn_canvas}">`;
            $(".remove_draw_sign").append(row);

            $(".remove_draw_sign").on("click", function () {
                ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
                $(".remove_draw_sign_icon").remove(); // Remove the remove button
            });
        }
    }

    // document.getElementById("clearCanvas").addEventListener("click", function () {
    //     ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
    //     $(".remove_draw_sign").remove(); // Remove the remove button
    // });

    document
        .getElementById("saveSignature")
        .addEventListener("click", function () {
            // Check if the canvas is empty
            if (isCanvasEmpty(canvas)) {
                showToast("Please draw your signature before saving.");
                // return;
            }

            // Convert canvas to image data URL
            var imageData = canvas.toDataURL("image/png");
            // Set the image data URL as the source of the preview image
            document.getElementById("previewSignatureImage").src = imageData;
            document.getElementById("previewSignatureImage").style.display =
                "block";

            // Close the modal (if using Bootstrap modal)
            var modal = bootstrap.Modal.getInstance(
                document.getElementById("signatureModal")
            );
            if (modal) {
                modal.hide();
            }

            ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
            $(".remove_draw_sign_icon").remove(); // Remove the remove button
        });

    // Function to check if the canvas is empty
    function isCanvasEmpty(canvas) {
        var blank = document.createElement("canvas");
        blank.width = canvas.width;
        blank.height = canvas.height;
        return canvas.toDataURL() === blank.toDataURL();
    }
});
