<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome, <strong>{{ Auth::user()->name }}</strong>!</p>
        <p>You are successfully logged in.</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background-color: #dc3545;">Logout</button>
        </form>
    </div>
</body>
</html>