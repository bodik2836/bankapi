<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{

    function customer(string $name, string $cnp)
    {
        $customer = new Customer();
        $customer->name = $name;
        $customer->cnp = $cnp;

        if ($customer->save()) {
            return response()->json(['customer_id' => $customer->customer_id]);
        }

        return null;
    }
}
