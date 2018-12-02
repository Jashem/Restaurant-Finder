<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Photo;
use Illuminate\Support\Facades\Gate;
use Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::allows('admin-options')) {
            $restaurants = Restaurant::all();
            return view('admin.restaurants.index',compact('restaurants'));
        } else{
            return view('welcome');
        }

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if (Gate::allows('admin-options')) {
            return view('admin.restaurants.create');
        } else{
            return view('welcome');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validatedData = $request->validate([
            'name' => 'required|',
            'address' => 'required',
            'contact' => 'required|numeric',
            'photo_id' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();
        $name = time() . $request->photo_id->getClientOriginalName();
        $request->file('photo_id')->move(public_path('images'), $name);
        $photo = Photo::create(['path'=>$name]);
        $input['photo_id'] = $photo->id;
        $input['user_id'] = Auth::user()->id;
        Restaurant::create($input);
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
