
@extends('auth.home')
@section('content')
@include('sweetalert::alert')

<div class="card">
    <div class="card-header">{{__('Forgot Password')}}</div>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" aria-describedby="emailHelp"
                placeholder="{{__('Enter Email Address')}}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">{{__("Submit")}}</button>
            <div class="text-center">
                <a class="text-info mediam" href="{{route('login')}}">{{__("Login")}}</a>
            </div>
        </form>
    </div>
</div>
@endsection