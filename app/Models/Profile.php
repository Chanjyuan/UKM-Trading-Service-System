<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Profile extends Model
{
	protected $guarded = [];

    use HasFactory, Commentable;

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
