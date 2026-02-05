<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $customer = Customer::firstOrCreate(
            ['email' => $request->email],
            ['name' => null, 'phone' => null]
        );

        $otp = rand(100000, 999999);
        $customer->otp = $otp;
        $customer->otp_expiry = Carbon::now()->addMinutes(5);
        $customer->save();

        // Mail send (dummy for now)
        // Mail::to($customer->email)->send(new CustomerOtpMail($otp));

        return redirect()->route('customer.otp.form', ['email' => $customer->email])
            ->with('success', 'OTP sent to your email: ' . $otp); // For dev/testing
    }

    public function showOtpForm(Request $request)
    {
        $email = $request->query('email');
        return view('customer.verify-otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        $customer = Customer::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expiry', '>', now())
            ->first();

        if (!$customer) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        Auth::guard('customer')->login($customer);

        $customer->otp = null;
        $customer->otp_expiry = null;
        $customer->save();

        return redirect()->route('customer.dashboard');
    }
    
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login')
            ->with('success', 'Logged out successfully');
    }
}
