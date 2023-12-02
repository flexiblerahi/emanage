@extends('home')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        @push('style')
                            <style>
                                .bg-login-image{
                                    background:url("");
                                    background-position:center;
                                    background-size:cover
                                }
                            </style>
                        @endpush
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{__('Forgot Password')}}</h1>
                                    </div>
                                    <form action="{{ route('password.update') }}" method="POST" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email" aria-describedby="emailHelp"
                                                placeholder="{{__('Enter Email Address')}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">{{__("Submit")}}</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{route('login')}}">{{__("Login")}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection