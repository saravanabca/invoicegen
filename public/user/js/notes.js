$(document).ready(function () {
    var mode, id, coreJSON;
    // Declare coreJSON outside the scope
    GetNotes()
    // ***************************[Get] ********************************************************************
    function GetNotes() {

    $.ajax({
        url: baseUrl + "/notes_get",
        type: "GET",
        dataType: "json",
        success: function (response) {
            disNotes(response);
            coreJSON = response.notesdetails;
            console.log(coreJSON);
        },
        error: function (xhr, status, error) {
            console.error("Error fetching invoice details:", error);
        },
    });
}

    function disNotes(response) {
        const notesContainer = document.getElementById('notesContainer'); // The container where notes data will be appended
        notesContainer.innerHTML = ''; // Clear the container before appending new data
        var edit_icon = baseUrl + "/user/images/buttons_icon/edit.png";
        var delete_icon = baseUrl + "/user/images/buttons_icon/delete.png";
        var terms_placeholder = baseUrl + "/user/images/settings/notesterms_placeholder.png";

        response.notesdetails.forEach((notes, index) => {
            // console.log(index);
        const isActive = notes.notes_active === 1 ? 'checked' : '';

            const notesHTML = `
            <div class="row notes_data">
                    <div class="col col-md-3">
                        <input type="radio" class="active_notes" id="${notes.id}" name="select_notes" value="" ${isActive}>
                    </div>
                    <div class="col col-md-5 notes-align">
                        <span class="notes_name">${notes.notes}</span><br>
                        <img src="{{ asset('user/images/buttons_icon/template_btn_icon.png') }}" alt="">
                    </div>
                    
                    <div class="col col-md-4">
                        <div class="notes_action_btns d-flex">
                            <button class="notes_edit_btn d-flex" id="${index}"><img src="${edit_icon}" alt="">Edit</button>
                            <button class="notes_delete_btn d-flex" id="${notes.id}"><img src="${delete_icon}" alt="">Delete</button>
                        </div>
                    </div>
                </div>
            `;
            notesContainer.insertAdjacentHTML('beforeend', notesHTML);
        });
    

    }
 // ***************************[Active notes] ********************************************************************

 $(document).on("change", ".active_notes", function () {
    var notesactiveid = $(this).attr("id");

    $.ajax({
        url: baseUrl + "/notes_active",
        type: "POST",
        data: {notesactiveid: notesactiveid },
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

    // $(".add_notes_btn").click(function () {
    //     mode = "new";
    //     $("#notes_modal").modal("show");
    // });


    $(".add_notes_btn").click(function () {
        $.ajax({
            url: baseUrl + '/check-company-table', // Your backend endpoint
            type: 'GET', // Or 'POST' if needed
            success: function(response) {
                if (response.status === 'error') {
                    showToast("Add a company to create notes");
                } else {
                    mode = "new";
                    $("#notes_modal").modal("show");
                }
            },
            error: function() {
                showToast('An error occurred. Please try again.');
            }
        });
    });

    $("#notes_modal").on("show.bs.modal", function () {
        $(this).find("form").trigger("reset");
        // $('.invalid-feedback').hide();
        $("#notes_add_form").removeClass("danger-border success-border");
        $(".error-message").html("");
    });


    // Real-time validation on keyup
    $("#notes_add_form textarea").on("keyup", function () {
        validateField($(this));
    });
    $("#notes_add_form #notes_title").on("keyup", function () {
        validateField($(this));
    });


    // Form submission
    $("#notes_add_form").on("submit", function (e) {
        e.preventDefault();
        var form = $(this);
        var isValid = true;
        var firstInvalidField = null;

        // Validate all fields
        if (!validateField($("#notes_title"))) {
            isValid = false;
            firstInvalidField = $("#notes_title");
        }
        else if (!validateField($("#notes_filed"))) {
            isValid = false;
            firstInvalidField = $("#notes_filed");
        }

        if (isValid) {
            var formData = new FormData(this);
            console.log(formData);
            // return;
            if (mode == "new") {
                // showToast("add");
                // return;
                AjaxSubmit(formData, baseUrl + "/notes_data_add", "POST");
            } else if (mode == "update") {
                // showToast(id);
                // return;
                formData.append("notes_id", id);
                AjaxSubmit(formData, baseUrl + "/notes_update", "POST");
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

        if (fieldId === "notes_title") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Notes title is required";
            }
            else if (fieldValue.length > 25) {
                isValid = false;
                fieldValue = fieldValue.substring(0, 25);
                field.val(fieldValue);
                errorMessage = "Notes title cannot exceed 25 characters";
            }
        } 
       else if (fieldId === "notes_filed") {
            if (fieldValue === "") {
                isValid = false;
                errorMessage = "Notes is required";
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
                if (response.status === "notes_add_success") {
                    if (response.status_value) {
                        showToast(response.message);

                        // showToast(response.message);
                        $("#notes_modal").modal("hide");

                        GetNotes();
                    } else {
                        showToast(response.message);
                    }
                }
                if (response.status === "notes_update_success") {
                    if (response.status_value) {
                        showToast(response.message);
                        $("#notes_modal").modal("hide");

                        GetNotes();

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

    $(document).on("click", ".notes_edit_btn", function () {
        var r_index = $(this).attr("id");
        mode = "update";
        $("#notes_modal").modal("show");
        $("#notes_filed").val(coreJSON[r_index].notes);
        $("#notes_title").val(coreJSON[r_index].notes_title);
       
        console.log(coreJSON);
        id = coreJSON[r_index].id;
        // console.log(id);

    });


    // ***************************[Delete] ********************************************************************
    $(document).on("click", ".notes_delete_btn", function () {
        var selectedId = $(this).attr("id");
        $.confirm({
            title: "Confirmation!",
            content: "Are you sure want to delete?",
            type: "red",
            typeAnimated: true,
            // autoClose: 'cancelAction|8000',
            buttons: {
                deletenotes: {
                    text: "delete notes",
                    action: function () {
                        $.ajax({
                            url: baseUrl + "/notes_delete",
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
                                    GetNotes();

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


