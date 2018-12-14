<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;
use App\Restaurant;

class CommentController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        if(Auth::check()){
            $restaurant = Restaurant::findOrFail($id);
            return view('comments.create', compact('restaurant'));
        }
        return redirect()->back()->with("warning","You need to be logged in to do that");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'body' => 'required|',
        ]);
        $input = $request->all();
        $input['user_id'] = Auth::id();

        Comment::create($input);
        return redirect()->route('show', $request->restaurant_id);
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
        $comment = Comment::findOrFail($id);
        if(Auth::id() == $comment->user_id){
            return view('comments.edit', compact('comment'));
        }
        return redirect()->back()->with("warning","You need to be logged in to do that");
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
        $validatedData = $request->validate([
            'body' => 'required|',
        ]);
        $comment = Comment::findOrFail($id);
        $input = $request->all();

        $comment->update($input);
        return redirect()->route('show', $comment->restaurant_id);
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
        Comment::destroy($id);
        return redirect()->back();
    }
}
