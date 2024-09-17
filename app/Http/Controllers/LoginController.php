<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;



class LoginController extends Controller
{
    public function redirectToGoogle()
{

    return Socialite::driver('google')->redirect();
}

// public function handleGoogleCallback()
// {
//     $user = Socialite::driver('google')->user();
//     // Perform authentication logic or store user data
// }

public function handleGoogleCallback()
{
    $user = Socialite::driver('google')->user();

    // Perform necessary actions with user data
    $name = $user->getName();
    $email = $user->getEmail();
    $avatar = $user->getAvatar();
    $firstName = explode(' ', $name)[0]; // Extracting the first name

    // dd($avatar);

    // // If user does not exist, create a new one
    $existingUser = User::where('email', $email)->first();
    if ($existingUser) {
        // User exists, update the existing user
        $existingUser->name = $name;
        $existingUser->avatar = $avatar;
        $existingUser->save();
    } else {
        // User does not exist, create a new user
        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->avatar = $avatar;
        $newUser->save();
    }

    // session([
    //     'name' => $name,
    //     'email' => $email,
    //     'avatar' => $avatar
    // ]);

    // Log in the user
    // auth()->login($existingUser ?? $newUser);
    Auth::login($existingUser ?? $newUser); 

    // return response()->json([
    //     'success' => true,
    // ]);


    // Redirect to a protected resource
    // return redirect('auth_check');
    // return redirect('/');
    return redirect('invoice');

    // Email has already been taken.
}

// public function auth_check(){
//     if (Auth::guard('web')->check()) {
            
//     }
// }



public function redirectToFacebook()
{
    return Socialite::driver('facebook')->redirect();
}



public function handleFacebookCallback()
{
    $user = Socialite::driver('facebook')->user();

    $name = $user->getName();
    $email = $user->getEmail();
    $avatar = $user->getAvatar();
    $firstName = explode(' ', $name)[0]; // Extracting the first name

    // dd($avatar);

    // // If user does not exist, create a new one
    $existingUser = User::where('email', $email)->first();
    if (!$existingUser) {
        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->avatar = $avatar;
        $newUser->save();
    }

    session([
        'name' => $firstName,
        'email' => $email,
        'avatar' => $avatar
    ]);

    // Log in the user
    auth()->login($existingUser ?? $newUser);

    // Redirect to a protected resource
    // return redirect('client');
    return redirect('auth_check');
}


public function redirectToApple()
{
    return Socialite::driver('apple')->redirect();
}

public function handleAppleCallback()
{
    $user = Socialite::driver('apple')->user();

    $name = $user->getName();
    $email = $user->getEmail();
    $avatar = $user->getAvatar();
    $firstName = explode(' ', $name)[0]; // Extracting the first name

    // dd($avatar);

    // // If user does not exist, create a new one
    $existingUser = User::where('email', $email)->first();
    
    if (!$existingUser) {
        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->avatar = $avatar;
        $newUser->save();
    }

    session([
        'name' => $firstName,
        'email' => $email,
        'avatar' => $avatarx
    ]);

    // Log in the user
    auth()->login($existingUser ?? $newUser);

    // Redirect to a protected resource
    return redirect('client');
}

public function logout()
{
    Auth::logout();
    session()->forget(['name', 'email', 'avatar']); // Clear user data from session
    return redirect('/');
}


public function signup_email_verify(Request $request) {
    $email = $request->email;
    // dd($email);
    $emailVerify = User::where('email', $request->email)->first();
    if($emailVerify){
        return response()->json([
            'emailverify' => true,
        ]);
    }
    else{
        return response()->json([
            'emailverify' => false,
        ]);
    }
    
   
}

public function signup_auth(Request $request)
{
    $email = $request->email;
    $name = $request->name;
    $phone = $request->phone;
    $password = $request->password;
    // dd($phone);

    // Check if the user with the given email already exists
    $existingUser = User::where('email', $request->email)->first();
    if (!$existingUser) {
        // If the user does not exist, create a new user
        $user = User::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
        // dd($user);

        // Log in the newly registered user
        Auth::login($user);

        // Dispatch the Registered event
        event(new Registered($user));


        return response()->json([
            'signup' => true,
            'success' => true,
            'message' => 'User Created successfully'
        ]);
        
        // return redirect('dashboard');
        // return Redirect::to('dashboard');

    } 
    else {
        // If the user already exists, you may handle this case according to your application's requirements
        // For example, you can return a response indicating that the user already exists
        return response()->json([
            'signup' => true,
            'success' => false,
            'message' => 'User already updated. Please use another email address.'
        ]);    

    }

    // Redirect the user to the invoicelist page after successful registration
}

public function login_auth(Request $request)
{
    $user = User::where('email', $request->email)->first();
    if ($user) {
        if (Hash::check($request->password, $user->password)) {
            if (Auth::guard('web')->attempt(['email' => $request->email,'password' => $request->password])) {
                // Successful login
                return response()->json([
                    'loginsuccess'=>true,
                    'login' => true,
                    'message' => 'Welcome',
                ]);   
                return Redirect::to('invoice');
            } else {
                return response()->json([
                    'loginsuccess'=>true,
                    'login' => false,
                    'message' => 'Authentication failed. Password does not match. Please ensure that the entered passwords match each other.'
                ]);    
            }
        } 
        else {
            return response()->json([
                'loginsuccess'=>true,
                'login' => false,
                'message' => 'Invalid username or password. Please try again'
            ]);    
        }
    } 
    else {
        return response()->json([
            'loginsuccess'=>true,
            'login' => false,
            'message' => 'Invalid username or password. Please try again',
            'mailerr' => true
        ]);    

    }
}

public function forget_password(Request $request)
{
    // $email = $request->forget_email;
    if ($request->id != "") {
      $formData = $request->id;


        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    } else {
      
        $user = User::where('email', $request->forget_email)->first();
    
        if (!$user) {
            return response()->json(['message' => 'The email address you entered is not registered','otp_send_success' => false]);
        }
    }

    $otp = mt_rand(1000, 9999);
    $expires_at = now()->addMinutes(1);
    
    $user->otp = $otp;
    $user->expired_otp = $expires_at;
    $user->save();
    // Redis::setex("otp:email", 300, $otp);
    // Cache::put('otp:' . $email, $otp, $expiration);

    // Send OTP email
    Mail::to($user)->send(new OtpMail($otp));

    return response()->json(['id' => $user->id,'otp'=>$user->otp, 'email' => $user->email,'otp_send_success' => true]);

    // dd($email);
    // return response()->json([
    //     'success' => true,
    //     'message' => 'Otp send uccessfuly'
    // ]);
    // return view('otp_verify',compact('email','otp'));
    // return Redirect::to('otpverify',compact('email','otp'));

}

public function otp_verify_page()
{
    $otp_mail = Cache::get('mail:' . $email);
    // dd($otp_mail);
    return view('otp_verify');

}




public function verify_otp(Request $request)
{
    $email = $request->forget_email;
    $otp = $request->otp;

    // Retrieve the stored OTP from the cache
    $storedOtp = Cache::get('otp:' . $email);

    if ($storedOtp && $storedOtp == $otp) {
        // OTP is valid, proceed with password reset
        // You can redirect the user to the password reset page here
        return redirect()->route('password.reset', ['email' => $email]);

    } else {
        // Invalid OTP or expired
        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP or expired'
        ]);
    }
}


