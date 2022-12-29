@extends('layouts.app')

@section('content')

<main class="py-4">

    @isset($message_success)
        <div class="container">
            <div class="alert alert-success" role="alert">
                {{  $message_success }}
            </div>
        </div>
    @endisset

    @isset($message_warning)
    <div class="container">
        <div class="alert alert-warning" role="alert">
            {{  $message_warning  }}
        </div>
    </div>
@endisset


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
                    <div class="card-header">Create New Tag</div>
                    <div class="card-body">
                        <form action="/tag" method="post">
                            @csrf


                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" >
                                <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Slug</label>
                                <textarea class="form-control{{ $errors->has('slug') ? ' border-danger' : '' }}" id="description" name="slug" rows="5">{{old('slug')}}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('slug') !!}</small>
                            </div>


                            <input class="btn btn-primary mt-4" type="submit" value="Save Tag">
                        </form>
                        <a class="btn btn-primary float-right" href="/tag"><i class="fas fa-arrow-circle-up"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
