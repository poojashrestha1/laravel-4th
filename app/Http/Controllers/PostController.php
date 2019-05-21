<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\category;
use App\post;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             //$posts=Post::all();
             $posts=post::join('categorys','categorys.id','=','posts.category_id')
             ->select(['posts.id','posts.title','posts.heading','posts.shortstory'
             ,'posts.fullstory','posts.status','posts.description','categorys.name','posts.updated_at'])
             ->orderby('posts.updated_at','desc')->get();
              return view('back.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats=category::all();
        // dd($cats);
         return view('back.posts.create', compact('cats'));
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
          'title'=>'required',
          'description'=> 'required|string',
          'heading'=> 'required|string',
          'shortstory'=> 'required|string',
          'fullstory'=> 'required|string',
          'category_id'=>'required' ,
          'user_id'=>'nullable',
          'files' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'status' => 'required|boolean'
        ]);
            //Handle file upload
            if ($request->hasFile('files')) {
                // Get jst ext
                $extension = $request->file('files')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = time() . '.' . $extension;
                //uplod image
                $file = $request->file('files');
                $destinationPath = public_path('/uploads');
                $file->move($destinationPath, $fileNameToStore);
            } else {
                return redirect()->back()->withInput($request->input())->with('error', 'File Not Selected');
            }
        $posts= new post([
            'title'=>$request->get('title'), //right side is table data name and left side is form name
            'description'=>$request->get('description'),
            'heading'=>$request->get('heading'),
            'shortstory'=>$request->get('shortstory'),
            'fullstory'=>$request->get('fullstory'),
            'category_id'=>$request->get('category_id'),
            //'user_id' => Auth::user()->id,
            'status'=>$request->get('status'),
            'fimage'=>$fileNameToStore
            
        ]);
        $posts->save();
        return redirect('/posts')->with('success', 'Post has been added');
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
        $posts = post::find($id);

        return view('back.posts.edit', compact('posts'));
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
        $posts = post::find($id);
        $posts->title = $request->get('title');
        $posts->keyword = $request->get('keyword');
        $posts->description =  $request->get('description');
        $posts->heading = $request->get('heading');
        $posts->shortstory =$request->get('shortstory') ;
        $posts->fullstory =$request->get('fullstory') ;
        $posts->fimage =$request->get('fimage');
        $posts->category_id =$request->get('category_id') ;
        $posts->user_id =$request->get('user_id') ;
        $posts->status = $request->get('status');
        $posts->save();

        return redirect('/posts')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

{
     $posts = post::find($id);
     $posts->delete();

     return redirect('/posts')->with('success', 'Post has been deleted Successfully');
}
    
}
