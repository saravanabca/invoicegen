{{-- Log in --}}
<div class="modal-content">
    <img src="{{ asset('images/login/login_head.png') }}" alt=""
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
            <h2>Welcome Back !</h2>
            <h5>we are happy to have you visit us again</h5>
            <p class="signup_link"><span class="triggerModal" data-name="signup">Don’t have an account ? Signup</span></p>
        </div>

        {{-- <div class="container">
            <div class="row social_login">
                <div class="col col-lg-4 col-md-4">
                    <a href="{{ url('auth/facebook') }}"><button class="fb_btn"><img
                                src="{{ asset('images/social/fb.png') }}" alt=""><span>Sign Up
                                with Facebook</span></button></a>
                </div>
                <div class="col col-lg-4 col-md-4">
                    <a href="{{ url('auth/google') }}"><button class="google_btn sigin_up_auth"><img
                                src="{{ asset('images/social/google.png') }}" alt="">Sign Up with
                            Google</button></a>
                </div>
                <div class="col col-lg-4 col-md-4">
                    <button class="apple_btn"><img src="{{ asset('images/social/apple.png') }}"
                            alt="">Sign
                        Up with Apple</button>
                </div>
            </div>
        </div> --}}

        <div class="row login_input mt-3">
            <div class="col col-lg-2 col-md-2"></div>
            <div class="col col-lg-8 col-md-8 text-center">

                <form id="login_form">

                    {{-- <input type="text" name="name" id="signup_name" class="signup_input input_alignment"
                        placeholder="Enter your Username" required autocomplete="off">
                    <span id="nameError" class="error err_align_text"></span><br> --}}

                    <div class="error_div">
                        <div class="input-group justify-content-center">
                            <div class="form-floating text-center w-100 otp_container">
                                <input type="email" class="form-control" name="email"
                                    val-name="The email is required." id="signup_email" placeholder=""
                                    autocomplete="off">
                                <label for="email">Email</label>

                            </div>
                        </div>
                        <div class="err_fixed">
                            <span class="signup_error text-danger"></span>

                        </div>
                    </div>
                   
                    <div class="error_div">

                        <div class="input-group justify-content-center">

                            <div class="form-floating text-center w-100">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                    name="password" val-name="The password is required.">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <span id="togglePassword" class="eye-icon"><i class="fas fa-eye-slash"></i></span>

                        </div>

                        <div class="err_fixed">
                            <span class="signup_error text-danger backend_err"></span>

                        </div>

                    </div>



                    {{-- <div class="terms_div">
                        <input type="checkbox" id="termscontion"><label for="termscontion" class="terms_par">By
                            signing up, I agree to <span class="terms_check">Terms of Use & Privacy
                                Policy</span></label>
                    </div> --}}
                    <p class="forget_txt triggerModal" data-name="forget">Forgot Password?</p>

                    <button type="button" class="login_btn">Log In</button>
                    <br>
                    {{-- <span class="signup_error text-danger"></span> --}}

                    <p>- Or <span class="or_border"></span></p>
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
