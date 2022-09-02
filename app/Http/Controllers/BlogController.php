<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query_type == 'other_user'){
            return Blog::where('user_id', $request->user_id)->with('user')->with('comments')->withCount('likes')->get();
        }else if($request->query_type == 'personal'){
            return Blog::where('user_id', auth()->user()->id)->with('user')->with('comments')->withCount('likes')->get();
        }
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
        $blog = new Blog();
        $blog->fill($request->all());
        $blog->save();
        return response()->json(['msg'=> 'Blog created successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Blog::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        if(auth()->user()->id == $blog->user_id){
            $blog->fill($request->all());
            $blog->save();
            return response()->json(['msg'=> 'Blog updated successfully.']);

        }else{
            return response()->json(['msg'=>'unauthendication'], 401);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if(auth()->user()->id == $blog->user_id){
            $blog->delete();
        }else{
            return response()->json(['msg'=>'unauthendication'], 401);
        }

    }
}
