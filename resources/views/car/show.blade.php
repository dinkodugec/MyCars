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
                        <br>
                        @if($car->tags->count() > 0)
                        <b>Used Tags </b> (Click to remove)
                        <p>
                            @foreach($car->tags as $tag)
                            <a href="/car/{{ $car->id }}}/tag/{{ $tag->id}} }}/detach"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                            @endforeach
                          </p>
                          @endif
                        <br>
                        <p>
                            @if($availableTags->count() > 0)
                            <b>Available Tags </b> (Click to assign)
                            @foreach($availableTags as $tag)
                                <a href="/car/{{ $car->id }}/tag/{{ $tag->id }}/attach"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                            @endforeach
                        </p>
                        @endif
                    </div>
                </div>

               
            </div>
        </div>
    </div>
@endsection
