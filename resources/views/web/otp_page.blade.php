<!DOCTYPE html>
<html>

<head>
    <title>Here’s the Otp to reset your password</title>
</head>

<body>
    <h1>Your Forget OTP iss: {{ $otp }}</h1>
    <p>Hello there,

        We received a request to reset the password for your account. If you made this request, click the link below to
        set a new password.</p>
    <img src="{{ asset('images/laptop.png') }}" alt="">
</body>

</html>
