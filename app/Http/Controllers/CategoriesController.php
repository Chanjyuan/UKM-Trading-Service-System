<?php

namespace App\Http\Controllers;

use App\Models\Category_model;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {
        if(auth()->user()->user_level != 'admin'){
            return redirect('/')->with('error', 'This action is unauthorized.');
        }

        $categories=Category_model::paginate(5);
        return view('admin.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.  
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required'
        ]);
        Category_model::create($request->all());
        return redirect('/admin/category')->with('success', 'Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->user_level != 'admin'){
            return redirect('/')->with('error', 'This action is unauthorized.');
        }

        $categories = Category_model::find($id);
        return view('admin.category.edit')->with('categories', $categories);
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

        if(auth()->user()->user_level != 'admin'){
            return redirect('/')->with('error', 'This action is unauthorized.');
        }

        $this->validate($request, [
            'name' => 'required',
        ]);
        $categories = Category_model::find($id);
        $categories->name = $request->input('name');
        $categories->save();
        return redirect('/admin/category')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(auth()->user()->user_level != 'admin'){
            return redirect('/')->with('error', 'This action is unauthorized.');
        }
        
        $categories = Category_model::find($id);
        $categories->delete();
        return redirect('/admin/category')->with('error', 'Category Removed');
    }
}
