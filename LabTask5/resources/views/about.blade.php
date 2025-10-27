@extends('layouts.app')


@section('title','About — GameHub')


@section('content')
<div class="text-center">
<h2>About GameHub</h2>
<p class="lead">GameHub is a demo frontend built for a Laravel assignment. The site showcases simple navigation and page structure using Blade templates.</p>
</div>


<div class="row mt-4">
<div class="col-md-6">
<h5>Mission</h5>
<p>To present a clean, responsive frontend using Laravel views, routes and a controller.</p>
</div>
<div class="col-md-6">
<h5>What we used</h5>
<ul>
<li>Laravel Blade</li>
<li>Routes & Controller</li>
<li>Bootstrap 5 for styling</li>
</ul>
</div>
</div>
@endsection