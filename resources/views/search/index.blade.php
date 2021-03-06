@extends('layouts.app')

@section('content')

<div class="container">
	<header class="jumbotron">
		<div class="container">
			<h1>Welcome To Restaurant Finder!</h1>
			<p>To add your restaurant please contact us</p>
			<p>
				<a class="btn btn-primary btn-lg" href="/campgrounds/new">Contact</a>
			</p>
		</div>
	</header>

	<div class="row text-center list">

        @foreach ($restaurants as $restaurant)
            <div class="col-lg-3 col-md-4 col-xs-6 list-item">
                <div class="img-thumbnail">
                    <img src="{{asset($restaurant->photo->path)}}" class="img-fluid" alt="Responsive image">
                    <div class="caption">
                        <h4>{{$restaurant->name}}</h4>
					</div>
                    <p><a href="{{route('show',['search'=>app('request')->input('search'),'id'=>$restaurant->id])}}" class="btn btn-primary">More Info</a></p>
                </div>
            </div>
            
        @endforeach
	</div>
</div>

@endsection