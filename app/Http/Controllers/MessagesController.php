<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\ReplyMessage;
use App\Models\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query_type == 'messages'){
            $messages = Messages::where('from_id', auth()->user()->id)->where('to_id', $request->user_id)
                            ->orWhere('from_id', $request->user_id)->where('to_id', auth()->user()->id)
                            ->orderBy('id', 'DESC')->with('replied')->take($request->page * 20)->get();
            foreach($messages as $msg){
                $msg->status = '0';
                $msg->save();
            }

            return $messages;
        }else if($request->query_type == 'user_list'){
            $fromIds = Messages::where('to_id', auth()->user()->id)->pluck('from_id');
            $toIds = Messages::where('from_id', auth()->user()->id)->pluck('to_id');
            return User::whereIn('id', $fromIds)->orWhereIn('id', $toIds)->get();
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
        $messages = new Messages();
        $messages->from_id = auth()->user()->id;
        $messages->to_id = $request->to_id;
        $messages->messages = $request->messages;
        $messages->save();
        if($request->replied_id != ''){
            $reply = new ReplyMessage();
            $reply->replied_id = $request->replied_id;
            $reply->message_id = $messages->id;
            $reply->save();
        }

        return response()->json(['msg'=> 'Messages created successfully.']);
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
