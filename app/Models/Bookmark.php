<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id', 'listing_id'
    ];

    public function bookmark(){
        return $this->belongsTo(Listing::class, User::class);
    }


}
