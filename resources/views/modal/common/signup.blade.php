<div class="modal-content signup_content">
    <img src="{{asset('images/login/login_head.png')}}" alt=""
        style="
            background-color: #4285F4;
            width: 100%;
            object-fit: contain;
            border: none;
            border-radius: 4rem 4rem 0 0;
        ">
    <div class="modal-header">
        {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> --}}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="text-center signup_head">
            <h2>Create an account</h2>
            <h5>Sign Up with Sky Invoice for Free</h5>
            <p class="login_link"><span class="triggerModal" data-name="login"> Already have an account? Log in</span></p>

        </div>


        <div class="row sigup_input mt-3">
            <div class="col col-lg-2 col-md-2"></div>
            <div class="col col-lg-8 col-md-8 text-center change_status">

                <form id="signup_form">
                    <div class="error_div">
                        <div class="input-group justify-content-center">
                            <div class="form-floating text-center w-100">
                                <input type="text" class="form-control" val-name="The name field is required."
                                    id="" placeholder="" name="name" autocomplete="off">
                                <label for="">Name</label>
                            </div>
                        </div>
                        <div class="err_fixed">
                            <span class="signup_error text-danger"></span>
                        </div>
                    </div>

                    <div class="error_div">
                        <div class="input-group justify-content-center">
                            <div class="form-floating text-center w-100 otp_container">
                                <input type="email" class="form-control" name="email"
                                    val-name="The email field is required." id="signup_email" placeholder=""
                                    autocomplete="off">
                                <label for="email">Email</label>
                                <button type="button" class="email_otp_btn">Get OTP</button>
                                <div class="loader"></div>
                                <img class="emailotp_verify_btn" src="{{ asset('images/login/otp_verify_new.png') }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="err_fixed">
                            <span class="signup_error mail_not_err text-danger"></span>

                        </div>
                    </div>

                    <div class="error_div">

                        <div class="input-group justify-content-center">

                            <div class="form-floating text-center w-100">
                                <input type="numer" class="form-control"
                                    val-name="The phone number field is required." name="phone" id=""
                                    placeholder="" autocomplete="off">
                                <label for="">Phone Number</label>
                                <button type="button" class="mobile_otp_btn">Get OTP</button>
                            </div>

                        </div>
                        <div class="err_fixed">
                            <span class="signup_error  text-danger"></span>

                        </div>
                    </div>

                    <div class="error_div">

                        <div class="input-group justify-content-center">

                            <div class="form-floating text-center w-100">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                    name="password" val-name="The password field is required.">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <span id="togglePassword" class="eye-icon"><i class="fas fa-eye-slash"></i></span>

                        </div>

                        <div class="err_fixed">
                            <span class="signup_error text-danger"></span>

                        </div>
                    </div>

                    <button type="submit" class="signup_btn">Sign Up</button>
                    <br>

                    <p>- Or -<span class="or_border"></span></p>
                    <div class="social_icon">
                        <img class="fb_icon" src="{{ asset('images/login/fb.png') }}" alt="">
                        <a href="{{ url('auth/google') }}"><img class="google_icon" src="{{ asset('images/login/google.png') }}" alt=""></a>
                        <img class="apple_icon" src="{{ asset('images/login/apple.png') }}" alt="">
                    </div> 
                </form>

            </div>
            <div class="col col-lg-2 col-md-2"></div>

        </div>
    </div>
</div>
