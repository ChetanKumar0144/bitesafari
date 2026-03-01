<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProfileController extends Controller
{
    public function edit()
    {
        $vendor = Auth::guard('vendor')->user();
        return view('vendor.profile.edit', compact('vendor'));
    }

   public function update(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();

        if ($request->has('address')) {
            $scrubbed = str_replace(["\r", "\n", "\t", "\\", '"', "'"], '', $request->address);
            $scrubbed = preg_replace('/[^a-zA-Z0-9\s]/', '', $scrubbed);
            $scrubbed = preg_replace('/\s+/', ' ', trim($scrubbed));
            $request->merge(['address' => $scrubbed]);
        }

        $request->validate([
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

        // Data Update
        $vendor->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Identity synchronized successfully!');
    }
}
