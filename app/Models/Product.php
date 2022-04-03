<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function canUpdateAmount($amount)
    {
        return ($this->amount += $amount) >= 0;
    }
}
