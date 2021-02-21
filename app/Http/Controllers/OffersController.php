<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewOfferAdded;
use App\Notifications\OfferApproved;
use App\Notifications\OfferRejected;
use DB;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $offers = Post::find($post_id)->offers;
        $offerby = User::all();
        // $offer = DB::select('SELECT * FROM offers WHERE post_id LIKE '.$post_id);
        return view('offers.index')->with('offers', $offers)->with('offerby', $offerby);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id)
    {
        return view('offers.create', compact('post_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($post_id, Request $request)
    {
        $this->validate($request, [
            'offer' => 'required'
        ]);

        // Create Offer
        $offer = new Offer;
        $offer->price = $request->input('offer');
        $offer->user_id = auth()->user()->id;
        $offer->post_id = $post_id;
        $offer->save();

        $post = Post::find($post_id);
        $post->status = "Pending";
        $post->save();
        $post->user->notify(new NewOfferAdded($post, $offer));

        return redirect('/')->with('success', 'Offer is sent to post owner.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($post_id, Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $id)
    {
        $offer = Offer::find($id);

        $offer->delete();
        return redirect()->back()->with('success', 'Offer is removed.');
    }

    public function myOffers($user_id)
    {
        $offers = Offer::where('user_id', $user_id)->get();
        return view('offers.offers')->with('offers', $offers)->with('user_id', $user_id);
    }

    public function receivedOffers($user_id)
    {
        $posts = Post::where('user_id', $user_id)->paginate(9);
        $offerby = User::all();
        return view('offers.receive')->with('posts', $posts)->with('user_id', $user_id)->with('offerby', $offerby);
    }

    public function approveOffer($id)
    {
        $offer = Offer::find($id);
        $offer->user->notify(new OfferApproved($offer));
        $offer->status = "Approved";
        $offer->save();

        return redirect()->back()->with('success', "Offer is approved.");
    }

    public function rejectOffer($id)
    {
        $offer = Offer::find($id);
        $offer->status = "Rejected";
        $offer->user->notify(new OfferRejected($offer));
        $offer->save();

        return redirect()->back()->with('success', "Offer is rejected.");
    }
}