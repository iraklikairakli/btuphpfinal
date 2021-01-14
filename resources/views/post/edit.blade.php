@extends('layouts.app')
@section('content')

<div class="app-content  my-3 my-md-5">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">პოსტის რედაქტირება</h3>
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

                <form action="{{ route('post.update', $post) }}" method="POST">
                    @method("PATCH")
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label text-dark">სათაური</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}" placeholder="სათაური"  autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark">მომხმარებელი</label>
                                <select id="user_id" class="form-control @error('user_id') is-invalid @enderror"  name="user_id" data-live-search="true" >
                                    <option value="">აირჩიეთ</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $post->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark">კატეგორია</label>
                                <select id="categories" class="form-control @error('categories') is-invalid @enderror" name="categories[]" data-live-search="true" multiple required>
                                    @foreach ($categories as $category)
                                            @if (in_array($category->id, $post->categories->pluck('id')->toArray()))
                                                <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endif
                                    @endforeach
                                </select>
                                @error('categories')
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

@push('js')
    <script>
        $(function () {
            $('select').selectpicker();
        });
    </script>
@endpush
