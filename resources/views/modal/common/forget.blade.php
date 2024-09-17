<div class="modal-content forget_modal_content">
    {{-- <p class="back_arrow forget_back triggerModal" data-name="login">&larr; Back</p> --}}
    <p class="forget_pw_title">Forget Password</p>
    <button type="button" class="btn-close otp-close" data-bs-dismiss="modal"
    aria-label="Close"></button>
    <div class="modal-header">
        {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> --}}
      
    </div>
    <div class="modal-body">
        <div class="row forget_input">
            <div class="col col-lg-2 col-md-2"></div>
            <div class="col col-lg-8 col-md-8 text-center change_status">
                <img class="forget_img" src="{{ asset('images/login/forget_image.png') }}" alt="">
                {{-- <h4 class="mt-3">Forget your password </h4> --}}
                <p class="txt_bold forget_content">Provide the email address you used to create your account, and we will send you instructions to reset your password.</p>
                <form id="forget_send_form">
                <input type="email" name="forget_email" id="forget_email" class="signup_input"
                    placeholder="Enter your email">
                <span id="ForgetEmailError" class="error err_align_text text-danger"></span><br>
                <div>
                    <button type="submit" class="forget_email_btn">Get OTP</button>
                    <br>
                    <span class="signin_error text-danger"></span>
                </div>
              </form>
            </div>
            <div class="col col-lg-2 col-md-2"></div>
        </div>
    </div>
</div>