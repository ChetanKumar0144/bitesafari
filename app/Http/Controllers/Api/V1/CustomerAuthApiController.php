<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CustomerAuthApiController extends Controller
{
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Customer::firstOrCreate(
            ['email' => $request->email],
            ['name' => 'Guest', 'phone' => null]
        );

        $otp = rand(100000, 999999);
        $customer->otp = $otp;
        $customer->otp_expiry = Carbon::now()->addMinutes(5);
        $customer->save();

        // TODO: send mail/sms
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
            'otp' => $otp // remove in production
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp'   => 'required|digits:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Customer::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expiry', '>', now())
            ->first();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP'
            ], 422);
        }

        // Clear OTP
        $customer->otp = null;
        $customer->otp_expiry = null;
        $customer->save();

        // Create token
        $token = $customer->createToken('mobile-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully',
            'customer' => [
                'id'    => $customer->id,
                'name'  => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
            ],
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $customer = $request->user();
        $customer->tokens()->delete(); // revoke all tokens

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    public function me(Request $request)
    {
        $customer = $request->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Token invalid or expired'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'customer' => [
                'id'    => $customer->id,
                'name'  => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
            ]
        ]);
    }
}
