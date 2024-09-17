/**AjaxSubmit**/

var emailotp_verified = false;
var emailverify = false;
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
            $(".err_otp").html("");

            var otp_data = data.validate;
            if (otp_data == "success") {
                var alldata = data.alldata;
                var name = alldata.name ?? "";
                var email = alldata.email ?? "";
                var phone = alldata.phone ?? "";
                emailotp_verified = true;
                // var session_email = $(".session_email").val();
                $(".signup-dialog .signup_content").html(old_html);
                $(".email_otp_btn").remove();
                $(".loader").remove();
                $(".emailotp_verify_btn").show();
                var emailInput = $('input[name="email"]');
                emailInput.val(email).prop("readonly", true);
                var nameInput = $('input[name="name"]');
                nameInput.val(name);
                var phoneInput = $('input[name="phone"]');
                phoneInput.val(phone);
                // Prevent keyup events
                emailInput.on("keydown keyup", function (e) {
                    // alert();
                    $(".email_otp_btn").remove();
                    e.preventDefault();
                });

                sessionStorage.clear();
         
            } else if (otp_data == "expired") {
                $(".err_otp").html("OTP expired. Please request a new one");
            } else if (otp_data == "invalid") {
                $(".err_otp").html("Invalid OTP. Please try again");
            }


            if (data.mailotp_send) {
                // $(".session_email").val(data.email);
                otp_page(data);
            }
            else{
                $('.mail_not_err').html(data.message);
                $(".loader").hide();
                $(".email_otp_btn").hide();
            }

            if (data.signup) {
                if (data.success) {
                    // alert(data.message);
                    
                    window.location.href = baseUrl +'/invoice';
                } else {
                    $(".signup_error").html(data.message);

                    showToast(data.message);
                }
            }

            // console.log(data.otp);
            // console.log(data.email);

            if (data.loginsuccess) {
                if (data.login) {
                    // $(".signup_error").html(data.message);

                    // alert(data.message);
                    window.location.href = baseUrl +'/invoice';
                } else {
                    $(".backend_err").html(data.message);

                    // alert(data.message);
                }
            }   

            if(data.emailverify){

                emailverify = true;
                // var emailInput  = $('input[name="email"]');
                // emailInput.closest(".error_div").find(".signup_error").html(data.message);
                // emailInput.addClass("error_border").removeClass("success_border");
            }

            if (data.otp_send_success) {
                $(".get_idlgn").attr("id", data.id);
                console.log(data.otp);
                forget_otp_page(data);
            }else{
                $("#ForgetEmailError").html(data.message);
                $("#forget_email").addClass("error_border");
            }

            var validate_forget = data;
            // console.log(forget_otp_data);
            if (validate_forget == "success") {
                showToast("success verified");
                pwd_changeform();
            } else if (validate_forget == "expired") {
                $(".err_otp").html("OTP expired. Please request a new one");
            } else if (validate_forget == "invalid") {
                $(".err_otp").html("Invalid OTP. Please try again");
            }

            if (data.html) {
                $(".modal .modal-dialog").html(data.html);

                if (guest == "signup") {
                    $(".modal .modal-dialog").addClass("signup-dialog");
                } else if (guest == "login") {
                    $(".modal .modal-dialog").addClass("signup-dialog");
                } else if (guest == "forget") {
                    $(".modal .modal-dialog").addClass("signup-dialog");
                } else {
                    $(".modal .modal-dialog")
                        .removeClass("modal-fullscreen")
                        .removeClass("modal-sm");
                }
                if (!$("body").hasClass("modal-open")) {
                    $("#modal").modal("show");
                }
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

$(document).on("click", ".triggerModal", function () {
    var formData = new FormData();
    formData.append("page", $(this).attr("data-name"));
    AjaxSubmit(
        formData,
        baseUrl + "/redering-page",
        "POST",
        $(this).attr("data-name")
    );
});

// 2. Toggle password:
$(document).on("click", "#togglePassword", function () {
    var passwordInput = $("#floatingPassword");
    var icon = $(this).find("i");

    if (passwordInput.attr("type") === "password") {
        passwordInput.attr("type", "text");
        icon.addClass("fa-eye").removeClass("fa-eye-slash");
    } else {
        passwordInput.attr("type", "password");
        icon.addClass("fa-eye-slash").removeClass("fa-eye");
    }
});


$(document).on("click", "#confirmtogglePassword", function () {
    var passwordInput = $("#confirmFloatingPassword");
    var icon = $(this).find("i");

    if (passwordInput.attr("type") === "password") {
        passwordInput.attr("type", "text");
        icon.addClass("fa-eye").removeClass("fa-eye-slash");
    } else {
        passwordInput.attr("type", "password");
        icon.addClass("fa-eye-slash").removeClass("fa-eye");
    }
});

// 3.Signup Validation:

$(document).on("keyup", ".modal #signup_form input", function () {
    ValidationError($(this));

});
$(document).on("submit", "#signup_form", function (e) {
    e.preventDefault();

    ValidationError($(this), "submit");
});

var emailRegex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-zA-Z]).{8,}$/;
const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
const nonNumericRegex = /[^0-9]/g;


