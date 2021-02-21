<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //no need to login for Home Controller
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $products=Post::orderBy('id', 'DESC')->Paginate(6);
        return view('home')->with('products', $products);
    }

    public function catalog() {
        $products=Post::orderBy('id', 'DESC')->Paginate(9);
        return view('posts.catalog')->with('products', $products);
    }

    public function showCates($id) {
        $category_products=Post::where('category', $id)->orderBy('id', 'DESC')->Paginate(9);
        $id_ = $id;
        return view('posts.category_list_pro',compact('category_products'))->with('id_', $id_);
    }

    public function search(){
        $search = request()->query('search');
        $products = Post::where('title','LIKE',"%{$search}%")->orWhere('type', 'LIKE', "%{$search}%")->orderBy('id', 'DESC')->paginate(9);
        return view('posts.search')->with('products', $products);
    }
}
