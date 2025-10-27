@extends('layouts.app')


@section('title', 'Home — GameHub')


@section('content')
<div class="row align-items-center">
<div class="col-md-6">
<h1 class="display-5">Welcome to GameHub</h1>
<p class="lead">Discover trending games, read news and connect with fellow gamers. This is a frontend-only demo for your Laravel assignment.</p>
<a href="{{ route('about') }}" class="btn btn-primary me-2">Learn more</a>
<a href="{{ route('contact') }}" class="btn btn-outline-light">Contact Us</a>
</div>
<div class="col-md-6 text-center">
<img src="{{ asset('images/banner.png') }}" alt="gaming" class="img-fluid rounded shadow-lg">
</div>
</div>


<hr class="my-5">


<div class="row">
<div class="col-md-4">
<div class="card h-100">
<div class="card-body">
<h5 class="card-title">Latest Releases</h5>
<p class="card-text">Short blurbs about new games and releases.</p>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card h-100">
<div class="card-body">
<h5 class="card-title">Top Streamers</h5>
<p class="card-text">Profiles, clips, and highlights (placeholder content).</p>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card h-100">
<div class="card-body">
<h5 class="card-title">Guides & Tips</h5>
<p class="card-text">Short guides for beginners and advanced players.</p>
</div>
</div>
</div>
</div>
@endsection