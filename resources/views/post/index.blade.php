@extends('layouts.app')

@section('content')

    <div class="app-content  my-3 my-md-5">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">პოსტები</div> <br>
                    <a class="btn btn-success" href="{{ route('post.create') }}">დამატება</a>
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
                                    <th>ავტორი</th>
                                    <th>სათაური</th>
                                    <th>კატეგორიები</th>
                                    <th>სტატუსი</th>
                                    @can('Admin')
                                        <th>რედაქტირება</th>
                                        <th>წაშლა</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user->name ?? '' }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            @foreach ($post->categories as $category)
                                                <small>{{ $category->title }}</small><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($post->published == 1)
                                                <button class="btn btn-success">გამოქვეყნებული</button>
                                            @else
                                                <button class="btn btn-danger publishnow" id="{{ $post->id }}">გამოაქვეყნე ! </button>
                                            @endif
                                        </td>
                                        @can('Admin')
                                            <td>
                                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm mb-1">რედაქტირება</a>
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('post.destroy', $post->id) }}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="submit" class="btn btn-danger btn-sm mb-1" value="წაშლა">
                                                </form>
                                            </td>
                                        @endcan
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

@push('js')
    

    @can('Admin')
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <script>
  

                $('.publishnow').click(function(){
                    
                    var id = $(this).attr('id');
                    
                       
                    $(this).removeClass('btn-danger');
                    $(this).removeClass('publishnow');
                    $(this).addClass('btn-success');
                    $(this).html('გამოქვეყნებული');

                    $.ajax({
                        url:"{{ route('postPublish') }}",
                        method:"POST",
                        data:{id:id, _token:$('input[name="_token"]').val()},
                        dataType: "json",
                        success:function(data)
                        {
                       
                        }
                    });

                 

                });

                
            </script> 
    @endcan

@endpush
