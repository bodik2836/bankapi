<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    function customer(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->cnp = $request->input('cnp');

        if ($customer->save()) {
            return response()->json(['customer_id' => $customer->id]);
        }

        return null;
    }
}
