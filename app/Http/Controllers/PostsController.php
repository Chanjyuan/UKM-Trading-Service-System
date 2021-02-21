<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Offer;
use App\Models\Category_model;
use App\Models\Cart;
use Session;
use Auth;
use View;
use DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['catalog','show','filter']]);   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->user_level != 'admin'){
            return redirect('/')->with('error', 'This action is unauthorized.');
        }
        $posts = Post::orderBy('created_at','asc')->paginate(9);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category_model::pluck('name', 'id');
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image'))
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $request->file('cover_image')->move(public_path('storage/post_images'), $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->type = $request->input('type');
        $post->category = $request->input('category');
        $post->price = $request->input('price');
        $post->description = $request->input('description');
        $post->cover_image = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $offers = Offer::where('post_id', $id)->where('status', 'Approved')->get();
        return view('posts.show')->with('post', $post)->with('offers', $offers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories=Category_model::pluck('name', 'id');
        $post = Post::find($id);

        //Check for correct user / admin
        if(auth()->user()->id == $post->user_id || auth()->user()->user_level == 'admin'){
            return view('posts.edit',compact('categories'))->with('post', $post);
        }
        else{
            return redirect('/posts')->with('error', 'This action is unauthorized.');
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image'))
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $request->file('cover_image')->move(public_path('storage/post_images'), $fileNameToStore);
        }

        // Update Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->type = $request->input('type');
        $post->category = $request->input('category');
        $post->price = $request->input('price');
        $post->description = $request->input('description');
        if($request->hasFile('cover_image'))
        {
            if ($post->cover_image != 'noimage.jpg') {
                Storage::delete('public/post_images/'.$post->cover_image);
            }
            $post->cover_image = $fileNameToStore;
        }
        $post->status = $request->input('status');
        $post->save();

        return redirect('/')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //Check for correct user / admin
        if(auth()->user()->id == $post->user_id || auth()->user()->user_level == 'admin'){

        if ($post->cover_image != 'noimage.jpg') {
            Storage::delete('public/post_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/')->with('success', 'Post Removed');
        }

        else{
            return redirect('/')->with('error', 'This action is unauthorized.');
        }
    }

    public function addtocart(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            //Generate session Id if not exists
            $session_id = Session::get('session_id');
            if(empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }
            $cart = new Cart;
            //Check product if already exists in User Cart
            if(Auth::check()) {
                //User is logged in
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'user_id'=>Auth::user()->id])->count();
                $cart->user_id = auth()->user()->id;
            }
            else {
                //User is not logged in
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'session_id'=>Session::get('session_id')])->count();
            }
            
            if ($countProducts>0) {
                $message = "Item already added in Wishlist!";
                Session::flash('error_message', $message);
                return redirect()->back();
            } 

            //Save product in cart
            // Cart::insert(['session_id'=>$session_id, 'product_id'=>$data['product_id']]);
            $cart->session_id = $session_id;
            $cart->product_id = $data['product_id'];
            $cart->save();

            $message = "Item has been added in Wishlist!";
            Session::flash('success_message', $message);
            return redirect()->back();
        }
    }

    public function cart(){
        $userCartItems = Cart::userCartItems();
        //echo "<pre>"; print_r($userCartItems); die;
        return view('posts.cart')->with(compact('userCartItems'));
    }

    public function deleteCartItem(Request $request) {
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            Cart::where('id', $data['cartid'])->delete();
            $userCartItems = Cart::userCartItems();
            return response()->json([
                'view'=>(String)View::make('posts.cart_items')->with(compact('userCartItems'))
            ]);
        }
    }

    // public function filter(Request $request){
    //     $categories = DB::table('categories')->select('name')->distinct()->get()->pluck('name')->sort();
    //     $type = DB::table('posts')->select('type')->distinct()->get()->pluck('type')->sort();

    //     $post = POST::query();

    //     if($request->filled('name')){
    //         $post->where('name', $request->name);
    //     }
    //     if($request->filled('type')){
    //         $post->where('type', $request->type);
    //     }
    //     return view ('posts.catalog', [
    //         'categories' -> $categories,
    //         'type' -> $type,
    //         'posts' -> $post->get(),
    //     ]);

    // }

}
