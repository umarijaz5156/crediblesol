<?php

use App\Models\Currency;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;

if (!function_exists('getMinimumProductPrice')) {
    function getMinimumProductPrice($sellerId)
    {
        $seller = User::find($sellerId);
        if ($seller) {
            $minPrice = Product::where('user_id', $sellerId)->min('price');
            if($minPrice){
                return $minPrice;     
            }else{
                return '50';
            }
        }
        return '';
    }
}

if (!function_exists('getCurrency')) {
    function getCurrency()
    {

        $currencySymbol = env('APP_CURRENCY_SYMBOL', '$');
        return $currencySymbol;

        // $setting = Setting::get();
        // if ($setting) {
        //     $currency = $setting->where('key', 'currency')->whereNotNull('value')->first();
        //     if($currency){
        //         $currency_type = Currency::findOrFail($currency->value);
        //         return $currency_type->symbol;

        //     }else{
        //         return '$';
        //     }
            
        // }else{

        //     return '$';
        // }
    }
}

