<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'transaction_id';
    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];
}
