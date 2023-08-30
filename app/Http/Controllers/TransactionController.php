<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    function store(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'customer_id' => 'required|int',
        ]);

        $transaction = new Transaction($data);

        if ($transaction->save()) {
            return new TransactionResource($transaction);
        }

        return null;
    }

    function getTransaction(int $customer_id, int $transaction_id) {
        $transaction = Transaction::where([
            'transaction_id' => $transaction_id,
            'customer_id_id' => $customer_id
            ])->first();
        //$transaction = Transaction::find($transaction_id)->where('customer_id_id', $customer_id);
        if ($transaction) {
            return response()->json([
                'transaction_id' => $transaction->transaction_id,
                'amount' => (float) $transaction->amount,
                'date' => $transaction->date->format('d.m.Y')
            ]);
        }

        return null;
    }

    function updateTransaction(int $transaction_id, int $amount) {

        Transaction::where('transaction_id', $transaction_id)->update(['amount' => $amount]);
        $transaction = Transaction::find($transaction_id);
        if ($transaction) {
            return response()->json([
                'transaction_id' => $transaction->transaction_id,
                'customer_id_id' => $transaction->customer_id_id,
                'amount' => (float) $transaction->amount,
                'date' => $transaction->date->format('d.m.Y')
            ]);
        }

       return null;
    }

    function deleteTransaction(int $transaction_id) {
        $transaction = Transaction::where('transaction_id', $transaction_id)->delete();

        if ($transaction) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'fail']);
        }
    }

    function filterTransaction(int $customer_id_id, float $amount, string $date, int $offset, int $limit) {
        $transaction = Transaction::where([
           'customer_id_id' => $customer_id_id,
           'amount' => $amount,
           'date' => $date
        ])->offset($offset)->limit($limit)->get();

        $data = [];
        foreach ($transaction as $value) {
            $data[] = [
                "transaction_id" => $value->transaction_id,
                "amount" => (float) $value->amount,
                "date" => $value->date->format('d.m.Y'),
                "customer_id" => $value->customer_id_id
            ];
        }

        if ($data) {
            return response()->json($data);
        }

        return null;
    }

}
