<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'review',
        'rating',
        'product_id',
        'is_approved',
        'order_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attachments()
    {
        return $this->hasMany(ReviewAttachment::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function generateStarRating()
    {
        $rating = $this->rating ?? 0;
        $fullStars = floor($rating);
        $remainder = $rating - $fullStars;
     

            //     $whiteStar = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
            //     viewBox="0 0 14 14" fill="none">
            //     <path
            //         d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
            //         fill="white"></path>
            // </svg>';
            $whiteStar = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14" fill="#D1D5DB">
                <path d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z" fill="#D1D5DB"></path>
            </svg>';

                $orangeStar = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                viewBox="0 0 14 14" fill="none">
                <path
                    d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                    fill="orange"></path>
            </svg>';

                $halfStar = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14" fill="none">
            <defs>
                <linearGradient id="orangeGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="50%" style="stop-color: orange; stop-opacity: 1" />
                    <stop offset="50%" style="stop-color: #D1D5DB; stop-opacity: 1" />
                </linearGradient>
            </defs>
            <path d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z" fill="url(#orangeGradient)"></path>
        </svg>';

        $stars = str_repeat($orangeStar, $fullStars);
        if ($rating > 0) {
            if ($remainder > 0 && $remainder <= 0.2) {
                $stars .= $whiteStar;
            } elseif ($remainder > 0.2 && $remainder <= 0.8) {
                $stars .= $halfStar;
            } else if ($remainder >= 0.8) {
                $stars .= $orangeStar;
            }

            if ($fullStars < 5)
                $stars .= str_repeat($whiteStar, 5 - $fullStars - 1);
        } else {
            $stars = str_repeat($whiteStar, 5);
        }
        


        return $stars;
    }

}
