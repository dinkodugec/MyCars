@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">

                    @isset($filter)
                        <div class="card-header">Filtered hobbies by
                            <span style="font-size: 130%;" class="badge badge-{{ $filter->style }}">{{ $filter->name }}</span>
                            <span class="float-right"><a href="/car">Show all CARS</a></span>
                        </div>
                    @else
                        <div class="card-header">All the Cars</div>
                    @endisset

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($cars as $car)
                                <li class="list-group-item">
                                    <a title="Show Details" href="/car/{{ $car->id }}">
                                        <img src="/img/thumb_landscape.jpg" alt="thumb">
                                        {{ $car->name }}
                                    </a>
                                    @auth
                                    <a class="btn btn-sm btn-light ml-2" href="/car/{{ $car->id }}/edit"><i class="fas fa-edit"></i> Edit CAr</a>
                                    @endauth
                                    <span class="mx-2">Posted by: <a href="/user/{{ $car->user->id }}">{{ $car->user->name }} ({{ $car->user->cars->count() }} Cars)</a>
                                    <a href="/user/{{ $car->user->id }}"><img class="rounded" src="/img/thumb_portrait.jpg"></a>
                                    </span>
                                    @auth
                                    <form class="float-right" style="display: inline" action="/car/{{ $car->id }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                                    </form>
                                    @endauth
                                    <span class="float-right mx-2">{{ $car->created_at->diffForHumans() }}</span>
                                    <br>
                                    @foreach($car->tags as $tag)
                                        <a href="/car/tag/{{ $tag->id }}"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $cars->links() }}
                </div>
                @auth
                <div class="mt-2">
                    <a class="btn btn-success btn-sm" href="/car/create"><i class="fas fa-plus-circle"></i> Create new CAR</a>
                </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