function ValidationError(current, type) {
    if (type == "submit") {
        $(".modal #signup_form input").each(function () {
            var current = $(this); //
            var value = current.val().trim();
            var name = current.attr("name");


            if (name === "name") {
                if (specialCharRegex.test(value)) {
                    value = value.replace(specialCharRegex, '');
                    current.val(value);
                    showToast("Special characters not allowed.");
                }
                if (value.length > 25) {
                    value = value.substring(0, 25);
                    current.val(value);
                    showToast("Name cannot be more than 25 characters.");
                }
            }

            if (name === "phone") {
                if (nonNumericRegex.test(value)) {
                    value = value.replace(nonNumericRegex, '');
                    current.val(value);
                    showToast("Phone number can only contain digits.");
                }
               
            }


            if (value == "") {
                current
                    .closest(".error_div")
                    .find(".signup_error")
                    .html(current.attr("val-name"));
                current.addClass("error_border").removeClass("success_border");
            }
            else if (name === "name" && specialCharRegex.test(value)) {
                current
                    .closest(".error_div")
                    .find(".signup_error")
                    .html("Name cannot contain special characters");
                current.addClass("error_border").removeClass("success_border");
            } 
            else if (name === "email" && !emailRegex.test(value)) {
                current
                    .closest(".error_div")
                    .find(".signup_error")
                    .html("Invalid email address");
                current.addClass("error_border").removeClass("success_border");
            }

            else if (name === "email" && emailotp_verified === false) {
                // alert(current);
                current.closest(".error_div").find(".signup_error").html("Please verify the OTP.");
                current.addClass("error_border").removeClass("success_border");
            }
            else if (name === "phone" && value.length !== 10) {
                current
                    .closest(".error_div")
                    .find(".signup_error")
                    .html("Enter the Valid phone number");
                current.addClass("error_border").removeClass("success_border");
            } else if (name === "password" && !passwordRegex.test(value)) {
                current
                    .closest(".error_div")
                    .find(".signup_error")
                    .html(
                        "Must contain at least one special character (e.g., Pass@123)"
                    );
                current.addClass("error_border").removeClass("success_border");
            } else {
                current.closest(".error_div").find(".signup_error").empty();
                current.addClass("success_border").removeClass("error_border");
            }
        });
        send_signup_data();
    } else {
        var name = current.attr("name");
        var value = current.val().trim();


        if (name === "name") {
            if (specialCharRegex.test(value)) {
                value = value.replace(specialCharRegex, '');
                current.val(value);
                showToast("Special characters not allowed.");
            }
            if (value.length > 25) {
                value = value.substring(0, 25);
                current.val(value);
                showToast("Name cannot be more than 25 characters.");
            }
        }

        if (name === "phone") {
            if (nonNumericRegex.test(value)) {
                value = value.replace(nonNumericRegex, '');
                current.val(value);
                showToast("Phone number can only contain digits.");
            }
          
        }

        if (value == "") {
            current
                .closest(".error_div")
                .find(".signup_error")
                .html(current.attr("val-name"));
            current.addClass("error_border").removeClass("success_border");
        } 
        else if (name === "name" && specialCharRegex.test(value)) {
            current
                .closest(".error_div")
                .find(".signup_error")
                .html("Name cannot contain special characters");
            current.addClass("error_border").removeClass("success_border");
        } 
        else if (name === "email" && !emailRegex.test(value)) {
            current
                .closest(".error_div")
                .find(".signup_error")
                .html("Invalid email address");
            current.addClass("error_border").removeClass("success_border");
            toggleOTPButton(false);
        } 
        else if (name === "email" && emailverify === true) {
            // alert(current);
            current.closest(".error_div").find(".signup_error").html("User already updated. Please use another email address.");
            current.addClass("error_border").removeClass("success_border");
        }
        else if (name === "phone" && value.length !== 10) {
            current
                .closest(".error_div")
                .find(".signup_error")
                .html("Enter the Valid phone number");
            current.addClass("error_border").removeClass("success_border");
            mobileOTPButton(false);
        } else if (name === "password" && !passwordRegex.test(value)) {
            current
                .closest(".error_div")
                .find(".signup_error")
                .html("Must contain at least one special character (e.g., Pass@123)");
            // Password must be at least 8 characters long, contain one symbol, one uppercase letter, and one number
            current.addClass("error_border").removeClass("success_border");
        } else {
            current.closest(".error_div").find(".signup_error").empty();
            current.addClass("success_border").removeClass("error_border");
            if (name === "email") {
                toggleOTPButton(true);
                // signupEmailVerify(value);
            }
            if (name === "phone") {
                mobileOTPButton(true);
            }
        }
    }
}

