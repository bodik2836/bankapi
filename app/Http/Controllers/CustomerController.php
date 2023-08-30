<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
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
}
