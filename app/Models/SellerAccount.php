<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'username',
        'description',
        'phone_number',
        'country_id',
        'city',
        'address',
        'business_image',
        'businessName',
        'is_approved',
        'individual_or_business',
        'orange_money_idType',
        'orange_money_id',
        'orange_money_enable'
    ];


    public function getMinimumProductPrice()
    {
        $seller = SellerAccount::find($this->id);
        if ($seller) {
            $minPrice = Product::where('seller_account_id', $this->id)->min('price');
            if($minPrice){
                return $minPrice;     
            }else{
                return '50';
            }
        }
        return '30';
        }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
