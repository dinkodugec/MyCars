@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Car</div>
                    <div class="card-body">
                        <form autocomplete="off" action="/car/{{ $car->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- made a hidden input to know that is method PUT --}}

                            <div class="form-group">
                                <label for="name">Manufacturer</label>
                                <input type="text" class="form-control{{ $errors->has('manufacturer') ? ' border-danger' : '' }}" id="name" name="manufacturer" value="{{$car->manufacturer ?? old('manufacturer')}}">
                                <small class="form-text text-danger">{!! $errors->first('manufacturer') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' border-danger' : '' }}" id="name" name="name" value="{{$car->name ?? old('name')}}">
                                <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control{{ $errors->has('description') ? ' border-danger' : '' }}" id="description" name="description" rows="5">{{$car->description ?? old('description')}}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                            </div>

                            @if (file_exists('img/cars/' . $car->id . '_large.jpg'))
                            <div class="mb-2">
                                <img style="max-width: 400px; max-height: 300px;" src="/img/cars/{{ $car->id }}_large.jpg" alt="">
                                <a class="btn btn-outline-danger float-right" href="/delete-car/car/{{ $car->id }}">DELETE IMAGES</a>
                             </a>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="file">Image</label>
                                    <input type="file"
                                           id="image"
                                           name="image"
                                           class="form-control-file{{ $errors->has('image') ? ' border-danger' : '' }}">
                                           <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                              </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Save Car">
                        </form>
                        <a class="btn btn-primary float-right" href="/car"><i class="fas fa-arrow-circle-up"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
