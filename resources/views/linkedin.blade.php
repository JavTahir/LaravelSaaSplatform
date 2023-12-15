<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ route('linkedin.post') }}" method="post">
    @csrf
    <button type="submit">Post to LinkedIn</button>
</form>


</body>
</html>