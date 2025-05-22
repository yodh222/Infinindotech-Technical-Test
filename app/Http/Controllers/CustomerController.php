<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search  = $request->get('query');
        $perPage = (int) $request->get('size', 10);

        $query = Customer::query();

        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('no_telp', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%");
        }

        $customers = $query
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'size'   => $perPage,
            ]);

        return view('pages.customer', compact('customers', 'search', 'perPage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $data = $request->validated();

        $customer = Customer::create($data);

        return redirect()
            ->route('customers.index')
            ->with('success', "Customer “{$customer->nama}” berhasil ditambahkan.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $validated = $request->validated();

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id);
        return redirect()->back()->with('success', 'Customer berhasil dihapus.');
    }
}
