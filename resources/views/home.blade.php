@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h2>Hello {{ auth()->user()->name }}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @isset($cars)
                    @if ($cars->count() > 0)
                        <h3>Your Cars</h3>
                    @endif
                        <ul class="list-group">
                        @foreach($cars as $car)
                        <li class="list-group-item">
                          <a title="Show details" href="/car/{{ $car->id }}">  {{ $car->name }}</a>

                           @auth
                              <a class="btn btn-sm btn-light ml-2"  href="/car/{{ $car->id }}/edit">Edit a Car</a>
                            @endauth



                            @auth
                                <form class="float-right" style="display: inline" action="/car/{{ $car->id }}" method="post">
                                    @csrf
                                @method("DELETE")
                                    <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                                </form>

                           @endauth


                         <span class=" float-right mx-2">{{ $car->created_at->diffForHumans() }}</span>

                         <br>
                                @foreach($car->tags as $tag)
                                    <a href="/car/tag/{{ $tag->id }}"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a>
                                @endforeach
                        </li>
                    @endforeach
                    </ul>
                    @endisset

                    <a class="btn btn-success btn-sm mt5" href="/car/create"><i class="fas fa-plus-circle"></i> Create new CAR</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


