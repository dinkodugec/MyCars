@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Hobby Detail</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <b>{{$car->name}}</b>
                                <p>{{$car->description}}</p>
                                @if($car->tags->count() > 0)
                                    <b>Used Tags:</b> (Click to remove)
                                    <p>
                                        @foreach($car->tags as $tag)
                                            <a href="/car/{{$car->id}}/tag/{{$tag->id}}/detach"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                        @endforeach
                                    </p>
                                @endif

                                @if($availableTags->count() > 0)
                                    <b>Available Tags:</b> (Click to assign)
                                    <p>
                                        @foreach($availableTags as $tag)
                                            <a href="/car/{{$car->id}}/tag/{{$tag->id}}/attach"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if (Auth::user() && file_exists('img/cars/' . $car->id . '_large.jpg'))
                                <a href="/img/cars/{{$car->id}}_large.jpg" data-lightbox="img/cars/{{$car->id}}_large.jpg" data-title="{{ $car->name }}">
                                    <img class="img-fluid" src="/img/cars/{{$car->id}}_large.jpg" alt="">
                                </a>
                                <i class="fa fa-search-plus"></i> Click image to enlarge
                                @endif
                                @if (!Auth::user() && file_exists('img/cars/' . $car->id . '_pixelated.jpg'))
                                   <img class="img-fluid" src="/img/cars/{{$car->id}}_pixelated.jpg" alt="">
                                </a>
                               @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="mt-2">
                    <a class="btn btn-primary btn-sm" href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-up"></i> Back to Overview</a>
                </div>
                -->
            </div>
        </div>
    </div>
@endsection
