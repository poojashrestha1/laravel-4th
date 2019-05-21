<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats=category::all(); //model, like select * from categorys , from model
        return view('back.categorys.index', compact('cats')); //migration, to view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.categorys.create'); //migration, to view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=> 'required|string',
            'status' => 'required'
          ]);
          $cats = new category([
            'name' => $request->get('name'),
            'description'=> $request->get('description'),
            'status'=> $request->get('status')
          ]);
          $cats->save();
          return redirect('/cats')->with('success', 'Category has been added');
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
        $cats = category::find($id);

        return view('back.categorys.edit', compact('cats'));
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
          $request->validate([
            'name'=>'required',
            'description'=> 'required|string',
            'status' => 'required|string'
          ]);
    
          $item = category::find($id);
          $item->name = $request->get('name');
          $item->description = $request->get('description');
          $item->status = $request->get('status');
          $item->save();
    
          return redirect('/cats')->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
     $item = category::find($id);
     $item->delete();

     return redirect('/cats')->with('success', 'Category has been deleted Successfully');
}
}
