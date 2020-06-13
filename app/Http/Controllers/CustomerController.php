<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{

    function customer(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->cnp = $request->input('cnp');

        if ($customer->save()) {
            return response()->json(['customer_id' => $customer->customer_id]);
        }

        return null;
    }
}
