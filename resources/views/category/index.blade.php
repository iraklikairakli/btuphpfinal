@extends('layouts.app')

@section('content')

    <div class="app-content  my-3 my-md-5">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">კატეგორიები</div> <br>
                    <a class="btn btn-success" href="{{ route('category.create') }}">დამატება</a>
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

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>სათაური</th>
                                    <th>რედაქტირება</th>
                                    <th>წაშლა</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm mb-1">რედაქტირება</a>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                                                @csrf
                                                @method("DELETE")
                                                <input type="submit" class="btn btn-danger btn-sm mb-1" value="წაშლა">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
