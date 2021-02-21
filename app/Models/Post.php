<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

     // Table Name
     protected $table = 'posts';
     // Primary Key
     public $primaryKey = 'id';
     // Timestamps
     public $timestamps = true;

     public function user(){
     	return $this->belongsTo(User::class);
     }

     public function offers(){
        return $this->hasMany(Offer::class);
    }

}
