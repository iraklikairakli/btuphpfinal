@extends('layouts.auth_app')
@section('content')

	<!--Page-->
    <div class="page  h-100">
        <div class="page-content z-index-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-12 col-md-12 d-block mx-auto">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h3 class="card-title">რეგისტრაცია</h3>
                            </div>


                            <form  method="POST" action="{{ route('register') }}" class="mt-4">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="form-label text-dark">თქვენი სახელი</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="თქვენი სახელი" required >

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-dark">თქვენი ელექტორნული ფოსტა</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="თქვენი ელექტორნული ფოსტა" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-dark">თქვენი პაროლი</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="ჩაწერეთ პაროლი" required autocomplete="ჩაწერეთ პაროლი">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-dark">გაიმეორეთ თქვენი პაროლი</label>
                                        <input id="password-confirm"  type="password" class="form-control" name="password_confirmation" placeholder="გაიმეორეთ ჩაწერეთ პაროლი" required >

                                     
                                    </div>
                                    <div class="form-footer mt-2">
                                        <button class="btn btn-primary btn-block" type="submit">რეგისტრაცია</button>
                                    </div>


                                    <div class="col text-center mt-2">
                                        <p>უკვე გაქვთ ანგარიში? <a href="{{ route('login') }}" class="text-danger">ავტორიზაცია</a></p>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
