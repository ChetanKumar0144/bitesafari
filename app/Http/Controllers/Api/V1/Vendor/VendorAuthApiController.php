<?php

namespace App\Http\Controllers\Api\V1\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VendorAuthApiController extends Controller
{
    public function verifyUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:vendors,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $vendor = Vendor::where('email', $request->email)->first();

        if (!$vendor || !Hash::check($request->password, $vendor->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid credentials provided.',
            ], 401);
        }

        $token = $vendor->createToken('vendor_token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'Login successful',
            'data'    => [
                'token'  => $token,
                'vendor' => [
                    'id'    => $vendor->id,
                    'name'  => $vendor->name,
                    'email' => $vendor->email,
                ]
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
