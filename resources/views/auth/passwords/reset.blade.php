@extends('auth.home')
@section('content')
@include('sweetalert::alert')
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 font-weight-bold mb-4">Reset Password</h1>
                </div>
                <form action="{{route('password.update')}}" method="post" class="user">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus> --}}
                        <input type="hidden" id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" name="email" value="{{ $email ?? old('email') }}" aria-describedby="emailHelp" required autocomplete="email" autofocus placeholder="Enter Email Address...">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                                        
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span pan>
                            @enderror     
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" id="password" placeholder="Confirm Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span pan>
                            @enderror     
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                </form>
            </div>
        </div>
@endsection