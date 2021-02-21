<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Auth;
use DB;

class ProfilesController extends Controller
{
    //
    //     public function profile(User $user)
    // {
    //     // $user = User::findOrFail($user);
    //  // return view('profile', compact('user'));
    //     return view('profile', array('user' => Auth::user()));
    // }

        public function profile(User $user) {
            //'profile' = profile.blade.php
            $rating = DB::table('ratings')
                      ->join('comments','comments.id','=','ratings.id')
                      ->where('commentable_id','=',$user->id)
                      ->avg(('rating'), 2);

            return view('profile', compact('user'))->with('rating', $rating);
        }

        public function edit(User $user)
    {
        if(auth()->user()->id != $user->profile->user_id){
            return redirect('/')->with('error', 'This action is unauthorized.');
        }

        return view('edit', compact('user'));
    }
        public function update(User $user, Request $request)
    {
        if(auth()->user()->id != $user->profile->user_id){
            return redirect('/')->with('error', 'This action is unauthorized.');
        }

        $data = request()->validate([
            'fname'=>'required',
            'lname'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'image'=>'',
        ]);
        // if (request('image')){
        //     $imagePath = request('image')->store('profile','public');

        //     $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
        //     $image->save();
        // }
        // auth()->user()->update(array_merge(
        //     $data,
        //     ['image' => $imagePath]));

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->fit(1000, 1000)->save( public_path('/storage/uploads/' . $filename));

            $user = Auth::user();
            $user->image = $filename;
            $user->save();
    }
        auth()->user()->update($data);
        return redirect("/profile/{$user->id}")->with('success', 'Your details have updated successfully. ');;
    }

    //Admin Manage Account

        public function __construct()
        {
            $this->middleware('auth', ['except'=>['profile','review']]);
            
        }

        public function index()
        {
        if(auth()->user()->user_level != 'admin'){
            return redirect('/')->with('error', 'This action is unauthorized.');
        }
        $profiles=User::where('user_level','=','user')->paginate(10);
        return view('admin.profile.index')->with('profiles', $profiles);
        }

        public function destroy($id) {
            if(auth()->user()->user_level != 'admin'){
                return redirect('/')->with('error', 'This action is unauthorized.');
        }
            $profiles = User::find($id);
            $profiles->delete();
            return redirect('/accounts')->with('success', 'Account has successfully removed.');       
        }

    //     public function adminedit($id) {
    //         if(auth()->user()->user_level != 'admin'){
    //             return redirect('/')->with('error', 'This action is unauthorized.');
    //     }
    //         $profiles = User::find($id);
    //         return view('admin.profile.edit')->with('profiles', $profiles);
    //     }

    //     public function adminupdate(Request $request, $id)
    //     {

    //         if(auth()->user()->user_level != 'admin'){
    //             return redirect('/')->with('error', 'This action is unauthorized.');
    //     }

    //         $this->validate($request, [
    //             'fname'=>'required',
    //             'lname'=>'required',
    //             'phone'=>'required',
    //             'gender'=>'required',
    //     ]);

    //         $profiles = User::find($id);
    //         $profiles->fname = $request->input('fname');
    //         $profiles->lname = $request->input('lname');
    //         $profiles->phone = $request->input('phone');
    //         $profiles->gender = $request->input('gender');
    //         $profiles->save();
    //         return redirect('/accounts')->with('success', 'Profile Updated');
    // }

    public function review(User $user) {

        $rating = DB::table('ratings')
                  ->join('comments','comments.id','=','ratings.id')
                  ->where('commentable_id','=',$user->id)
                  ->avg(('rating'), 2);

        return view('review', compact('user'))->with('rating', $rating);
    }
}
