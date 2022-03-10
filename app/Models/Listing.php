<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id', 'location', 'price', 'description', 'type', 'rooms', 'furnished', 'bathrooms'
    ];


    public function listing(){
        return
            $this->belongsTo(User::class);

    }
}
