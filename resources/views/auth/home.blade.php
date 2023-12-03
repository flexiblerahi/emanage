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
        @yield('content')
    </body>
</html>