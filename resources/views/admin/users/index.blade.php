@extends('layouts.app')

@section('content')

<div class="container">
    @if ($message = Session::get('warning'))

    <div class="alert alert-warning alert-block">
    
        <button type="button" class="close" data-dismiss="alert">×</button>	
    
        <strong>{{ $message }}</strong>
    
    </div>
    
    @endif
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Type</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        
        </tbody>
    </table> 
</div>

@endsection