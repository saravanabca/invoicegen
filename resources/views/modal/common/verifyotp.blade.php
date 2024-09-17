<div class="modal-content">
    <p class="forget_pw_title">Verify OTP</p>

    <div class="modal-header">
        {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> --}}
        <button type="button" class="btn-close otp-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        <p class="back_arrow changepw_back triggerModal" data-name="forget">&larr; Back</p>
    </div>
    <div class="modal-body">
        <div class="row forget_input">
            <div class="col col-lg-2 col-md-2"></div>
            <div class="col col-lg-8 col-md-8 text-center change_status">
                <img class="forget_img" src="{{ asset('images/login/otp_img.png') }}" alt="">
                {{-- <h4 class="mt-3">Forget your password </h4> --}}
                <p class="txt_bold forget_content"> We just send you a verification code to Sky...@gmail.com
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
                        <a class="text-decoration-none" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" id="resend-otp"></a>
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
    </div>
</div>