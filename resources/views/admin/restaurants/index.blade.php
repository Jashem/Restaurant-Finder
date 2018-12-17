@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))

    <div class="alert alert-success alert-block">
    
        <button type="button" class="close" data-dismiss="alert">×</button>	
    
        <strong>{{ $message }}</strong>
    
    </div>
    
    @endif

    <div class="card">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Restaurant Details</h3>
        <div class="card-body">
            <span class="table-add float-right mb-3 mr-2"><a class="btn btn-primary" href="{{route('restaurants.create')}}">Add New</a></span>
            <table class="table table-bordered table-responsive-md table-striped text-center table-hover">
                <tr class="text-center">
                    <th scope="col">Id</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    <th scope="col">Actions</th>
                </tr>
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <th scope="row" class="pt-3-half">{{$restaurant->id}}</th>
                        <td class="pt-3-half"><img height='100' src="{{asset($restaurant->photo->path)}}" alt=""></td>
                        <td class="pt-3-half">{{$restaurant->name}}</td>
                        <td class="pt-3-half">{{$restaurant->address}}</td>
                        <td class="pt-3-half">{{$restaurant->contact}}</td>
                        <td class="pt-3-half">{{$restaurant->created_at->diffForHumans()}}</td>
                        <td class="pt-3-half">{{$restaurant->updated_at->diffForHumans()}}</td>
                        <td class="pt-3-half" style='white-space: nowrap'>
                            <div class="btn-group">
                            <a class="btn btn-warning btn-rounded btn-sm my-0" href="{{route('restaurants.edit', $restaurant->id)}}">Edit</a>
                            <form class="delete-form " action="{{route('restaurants.destroy', $restaurant->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ml-1 btn btn-danger btn-rounded btn-sm my-0 float-right" type="submit">Delete</button>
                            </form>
                        </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
    
@endsection