function toggleOTPButton(show) {
    if (show) {
        $(".email_otp_btn").show();
    } else {
        $(".email_otp_btn").hide();
    }
}

function mobileOTPButton(show) {
    if (show) {
        $(".mobile_otp_btn").show();
    } else {
        $(".mobile_otp_btn").hide();
    }
}
function signupEmailVerify(email){
    var email = email;
    console.log(email);
    AjaxSubmit(email,baseUrl + "/signup_email_verify", "POST")
}

function send_signup_data() {
    // alert();
    var length = $(".modal.show .error_border").length;
    // alert(length);
    if (length == 0) {
        // alert();
        var form = $("#signup_form")[0];
        var formData = new FormData(form);
        // console.log(formData);

        AjaxSubmit(formData, baseUrl + "/signup_auth", "POST");
    }
}

// Signup email otp verify:
let old_html = "";

$(document).on("click", ".email_otp_btn", function () {
    // var email = $('input[name="email"]').val();
    // console.log(email);
    // var otp_mail = email;|
    $(".email_otp_btn").hide();
    $(".loader").show();
    var form = $("#signup_form")[0];
    var formData = new FormData(form);

    var emailValue = $('#signup_email').val();
    sessionStorage.setItem('signup_email', emailValue);
   
    // formData.append("otp_mail", otp_mail);
    old_html = $(".signup-dialog").html();
    AjaxSubmit(formData, baseUrl + "/otp_mail", "POST");
});
var all_data = "";

function otp_page(data) {
    var imageUrl = baseUrl + "/images/login/otp_img.png";
    var signupmaill = $('#signup_email').val();
    $(".signup_content").html(
        `
        <p class="forget_pw_title">Verify OTP</p>
         <button type="button" class="btn-close signup_otp_close" data-bs-dismiss="modal"
            aria-label="Close"></button>
    <div class="modal-header">
       
      
    </div>
    <div class="modal-body">
        <div class="row forget_input">
            <div class="col col-lg-2 col-md-2"></div>
            <div class="col col-lg-8 col-md-8 text-center change_status">
              <img class="forget_img" src="` +
            imageUrl +
            `" alt="">
                <p class="txt_bold forget_content"> We just sent you a verification code to ` + signupmaill +
            `
                </p>
                <div id="otp" class="justify-content-center mt-2">
                    <div class="otp-inputs">
                        <input type="text" id="digit1" maxlength="1" autocomplete ="off" />
                        <input type="text" id="digit2" maxlength="1" autocomplete ="off" />
                        <input type="text" id="digit3" maxlength="1" autocomplete ="off" />
                        <input type="text" id="digit4" maxlength="1" autocomplete ="off" />
                    </div>
                    <div>
                        <small class="err_otp text-danger"></small>
                    </div>
                    <div
                        class="content d-flex dropright ms-3 justify-content-center align-items-center mt-3 dropright">
                    
                                                     <span class="resend_otp_btn" id="mail_resend_otp"></span>

                    </div>
                </div>
                <div>
                    <button class="otp_verify_btn">Verify</button>
                    <br>
                    <span class="signin_error text-danger"></span>
                </div>
            </div>
            <div class="col col-lg-2 col-md-2"></div>
        </div>
    </div>`
    );
    // $('#resetmodel .backimglgn img').attr('src', baseUrl+"images/01/otp_banner.png");
    otpcountdown();
    paste_allotp();
    $(".otp-close").click(function (event) {
        event.preventDefault();
        closeexit();
    });

    function closeexit() {
        var result = confirm("Are you sure you want to close ?");
        if (result) {
            location.reload();
           
        } else {
          
        }
    }

    function restrictToNumbers(event) {
        var charCode = event.which ? event.which : event.keyCode;
        if (charCode < 48 || charCode > 57) {
            event.preventDefault();
            showToast("Special characters and letters not allowed.");
        }
    }

    $("#digit1, #digit2, #digit3, #digit4").on("keypress", restrictToNumbers);

    $("#digit1, #digit2, #digit3, #digit4").on("keyup", function () {
        var digit1 = $("#digit1").val();
        var digit2 = $("#digit2").val();
        var digit3 = $("#digit3").val();
        var digit4 = $("#digit4").val();
        all_data = digit1 + digit2 + digit3 + digit4;
        // otpsend(all_data);
    });
}



