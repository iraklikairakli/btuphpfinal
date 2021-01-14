@extends('layouts.app')

@section('content')

<div class="app-content  my-3 my-md-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">კატეგორიის რედაქტირება</h3>
            </div>

            <div class="card-body">

                @if (\Session::has('Error'))
                    <div class="alert alert-danger">
                        {!! \Session::get('Error') !!}
                    </div>
                @endif

                @if (\Session::has('Success'))
                    <div class="alert alert-success">
                        {!! \Session::get('Success') !!}
                    </div>
                @endif

                <form action="{{ route('category.update', $category) }}" method="POST">
                    @method("PATCH")
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label text-dark">კატეგორია</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $category->title }}" placeholder="კატეგორია"  autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">რედაქტირება</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    
</div>

@endsection

