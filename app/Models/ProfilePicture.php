<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'url',
        'is_primary'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }    
}