$(document).on("click", ".otp_verify_btn", function () {
    if (all_data.length === 4) {
        otpsend(all_data);
    } else {
        $(".err_otp").html("Enter the OTP");
    }
});

function otpsend(all_data) {
    // alert();
    var otp_type = all_data;
    var formData = new FormData();
    formData.append("otp_type", otp_type);
    console.log(otp_type);
    if (otp_type.length >= 4) {
        AjaxSubmit(formData, baseUrl + "/otp-send", "POST");
    } else {
        $(".err_otp").html("");
    }
}

function otpcountdown() {
    $(".content a").removeClass("dropdown-toggle");
    $("#mail_resend_otp").removeClass("resend-otp");
    const timeLimit = 1;
    const countdownEl = document.getElementById("mail_resend_otp");
    let countdownTime = timeLimit * 60;
    const countdownInterval = setInterval(() => {
        const minutes = Math.floor(countdownTime / 60);
        const seconds = countdownTime % 60;
        countdownEl.innerText = `${minutes}:${seconds
            .toString()
            .padStart(2, "0")}`;
        countdownTime--;
        if (countdownTime < 0) {
            clearInterval(countdownInterval);
            $("#mail_resend_otp").addClass("resend-otp");
            $(".content a").addClass("dropdown-toggle");
            $(".resend-otp").click(function () {
                // alert();
                mailresentotp();
            });
            $(countdownEl).html("Resend OTP");
        }
    }, 1000);
}


function mailresentotp() {
    
    var signup_email = sessionStorage.getItem('signup_email');
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    if (csrfToken) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });
    }
    $.ajax({
        url: baseUrl + "/otp_mail",
        type: "POST",
        data: {email : signup_email},
        success: function (response) {
            otpcountdown();
        },
        error: function () {},
    });
}



function resentotp() {
    var id = $(".get_idlgn").attr("id");
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    if (csrfToken) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });
    }
    $.ajax({
        url: baseUrl + "/forget_password",
        type: "POST",
        data: { id: id },
        success: function (response) {
            forgetotpcountdown();
        },
        error: function () {},
    });
}


function forgetotpcountdown() {
    $(".content a").removeClass("dropdown-toggle");
    $("#resend-otp").removeClass("resend-otp");
    const timeLimit = 1;
    const countdownEl = document.getElementById("resend-otp");
    let countdownTime = timeLimit * 60;
    const countdownInterval = setInterval(() => {
        const minutes = Math.floor(countdownTime / 60);
        const seconds = countdownTime % 60;
        countdownEl.innerText = `${minutes}:${seconds
            .toString()
            .padStart(2, "0")}`;
        countdownTime--;
        if (countdownTime < 0) {
            clearInterval(countdownInterval);
            $("#resend-otp").addClass("resend-otp");
            $(".content a").addClass("dropdown-toggle");
            $(".resend-otp").click(function () {
                resentotp();
            });
            $(countdownEl).html("Resend OTP");
        }
    }, 1000);
}

