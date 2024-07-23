<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function seller()
    {
        return $this->belongsTo(SellerAccount::class,'seller_account_id');
    }
    

}
