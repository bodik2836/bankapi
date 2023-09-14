<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return CustomerResource::collection($customers);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'cnp' => 'required|string',
        ]);

        $customer = new Customer($data);

        if ($customer->save()) {
            return new CustomerResource($customer);
        }

        return null;
    }

    public function show(int $customerId)
    {
        $customer = Customer::query()->find($customerId);

        if ($customer) {
            return new CustomerResource($customer);
        }

        return null;
    }

    public function update(Request $request, int $customerId)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'cnp' => 'required|string',
        ]);

        $customer = Customer::query()->find($customerId);

        if ($customer->update($data)) {
            return new CustomerResource($customer);
        }

        return null;
    }

    public function destroy(int $customerId)
    {
        if (Customer::destroy($customerId)) {
            return response()->json(['msg' => 'Item deleted.']);
        }

        return response()->json(['msg' => 'Item not deleted.']);
    }
}
