@extends('auth.home')
@section('content')
@include('sweetalert::alert')

<div class="card">
    <div class="card-body">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
        </div>
        <form action="{{route('login.check')}}" method="post" class="user">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                                        
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                    name="password" id="password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span pan>
                    @enderror     
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">{{__("Login")}}</button>
        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
        <div class="text-center">
            <a class="small" href="{{route('register')}}">Create an Account!</a>
        </div>
    </div>
</div>
@endsection