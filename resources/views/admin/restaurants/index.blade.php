@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))

    <div class="alert alert-success alert-block">
    
        <button type="button" class="close" data-dismiss="alert">×</button>	
    
        <strong>{{ $message }}</strong>
    
    </div>
    
    @endif
    <div class="row">
        <div class="col-sm-11"><h2>Restaurant Details</h2></div>
        <div class="col-sm-1">
            <a class="btn btn-primary" href="{{route('restaurants.create')}}">Add New</a>
        </div>
    </div>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Contact</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($restaurants as $restaurant)
                <tr>
                <th scope="row">{{$restaurant->id}}</th>
                    <td><img height="100" src="{{asset($restaurant->photo->path)}}" alt=""></td>
                    <td>{{$restaurant->name}}</td>
                    <td>{{$restaurant->address}}</td>
                    <td>{{$restaurant->contact}}</td>
                    <td>{{$restaurant->created_at->diffForHumans()}}</td>
                    <td>{{$restaurant->updated_at->diffForHumans()}}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{route('restaurants.edit', $restaurant->id)}}">Edit</a>
                        <form class="delete-form" action="{{route('restaurants.destroy', $restaurant->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="ml-1 btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        
        </tbody>
    </table> 
</div>
    
@endsection