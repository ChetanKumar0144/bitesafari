<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('phone', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();
        return view('admin.users.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $customer->load('addresses', 'orders');

        return view('admin.users.show', compact('customer'));
    }

    public function toggleStatus(Customer $customer)
    {
        $customer->update([
            'is_blocked' => ! $customer->is_blocked
        ]);

        return back()->with('success', 'Customer status updated');
    }

    public function export()
    {
        $fileName = 'customers.csv';
        $customers = Customer::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () use ($customers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Phone', 'Email', 'Status']);

            foreach ($customers as $c) {
                fputcsv($file, [
                    $c->id,
                    $c->name,
                    $c->phone,
                    $c->email,
                    $c->is_blocked ? 'Blocked' : 'Active'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
