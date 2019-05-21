<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallerys=gallery::all(); //model, like select * from categorys , from model
        return view('back.gallerys.index', compact('gallerys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.gallerys.create');
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
            'gtype'=>'required',
            'name'=> 'required|string',
            'description' => 'required',
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

          $gallerys = new gallery([
            'gtype' => $request->get('gtype'),
            'name' => $request->get('name'),
            'description'=> $request->get('description'),
            'image'=>$fileNameToStore,
            'status'=> $request->get('status')
          ]);
          $gallerys->save();
          return redirect('/gallerys')->with('success', 'Gallery has been added');
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
        $gallerys = gallery::find($id);

        return view('back.gallerys.edit', compact('gallerys'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        {
            $request->validate([
              'gtype'=>'required',
              'name'=> 'required|string',
              'description'=> 'required|string',

              'files' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'status' => 'required|boolean'
            ]);
      
            $gallerys = gallery::find($id);
            $gallerys->gtype = $request->get('gtype');
            $gallerys->title = $request->get('title');
            $gallerys->description = $request->get('description');
            $gallerys->image =$request->get('files');
            $gallerys->status = $request->get('status');

            $gallerys->save();
      
            return redirect('/gallerys')->with('success', 'Gallery has been updated');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
{
     $gallerys = gallery::find($id);
     $gallerys->delete();

     return redirect('/gallerys')->with('success', 'Gallery has been deleted Successfully');
}
}
