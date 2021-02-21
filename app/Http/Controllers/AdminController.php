<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Offer;
use App\Models\Category_model;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index(Request $request) {
        if(auth()->user()->user_level != 'admin'){
            return redirect('/')->with('error', 'This action is unauthorized.');
        }
        $userCount = User::where('user_level','=','user')->count();
        $productCount = Post::where('category', '!=', '4')->count();
        $serviceCount = Post::where('category', '=', '4')->count();
        $categoryCount = Category_model::count();


        //Monthly Post
        $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];

        $post2 = [];
        foreach ($month as $key => $value) {
            $post2[] = Post::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->where('created_at','LIKE',"2020%")->count();
        }
        $post3 = [];
        foreach ($month as $key => $value) {
            $post3[] = Post::where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->where('created_at','LIKE',"2021%")->count();
        }

        //Monthly User
        $month2 = ['01','02','03','04','05','06','07','08','09','10','11','12'];

        $post4 = [];
        foreach ($month2 as $key => $value) {
            $post4[] = User::where('user_level','=','user')->where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->where('created_at','LIKE',"2020%")->count();
        }
        $post5 = [];
        foreach ($month2 as $key => $value) {
            $post5[] = User::where('user_level','=','user')->where(\DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->where('created_at','LIKE',"2021%")->count();
        }

        //Top Categories
        $cat = Category_model::all();
        $catname = $cat->pluck('name');
        $cat1 = Post::where('category', '=', '1')->count();
        $cat2 = Post::where('category', '=', '2')->count();
        $cat3 = Post::where('category', '=', '3')->count();
        $cat4 = Post::where('category', '=', '4')->count();
        $cat5 = Post::where('category', '=', '5')->count();

        //Gender
        $gen1 = User::where('user_level','=','user')->where('gender', '=', 'Male')->count();
        $gen2 = User::where('user_level','=','user')->where('gender', '=', 'Female')->count();

        //Post Status
        $sta1 = Post::where('status', '=', 'Available')->count();
        $sta2 = Post::where('status', '=', 'Pending')->count();
        $sta3 = Post::where('status', '=', 'Traded')->count();
        $sta4 = Post::where('status', '=', 'Sold')->count();

        //Trending product/service
        $offers = DB::table('posts')
                ->leftJoin('offers','offers.post_id','=','posts.id')
                ->select('posts.id AS id', 'posts.title AS title', DB::raw("count(offers.post_id) AS total_offers"))
                ->groupBy('posts.id', 'posts.title')
                ->orderBy('total_offers','desc')
                ->take(3)
                ->get();


        // $users = User::select(\DB::raw("COUNT(*) as count"))
        //             ->whereYear('created_at', date('Y'))
        //             ->groupBy(\DB::raw("Month(created_at)"))
        //             ->pluck('count');


        return view('admin.index', compact('offers', 'gen1', 'gen2', 'sta1', 'sta2', 'sta3', 'sta4', 'cat', 'catname', 'cat1', 'cat2', 'cat3', 'cat4', 'cat5', 'userCount', 'productCount', 'serviceCount', 'categoryCount'))->with('month',json_encode($month,JSON_NUMERIC_CHECK))->with('post2',json_encode($post2,JSON_NUMERIC_CHECK))->with('post3',json_encode($post3,JSON_NUMERIC_CHECK))->with('month2',json_encode($month2,JSON_NUMERIC_CHECK))->with('post4',json_encode($post4,JSON_NUMERIC_CHECK))->with('post5',json_encode($post5,JSON_NUMERIC_CHECK));
    }
}