function paste_allotp() {
    const otpFields = document.querySelectorAll(".otp-inputs input");
    otpFields.forEach((field, index) => {
        field.addEventListener("input", (e) => {
            if (e.data !== null) {
                otpFields[index + 1].focus();
            }
        });
        field.addEventListener("paste", (e) => {
            e.preventDefault();
            const pasteData = e.clipboardData.getData("text/plain");
            for (let i = 0; i < pasteData.length; i++) {
                if (i < otpFields.length) {
                    otpFields[i].value = pasteData[i];
                    otpFields[i].dispatchEvent(new Event("input"));
                }
            }
        });
        field.addEventListener("keydown", (e) => {
            // alert();
            if (e.keyCode === 8 && field.value === "") {
                e.preventDefault();
                otpFields[index - 1].focus();
            }
        });
    });
}



// login:

//  login Validation:

$(document).on("keyup", ".modal #login_form input", function () {
    ValidationLogin($(this));
});
$(document).on("click", ".modal .login_btn", function () {
    ValidationLogin($(this), "submit");
});

var emailRegex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-zA-Z]).{8,}$/;

function ValidationLogin(current, type) {
    if (type == "submit") {
        $(".modal #login_form input").each(function () {
            var current = $(this); //
            var value = current.val().trim();
            var name = current.attr("name");

            if (value == "") {
                current
                    .closest(".error_div")
                    .find(".signup_error")
                    .html(current.attr("val-name"));
                current.addClass("error_border").removeClass("success_border");
            } else if (name === "email" && !emailRegex.test(value)) {
                current
                    .closest(".error_div")
                    .find(".signup_error")
                    .html("Invalid email address");
                current.addClass("error_border").removeClass("success_border");
            } else {
                current.closest(".error_div").find(".signup_error").empty();
                current.addClass("success_border").removeClass("error_border");
            }
        });
        send_signin_data();
    } else {
        var name = current.attr("name");
        var value = current.val().trim();

        if (value == "") {
            current
                .closest(".error_div")
                .find(".signup_error")
                .html(current.attr("val-name"));
            current.addClass("error_border").removeClass("success_border");
        } else if (name === "email" && !emailRegex.test(value)) {
            current
                .closest(".error_div")
                .find(".signup_error")
                .html("Invalid email address");
            current.addClass("error_border").removeClass("success_border");
            toggleOTPButton(false);
        } else {
            current.closest(".error_div").find(".signup_error").empty();
            current.addClass("success_border").removeClass("error_border");
        }
    }
}

function send_signin_data() {
    var length = $(".modal.show .error_border").length;
    // alert(length);
    if (length == 0) {
        // alert();
        var form = $("#login_form")[0];
        var formData = new FormData(form);
        console.log(formData);

        AjaxSubmit(formData, baseUrl + "/login_auth", "POST");
    }
}

$(document).on("submit", "#forget_send_form", function (e) {
    // alert();
    e.preventDefault();

    if ($("#forget_email").val() === "") {
        // pageplaced(this.id);
        // toastwarning("Please Enter Email");
        $("#ForgetEmailError").html("Enter the Email");
        $("#forget_email").addClass("error_border");
    } else {
        send_forget_data();
    }
});

function send_forget_data() {
    // alert();
    var forget_email = $("#forget_email").val();
    var formData = new FormData();
    formData.append("forget_email", forget_email);
    AjaxSubmit(formData, baseUrl + "/forget_password", "POST");

    // $.ajax({
    //     type: "POST",
    //     data: formData,
    //     url: base_Url + "/forget_password",
    //     contentType: false,
    //     cache: false,
    //     processData: false,
    //     enctype: "multipart/form-data",
    //     success: (data) =>
    //         {
    //             // console.log(data);
    //             // return;
    //             // $('.change_status').html('<div class="loader"></div><div class="text-center">Please wait...</div>');
    //             // var image = baseUrl+"images/01/placeholder_load.png";
    //             // $('.change_status .loader').html('<img src ='+image+'>');

    //             setTimeout(function() {
    //                 opt_type(data);
    //             }, 1000);
    //                 $('.get_idlgn').attr('id', data.id);
    //         },
    //         error: function(data)
    //         {
    //             // console.log(data);
    //             // return;
    //             $('#reset_passwordhme').html(`Reset`);
    //             if (data.status === 422)
    //             {
    //                 alert('422');
    //                 clrErr();
    //                 var resJSON = data.responseJSON;
    //                 $.each(resJSON.errors, function (key, value) {
    //                     alert(value);
    //                     $('#resetpass .' + key + '-error').html(value);
    //                     $('#resetpass #' + key).addClass('is-invalid');
    //                     $('.loginpdoc #resetpass .is-invalid').css('border-left', '1px solid #dc3545');
    //                 });

    //             }

    //             function clrErr()
    //             {
    //                 $("#resetpass .form-group" ).removeClass( "has-error" );
    //                 $("#resetpass .err_msg").html('');
    //                 let isinvcls = document.querySelectorAll('#resetpass .is-invalid');
    //                 isinvcls.forEach(function(item) {
    //                     item.classList.remove('is-invalid');
    //                     $('.loginpdoc #resetpass .brdr').css('border-left', '0px');
    //                 });
    //             }
    //         }

    // });

    // alert();
}

