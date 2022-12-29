@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">All the Cars</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($cars as $car)
                        <li class="list-group-item">
                          <a title="Show details" href="/car/{{ $car->id }}">  {{ $car->name }}</a>
                          <a class="btn btn-sm btn-light ml-2"  href="/car/{{ $car->id }}/edit">Edit a Car</a>
                          <form class="float-right" style="display: inline" action="/car/{{ $car->id }}" method="post">
                            @csrf
                            @method("DELETE")
                            <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                        </form>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a class="btn btn-success btn-sm" href="/car/create"><i class="fas fa-plus-circle"></i> Create new Car</a>
        </div>
    </div>
</div>
@endsection


