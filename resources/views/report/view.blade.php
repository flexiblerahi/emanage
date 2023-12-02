
<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    @include('report.css')
</head>

<body class="m-2 border p-3">
    @include('report.heading')
    @include($page)
</body>
</html>