function closeexit() {
    var result = confirm("Are you sure you want to close ?");
    if (result) {
        location.reload();
       
    } else {
      
    }
}

var forget_all_data = "";


function forget_otp_page(data) {
    var imageUrl = baseUrl + "/images/login/otp_img.png";
    $(".forget_modal_content").html(
        `
        
        <p class="forget_pw_title">Verify OTP</p>
 <button type="button" class="btn-close otp-closee" data-bs-dismiss="modal"
            aria-label="Close"></button>
    <div class="modal-header">
       
       
    </div>
    <div class="modal-body">
        <div class="row forget_input">
            <div class="col col-lg-2 col-md-2"></div>
            <div class="col col-lg-8 col-md-8 text-center change_status">
              <img class="forget_img" src="` +
            imageUrl +
            `" alt="">
                <p class="txt_bold forget_content">We just sent you a verification code to ` +
            data.email +
            `
                </p>
                <div id="otp" class="justify-content-center mt-2">
                    <div class="forget_otp_inputs">
                        <input type="text" id="digitf1" maxlength="1" autocomplete ="off" />
                        <input type="text" id="digitf2" maxlength="1" autocomplete ="off" />
                        <input type="text" id="digitf3" maxlength="1" autocomplete ="off" />
                        <input type="text" id="digitf4" maxlength="1" autocomplete ="off" />
                    </div>
                    <div>
                        <small class="err_otp text-danger"></small>
                    </div>
                    <div class="content d-flex dropright ms-3 justify-content-center align-items-center mt-3 dropright">
            
                         <span class="resend_otp_btn" id="resend-otp"></span>

                    </div>
                </div>
                <div>
                    <button class="forget_otp_verify_btn">Verify</button>
                    <br>
                    <span class="signin_error text-danger"></span>
                </div>
            </div>
            <div class="col col-lg-2 col-md-2"></div>
        </div>
    </div>`
    );
    // $('#resetmodel .backimglgn img').attr('src', baseUrl+"images/01/otp_banner.png");
    forgetotpcountdown();
    paste_all_forget_otp();
    $(".otp-closee").click(function () {
         closeexit();
     });
  
     function restrictToNumbers(event) {
        var charCode = event.which ? event.which : event.keyCode;
        if (charCode < 48 || charCode > 57) {
            event.preventDefault();
            showToast("Special characters and letters not allowed.");
        }
    }

    $("#digitf1, #digitf2, #digitf3, #digitf4").on("keypress", restrictToNumbers);

    $("#digitf1, #digitf2, #digitf3, #digitf4").on("keyup", function () {
        var digit1 = $("#digitf1").val();
        var digit2 = $("#digitf2").val();
        var digit3 = $("#digitf3").val();
        var digit4 = $("#digitf4").val();
        forget_all_data = digit1 + digit2 + digit3 + digit4;
        // otpsend(all_data);
        console.log(forget_all_data);
    });
}

$(".otp-closee").click(function () {
    closeexit();
});



function paste_all_forget_otp() {
    const otpFields = document.querySelectorAll(".forget_otp_inputs input");
    otpFields.forEach((field, index) => {
        field.addEventListener("input", (e) => {
            if (e.data !== null) {
                otpFields[index + 1].focus();
            }
        });
        field.addEventListener("paste", (e) => {
            e.preventDefault();
            const pasteData = e.clipboardData.getData("text/plain");
            for (let i = 0; i < pasteData.length; i++) {
                if (i < otpFields.length) {
                    otpFields[i].value = pasteData[i];
                    otpFields[i].dispatchEvent(new Event("input"));
                }
            }
        });
        field.addEventListener("keydown", (e) => {
            // alert();
            if (e.keyCode === 8 && field.value === "") {
                e.preventDefault();
                otpFields[index - 1].focus();
            }
        });
    });
}


