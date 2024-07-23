<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewAttachment extends Model
{
    use HasFactory;

    protected $table = 'review_attachments';

    protected $fillable = [
        'review_id',
        'file_path',
        'file_type',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
