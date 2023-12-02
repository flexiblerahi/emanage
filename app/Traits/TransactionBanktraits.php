<?php

namespace App\Traits;

use App\Models\BankTransaction;
use Carbon\Carbon;

trait TransactionBanktraits
{
    public function bank_transaction()
    {
        return $this->morphOne(BankTransaction::class, 'model');
    }

    public function transaction()
    {
        return $this->morphOne(Transaction::class, 'model');
    }

    
}