$(document).on("click", ".forget_otp_verify_btn", function () {
    if (forget_all_data.length === 4) {
        forgetotpsend(forget_all_data);
    } else {
        $(".err_otp").html("Enter the OTP");

        // console.log("Please enter all digits of the OTP.");
        // Optionally, provide user feedback that all digits are required
    }
});

function forgetotpsend(forget_all_data) {
    // alert();
    var id = $(".get_idlgn").attr("id");

    var otp_type = forget_all_data;
    var formData = new FormData();
    formData.append("otp_type", otp_type);
    console.log(otp_type);
    if (otp_type.length >= 4) {
        AjaxSubmit(formData, baseUrl + "/otp_forget_send" + "/" + id, "POST");
    } else {
        $(".err_otp").html("");
    }
}

function pwd_changeform() {
    var imageUrl = baseUrl + "/images/login/changepw_img.png";
    // alert();
    // $('#resetmodel .backimglgn img').attr('src',baseUrl+"images/01/login-popup.png");
    $(".forget_modal_content").html(
        `
       <p class="forget_pw_title">Set New Password</p>
   <button type="button" class="btn-close otp-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
    <div class="modal-header">
     
    </div>
    <div class="modal-body">
        <div class="row forget_input">
            <div class="col col-lg-2 col-md-2"></div>
            <div class="col col-lg-8 col-md-8 text-center change_status">
                <img class="forget_img" src="` +
            imageUrl +
            `" alt="">
              
                <p class="txt_bold forget_content">Enter new password you want to create and repeat it ! 
                </p>
                 <form>
                      <div class="input-group justify-content-center">

                            <div class="form-floating text-center w-100">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                    name="password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <span id="togglePassword" class="eye-icon"><i class="fas fa-eye-slash"></i></span>

                        </div>

                          <div class="input-group justify-content-center mt-4">

                            <div class="form-floating text-center w-100">
                                <input type="password" class="form-control" id="confirmFloatingPassword" placeholder="Password"
                                    name="confirm_password" val-name="The password field is required.">
                                <label for="confirmFloatingPassword">Confirm Password</label>
                            </div>
                            <span id="confirmtogglePassword" class="eye-icon"><i class="fas fa-eye-slash"></i></span>

                        </div>

                        <div class="err_fixed">
                            <span class="twopass_err text-danger"></span>
                        </div>

                    <button type="button" id="change_password" class="mb-4">Change Passowrd</button>
                </form>
            </div>
            <div class="col col-lg-2 col-md-2"></div>
        </div>
    </div>
    `
    );
}

$(document).on("click", "#change_password", function (event) {
    event.preventDefault();
    change_password();
});

function change_password() {
    var id = $(".get_idlgn").attr("id");
    var formData = $("#change_password").closest("form").serialize();
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (csrfToken) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    }
    $.ajax({
        url: baseUrl + "/change-password" + "/" + id,
        method: "POST",
        data: formData,
        success: (data) => {
            $(".twopass_err").html("");
            if (data == "match_error") {
                $(".twopass_err").html("Two Password Do not match");
            } else {
              
                showToastAndReload("success");

                // alerttoast();
                // $('.change_status').html('<div class="loader"></div><div class="text-center">Please wait...</div>');
                // var image = baseUrl+"images/01/placeholder_load.png";
                // $('.change_status .loader').html('<img src ='+image+'>');
                // setTimeout(function() {

                //     // undo_restpage();
                // }, 1000);

                // $('#resetmodel .backimglgn img').attr('src', baseUrl+"images/01/reset_banner.png");
            }
        },
        error: function (data) {
            if (data.status === 422) {
                clrErr();
                var resJSON = data.responseJSON;
                $.each(resJSON.errors, function (key, value) {
                    $(".twopass_err").html(value);
                });
            }
            function clrErr() {
                $(".err_fixed .twopass_err").html("");
            }
        },
    });
}


// google auth
// $(document).on("click", "#google_auth_btn", function (event) {
//     // Open Google Auth in a new tab
//     window.open('{{ url('auth/google') }}', '_blank');
    
//     // Minimize the current window
//     window.open('', '_self', '');
//     window.close();
// });