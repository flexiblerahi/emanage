<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
        <style>
    /* Some additional custom styling */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: rgb(20, 159, 224)
    }
    .card {
      width: 300px;
    }
  </style>
    </head>
    <body>
        <div class="card">
            <div class="card-header">{{__('Forgot Password')}}</div>

            <div class="card-body">
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
    </body>
</html>