public function changepass(Request $request, $id){
    $request->validate([
        'password' => [
            'required',
            'regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/',
        ],
        'confirm_password' => 'required|same:password',
    ], [
        'password.required' => 'The password field is required.',
        'password.regex' => 'The password must contain at least one uppercase letter, one number, one special character, and must be at least 8 characters long.',
        'confirm_password.required' => 'The password confirmation field is required.',
        'confirm_password.same' => 'Two Password Do not match.',
    ]);
    

    if($request->password == $request->confirm_password){
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        return response()->json();
    }else{
        $validate = "match_error";
        return response()->json($validate);
    }

}




public function otp_mail(Request $request)
{
try{

    $alldata = $request->all();
    $email = $request->email;
    // dd($email);
    

    $user = User::where('email', $email)->where('flag',1)->first();
    // dd($user);
    if (!$user) {
        $otp = mt_rand(1000, 9999);
        $expires_at = now()->addMinutes(1);
        // dd($email);
        session([
            'otp' => $otp,
            'expires_at' => $expires_at,
            // 'email' => $email,
            'alldata'=>$alldata
        ]);
    
        // $alldata = session('alldata');
        // dd($alldata);
        Mail::to($email)->send(new OtpMail($otp));
    
        return response()->json(['mailotp_send' => true,'otp' => $otp]);
    }
    else{

        return response()->json(['mailotp_send' => false,'message' => 'User with provided email not found']);
}

}
catch (Exception $e) {
    return response()->json([
        // 'success' => false,
        'message' => $e->getMessage()
    ]); // Custom status code for bad request
}

}



public function otpsend(Request $request){
    $otp_check = session('otp');
    $alldata = session('alldata');
    $expires_at = session('expires_at');
    $otp_type = $request->otp_type;

    // dd($alldata);

    if (Carbon::now()->gt($expires_at)) {
        $validate = "expired";
    }elseif($otp_check == $request->otp_type){
        $validate ="success";
       
     }else{
         $validate = "invalid";
     }
    return response()->json([
        'validate' => $validate,
        'alldata' => $alldata
    ]);
}


public function otp_forget_send(Request $request, $id){
    $otp_check = User::find($id);
    if (Carbon::now()->gt($otp_check->expired_otp)) {
        $validate_forget = "expired";
    }elseif($otp_check->otp == $request->otp_type){
        $validate_forget ="success";
     }else{
         $validate_forget = "invalid";
     }
    return response()->json($validate_forget);
}

}