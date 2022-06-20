<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function mobileforgetpassword()
    {
        return view('auth.mobileforgetpassword');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    public function mobileForgetPasswordPost(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
        ]);
        // dd($request->mobile);

        // otp create and send to mobile from here
        $user = User::where('mobile', bdMobileWithoutCode($request->mobile))->first();
        // dd($user);
        if($user)
        {
            $tp = rand(10000000,99999999);
            $user->password_temp = $tp;
            $user->password = Hash::make($tp);
            $user->save();
            $user->passwordResetSmsSend();
            return view('auth.mobileforgetpasswordOtp', [
                'mobile' => $request->mobile
            ]);
        }
        else
        {
            return back()->with('error', 'Sorry, Your mobile did not match');
        }

        
    }
}
