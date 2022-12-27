@extends('layouts.app')

@section('content')

<main class="py-4">
    @if($errors->any())
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @yield('content')
</main>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Car</div>
                    <div class="card-body">
                        <form action="/car" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">Manufacturer</label>
                                <input type="text" class="form-control" id="name" name="manufacturer" value="{{ old('manufacturer') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description"  value="{{ old('description') }}" name="description" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="file">Image</label>
                                    <input type="file"
                                           name="image"
                                           class="form-control-file">
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
