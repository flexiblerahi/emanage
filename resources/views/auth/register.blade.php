@extends('auth.home')
@section('content')
    <div class="card" style="width: 50rem;">
        <div class="card-header">{{ __('Create an Account!') }}</div>
        <div class="card-body" >
           
            <form class="user" method="POST" action="{{route('registration')}}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" required id="name" name="name" placeholder="Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="account_id" name="account_id" placeholder="Account Number">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" required id="phone" name="phone" placeholder="Phone Number">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" required id="email" name="email" placeholder="Email Address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" required name="password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" required id="confirm_password"
                            name="confirm_password" placeholder="Confirm Password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Register Account
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
            </div>
            <div class="text-center">
                <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
            </div>
        </div>
    </div>
@endsection