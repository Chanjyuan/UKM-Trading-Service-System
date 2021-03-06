<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Session;
use Auth;

class Cart extends Model
{
    use HasFactory;

    public static function userCartItems() {
    	if(Auth::check()) {
    		$userCartItems = Cart::with(['product'=>function($query){
    			$query->select('id', 'title', 'type', 'price', 'cover_image');
    		}])->where('user_id',Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();
    	}
    	else {
    		$userCartItems = Cart::with(['product'=>function($query){
    			$query->select('id', 'title', 'type', 'price', 'cover_image');
    		}])->where('session_id',Session::get('session_id'))->orderBy('id', 'Desc')->get()->toArray();
    	}
    	return $userCartItems;	
    }

    public function product() {
    	return $this->belongsTo('App\Models\Post', 'product_id');
    }
}