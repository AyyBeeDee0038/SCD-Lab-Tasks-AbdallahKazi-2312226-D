<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Event Planner')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* simple base styles */
        body { font-family: Arial, sans-serif; margin: 20px; background:#f7f7f7; color:#222; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 18px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.06); }
        header { display:flex; justify-content:space-between; align-items:center; margin-bottom: 18px; }
        nav a { margin-right: 12px; text-decoration:none; color:#333; }
        table { width:100%; border-collapse: collapse; margin-top: 12px; }
        th, td { padding:8px 10px; border-bottom: 1px solid #eee; text-align:left; }
        .status-upcoming { color: #0066cc; font-weight:600; }
        .status-ongoing { color: #28a745; font-weight:600; }
        .status-completed { color: #888; font-weight:600; }
        .error { color: #b00020; margin-bottom: 10px; }
        .success { color: #0b6623; margin-bottom: 10px; }
    </style>

    @stack('styles')
</head>
<body>
    <div class="container">
        <header>
            <h1>@yield('header', 'Event Planner System')</h1>
            <nav>
                <a href="{{ url('/') }}">Events</a>
                <a href="{{ route('events.create') }}">Create Event</a>
            </nav>
        </header>

        @yield('content')

        <footer style="margin-top:18px; font-size:13px; color:#666;">
            &copy; {{ date('Y') }} Event Planner System — LabTask6
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
