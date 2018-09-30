<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Member</title>
</head>
<body>
    <h1>Welcome {{ $user->name }}</h1>
    <h3>Your account information:</h3>
    <p>Email: {{ $user->email }}</p>
    <p>password: {{ $password }}</p>
    <p>please click this link to activate your account</p>
    <a href="http://localhost:8000/members/activate/{{ $user->token }}">click here</a>

</body>
</html>