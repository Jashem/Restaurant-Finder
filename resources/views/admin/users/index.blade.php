@extends('layouts.app')

@section('content')

<div class="container">
    @if ($message = Session::get('warning'))

    <div class="alert alert-warning alert-block">
    
        <button type="button" class="close" data-dismiss="alert">×</button>	
    
        <strong>{{ $message }}</strong>
    
    </div>
    
    @endif
    <div class="card">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Registered Users</h3>
        <div class="card-body">
            <table class="table table-bordered table-responsive-md table-striped text-center table-hover">
                <tr class="text-center">
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Type</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row" class="pt-3-half">{{$user->id}}</th>
                        <td class="pt-3-half">{{$user->name}}</td>
                        <td class="pt-3-half">{{$user->email}}</td>
                        <td class="pt-3-half">{{$user->role->name}}</td>
                        <td class="pt-3-half">{{$user->created_at->diffForHumans()}}</td>
                        <td class="pt-3-half">{{$user->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div> 
</div>

@endsection