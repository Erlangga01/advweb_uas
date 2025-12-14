<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['customer_name', 'transaction_date', 'total_amount'];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
