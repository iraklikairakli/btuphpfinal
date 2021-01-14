@extends('layouts.app')
@section('content')

    <div class="app-content  my-3 my-md-5">
       
        <div class="col-md-12 col-lg-12 col-xl-12">

            <div class="text-center">
                თქვენ ავტორიზაცია გაიარეთ როგორც : {{ Auth::user()->role == "admin" ? 'ადმინმა' : 'მომხმარებელმა' }}
            </div>
            
        </div>

    </div>

@endsection
