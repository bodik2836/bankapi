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

        return response()->json(['status' => 'fail', 'message' => 'Item not saved.']);
    }

    public function show(int $customerId)
    {
        $customer = Customer::query()->find($customerId);

        if ($customer) {
            return new CustomerResource($customer);
        }

        return response()->json(['status' => 'fail', 'message' => 'Item not found.'], 404);
    }

    public function update(Request $request, int $customerId)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'cnp' => 'required|string',
        ]);

        $customer = Customer::query()->find($customerId);

        if ($customer && $customer->update($data)) {
            return new CustomerResource($customer);
        }

        return response()->json(['status' => 'fail', 'message' => 'Item not found.'], 404);
    }

    public function destroy(int $customerId)
    {
        if (Customer::destroy($customerId)) {
            return response()->json(['status' => 'success', 'message' => 'Item deleted.']);
        }

        return response()->json(['status' => 'fail', 'message' => 'Item not deleted.'], 404);
    }
}
