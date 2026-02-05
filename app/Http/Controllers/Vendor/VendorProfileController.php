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
        /** @var \App\Models\Vendor $vendor */
        $vendor = Auth::guard('vendor')->user();

        $request->validate([
            'name'    => 'required|string|max:100',
            // Email strictly unique (vendor table mein) aur lowercased validation
            'email'   => 'required|email:rfc,dns|unique:vendors,email,' . $vendor->id,
            // Strictly 10 digits only
            'phone'   => 'required|numeric|digits:10',
            'address' => 'required|string|max:500',
        ], [
            'phone.digits' => 'Mobile number strictly 10 digits ka hona chahiye.',
            'phone.numeric' => 'Mobile number mein sirf numbers allowed hain.',
        ]);

        // Data Update
        $vendor->update([
            'name'    => $request->name,
            'email'   => strtolower($request->email), // Always save in lowercase
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Identity synchronized successfully!');
    }
}
