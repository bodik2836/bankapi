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

    function show(int $customerId, int $transactionId) {
        $transaction = Transaction::where([
            'id' => $transactionId,
            'customer_id' => $customerId
        ])->first();

        if ($transaction) {
            return new TransactionResource($transaction);
        }

        return null;
    }

    function update(Request $request, Transaction $transaction) {
        $data = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $isUpdated = $transaction->update($data);

        if ($isUpdated) {
            return new TransactionResource($transaction);
        }

        return null;
    }

    function destroy(int $transactionId) {
        $transaction = Transaction::query()->find($transactionId);

        if (!$transaction) {
            return response()->json(['msg' => 'Item not found.']);
        }

        if (Transaction::destroy($transactionId)) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'fail']);
        }
    }

    function filterTransaction(int $customerId, float $amount, string $date, int $offset, int $limit) {
        $transactions = Transaction::where([
           'customer_id' => $customerId,
           'amount' => $amount,
           'created_at' => $date
        ])->offset($offset)->limit($limit)->get();

        if ($transactions) {
            return TransactionResource::collection($transactions);
        }

        return null;
    }

}
