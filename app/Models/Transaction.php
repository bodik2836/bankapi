<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['amount', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        return $query->when(
            $filters['customer_id'],
            fn ($query, $value) => $query->where('customer_id', $value)
        )->when(
            $filters['amount'],
            fn ($query, $value) => $query->where('amount', $value)
        )->when(
            $filters['offset'],
            fn ($query, $value) => $query->offset($value)
        )->when(
            $filters['limit'],
            fn ($query, $value) => $query->limit($value)
        );
    }
}
