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
     * 
     *
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (Gate::allows('admin-options')) {
            $restaurants = Restaurant::all();
            return view('admin.restaurants.index',compact('restaurants'));
        } else{
            return redirect()->route("home")->with("warning","You need to be admin to do that");
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
            return redirect()->route("home")->with("warning","You need to be admin to do that");
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
            'contact' => 'required|digits:11',
            'photo_id' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();
        $name = time() . $request->photo_id->getClientOriginalName();
        $request->file('photo_id')->move(public_path('images'), $name);
        $photo = Photo::create(['path'=>$name]);
        $input['photo_id'] = $photo->id;
        $input['user_id'] = Auth::user()->id;
        Restaurant::create($input);

        return redirect('admin/restaurants')->with('success','Restaurant added successfully');

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


        if (Gate::allows('admin-options')) {
            $restaurant = Restaurant::findOrFail($id);
            return view('admin.restaurants.edit', compact('restaurant'));
        } else{
            return redirect()->route("home")->with("warning","You need to be admin to do that");
        }
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
            'name' => 'required|',
            'address' => 'required',
            'contact' => 'required|digits:11',
            'photo_id' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $restaurant = Restaurant::findOrFail($id);
        $input = $request->all();
        
        if($request->hasFile('photo_id')){
            $name = time() . $request->photo_id->getClientOriginalName();
            $request->file('photo_id')->move(public_path('images'), $name);
            unlink($restaurant->photo->path);
            Photo::destroy($restaurant->photo_id);
            $photo = Photo::create(['path'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $input['user_id'] = Auth::user()->id;
        $restaurant->update($input);

        return redirect('admin/restaurants')->with('success','Restaurant updated successfully');
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
        $restaurant = Restaurant::findOrFail($id);
        unlink($restaurant->photo->path);
        Photo::destroy($restaurant->photo_id);
        $restaurant->delete();
        return redirect('admin/restaurants')->with('success','Restaurant deleted successfully');
    }
}
