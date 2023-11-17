<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\TransactionResource;
use App\Models\Customer;
use App\Models\Transaction;

class TransactionController extends Controller
{
    function show(int $customerId, int $transactionId) {
        $filters = [
            'id' => $transactionId,
            'customer_id' => $customerId
        ];

        $transaction = Transaction::query()->where($filters)->first();

        if ($transaction) {
            return new TransactionResource($transaction);
        }

        return response()->json(['status' => 'fail', 'message' => 'Item not found.'], 404);
    }

    function store(int $customerId, float $amount)
    {
        $customer = Customer::query()->find($customerId);

        $transaction = new Transaction(['amount' => $amount]);
        $transaction->customer()->associate($customer);

        if ($customer && $transaction->save()) {
            return new TransactionResource($transaction);
        }

        return response()->json(['status' => 'fail', 'message' => 'Item not saved.']);
    }

    function update(int $transactionId, float $amount)
    {
        $transaction = Transaction::query()->find($transactionId);

        if ($transaction && $transaction->update(['amount' => $amount])) {
            return new TransactionResource($transaction);
        }

        return response()->json(['status' => 'fail', 'message' => 'Item not found.'], 404);
    }

    function destroy(int $transactionId)
    {
        if (Transaction::destroy($transactionId)) {
            return response()->json(['status' => 'success', 'message' => 'Item deleted.']);
        }

        return response()->json(['status' => 'fail', 'message' => 'Item not deleted.'], 404);
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
