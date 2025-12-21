<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>
    <h2>Hello, {{ $user->name }}</h2>
    <p>Please click the link below to verify your email address:</p>
    <a href="{{ url('/verify/' . $user->id) }}">Verify My Account</a>
</body>
</html>