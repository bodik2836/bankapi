<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'cnp'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
