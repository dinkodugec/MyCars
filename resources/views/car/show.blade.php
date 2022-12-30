@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Car Detail</div>

                    <div class="card-body">
                        <b>{{$car->name}}</b>
                        <p>{{$car->manufacturer}}</p>
                        <p>{{$car->description}}</p>
                    </div>
                </div>

                <div class="mt-2">
                    <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Back to Overview</a>
                </div>
            </div>
        </div>
    </div>
@endsection
