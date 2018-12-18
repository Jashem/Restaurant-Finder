@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-mid-12 col-lg-12">
        <h1 style="text-align: center">Edit Comment</h1>
            <div style="width: 30%; margin: 25px auto;">
            <form action="{{route('comments.update', $comment->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                    <input type="hidden" name="search" value="{{$search}}">
                    <textarea id="body" class="form-control{{ $errors->has('body')? 'is-invalid ' : ''}}" name="body" required autofocus>{{$comment->body}}</textarea>
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('body')}}</strong>
                        </span>
                    </div>					
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">Update!</button>
                    </div>
                </form>
            <a href="{{route('show', ['search'=> $search,'id'=>$comment->restaurant_id])}}">Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection