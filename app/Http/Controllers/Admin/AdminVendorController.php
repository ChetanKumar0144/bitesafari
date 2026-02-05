<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Services\VendorService;
use Illuminate\Support\Facades\Hash;

class AdminVendorController extends Controller
{
    public function __construct(protected VendorService $vendorService){}

    // List all vendors
    public function index()
    {
        $query = Vendor::query();

        // Search by name, email, or phone
        if ($search = request('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%");
            });
        }

        // Filter by status
        if (request()->has('status') && request('status') !== '') {
            $query->where('is_active', request('status'));
        }

        $vendors = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.vendors.index', compact('vendors'));
    }

    // Show create form
    public function create()
    {
        return view('admin.vendors.create');
    }

    // Store new vendor
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:vendors,email',
            'phone'=> 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean'
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['password'] = Hash::make('12345678');
        Vendor::create($data);

        return redirect()->route('admin.vendors.index')->with('success','Vendor created successfully!');
    }

    // Show edit form
    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', compact('vendor'));
    }

    // Update vendor
    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:vendors,email,' . $vendor->id,
            'phone'=> 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean'
        ]);

        $vendor->update($data);

        return redirect()->route('admin.vendors.index')->with('success','Vendor updated successfully!');
    }

    // Delete vendor
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('admin.vendors.index')->with('success','Vendor deleted successfully!');
    }
}
