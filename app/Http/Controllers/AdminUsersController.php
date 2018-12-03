<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminUsersController extends Controller
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
            $users = User::all();
            return view('admin.users.index',compact('users'));
        } else{
            return redirect()->route("home")->with("warning","You need to be admin to do that");
        }
        
    }

}
