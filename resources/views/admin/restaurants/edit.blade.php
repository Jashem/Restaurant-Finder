@extends('layouts.app')

@section('content')

<div class="container">
    @if ($message = Session::get('success'))

    <div class="alert alert-warning alert-block">
    
        <button type="button" class="close" data-dismiss="alert">×</button>	
    
        <strong>{{ $message }}</strong>
    
    </div>
    
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Restaurant Info</div>

                <div class="card-body">
                    <form method="POST" action="{{route('restaurants.update', $restaurant->id)}}"  enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Restaurant Name</label>

                            <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{$errors->has('name')? ' is-invalid' : '' }}" name="name" value="{{$restaurant->name}}" autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{$errors->has('address')? ' is-invalid' : '' }}" name="address" value="{{$restaurant->address}}">
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">Contact Number</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control{{$errors->has('contact')? ' is-invalid' : '' }}" name="contact" value="{{$restaurant->contact}}">
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">Photo</label>

                            <div class="col-md-6">
                                <input id="photo_id" type="file" class="form-control-file{{$errors->has('photo_id')? ' is-invalid' : '' }}" name="photo_id">
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo_id') }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection