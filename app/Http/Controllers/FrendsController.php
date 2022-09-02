<?php

namespace App\Http\Controllers;

use App\Models\Frends;
use Illuminate\Http\Request;

class FrendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Frends::where('user_id', auth()->user()->id)->with('friend')->get();
    }

    // check friends user

    public function checkFriendUser(Request $request){
        $friend = Frends::where('user_id', auth()->user()->id)->where('friend_id', $request->friend_id)->where('status', '1')->first();
        if($friend && $friend != ''){
            return 1;
        }

        $firend_waiting = Frends::where('user_id', auth()->user()->id)->where('friend_id', $request->friend_id)->where('status', '0')->first();
        if($firend_waiting && $firend_waiting != ''){
            return 2;
        }else{
            return 0;
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
        if($request->type == 'send'){
            $friend = new Frends();
            $friend->friend_id = $request->friend_id;
            $friend->user_id = auth()->user()->id;
            $friend->save();
            return response()->json(['msg'=> 'Request send successfully.']);
        }else if($request->type == 'unsend'){
            $friend = Frends::where('user_id', auth()->user()->id)->where('friend_id', $request->friend_id)->first();
            $friend->delete();
            return response()->json(['msg'=> 'Request unsend successfully.']);
        }else if($request->type == 'accept'){
            $friend = Frends::where('user_id', $request->user_id)->where('friend_id', auth()->user()->id)->first();
            $friend->status = '1';
            $friend->save();
            return response()->json(['msg'=> 'Request accept successfully.']);
        }else if($request->type == 'reject'){
            $friend = Frends::where('user_id', $request->user_id)->where('friend_id', auth()->user()->id)->first();
            $friend->delete();
            return response()->json(['msg'=> 'Request reject successfully.']);
        }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
