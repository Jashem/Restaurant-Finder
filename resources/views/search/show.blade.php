@extends('layouts.app')

@section('content')

<div class="container">
    @if ($message = Session::get('warning'))

    <div class="alert alert-warning alert-block">
    
        <button type="button" class="close" data-dismiss="alert">×</button>	
    
        <strong>{{ $message }}</strong>
    
    </div>
    
    @endif
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Restaurant Finder</p>
            <form action="{{route('search')}}" method="GET">
                <input type="hidden" name="search" value="{{$search}}">
                <button  class="btn btn-outline-primary btn-block" type="submit">Go Back</button>
            </form>
        </div>
        <div class="col-md-9">
            <div class="img-thumbnail">
                <img class="img-fluid" src="{{asset($restaurant->photo->path)}}">
                <div class="caption-full">
                    <h4><a href="">{{$restaurant->name}}</a></h4>
                    <p>{{$restaurant->address}}</p>
                    <p>
                        <em>{{$restaurant->contact}}</em>
                            
                    </p>
                </div>
            </div>
            <div class="card card-body bg-light">
                <div class="text-right">
                    <a class="btn btn-success" href="{{route('comments.create', $restaurant->id)}}">Add New Comment</a>
                </div>

                @foreach ($restaurant->comments as $comment)
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <strong>{{$comment->user->name}}</strong>
                            <span class="float-right">{{$comment->updated_at->diffForHumans()}}</span>
                            <p>{{$comment->body}}</p>
                            @if ($comment->user_id === Auth::id())
                                <a class="btn btn-sm btn-warning" href="{{route('comments.edit', $comment->id)}}">Edit</a>
                                <form class="delete-form" action="{{route('comments.destroy', $comment->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" name="" class="btn btn-sm btn-danger ml-1" value="Delete">
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection