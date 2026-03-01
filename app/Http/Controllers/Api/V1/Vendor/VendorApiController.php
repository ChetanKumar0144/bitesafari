<?php

namespace App\Http\Controllers\Api\V1\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorApiController extends Controller
{
    public function getProfile(Request $request)
    {
        $vendor = $request->user();

        return response()->json([
            'status'  => true,
            'message' => 'Profile details fetched successfully.',
            'data'    => [
                'vendor' => [
                    'id'      => $vendor->id,
                    'name'    => $vendor->name,
                    'email'   => $vendor->email,
                    'phone'   => $vendor->phone ?? '',
                    'address' => $vendor->address ?? '',
                    'created_at' => $vendor->created_at->format('Y-m-d'),
                ]
            ]
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $vendor = $request->user();

        if ($request->has('address')) {
            $scrubbed = str_replace(["\r", "\n", "\t", "\\", '"', "'"], '', $request->address);
            $scrubbed = preg_replace('/[^a-zA-Z0-9\s]/', '', $scrubbed);
            $scrubbed = preg_replace('/\s+/', ' ', trim($scrubbed));
            $request->merge(['address' => $scrubbed]);
        }

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100',
            'phone'   => 'required|numeric|digits:10',
            'address' => [
                'required',
                'string',
                'max:500',
                'regex:/^[a-zA-Z0-9\s]+$/u'
            ],
        ], [
            'phone.digits'    => 'The mobile number must be exactly 10 digits.',
            'phone.numeric'   => 'The mobile number must contain only numeric digits.',
            'address.regex'   => 'The address must not contain special characters. Only letters, numbers, and spaces are allowed.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $vendor->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Profile Update successfully!',
            'data'    => [
                'vendor' => [
                    'name'    => $vendor->name,
                    'phone'   => $vendor->phone,
                    'address' => $vendor->address,
                ]
            ]
        ], 200);
    }
}
